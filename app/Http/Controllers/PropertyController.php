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

//Este controlador se encarga de todos los procesos o registros que tenga que llevar una propiedad.
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //
    //Funcion index carga las propiedades registradas.
    public function index()
    {
        //Obtiene las propiedades con las caracteristicas de su informacion, localizacion, fotografias, el tipo de propiedad y el estado legal en el que se encuentra.
        $property = Property::with(['propertyInformation','propertyLocalization','propertyPhotos','propertyType','propertyLegalStatus'])->get();
        
        //Obtiene las areas de seguridad
        $localization = SecurityAndSocialFactorArea::with('localization')->get();

        //Envia a la vista(Pagina) los datos obtenidos para su utilizacion.
        return View('administrator.PropertyView.index')->with('property',$property)->with('localization',$localization);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Muestra la vista(pagina) para registrar una propiedad nueva.
    public function create()
    {
        //Envia la vista con la informacion de estados legales, estatus de la propiedad, el tipo de propiedad, el estado al que pertenece y sus servicios generales.
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

     //Funcion para almacenar los datos a registrar.
    public function store()
    {
        //Solicita todos los campos llenados en la pagina, los valida y los almacena en $attributes.
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
        
        //Se divide el arreglo de $attributes en 3 para un mejor menejo de la informacion
        //Almacesa solo los atributos principales.
        $propertyMainlAttributes =  [
            'property_type_id' => $attributes['property_type_id'],
            'property_status_id' => $attributes['property_status_id'],
            'property_legal_status_id' => $attributes['property_legal_status_id'],
            'state_id' => $attributes['state_id'],
            'userable_type' => 'User',
            'userable_id' => 1
        ];

        //Registra en la base de datos una propiedad 
        $Property = Property::create($propertyMainlAttributes);
        //dd($Property);

        //Se registra en la base de datos los servicios de la casa con su relacion a la casa registrada anteriormente.
        $Property->propertyServices()->attach($attributes['services']);
        
        //Se crea un arreglo con los atributos de la informacion general.
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

        //Se crea un arreglo con las fotos enviadas.
        $PropertyPhotosAttributes = [
            'property_id' => $Property->id,
            'images[]' => $attributes['images']
        ];

        //Se crea un arreglo con las cordenadas de la ubicacion de la casa.
        $PropertyLocalizationAttributes = [
            'property_id' => $Property->id,
            'latitude' => $attributes['latitude'],
            'length' => $attributes['length'],
            'address' => $attributes['address']
        ];

        //Funciones para registrar los demas arreglos con las caracteristicas de la propiedad.
        $this->createPropertyInformation($propertyInformationAttributes);
        $this->createPropertyPhotos($PropertyPhotosAttributes);
        $this->createPropertyLocalization($PropertyLocalizationAttributes);

        //Envia la alerta de que todo se registro correctamente
        Session::flash('success', "Record added successfully");
        //Redirecciona a una pagina anterior
        return redirect()->back();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Funcion que muestra la propiedad buscada con el $id
    public function show($id)
    {
        //Busca la propiedad con el $id pasado como parametro junto con toda la informacion que lleva.
        $property = Property::where('id',$id)->with(['propertyInformation','propertyLocalization','propertyPhotos','propertyType','propertyLegalStatus','propertyStatus','propertyServices'])->first();
        
        //Envia la informacion obtenida a la vista(pagina) para su uso.
        return view('administrator.PropertyView.show')->with('property',$property);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Carga la vista para editar la propiedad del $id enviado.
    public function edit($id)
    {
        //Busca y jala la informacion de la propiedad buscada por medio de su id.
        $property = Property::where('id', $id)->with(['propertyInformation','propertyLocalization','propertyServices'])->first();

        //Envia la propiedad a la pagina para mostrarla junto con todos los atributos necesarios.
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
    
     //Actualiza la informacion de la propiedad editada
    public function update(Request $request, $id)
    {
        //Se validadn los datos ingresados y se almacenan.
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

        //Se guarda en un arreglo los atributos principales de la porpiedad
        $propertyMainlAttributes =  [
            'property_type_id' => $attributes['property_type_id'],
            'property_status_id' => $attributes['property_status_id'],
            'property_legal_status_id' => $attributes['property_legal_status_id'],
            'state_id' => $attributes['state_id'],
            'userable_type' => 'User',
            'userable_id' => 1
        ];
        //Se busca la propiedad en la base de datos por medio de su $id
        $Property = Property::find($id);
        //Se manda a llamar update que actualiza esos datos por los nuevos se le envia como parametro el arreglo de los atributos principales.
        $Property->update($propertyMainlAttributes);
        //Se actualizan los servicios de la casa.
        $Property->propertyServices()->sync($attributes['services']);

        //Se almacenan en un arreglo la informacion de la propiedad
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
        
        //Se almacenan en un arreglo las fotos a subir.
        $PropertyPhotosAttributes = [
            'property_id' => $id,
            'images[]' => $attributes['images']
        ];
        
        //Se almacena en un arreglo la infromaciond e la localizacion de la casa
        $PropertyLocalizationAttributes = [
            'property_id' => $id,
            'latitude' => $attributes['latitude'],
            'length' => $attributes['length'],
            'address' => $attributes['address']
        ];

        //Se manda la informacion a funciones para su alacenamiento.
        $this->updatePropertyInformation($propertyInformationAttributes);
        $this->updatePropertyPhotos($PropertyPhotosAttributes);
        $this->updatePropertyLocalization($PropertyLocalizationAttributes);

        //Envia el mensaje que de que la informacion a sido agregada exitosamente.
        Session::flash('success', "Record added successfully");

        //Redirecciona a la pagina principal de propiedades.
        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Funcion para eliminar una propiedad.
    public function destroy($id)
    {
        //Busca en la base de datos por medio del id la propieedad
        $Property = Property::find($id);

        //Elimina su infromacion donde coincida el id enviado
        PropertyInformation::where('property_id' , '=', $id)->delete();
        
        //Elimina las fotos de la propiedad
        PropertyPhoto::where('property_id' , '=', $id)->delete();
        foreach (glob("images/houseImagesUploads/[" . $id ."]*.*") as $file_to_delete) {
            unlink($file_to_delete);
        }

        //Elimina la informacion de la localizacion de la propiedad.
        PropertyLocalization::where('property_id' , '=', $id)->delete();
        
        //Elimina los servicios registrados de la propiedad
        $Property->propertyServices()->detach();

        //Elimina la propiedad
        $Property->delete();

        //Redirecciona  a la pagina principal.
        return redirect()->back();
    }

    //Funcion que registra la informacion general de la propiedad.
    public function createPropertyInformation($propertyInformationAttributes)
    {
        //Registra en la base de datos la informacion de la propiedad de la propiedad creada.
        PropertyInformation::create($propertyInformationAttributes);
        return true;
    }

    //Funcion que registra las fotos de la casa
    public function createPropertyPhotos($PropertyPhotosAttributes)
    {

        $count = 1;
        //Recorre las fotografias enviadas en el arreglo las almacena en la base de datos la direccion de donde estan almacenadas, y las guarda virtualmente en la aplicaicion.
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

    //Funcion que registra la ubicacion de la propiedad
    public function createPropertyLocalization($PropertyLocalizationAttributes)
    {
        //Almacena en la base de datos la ubicacion de la propiedad
        PropertyLocalization::create($PropertyLocalizationAttributes);
        return true;
    }

    //Funcuion que acttualiza la informacion de la propiedad.
    public function updatePropertyInformation($propertyInformationAttributes)
    {
        //Actualiza el registro en la base de datos de la propiedad por medio del $id pasado
        PropertyInformation::where('property_id', '=', $propertyInformationAttributes['property_id'])->update($propertyInformationAttributes);
        return true;
    }

    //Funcion que actualiza las fotografias de la propiedad.
    public function updatePropertyPhotos($PropertyPhotosAttributes)
    {
        $count = 1;
        //Recorre el arreglo de las fotos elimina las antiguas y registra las nuevas a la base de datos,
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
    //Funcion que actualiza la ubicacion de la propiedad
    public function updatePropertyLocalization($PropertyLocalizationAttributes)
    {
        //Acutaliza el registro en la base de datos en base al id enviado
        PropertyLocalization::where('property_id', '=', $PropertyLocalizationAttributes['property_id'])->update($PropertyLocalizationAttributes);
        return true;
    }
}