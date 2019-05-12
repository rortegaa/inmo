<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PropertyStatus;
use Session;

class PropertyStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrator.PropertyStatusView.index')->with('property_status',PropertyStatus::orderBy('id','desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $attribute = request()->validate([
            'property_status'=>'required'
        ]);

        $attribute['inserted_by'] = 'David Ortega';          
        PropertyStatus::create($attribute);
        Session::flash('success', "Status: $attribute[property_status] added successfully!");

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($status)
    {
        $attribute = request()->validate([
            'property_status'=>'required'
        ]);

        $attribute['updated_by'] = 'David Ortega';
        PropertyStatus::where('property_status','=', $status)->update($attribute);        
        Session::flash('success', "Status: $attribute[property_status] updated successfully!");

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($property_status)
    {
        PropertyStatus::where('property_status','=', $property_status)->delete();
        Session::flash('success', "Status: $property_status deleted successfully");

        return redirect()->back();
    }
}
