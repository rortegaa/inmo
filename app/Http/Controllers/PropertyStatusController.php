<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PropertyStatus;
use Session;

//Controlador que se encarga de los estados de la propiedad. (Venta, Renta, ETC)
class PropertyStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //Funcion que retorna la vista(Pagina) principal con los tipos de estado de la propiedad registrados.
    public function index()
    {
        return view('administrator.PropertyStatusView.index')->with('propertyStatus',PropertyStatus::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     //Funcion que retorna la vista(pagina) para el registro de nuevos estados de la propiedad.
    public function create()
    {
        return view('administrator.PropertyStatusView.create');  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //Funcion que almacena en la base de datos el nuevo tipo de estado de la propiedad.
    public function store(Request $request)
    {
        $attribute = $request->validate([
            'property_status'=>'required'
        ]);

        $attribute['inserted_by'] = auth()->user()->name;;   

        PropertyStatus::create($attribute);

        Session::flash('success',"Registro agregado sastifactoriamente");

        return redirect()->route('property_status.index');
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

    //Funcion que muestra la vista(pagina) para editar el tipo de estado de la propiedad que se ha seleccionado.
    public function edit(PropertyStatus $propertyStatus)
    {
        return view('administrator.PropertyStatusView.edit',['propertyStatus' => $propertyStatus]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Actualiza el registro de la base de datos del estado de la propiedad seleccionado.
    public function update(Request $request,PropertyStatus $propertyStatus)
    {
        $attribute = $request->validate([
            'property_status'=>'required'
        ]);

        $attribute['updated_by'] = auth()->user()->name;;
        
        $propertyStatus->update($attribute);      

        Session::flash('success',"Registro actualizado satisfactoriamente");

        return redirect()->route('property_status.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Funcion que se encarga de eliminar el registro de la base de datos del estado de la propiedad seleccionado.
    public function destroy(PropertyStatus $propertyStatus)
    {
        $propertyStatus->delete();

        Session::flash('success', "Registro eliminado satisfactoriamente");

        return redirect()->route('property_status.index');
    }
}
