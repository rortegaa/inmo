<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PropertyLegalStatus;
use Session;

//Control que se encarga de administrar los estados legales de la propiedad.
class PropertyLegalStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Funcion que retorna la vista con todos los estados legales de la propiedad registrados.
    public function index()
    {
        return view('administrator.PropertyLegalStatusView.index')->with('legalStatus', PropertyLegalStatus::all());      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     //Funcion que llama a la vista(Pagina) para la creacion de estatus legales de la propiedad.
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

     //Funcion que almacena en la base de datos el estado de la propiedad querido.
    public function store(Request $request)
    {
        $attribute = $request->validate([
            'property_legal_status'=>'required'
        ]);

        $attribute['inserted_by'] = auth()->user()->name;

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

    //Funcion que retorna la Vista(Pagina) para editar el estado legal seleccionado
    public function edit(PropertyLegalStatus $legalStatus)
    {
        return view('administrator.PropertyLegalStatusView.edit',['legalStatus' => $legalStatus]);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Funcion que actualiza el estado legal deseado.
    public function update(Request $request, PropertyLegalStatus $legalStatus)
    {
        $attribute = $request->validate([
            'property_legal_status'=>'required'
        ]);

        $attribute['updated_by'] = auth()->user()->name;

        $legalStatus->update($attribute);

        Session::flash('success',"Registro actualizado satisfactoriamente");

        return redirect()->route('legal_status.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Funcion que elimina el estado legal de la propiedad seleccionado.
    public function destroy(PropertyLegalStatus $legalStatus)
    {
        $legalStatus->delete();
        
        Session::flash('success', "Registro eliminado satisfactoriamente");

        return redirect()->route('legal_status.index');

    }
}
