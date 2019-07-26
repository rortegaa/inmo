<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GeneralService;
use Session;


//Controlador que se encarga de administrar los servicios que puede llegar a tener una propiedad.
class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Muestra la pagina con todos los servicios registrados.
    public function index()
    {
        return view('administrator.ServicesView.index')->with('services', GeneralService::orderBy('id','desc')->get());
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

    //Se encarga de almacenar el nuevo servicio que se desea registrar a la base de datos.
    public function store()
    {
        $attribute = request()->validate([
            'service'=>'required'
        ]);

        $attribute['inserted_by'] = 'David Ortega';          
        GeneralService::create($attribute);
        Session::flash('success', "Service: $attribute[service] added successfully!");

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

    //Se encarga de actualizar el servicio seleccionado.
    public function update($service)
    {
        $attribute = request()->validate([
            'service'=>'required'
        ]);

        $attribute['updated_by'] = 'David Ortega';
        GeneralService::where('service','=', $service)->update($attribute);        
        Session::flash('success', "Service: $attribute[service] updated successfully!");

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Funcion encargada de eliminar el servicio de la base ded atos que se ha seleccionado.
    public function destroy($service)
    {
        GeneralService::where('service','=', $service)->delete();
        Session::flash('success', "Service: $service deleted successfully");

        return redirect()->back();
    }
}
