<?php

namespace App\Http\Controllers;

use App\Airport;
use App\Fleet;
use App\Routes;
use App\Schedules;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $recieved=Schedules::select('recieved','date')->orderBy('date','asc')->whereNotNull('recieved');
        $netcost=Schedules::select('netcost','date')->orderBy('date','asc')->whereNotNull('netcost');

        if($request->type>=0 && $request->type<3){
            if($request->type==0){
                if($recieved->whereDate('date', '=', Carbon::now())->count()>0){
                    $recieved=$recieved->whereDate('date', '=', Carbon::now())->whereTime('time','<=',Carbon::now())->get()
                    ->groupBy(function($date) {
                        return Carbon::parse($date->time)->format('g A');
                    });
                    $netcost=$netcost->whereDate('date', '=', Carbon::now())->whereTime('time','<=',Carbon::now())->get()
                    ->groupBy(function($date) {
                        return Carbon::parse($date->time)->format('g A');
                    });
                }
                else{
                    $recieved=null;
                    $netcost=null;
                }
            }
            else if($request->type==1){
                if($recieved->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count()>0){

                    $recieved=$recieved->whereBetween('date', [Carbon::now()->subDays(7), Carbon::now()])->get()
                    ->groupBy(function($date) {
                        return Carbon::parse($date->date)->format('D');
                    });
                    $netcost=$netcost->whereBetween('date', [Carbon::now()->subDays(7), Carbon::now()])->get()
                    ->groupBy(function($date) {
                        return Carbon::parse($date->date)->format('D');
                    });

                }
                else{
                    $recieved=null;
                    $netcost=null;
                }
            }

            else if($request->type==2){

                if($netcost->whereMonth('date', '>=', Carbon::now()->month)->count()>0){
                    $netcost=$netcost->whereMonth('date', '>=', Carbon::now()->month)->get()
                    ->groupBy(function($date) {
                        return Carbon::parse($date->date)->format('d/m/y');
                    });
                    $recieved=$recieved->whereMonth('date', '>=', Carbon::now()->month)->get()
                    ->groupBy(function($date) {
                        return Carbon::parse($date->date)->format('d/m/y');
                    });
                }
                else{
                    $recieved=null;
                    $netcost=null;
                }
            }
        }
        else{
            if($recieved->whereDate('date', '=', Carbon::now())->count()>0){
                $recieved=$recieved->whereDate('date', '=', Carbon::now())->get()
                ->groupBy(function($date) {
                    return Carbon::parse($date->time)->format('g A');
                });
                $netcost=$netcost->whereDate('date', '=', Carbon::now())->get()
                ->groupBy(function($date) {
                    return Carbon::parse($date->time)->format('g A');
                });
            }
            else{
                $recieved=null;
                $netcost=null;
            }

        }

        $airport=Airport::select('name','gndcost')->get();
        $flight=Fleet::select('status',DB::raw('count(*) as total'))->orderBy('status')->groupBy('status')->get();
        $tf=Fleet::count();
        $todaySchedult=Schedules::whereDate('date',date('Y-m-d'))->whereTime('time','>=',date('H:i:s'))->count();
        return view('home',['recieved'=>$recieved,'netcost'=>$netcost,'tf'=>$tf,'airport'=>$airport,'flight'=>$flight,'todaySchedult'=>$todaySchedult]);
    }
}
