<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Property;
use App\PropertyInformation;
use App\PropertyLegalStatus;
use App\PropertyStatus;
use App\PropertyType;
use App\State;
use App\PropertyPhoto;
use App\PropertyLocalization;



class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrator.PropertyView.create')->with('propertyLegalSatuses',PropertyLegalStatus::All())
                                                    ->with('propertySatuses',PropertyStatus::All())
                                                    ->with('propertyTypes',PropertyType::All())
                                                    ->with('states',State::All());
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
            'property_type_id' => 'required',
            'property_status_id' => 'required',
            'property_legal_status_id' => 'required',
            'state_id' => 'required',
            'bedrooms' => 'required',
            'bathrooms' => 'required',
            'parking_lots' => 'required',
            'antiquity' => 'required',
            'price' => 'required',
            'maintenance' => 'required',
            'area' => 'required',
            'total_lot_area' => 'required',
            'images' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'length' => 'required',
        ]);

        $propertyMainlAttributes =  [ 
        'property_type_id' => $attributes['property_type_id'], 
        'property_status_id' => $attributes['property_status_id'], 
        'property_legal_status_id' => $attributes['property_legal_status_id'], 
        'state_id' => $attributes['state_id'],
        'userable_type' => 'User',
        'userable_id' => 1
        ];

        $Property = Property::create($propertyMainlAttributes);

        $propertyInformationAttributes =  [ 
        'property_id' => $Property->id,
        'bedrooms' => $attributes['bedrooms'], 
        'bathrooms' => $attributes['bathrooms'], 
        'parking_lots' => $attributes['parking_lots'], 
        'antiquity' => $attributes['antiquity'],
        'price' => $attributes['price'],
        'maintenance' => $attributes['maintenance'],
        'area' => $attributes['area'],
        'total_area_lot' => $attributes['total_lot_area'],
        'inserted_by' => 'Mario'
        ];

        $PropertyPhotosAttributes = [
        'property_id' => $Property->id,
        'images[]' => $attributes['images']
        ];

        $PropertyLocalizationAttributes = [
        'property_id' => $Property->id,
        'latitude' => $attributes['latitude'],
        'length' => $attributes['length'],
        'address' => $attributes['address']
        ];

        $this->create_property_information($propertyInformationAttributes);
        $this->create_property_photos($PropertyPhotosAttributes);
        $this->create_property_localization($PropertyLocalizationAttributes);
        Session::flash('success',"Record added successfully");

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
        $property = Property::where('id',$id)->with(['PropertyInformation','PropertyInformation'])->first()->get();
                                             //->with('PropertyLocalization')->first();
        dd($property);
        return view('administrator.PropertyView.create')->with('propertyLegalSatuses',PropertyLegalStatus::All())
                                                        ->with('propertySatuses',PropertyStatus::All())
                                                        ->with('propertyTypes',PropertyType::All())
                                                        ->with('states',State::All())
                                                        ->with('property',$property);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $attributes = request()->validate([
            'property_type_id' => 'required',
            'property_status_id' => 'required',
            'property_legal_status_id' => 'required',
            'state_id' => 'required',
            'bedrooms' => 'required',
            'bathrooms' => 'required',
            'parking_lots' => 'required',
            'antiquity' => 'required',
            'price' => 'required',
            'maintenance' => 'required',
            'area' => 'required',
            'total_lot_area' => 'required',
            'images' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'length' => 'required',
        ]);

        $propertyMainlAttributes =  [ 
            'property_type_id' => $attributes['property_type_id'], 
            'property_status_id' => $attributes['property_status_id'], 
            'property_legal_status_id' => $attributes['property_legal_status_id'], 
            'state_id' => $attributes['state_id'],
            'userable_type' => 'User',
            'userable_id' => 1
            ];
    
            $Property = Property::create($propertyMainlAttributes);
    
            $propertyInformationAttributes =  [ 
            'property_id' => $Property->id,
            'bedrooms' => $attributes['bedrooms'], 
            'bathrooms' => $attributes['bathrooms'], 
            'parking_lots' => $attributes['parking_lots'], 
            'antiquity' => $attributes['antiquity'],
            'price' => $attributes['price'],
            'maintenance' => $attributes['maintenance'],
            'area' => $attributes['area'],
            'total_area_lot' => $attributes['total_lot_area'],
            'inserted_by' => 'Mario'
            ];
    
            $PropertyPhotosAttributes = [
            'property_id' => $Property->id,
            'images[]' => $attributes['images']
            ];
    
            $PropertyLocalizationAttributes = [
            'property_id' => $Property->id,
            'latitude' => $attributes['latitude'],
            'length' => $attributes['length'],
            'address' => $attributes['address']
            ];



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    function create_property_information($propertyInformationAttributes)
    {
        PropertyInformation::create($propertyInformationAttributes);
        return true;
    }

    function create_property_photos($PropertyPhotosAttributes){
        $count = 1;
        if($files=$PropertyPhotosAttributes['images[]']){
            foreach($files as $file){
                $name=$PropertyPhotosAttributes['property_id'] . "_" . $count ."_" . date("Y-m-d");
                $guessExtension = $file->guessExtension();
                $file->move('images/houseImagesUploads', $name . '.' . $guessExtension);
                $finalAtributtes = [
                    'property_id' => $PropertyPhotosAttributes['property_id'],
                    'url' =>  'images/houseImagesUploads', $name . '.' . $guessExtension
                ];
                PropertyPhoto::create($finalAtributtes);
                $count++;
            }
        }
        return true;
    }

    function create_property_localization($PropertyLocalizationAttributes){
        PropertyLocalization::create($PropertyLocalizationAttributes);
        return true;
    }

    function uptade_property_information($propertyInformationAttributes)
    {
        PropertyInformation::create($propertyInformationAttributes);
        return true;
    }

    function update_property_photos($PropertyPhotosAttributes){  
        $count = 1;
        if($files=$PropertyPhotosAttributes['images[]']){
            PropertyPhoto::where('property_id' , '=' ,$PropertyPhotosAttributes['property_id'])->delete();
            foreach(glob("images/houseImagesUploads/[" . $id ."]*.*") as $file_to_delete) {
                unlink($file_to_delete);
            }
            foreach($files as $file){
                $name=$PropertyPhotosAttributes['property_id'] . "_" . $count ."_" . date("Y-m-d");
                $guessExtension = $file->guessExtension();
                $file->move('images/houseImagesUploads', $name . '.' . $guessExtension);
                $finalAtributtes = [
                    'property_id' => $PropertyPhotosAttributes['property_id'],
                    'url' =>  'images/houseImagesUploads', $name . '.' . $guessExtension
                ];
                PropertyPhoto::create($finalAtributtes);
                $count++;
            }
        }
        return true;
    }

    function update_property_localization($PropertyLocalizationAttributes){
        PropertyLocalization::create($PropertyLocalizationAttributes);
        return true;
    }
}
