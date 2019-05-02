<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
class AreasController extends Controller
{
    public function securityAndSocialIndex()
    {
        return view('administrator.areas.security_social');
    }

    public function securityAndSocialStore()
    {
       
        request()->validate([
            'security' => 'required',
            'social_status' => 'required',
            'area_name' => 'required',
            'lat' => 'required',
            'lng' => 'required'
        ]);

        $array = [];
      
        for ($i=0; $i < count(request()->get("lat")) ; $i++) { 
            $array = Arr::add($array, $i, [
                "latitude" => request()->get("lat.punto$i"),
                "length" => request()->get("lng.punto$i"),
            ]);
        }

        dd($array);
    }
}
