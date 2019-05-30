@extends('layouts.administrator.app')
@section('content')
@include('shares.errors')
@include('shares.SuccessBootstrapAlert')
<form method="POST" action="{{ route('property.update',['id'=>$property->id]) }}" role="form"
    enctype="multipart/form-data" class="p-3 shadow bg-white rounded">
    {{ csrf_field() }} @method('PATCH')
    <h3>Editar</h3>
    <!--Property Gral -->
    <div class="row my-2">
        <div class="col-md-6  from-group">
            <label for="property_type_id">Tipo:</label>
            <select class="form-control" id="property_type_id" name="property_type_id" required>
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
            <label for="property_status_id">Estado de la casa:</label>
            <select class="form-control" id="property_status_id" name="property_status_id" required>
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
            <label for="property_legal_status_id">Estado legal:</label>
            <select class="form-control" id="property_legal_status_id" name="property_legal_status_id" required>
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
            <label for="country">Estado:</label>
            <select class="form-control" id="state_id" name="state_id" required>
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

    <!--Information Property -->
    <div class="row my-2">
        <div class="col-md-3 form-group">
            <label for="bedrooms">Cuartos:</label>
            <input name="bedrooms" type="number" class="form-control" id="bedrooms"
                value="{{$property->propertyInformation->bedrooms}}" required>
        </div>
        <div class="col-md-3 form-group">
            <label for="bathrooms">Baños:</label>
            <input name="bathrooms" type="number" class="form-control" id="bathrooms"
                value="{{$property->propertyInformation->bathrooms}}" required>
        </div>
        <div class="col-md-3 form-group">
            <label for="parking_lots">Estacionamiento:</label>
            <input name="parking_lots" type="number" class="form-control" id="parking_lots"
                value="{{$property->propertyInformation->parking_lots}}" required>
        </div>
        <div class="col-md-3 form-group">
            <label for="antiquity">Antiguedad de la casa:</label>
            <input name="antiquity" type="number" class="form-control" id="antiquity"
                value="{{$property->propertyInformation->antiquity}}" required>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-3 form-group">
            <label for="price">Precio:</label>
            <input name="price" type="number" class="form-control" id="price"
                value="{{$property->propertyInformation->price}}" required>
        </div>
        <div class="col-md-3 form-group">
            <label for="maintenance">Costo de reparacion:</label>
            <input name="maintenance" type="number" class="form-control" id="maintenance" min="0" step=0.01
                value="{{$property->propertyInformation->maintenance}}" required>
        </div>
        <div class="col-md-3 form-group">
            <label for="area">Terreno construido:</label>
            <input name="area" type="number" class="form-control" id="area" min="0" step=0.01
                value="{{$property->propertyInformation->area}}" required>
        </div>
        <div class="col-md-3 form-group">
            <label for="total_area_lot">Terreno:</label>
            <input name="total_area_lot" type="number" class="form-control" id="total_area_lot" min="0" step=0.01
                value="{{$property->propertyInformation->total_area_lot}}" required>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-12 form-group">
            <label for="sale_message">Mensaje de venta:</label>
            <textarea class="form-control" rows="4" cols="50" name="sale_message"
                id="sale_message" required>{{$property->propertyInformation->sale_message}}</textarea>
        </div>
    </div>
    <!-- Property Services -->
    <div>
        <h4 class="text-center">Servicios:</h4>
    </div>
    <div class="row">
        @foreach ($services as $service)
        <div class="col">
            <label class="font-weight-bold"><input type="checkbox" name="services[]" class="mx-1"
                    value="{{$service->id}}" @if($property->propertyServices->contains($service->id)) checked=checked
                @endif/>{{$service->service}}</span>
        </div>
        @endforeach
    </div>
    <!-- Property Localization -->
    <div class="row my-2">
        <div class="col-12 ">
            <div id="map" style="height:300px"></div>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-12 ">
            <label for="address">Direccion:</label>
            <input name="address" type="text" class="form-control" id="address"
                value="{{$property->propertyLocalization->address}}" required>
        </div>
    </div>
    <input type="text" name="latitude" id="Lat" style="display:none"
        value="{{$property->propertyLocalization->latitude}}">
    <input type="text" name="length" id="Lng" style="display:none" value="{{$property->propertyLocalization->length}}">
    <!--Property_photos -->
    <div class="row my-2">
        <div class="col-6 form-group">
            <label for="images">Fotos de la casa:</label>
            <input type="file" class="form-control-file" id="images" name="images[]" multiple>
        </div>
        <div class="col-6 form-group text-right">
            <button class="btn btn-success" type="submit">Actualizar</button>
        </div>
    </div>
</form>
@endsection

<script src="https://code.jquery.com/jquery-3.4.0.js" integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
    crossorigin="anonymous"></script>
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