<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\SecurityAndSocialFactorArea;
use Session;

class AreasController extends Controller
{
    //Envia la vista con todas las areas de seguridad ingresadas.
    public function securityAndSocialIndex()
    {
        return view('administrator.areas.security_social_index')->with('localization', SecurityAndSocialFactorArea::with('localization')->get());
    }

    //Carga la pagina para registrar una nueva area.
    public function securityAndSocialCreate()
    {      
        return view('administrator.areas.security_social_create')->with('localization', SecurityAndSocialFactorArea::with('localization')->get());
    }

    //Funcion que almacena la nueva area en la base de datos.
    public function securityAndSocialStore(Request $request)
    {
       //Valida los datos ingresados.
        $request->validate([
            'security' => 'required',
            'social_status' => 'required',
            'area_name' => 'required',
            'lat' => 'required',
            'lng' => 'required'
        ]);

        
        if($request->has(['lat','lng'])){

        $array = [];
        //Recorre las latitudes y las lng de los puntos ingresados por el usuario.
        for ($i=0; $i < count($request->input("lat")) ; $i++) { 
            $array = Arr::add($array, $i, [
                "latitude" => $request->input("lat.punto$i"),
                "length" => $request->input("lng.punto$i"),
            ]);
        }

        //Inserta en la bd cada una
        $area = new SecurityAndSocialFactorArea();
        $area->area_name = $request->input('area_name');
        $area->security = $request->input('security');
        $area->social_status = $request->input('social_status');
        $area->inserted_by = 'David Ortega';

        $area->save();

        $area->localization()->createMany($array);
     }

        Session::flash('success','Area added successfully' );

        return redirect()->back();
    }

    //Carga la pagina para llevar a cabo la edicion de las areas.
    public function securityAndSocialEdit($id)
    {
        
        return view('administrator.areas.security_socialUpdate')->with('localization', SecurityAndSocialFactorArea::where('id', $id)->with('localization')->first());
    }

    //Funcion encargada de actualiar el area que se solicito
    public function securityAndSocialUpdate(Request $request, $id)
    {

        //Valida la informacion
        $request->validate([
            'security' => 'required',
            'social_status' => 'required',
            'area_name' => 'required'
        ]);

        $area = SecurityAndSocialFactorArea::where('id', $id)->first();
        $area->area_name = $request->input('area_name');
        $area->security = $request->input('security');
        $area->social_status = $request->input('social_status');
        $area->updated_by = 'David Ortega';

        $area->save();

        if($request->has(['lat','lng'])){          
        //Actualiza las lng  lat de los puntos ingresados.
         $result = $area->localization()->delete();
         if($result)
         {
            $array = [];
      
            for ($i=0; $i < count($request->input("lat")) ; $i++) { 
                $array = Arr::add($array, $i, [
                    "latitude" => $request->input("lat.punto$i"),
                    "length" => $request->input("lng.punto$i"),
                ]);
            }
            $area->localization()->createMany($array);
        }
       
     }

        Session::flash('success','Area updated successfully' );

        return redirect()->back();
       
    }

    //Elimina el area seleccionada.
    public function securityAndSocialDelete($id)
    {
        SecurityAndSocialFactorArea::find($id)->delete();
        
        Session::flash('success','Area deleted successfully' );

        return redirect()->back();
    }
}
