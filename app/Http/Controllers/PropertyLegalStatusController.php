<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PropertyLegalStatus;
use Session;

class PropertyLegalStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrator.PropertyLegalStatusView.index')->with('legalStatus', PropertyLegalStatus::all());      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrator.PropertyLegalStatusView.create');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attribute = $request->validate([
            'property_legal_status'=>'required'
        ]);

        $attribute['inserted_by'] = 'David Ortega';

        PropertyLegalStatus::create($attribute);

        Session::flash('success',"Registro agregado sastifactoriamente");

        return redirect()->route('legal_status.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyLegalStatus $legalStatus)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PropertyLegalStatus $legalStatus)
    {
        return view('administrator.PropertyLegalStatusView.create',['legalStatus' => $legalStatus]);   
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
            'property_legal_status'=>'required'
        ]);

        $attribute['updated_by'] = 'David Ortega';

        PropertyLegalStatus::where('property_legal_status','=',$status)->update($attribute);

        Session::flash('success',"Legal status: $attribute[property_legal_status] updated successfuly!");

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyLegalStatus $legalStatus)
    {
        $legalStatus->delete();
        
        Session::flash('success', "Registro eliminado satisfactoriamente");

        return redirect()->route('legal_status.index');

    }
}
