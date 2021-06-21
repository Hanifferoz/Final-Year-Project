<?php

namespace App\Http\Controllers;

use App\Airport;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Phpml\Dataset\ArrayDataset;



use Phpml\Classification\KNearestNeighbors;
use Phpml\Dataset\CsvDataset;

class PredictCont extends Controller
{
    public function predict(Request $request){
        $airport=Airport::select('id','name','code')->get();
        return view('predict',['airport'=>$airport]);
    }
    public function test(Request $request){
        $from=Airport::find($request->fid);
        $to=Airport::find($request->tid);
        $dat=[];
        $date=[];
        for($i=-2;$i<5;$i++){
            $day=date('w',strtotime($request->date.$i.' days'));
            array_push($date,date('d-m',strtotime($request->date.$i.' days')));
            $x=[$from->id,$to->id,$day+1,date('m',strtotime($request->date.$i.' days')),($day==0 || $day=1)?1:0,$request->distance,$request->fuelcost,$from->gndcost+$to->gndcost];
            array_push($dat,$x);
        }

        $responsex = Http::post('127.0.0.1:5000/predicts', [
            'dat' => $dat
        ]);
        $prate= $responsex->json();
        return view('predicts',['to'=>$to,'distance'=>$request->distance,'fuelcost'=>$request->fuelcost,'from'=>$from,'prate'=>$prate,'date'=>$date]);

    }
}
