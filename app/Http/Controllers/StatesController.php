<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use Session;
class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrator.StatesView.index')->with('states',State::orderBy('id','desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'state' => 'required'
        ]);

        $attributes['inserted_by'] = 'David Ortega';

        State::create($attributes);

        Session::flash('success',"State: $attributes[state] added successfully");

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
    public function update($state)
    {
        $attributes = request()->validate([
            'state'=>'required'
        ]);

        $attributes['updated_by'] = 'David Ortega';
        
        State::where('state','=', $state)->update($attributes);
        
        Session::flash('success',"State: $attributes[state] updated successfully");

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($state)
    {
        State::where('state','=',$state)->delete();

        Session::flash('success',"State: $state deleted successfully");

        return redirect()->back();
    }
}
