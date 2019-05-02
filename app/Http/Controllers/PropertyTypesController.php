<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PropertyType;
use Session;

class PropertyTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrator.PropertyTypesView.index')->with('types',PropertyType::orderBy('id','desc')->get());
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
        $attributes = request()->validate([
            'property_type' => 'required'
        ]);

        $attributes['inserted_by'] = 'David Ortega';
        PropertyType::create($attributes);
        Session::flash('success',"Property type: $attributes[property_type] added successfully");

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
    public function update($type)
    {
        $attribute = request()->validate([
            'property_type'=>'required'
        ]);

        $attribute['updated_by'] = 'David Ortega';
        PropertyType::where('property_type','=', $type)->update($attribute);        
        Session::flash('success', "Property type: $attribute[property_type] updated successfully!");

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($type)
    {
        PropertyType::where('property_type','=', $type)->delete();
        Session::flash('success', "Property type: $type deleted successfully");

        return redirect()->back();
    }
}
