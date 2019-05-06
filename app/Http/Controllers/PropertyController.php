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
        $property = Property::with(['propertyInformation','propertyLocalization','propertyPhotos'])->get();
        return View('administrator.PropertyView.index')->with('property', $property);
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
            'total_area_lot' => 'required',
            'sale_message' => 'required',
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
        'total_area_lot' => $attributes['total_area_lot'],
        'sale_message' => $attributes['sale_message'],
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
        $property = Property::where('id',$id)->with(['propertyInformation','propertyLocalization'])->first();
        //dd($property);
                                             //->with('PropertyLocalization')->first();
        return view('administrator.PropertyView.edit')->with('propertyLegalSatuses',PropertyLegalStatus::All())
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
            'total_area_lot' => 'required',
            'sale_message' => 'required',
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
            //PropertyType::where('property_type','=', $type)->update($attribute); 
            $Property = Property::find($id)->update($propertyMainlAttributes);
    
            $propertyInformationAttributes =  [ 
            'property_id' => $id,
            'bedrooms' => $attributes['bedrooms'], 
            'bathrooms' => $attributes['bathrooms'], 
            'parking_lots' => $attributes['parking_lots'], 
            'antiquity' => $attributes['antiquity'],
            'price' => $attributes['price'],
            'maintenance' => $attributes['maintenance'],
            'area' => $attributes['area'],
            'total_area_lot' => $attributes['total_area_lot'],
            'sale_message' => $attributes['sale_message'],
            ];
    
            $PropertyPhotosAttributes = [
            'property_id' => $id,
            'images[]' => $attributes['images']
            ];
    
            $PropertyLocalizationAttributes = [
            'property_id' => $id,
            'latitude' => $attributes['latitude'],
            'length' => $attributes['length'],
            'address' => $attributes['address']
            ];


            Session::flash('success',"Record added successfully");
            $this->update_property_information($attributes,$id );
            $this->update_property_photos($PropertyPhotosAttributes);
            $this->update_property_localization($PropertyLocalizationAttributes);
            return redirect()->back();
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
                    'url' =>  '/images/houseImagesUploads/'. $name . '.' . $guessExtension
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

    function update_property_information($attributes,$id)
    {

        $propertyInformationAttributes =  [ 
            'bedrooms' => $attributes['bedrooms'], 
            'bathrooms' => $attributes['bathrooms'], 
            'parking_lots' => $attributes['parking_lots'], 
            'antiquity' => $attributes['antiquity'],
            'price' => $attributes['price'],
            'maintenance' => $attributes['maintenance'],
            'area' => $attributes['area'],
            'total_area_lot' => $attributes['total_area_lot'],
            'sale_message' => $attributes['sale_message'],
        ];

        PropertyInformation::where('property_id', '=', '' . $id)->update($propertyInformationAttributes);
        return true;
    }

    function update_property_photos($PropertyPhotosAttributes){  
        $count = 1;
        if($files=$PropertyPhotosAttributes['images[]']){
            PropertyPhoto::where('property_id' , '=' ,$PropertyPhotosAttributes['property_id'])->delete();
            foreach(glob("images/houseImagesUploads/[" . $PropertyPhotosAttributes['property_id']."]*.*") as $file_to_delete) {
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
                PropertyPhoto::where('property_id' , '=' ,$PropertyPhotosAttributes['property_id'])->update($finalAtributtes);
                $count++;
            }
        }
        return true;
    }

    function update_property_localization($PropertyLocalizationAttributes){
        PropertyLocalization::where('property_id', '=', $PropertyLocalizationAttributes['property_id'])->update($PropertyLocalizationAttributes);
        return true;
    }
}
