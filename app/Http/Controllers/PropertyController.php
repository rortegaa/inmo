<?php
namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\Property;
use App\PropertyInformation;
use App\PropertyLegalStatus;
use App\PropertyStatus;
use App\PropertyType;
use App\SecurityAndSocialFactorArea;
use App\State;
use App\PropertyPhoto;
use App\PropertyLocalization;
use App\GeneralService;
class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $property = Property::with(['propertyInformation','propertyLocalization','propertyPhotos','propertyType','propertyLegalStatus'])->get();
        $localization = SecurityAndSocialFactorArea::with('localization')->get();
        return View('administrator.PropertyView.index')->with('property',$property)->with('localization',$localization);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrator.PropertyView.create')->with('legalSatuses', PropertyLegalStatus::All())
                                                        ->with('satuses', PropertyStatus::All())
                                                        ->with('types', PropertyType::All())
                                                        ->with('states', State::All())
                                                        ->with('services', GeneralService::All());
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
            'services' => 'required'
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
        //dd($Property);
        $Property->propertyServices()->attach($attributes['services']);
        
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
        $this->createPropertyInformation($propertyInformationAttributes);
        $this->createPropertyPhotos($PropertyPhotosAttributes);
        $this->createPropertyLocalization($PropertyLocalizationAttributes);
        Session::flash('success', "Record added successfully");
    
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
        $property = Property::where('id',$id)->with(['propertyInformation','propertyLocalization','propertyPhotos','propertyType','propertyLegalStatus','propertyStatus','propertyServices'])->first();
        
        return view('administrator.PropertyView.show')->with('property',$property);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $property = Property::where('id', $id)->with(['propertyInformation','propertyLocalization','propertyServices'])->first();
        return view('administrator.PropertyView.edit')->with('legalSatuses', PropertyLegalStatus::All())
                                                      ->with('satuses', PropertyStatus::All())
                                                      ->with('types', PropertyType::All())
                                                      ->with('states', State::All())
                                                      ->with('services', GeneralService::All())
                                                      ->with('property', $property);
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
            'services' => 'required'
        ]);
        $propertyMainlAttributes =  [
            'property_type_id' => $attributes['property_type_id'],
            'property_status_id' => $attributes['property_status_id'],
            'property_legal_status_id' => $attributes['property_legal_status_id'],
            'state_id' => $attributes['state_id'],
            'userable_type' => 'User',
            'userable_id' => 1
        ];
        $Property = Property::find($id);
        $Property->update($propertyMainlAttributes);
        $Property->propertyServices()->sync($attributes['services']);
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
        $this->updatePropertyInformation($propertyInformationAttributes);
        $this->updatePropertyPhotos($PropertyPhotosAttributes);
        $this->updatePropertyLocalization($PropertyLocalizationAttributes);
        Session::flash('success', "Record added successfully");
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
        $Property = Property::find($id);
        PropertyInformation::where('property_id' , '=', $id)->delete();
        PropertyPhoto::where('property_id' , '=', $id)->delete();
        foreach (glob("images/houseImagesUploads/[" . $id ."]*.*") as $file_to_delete) {
            unlink($file_to_delete);
        }
        PropertyLocalization::where('property_id' , '=', $id)->delete();
        $Property->propertyServices()->detach();
        $Property->delete();
        return redirect()->back();
    }
    public function createPropertyInformation($propertyInformationAttributes)
    {
        PropertyInformation::create($propertyInformationAttributes);
        return true;
    }
    public function createPropertyPhotos($PropertyPhotosAttributes)
    {
        $count = 1;
        if ($files=$PropertyPhotosAttributes['images[]']) {
            foreach ($files as $file) {
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
    public function createPropertyLocalization($PropertyLocalizationAttributes)
    {
        PropertyLocalization::create($PropertyLocalizationAttributes);
        return true;
    }
    public function updatePropertyInformation($propertyInformationAttributes)
    {
        PropertyInformation::where('property_id', '=', $propertyInformationAttributes['property_id'])->update($propertyInformationAttributes);
        return true;
    }
    public function updatePropertyPhotos($PropertyPhotosAttributes)
    {
        $count = 1;
        if ($files=$PropertyPhotosAttributes['images[]']) {
            PropertyPhoto::where('property_id', '=', $PropertyPhotosAttributes['property_id'])->delete();
            foreach (glob("images/houseImagesUploads/[" . $PropertyPhotosAttributes['property_id']."]*.*") as $file_to_delete) {
                unlink($file_to_delete);
            }
            foreach ($files as $file) {
                $name=$PropertyPhotosAttributes['property_id'] . "_" . $count ."_" . date("Y-m-d");
                $guessExtension = $file->guessExtension();
                $file->move('images/houseImagesUploads', $name . '.' . $guessExtension);
                $finalAtributtes = [
                    'property_id' => $PropertyPhotosAttributes['property_id'],
                    'url' =>  '/images/houseImagesUploads/' . $name . '.' . $guessExtension
                ];
                PropertyPhoto::create($finalAtributtes);
                $count++;
            }
        }
        return true;
    }
    public function updatePropertyLocalization($PropertyLocalizationAttributes)
    {
        PropertyLocalization::where('property_id', '=', $PropertyLocalizationAttributes['property_id'])->update($PropertyLocalizationAttributes);
        return true;
    }
}