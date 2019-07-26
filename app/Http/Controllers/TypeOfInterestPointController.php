<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TypeOfInterestPoint;
use Session;

//Controlador encargado de administrar los tipos de puntos de interes.
class TypeOfInterestPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Funcion que retorna la pagina con los tipos de puntos de interes ya registrados.
    public function index()
    {
        return view('administrator.TypeOfInterestPointView.index')->with('types',TypeOfInterestPoint::orderBy('id','desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Funcion que muestra la pagina para registrar nuevos tipos de puntos de interes.
    public function create()
    {
        return view('administrator.TypeOfInterestPointView.create');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //Funcion que se encarga de almacenar el tipo de  punto de interes ingresado a la base de datos.
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'type_name' => 'required'
        ]);

        $attributes['inserted_by'] = 'David Ortega';
        TypeOfInterestPoint::create($attributes);
        Session::flash('success',"La categoria: $attributes[type_name] a sido agregada satisfactoriamente");

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

    //Funcion encargada de mostrar el tipo de punto de interes a editar.
    public function edit($id)
    {
        return view('administrator.TypeOfInterestPointView.edit');   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Funcion que se encarga de actualizar el registro seleccionado.
    public function update(Request $request, $id)
    {
        $attribute = request()->validate([
            'type_name'=>'required'
        ]);

        $attribute['updated_by'] = 'David Ortega';
        TypeOfInterestPoint::where('type_name','=', $type)->update($attribute);        
        Session::flash('success', "La categoria: $attribute[type_name] a sido actualizada");

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Funcion encargada de eliminar el registro seleccionado de la base de datos.
    public function destroy($type)
    {
        TypeOfInterestPoint::where('type_name','=', $type)->delete();
        Session::flash('success', "La categoria $type a sido eliminada");

        return redirect()->back();
    }
}
