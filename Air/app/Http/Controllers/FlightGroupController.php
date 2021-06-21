<?php

namespace App\Http\Controllers;

use App\FlightGroup;
use Illuminate\Http\Request;

use Validator;
use Illuminate\Contracts\Encryption\DecryptException;
class FlightGroupController extends Controller
{
    public function index(Request $request)
    {
        $data=FlightGroup::select('name','code','id')->orderBy('id','desc');
        if($request->name){
            $data=$data->where('name','LIKE','%'.$request->name);
        }
        if($request->code){
            $data=$data->where('code','LIKE','%'.$request->code);
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
        return view('FlightGroup/list',['data'=>$data]);
    }
    public function create()
    {
        return view('FlightGroup/add');
    }

    public function store(Request $request)
    {
        // return $request;
        $validate = Validator::make($request->all(),[
            'name' => 'required',
            'code' => 'required|unique:flight_groups,code',
        ],[
            'name.required'=>'Name is required',
            'code.required'=>'Code is required',
            'code.unique'=>'Sorry Code already taken',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }
        $data=new FlightGroup;
        $data->name=$request->name;
        $data->code=$request->code;
        $data->save();
        $request->session()->flash('status', 'Added Successfully');
        return redirect('/flightgroup');
    }

     public function show($id,Request $request)
    {
        try {
            $data=FlightGroup::find(decrypt($id));
            return view('FlightGroup/view',['data'=>$data]);
        }
        catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page.');
        }
        return redirect('/flightgroup');
    }

    public function edit($id,Request $request)
    {
        try {
            $data=FlightGroup::find(decrypt($id));
            return view('FlightGroup/edit',['data'=>$data]);
        }
        catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page.');
        }
        return redirect('/flightgroup');
    }

    public function update(Request $request,$id)
    {

        try {
            $validate = Validator::make($request->all(),[
                'name' => 'required',
                'code' => 'required',
            ],[
                'name.required'=>'Name is required',
                'code.required'=>'Code is required',
            ]);
            if ($validate->fails()) {
                return back()->withInput()->withErrors($validate);
            }

            $data=FlightGroup::find(decrypt($id));
            $data->name=$request->name;
            $data->code=$request->code;
            $data->save();
            $request->session()->flash('status', 'Edited Successfully');
            return redirect('/flightgroup');
        }
        catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page.Wrong Data ');
        }
        return redirect('/flightgroup');



    }

    public function destroy($id,Request $request)
    {
        try {
            $data=FlightGroup::find(decrypt($id))->delete();
            $request->session()->flash('status', 'Deleted Successfully.');
        }
        catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page.');
        }
        return redirect('/flightgroup');
    }
}
