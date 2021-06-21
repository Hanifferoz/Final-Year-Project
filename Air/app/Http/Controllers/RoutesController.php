<?php

namespace App\Http\Controllers;

use App\Airport;
use App\Routes;
use Illuminate\Http\Request;


use Validator;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Http;

class RoutesController extends Controller
{
    public function index(Request $request)
    {
        $data=Routes::select('tid','fid','id')->orderBy('id','desc');
        if($request->name){
            $data=$data->where('name','LIKE','%'.$request->name);
        }
        if($request->code){
            $data=$data->where('code','LIKE','%'.$request->code);
        }

        if($request->status && $request->status>=0 && $request->status<2){
            $data=$data->where('status',$request->status);
        }
        if($request->ordid && $request->ordid>=0 && $request->ordid<2){
            if($request->ordid==0){
                $data=$data->orderBy('created_at','asc');
            }
            else{
                $data=$data->orderBy('created_at','desc');
            }
        }
        $data=$data->paginate(20);
        return view('Routes/list',['data'=>$data]);
    }
    public function create()
    {
        // $fleet=Fleet::select('name','id')->get();
        $airport=Airport::select('name','id','code')->get();
        return view('Routes/add',['airport'=>$airport]);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'fid' => 'required|integer',
            'tid' => 'required|integer',
            'distance' => 'required|integer',
            'netmaincost' => 'required|integer',
            'travelcost' => 'required|integer',
        ],[
            'fid.required'=>'From Airport is required',
            'tid.required'=>'To Airport is required',
            'distance.required'=>'Distance is required',
            'distance.integer'=>'Enter a Valid Distance',
            'netmaincost.required'=>'Net Main Cost is required',
            'netmaincost.integer'=>'Enter a Valid Net Main Cost',
            'travelcost.required'=>'Travel Cost is required',
            'travelcost.integer'=>'Enter a Valid Travel Cost',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }
        if(Routes::where('fid',$request->fid)->where('tid',$request->tid)->count()>0){
            return back()->withInput()->withErrors(['tid'=>'Sorry Route already Exists']);
        }
        $data=new Routes;
        $data->fid=$request->fid;
        $data->tid=$request->tid;
        $data->distance=$request->distance;
        $data->netmaincost=$request->netmaincost;
        $data->travelcost=$request->travelcost;
        $data->save();
        $request->session()->flash('status', 'Added Successfully');
        return redirect('/routes');
    }

     public function show($id,Request $request)
    {
        try {
            $data=Routes::find(decrypt($id));
            $dat=[];
            $date=[];
            for($i=-2;$i<5;$i++){
                $day=date('w',strtotime($i.' days'));
                array_push($date,date('d-m',strtotime($i.' days')));
                $x=[$data->fid,$data->tid,$day+1,date('m',strtotime($i.' days')),($day==0 || $day=1)?1:0,$data->distance,$data->travelcost,$data->Tid->gndcost+$data->Fid->gndcost];
                array_push($dat,$x);
            }
            // return $dat;
            $responsex = Http::post('127.0.0.1:5000/predicts', [
                'dat' => $dat
            ]);
            $prate= $responsex->body();

            // return $prate;
            return view('Routes/view',['data'=>$data,'prate'=>$prate,'date'=>$date]);
        }
        catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page.');
        }
        return redirect('/routes');
    }

    public function edit($id,Request $request)
    {
        try {
            $data=Routes::find(decrypt($id));
            $airport=Airport::select('name','id','code')->get();
            return view('Routes/edit',['airport'=>$airport,'data'=>$data]);
        }
        catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page.');
        }
        return redirect('/routes');
    }

    public function update(Request $request,$id)
    {
        // return $request;

        try {
            $validate = Validator::make($request->all(),[
                'fid' => 'required|integer',
                'tid' => 'required|integer',
                'distance' => 'required|integer',
                'netmaincost' => 'required|integer',
                'travelcost' => 'required|integer',
            ],[
                'fid.required'=>'From Airport is required',
                'tid.required'=>'To Airport is required',
                'distance.required'=>'Distance is required',
                'distance.integer'=>'Enter a Valid Distance',
                'netmaincost.required'=>'Net Main Cost is required',
                'netmaincost.integer'=>'Enter a Valid Net Main Cost',
                'travelcost.required'=>'Travel Cost is required',
                'travelcost.integer'=>'Enter a Valid Travel Cost',
            ]);
            if ($validate->fails()) {
                return back()->withInput()->withErrors($validate);
            }
            $data=Routes::find(decrypt($id));
            $data->fid=$request->fid;
            $data->tid=$request->tid;
            $data->distance=$request->distance;
            $data->netmaincost=$request->netmaincost;
            $data->travelcost=$request->travelcost;
            $data->save();
            $request->session()->flash('status', 'Edited Successfully');
            return redirect('/routes/view/'.$id);
        }
        catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page.Wrong Data ');
        }
        return redirect('/routes');
    }

    public function destroy($id,Request $request)
    {
        try {
            $data=Routes::find(decrypt($id))->delete();
            $request->session()->flash('status', 'Deleted Successfully.');
        }
        catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page.');
        }
        return redirect('/routes');
    }

}
