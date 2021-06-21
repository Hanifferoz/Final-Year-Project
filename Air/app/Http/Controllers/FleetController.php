<?php

namespace App\Http\Controllers;

use App\Fleet;
use App\FlightGroup;
use Illuminate\Http\Request;

use Validator;
use Illuminate\Contracts\Encryption\DecryptException;

class FleetController extends Controller
{
    public function index(Request $request)
    {
        $data=Fleet::select('name','code','id','status','curstatus')->orderBy('id','desc');
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
        return view('Fleet/list',['data'=>$data]);
    }
    public function create()
    {
        $fleet=FlightGroup::select('name','id')->get();
        return view('Fleet/add',['fleet'=>$fleet]);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name' => 'required',
            'code' => 'required|unique:fleets,code',
            'seats' => 'required|integer',
            'status' => 'required',
            'curstatus' => 'required',
        ],[
            'name.required'=>'Fleet Name is required',
            'code.required'=>'Fleet Code is required',
            'code.unique'=>'Sorry Code already taken',
            'seats.required'=>'Fleet Code is required',
            'seats.integer'=>'Enter a valid seat number',
            'status.required'=>'Fleet Code is required',
            'curstatus.required'=>'Fleet Code is required',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }
        $data=new Fleet;
        $data->name=$request->name;
        $data->code=$request->code;
        $data->fid=$request->fid;
        $data->seats=$request->seats;
        $data->curstatus=$request->curstatus;
        $data->status=$request->status;
        $data->save();
        $request->session()->flash('status', 'Added Successfully');
        return redirect('/fleet');
    }

     public function show($id,Request $request)
    {
        try {
            $data=Fleet::find(decrypt($id));
            // return $data;
            return view('Fleet/view',['data'=>$data]);
        }
        catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page.');
        }
        return redirect('/fleet');
    }

    public function edit($id,Request $request)
    {
        try {
            $data=Fleet::find(decrypt($id));
            $fleet=FlightGroup::select('name','id')->get();
            return view('Fleet/edit',['fleet'=>$fleet,'data'=>$data]);
        }
        catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page.');
        }
        return redirect('/fleet');
    }

    public function update(Request $request,$id)
    {

        try {
            $validate = Validator::make($request->all(),[
                'name' => 'required',
                'code' => 'required',
            ],[
                'name.required'=>'Fleet Name is required',
                'code.required'=>'Fleet Code is required',
                'code.unique'=>'Sorry Code already taken',
            ]);
            if ($validate->fails()) {
                return back()->withInput()->withErrors($validate);
            }

            $data=Fleet::find(decrypt($id));
            $data->name=$request->name;
            $data->code=$request->code;
            $data->fid=$request->fid;
            $data->seats=$request->seats;
            $data->curstatus=$request->curstatus;
            $data->status=$request->status;
            $data->save();
            $request->session()->flash('status', 'Edited Successfully');
            return redirect('/fleet/view/'.$id);
        }
        catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page.Wrong Data ');
        }
        return redirect('/fleet');
    }

    public function destroy($id,Request $request)
    {
        try {
            $data=Fleet::find(decrypt($id))->delete();
            $request->session()->flash('status', 'Deleted Successfully.');
        }
        catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page.');
        }
        return redirect('/fleet');
    }
}
