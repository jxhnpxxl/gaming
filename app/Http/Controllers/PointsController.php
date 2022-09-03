<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Points;
use App\Models\Teams;
use Response;
use Redirect;

class PointsController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
         $teams = Teams::get();


        return view('points.index',compact('teams'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('employees.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'post' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        // $input = "";

        $custId = $request->cust_id;

        //Tried to have a feature about saving image
        // if ($image = $request->file('image')) {
        //     $destinationPath = 'image/';
        //     $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        //     $image->move($destinationPath, $profileImage);
        //     // $input['image'] = "$profileImage";
        // }
        // else if($input != "") {
        //     unset($input['image']);
        // }
        
        // Employee::updateOrCreate(['id' => $custId],['first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $request->email, 'phone_number' => $request->phone_number, 'post' => $request->post], ['image' => "$profileImage"]);
        Employee::updateOrCreate(['id' => $custId],['first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $request->email, 'phone_number' => $request->phone_number, 'post' => $request->post]);

        if(empty($request->cust_id))
            $msg = 'Employee entry created successfully.';
        else
            $msg = 'Employee data is updated successfully';

        return redirect()->route('employees.index')->with('success',$msg);
    }

    /**
    * Display the specified resource.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function show(Employee $employee)
    {
        return view('employees.show',compact('employee'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $where = array('id' => $id);
        $employee = Employee::where($where)->first();
        return Response::json($employee);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request)
    {

    }

    /**
    * Remove the specified resource from storage.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $cust = Employee::where('id',$id)->delete();
        return Response::json($cust);
    }
}