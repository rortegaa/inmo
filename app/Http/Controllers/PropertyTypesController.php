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
        return view('administrator.PropertyTypesView.index')->with('types', PropertyType::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrator.PropertyTypesView.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'property_type' => 'required'
        ]);

        $attributes['inserted_by'] =  auth()->user()->name;

        PropertyType::create($attributes);

        Session::flash('success', "Registro agregado satisfactoriamente");

        return redirect()->route('property_types.index');
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
    public function edit(PropertyType $propertyType)
    {
        return view('administrator.PropertyTypesView.edit')->with('type', $propertyType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PropertyType $propertyType)
    {
        $attribute = $request->validate([
            'property_type' => 'required'
        ]);

        $attribute['updated_by'] = auth()->user()->name;

        $propertyType->update($attribute);

        Session::flash('success',"Registro actualizado satisfactoriamente");

        return redirect()->route('property_types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyType $propertyType)
    {
        $propertyType->delete();
         
        Session::flash('success', "Registro eliminado satisfactoriamente");

        return redirect()->route('property_types.index');
    }
}
