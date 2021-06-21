<?php

namespace App\Http\Controllers;

use App\Airport;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Contracts\Encryption\DecryptException;


class AirportController extends Controller
{
    public function index(Request $request)
    {
        $data=Airport::select('name','code','id','city')->orderBy('id','desc');
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
        return view('Airport/list',['data'=>$data]);
    }
    public function create()
    {
        return view('Airport/add');
    }

    public function store(Request $request)
    {
        // return $request;
        $validate = Validator::make($request->all(),[
            'name' => 'required',
            'code' => 'required|unique:airports,code',
        ],[
            'name.required'=>'Airport Name is required',
            'code.required'=>'Airport Code is required',
            'code.unique'=>'Sorry Code already taken',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }
        $data=new Airport;
        $data->name=$request->name;
        $data->code=$request->code;
        $data->city=$request->city;
        $data->state=$request->state;
        $data->gndcost=$request->gndcost;
        $data->save();
        $request->session()->flash('status', 'Added Successfully');
        return redirect('/airport');
    }

     public function show($id,Request $request)
    {
        try {
            $data=Airport::find(decrypt($id));
            return view('Airport/view',['data'=>$data]);
        }
        catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page.');
        }
        return redirect('/airport');
    }

    public function edit($id,Request $request)
    {
        try {
            $data=Airport::find(decrypt($id));
            return view('Airport/edit',['data'=>$data]);
        }
        catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page.');
        }
        return redirect('/airport');
    }

    public function update(Request $request,$id)
    {

        try {
            $validate = Validator::make($request->all(),[
                'name' => 'required',
                'code' => 'required',
            ],[
                'name.required'=>'Airport Name is required',
                'code.required'=>'Airport Code is required',
                'code.unique'=>'Sorry Code already taken',
            ]);
            if ($validate->fails()) {
                return back()->withInput()->withErrors($validate);
            }

            $data=Airport::find(decrypt($id));
            $data->name=$request->name;
            $data->code=$request->code;
            $data->city=$request->city;
            $data->state=$request->state;
            $data->gndcost=$request->gndcost;
            $data->save();
            $request->session()->flash('status', 'Edited Successfully');
            return redirect('/airport/view/'.$id);
        }
        catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page.Wrong Data ');
        }
        return redirect('/airport');



    }

    public function destroy($id,Request $request)
    {
        try {
            $data=Airport::find(decrypt($id))->delete();
            $request->session()->flash('status', 'Deleted Successfully.');
        }
        catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page.');
        }
        return redirect('/airport');
    }
}
