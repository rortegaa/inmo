@extends('layouts.administrator.app') 
@section('content')
@include('shares.errors')
@include('shares.SuccessBootstrapAlert')
    <form method="POST" action="{{ route('property.update',['id'=>$property->id]) }}" role="form" enctype="multipart/form-data">
        {{ csrf_field() }} @method('PATCH')
        <div class="bs-stepper shadow p-3 mb-5 bg-white rounded">
            <div class="bs-stepper-header" role="tablist">
                <!-- your steps here -->
                <div class="step" data-target="#general-part">
                    <button type="button" class="step-trigger" role="tab" aria-controls="general-part"
                        id="general-part-trigger">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">General</span>
                    </button>
                </div>
                <div class="line"></div>
                <div class="step" data-target="#information-part">
                    <button type="button" class="step-trigger" role="tab" aria-controls="information-part"
                        id="information-part-trigger">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">Information</span>
                    </button>
                </div>
                <div class="line"></div>
                <div class="step" data-target="#localization-part">
                    <button type="button" class="step-trigger" role="tab" aria-controls="localization-part"
                        id="localization-part-trigger">
                        <span class="bs-stepper-circle">3</span>
                        <span class="bs-stepper-label">Localization</span>
                    </button>
                </div>
                <div class="line"></div>
                <div class="step" data-target="#services-part">
                    <button type="button" class="step-trigger" role="tab" aria-controls="services-part"
                        id="services-part-trigger">
                        <span class="bs-stepper-circle">4</span>
                        <span class="bs-stepper-label">Services</span>
                    </button>
                </div>
                <div class="line"></div>
                <div class="step" data-target="#photos-part">
                    <button type="button" class="step-trigger" role="tab" aria-controls="photos-part"
                        id="photos-part-trigger">
                        <span class="bs-stepper-circle">5</span>
                        <span class="bs-stepper-label">Photos</span>
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content">
                <!-- your steps content here -->
                <div id="general-part" class="content" role="tabpanel" aria-labelledby="general-part-trigger">
                    <!--Property Gral -->
                    <div class="row my-2">
                        <div class="col-md-6  from-group">
                            <label for="property_type_id">Type:</label>
                            <select class="form-control" id="property_type_id" name="property_type_id">
                                <option value="">Seleccione opcion</option>
                                @foreach ($types as $type)
                                @if ($type->id == $property->property_type_id)
                                <option selected value="{{$type->id}}">{{$type->property_type}}</option>
                                @else
                                <option value="{{$type->id}}">{{$type->property_type}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6  from-group">
                            <label for="property_status_id">House Status:</label>
                            <select class="form-control" id="property_status_id" name="property_status_id">
                                <option value="">Seleccione opcion</option>
                                @foreach ($satuses as $status)
                                @if ($status->id == $property->property_status_id)
                                <option selected value="{{$status->id}}">{{$status->property_status}}</option>
                                @else
                                <option value="{{$status->id}}">{{$status->property_status}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6  from-group">
                            <label for="property_legal_status_id">House Legal Status:</label>
                            <select class="form-control" id="property_legal_status_id" name="property_legal_status_id">
                            <option value="">Seleccione opcion</option>
                            @foreach ($legalSatuses as $legalSatus)
                            @if ($legalSatus->id == $property->property_legal_status_id )
                            <option selected value="{{$legalSatus->id}}">{{$legalSatus->property_legal_status}}</option>
                            @else
                            <option value="{{$legalSatus->id}}">{{$legalSatus->property_legal_status}}</option>
                            @endif
                            @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 from-group">
                            <label for="country">State:</label>
                            <select class="form-control" id="state_id" name="state_id">
                            <option value="">Seleccione opcion</option>
                            @foreach ($states as $state)
                            @if ($state->id == $property->state_id)
                            <option selected value="{{$state->id}}">{{$state->state}}</option>
                            @else
                            <option value="{{$state->id}}">{{$state->state}}</option>    
                            @endif
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-end my-2">
                        <div class="from-group mx-3">
                            <a class="btn btn btn-success" style="color:white" onclick="next()">Siguiente</a>
                        </div>
                    </div>
                </div>
                <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                    <!--Information Property -->
                    <div class="row my-2">
                        <div class="col-md-3 form-group">
                            <label for="bedrooms">Rooms:</label>
                            <input name="bedrooms" type="number" class="form-control" id="bedrooms" value="{{$property->propertyInformation->bedrooms}}">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="bathrooms">Bathrooms:</label>
                        <input name="bathrooms" type="number" class="form-control" id="bathrooms" value="{{$property->propertyInformation->bathrooms}}">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="parking_lots">Parking Spots:</label>
                            <input name="parking_lots" type="number" class="form-control" id="parking_lots" value="{{$property->propertyInformation->parking_lots}}">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="antiquity">House antiquity:</label>
                            <input name="antiquity" type="number" class="form-control" id="antiquity" value="{{$property->propertyInformation->antiquity}}">
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-md-3 form-group">
                            <label for="price">Price:</label>
                            <input name="price" type="number" class="form-control" id="price" value="{{$property->propertyInformation->price}}">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="maintenance">Reparation Cost:</label>
                            <input name="maintenance" type="number" class="form-control" id="maintenance" min="0" step=0.01 value="{{$property->propertyInformation->maintenance}}">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="area">House Construction m2:</label>
                            <input name="area" type="number" class="form-control" id="area" min="0" step=0.01 value="{{$property->propertyInformation->area}}">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="total_area_lot">Terrain:</label>
                            <input name="total_area_lot" type="number" class="form-control" id="total_area_lot" min="0" step=0.01 value="{{$property->propertyInformation->total_area_lot}}">
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-12 form-group">
                            <label for="sale_message">Sale Message:</label>
                            <textarea class="form-control" rows="4" cols="50" name="sale_message" id="sale_message">{{$property->propertyInformation->sale_message}}</textarea>
                        </div>
                    </div>
                    <div class="row justify-content-end my-2">
                        <div class="from-group col-auto mr-auto">
                            <a class="btn btn btn-danger" onclick="previus()" style="color:white">Atras</a>
                        </div>
                        <div class="from-group col-auto">
                            <a class="btn btn btn-success" onclick="next()" style="color:white">Siguiente</a>
                        </div>
                    </div>
                </div>
                <div id="localization-part" class="content" role="tabpanel" aria-labelledby="localization-part-trigger">
                    <!-- Property Localization -->
                    <div class="row my-2">
                        <div class="col-12 ">
                            <div id="map" style="height:300px"></div>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-12 ">
                            <label for="address">Address:</label>
                            <input name="address" type="text" class="form-control" id="address" value="{{$property->propertyLocalization->address}}">
                        </div>
                    </div>
                    <div class="row justify-content-end my-2">
                        <div class="from-group col-auto mr-auto">
                            <a class="btn btn btn-danger" onclick="previus()" style="color:white">Atras</a>
                        </div>
                        <div class="from-group col-auto">
                            <a class="btn btn btn-success" onclick="next()" style="color:white">Siguiente</a>
                        </div>
                    </div>
                    <input type="text" name="latitude" id="Lat" style="display:none" value="{{$property->propertyLocalization->latitude}}" > 
                    <input type="text" name="length" id="Lng" style="display:none" value="{{$property->propertyLocalization->length}}">
                </div>
                <div id="services-part" class="content" role="tabpanel" aria-labelledby="services-part-trigger">
                    <div class="row">
                        @foreach ($services as $service)
                            <div class="col">
                                <label class="font-weight-bold"><input type="checkbox" name="services[]" class="mx-1"
                                    value="{{$service->id}}" @if($property->propertyServices->contains($service->id)) checked=checked @endif/>{{$service->service}}</span>
                             </div>
                        @endforeach
                    </div>
                    <div class="row justify-content-end my-2">
                        <div class="from-group col-auto mr-auto">
                            <a class="btn btn btn-danger" onclick="previus()" style="color:white">Atras</a>
                        </div>
                        <div class="from-group col-auto">
                            <a class="btn btn btn-success" onclick="next()" style="color:white">Siguiente</a>
                        </div>
                    </div>
                </div>
                <div id="photos-part" class="content" role="tabpanel" aria-labelledby="photos-part-trigger">
                    <!--Property_photos -->
                    <div class="row my-2">
                        <div class="col-12 form-group">
                            <label for="images">House Images:</label>
                            <input type="file" class="form-control-file" id="images" name="images[]" multiple>
                        </div>
                    </div>
                    <div class="row justify-content-end my-2">
                        <div class="from-group col-auto mr-auto">
                            <a class="btn btn btn-danger" onclick="previus()" style="color:white">Atras</a>
                        </div>
                        <div class="from-group col-auto">
                            <input class="btn btn btn-primary" type="submit" style="color:white" value="Guardar" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

<script src="https://code.jquery.com/jquery-3.4.0.js" integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo=" crossorigin="anonymous"></script>
<script>
    var stepper
    document.addEventListener('DOMContentLoaded', function () {
        stepper = new Stepper(document.querySelector('.bs-stepper'))
    })

    function next(){
        stepper.next()
    }
    function previus(){
        stepper.previous()
    }


    var marker;
        function initMap() {
            //ingreso de cordenadas de cd juarez
            var cdjuarez = {lat: 31.7000, lng: -106.4410}
            //creacion del mapa por google
            map = new google.maps.Map(document.getElementById('map'), {
              center: cdjuarez,
              zoom: 16
            });
            marker = new google.maps.Marker({
                position: {lat: parseFloat($('#Lat').val()), lng: parseFloat($('#Lng').val())},
                map: map
            });
            google.maps.event.addListener(map, 'click', function(event) {
                if (marker && marker.setMap) {
                        marker.setMap(null);
                    }
                
                placeMarker(event.latLng);
                $('#Lat').val(event.latLng.lat())
                $('#Lng').val(event.latLng.lng())
            });         
        }
        function placeMarker(location) {
         marker = new google.maps.Marker({
            position: location, 
            map: map
        });
        }
</script>