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
        return view('administrator.areas.security_social_index')->with('localization', SecurityAndSocialFactorArea::with('localization')->get());
    }

    public function securityAndSocialCreate()
    {      
        return view('administrator.areas.security_social_create')->with('localization', SecurityAndSocialFactorArea::with('localization')->get());
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

        if($request->has(['lat','lng'])){

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
     }

        Session::flash('success','Area added successfully' );

        return redirect()->back();
    }

    public function securityAndSocialEdit($id)
    {
        
        return view('administrator.areas.security_socialUpdate')->with('localization', SecurityAndSocialFactorArea::where('id', $id)->with('localization')->first());
    }

    public function securityAndSocialUpdate(Request $request, $id)
    {

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

    public function securityAndSocialDelete($id)
    {
        SecurityAndSocialFactorArea::find($id)->delete();
        
        Session::flash('success','Area deleted successfully' );

        return redirect()->back();
    }
}
