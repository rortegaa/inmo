<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\SecurityAndSocialFactorArea;
use Session;

class AreasController extends Controller
{

    public function securityAndSocialIndex()
    {
        return view('administrator.areas.security_socialIndex')->with('localization', SecurityAndSocialFactorArea::with('localization')->get());
    }
    public function securityAndSocialCreate()
    {      
        return view('administrator.areas.security_social')->with('localization', SecurityAndSocialFactorArea::with('localization')->get());
    }

    public function securityAndSocialStore(Request $request)
    {
       
        $request->validate([
            'security' => 'required',
            'social_status' => 'required',
            'area_name' => 'required',
            'lat' => 'required',
            'lng' => 'required'
        ]);

        $array = [];
      
        for ($i=0; $i < count($request->input("lat")) ; $i++) { 
            $array = Arr::add($array, $i, [
                "latitude" => $request->input("lat.punto$i"),
                "length" => $request->input("lng.punto$i"),
            ]);
        }

        $area = new SecurityAndSocialFactorArea();
        $area->area_name = $request->input('area_name');
        $area->security = $request->input('security');
        $area->social_status = $request->input('social_status');
        $area->inserted_by = 'David Ortega';

        $area->save();

        $area->localization()->createMany($array);

        Session::flash('success','Area added successfully' );

        return redirect()->back();
    }

    public function securityAndSocialDelete($id)
    {
        SecurityAndSocialFactorArea::find($id)->delete();
        
        Session::flash('success','Area deleted successfully' );

        return redirect()->back();
    }
}
