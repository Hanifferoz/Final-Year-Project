<?php

namespace App\Http\Controllers;

use App\Airport;
use App\Fleet;
use App\Routes;
use App\Schedules;
use Illuminate\Http\Request;

use Validator;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Routing\Route;

class SchedulesController extends Controller
{
    public function index(Request $request)
    {
        $data=Schedules::select('rid','fid','id','time','date','status')->orderBy('id','desc');
        // return $request;
        if($request->fleet){
            $fid=Fleet::where('name','LIKE','%'.$request->fleet)->orWhere('code','LIKE','%'.$request->fleet)->pluck('id');
            $data=$data->whereIn('fid',$fid);
        }
        if($request->airport){
            $aid=Airport::where('name','LIKE','%'.$request->airport.'%')->orWhere('code','LIKE','%'.$request->airport.'%')->pluck('id');
            $rid=Routes::whereIn('fid',$aid)->orWhere('tid',$aid)->pluck('id');
            $data=$data->whereIn('rid',$rid);
        }
        if($request->status && $request->status>=0 && $request->status<3){
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
        return view('Schedules/list',['data'=>$data]);
    }
    public function create()
    {
        $fleet=Fleet::select('name','id')->get();
        $routes=Routes::select('fid','tid','id')->get();
        return view('Schedules/add',['routes'=>$routes,'fleet'=>$fleet]);
    }

    public function store(Request $request)
    {
        // return $request;
        $validate = Validator::make($request->all(),[
            'fid' => 'required|integer',
            'rid' => 'required|integer',
            'fare' => 'required|integer',
            'date' => 'required|date',
            'time' => 'required',
        ],[
            'fid.required'=>'Flight is required',
            'rid.required'=>'Routes is required',
            'fare.required'=>'Fare is required',
            'time.required'=>'Time is required',
            'date.required'=>'Date is required',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }
        $data=new Schedules;
        $data->fid=$request->fid;
        $data->rid=$request->rid;
        $data->fare=$request->fare;
        $data->time=$request->time;
        $data->date=$request->date;
        $data->save();
        $request->session()->flash('status', 'Added Successfully');
        return redirect('/schedules');
    }

     public function show($id,Request $request)
    {
        try {
            $data=Schedules::find(decrypt($id));
            return view('Schedules/view',['data'=>$data]);
        }
        catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page.');
        }
        return redirect('/routes');
    }

    public function edit($id,Request $request)
    {
        try {
            $data=Schedules::find(decrypt($id));
            $airport=Airport::select('name','id','code')->get();
            return view('Schedules/edit',['airport'=>$airport,'data'=>$data]);
        }
        catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page.');
        }
        return redirect('/routes');
    }

    public function update(Request $request,$id)
    {

        try {
            $validate = Validator::make($request->all(),[
                'seats' => 'required|integer',
                'date' => 'required|date',
                'status' => 'nullable',
                'time' => 'nullable',
                'netcost' => 'nullable|integer',
                'desc' => 'nullable',
                'recieved' => 'nullable|integer',
            ],[
                'seats.required'=>'Seat is required',
                'seats.integer'=>'Enter a Valid Seat',
                'date.required'=>'Arrival Date is required',
                'date.date'=>'Enter a Valid Date',
                'status.required'=>'Status is required',
                'time.required'=>'Time is required',
                'netcost.required'=>'Enter Net Cost',
                'recieved.required'=>'Enter a Valid Amount Recieved',
            ]);
            if ($validate->fails()) {
                return back()->withInput()->withErrors($validate);
            }
            $data=Schedules::find(decrypt($id));
            $data->desc=$request->desc;
            $data->seats=$request->seats;
            $data->date=$request->date;
            $data->time=$request->time;
            $data->status=$request->status;
            $data->recieved=$request->recieved;
            $data->sttype=$request->sttype;
            $data->netcost=$request->netcost;
            $data->save();
            $request->session()->flash('status', 'Edited Successfully');
            return redirect('/schedules/view/'.$id);
        }
        catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page.Wrong Data ');
        }
        return redirect('/routes');
    }

    public function destroy($id,Request $request)
    {
        try {
            $data=Schedules::find(decrypt($id))->delete();
            $request->session()->flash('status', 'Deleted Successfully.');
        }
        catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page.');
        }
        return redirect('/routes');
    }
}
