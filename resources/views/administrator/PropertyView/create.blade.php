@extends('layouts.administrator.admin')
@section('content')
@include('shares.errors')
@include('shares.SuccessBootstrapAlert')
<form method="POST" action="{{ route('property.store') }}" role="form" enctype="multipart/form-data"
    class="shadow p-3 bg-white rounded">
    <h3>Crear</h3>
    {{ csrf_field() }}
    <!--Property Gral -->
    <div class="row text-center justify-content-center">
        <div class="col-md-2">

        </div>
        <div class="col-md-8">
            <div class="box box-primary" data-widget="box-widget">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos Generales:</h3>
                    <div class="box-tools">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="col-md-6 from-group">
                        <label for="property_type_id">Tipo:</label>
                        <select class="form-control select2 select2 hiddem-accesible" id="property_type_id"
                            name="property_type_id" required autofocus>
                            <option value="">Seleccione opcion</option>
                            @foreach ($types as $type)
                            <option value="{{$type->id}}">{{$type->property_type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 from-group ">
                        <label for="property_status_id">Estado de la propiedad:</label>
                        <select class="form-control" id="property_status_id" name="property_status_id" required
                            autofocus>
                            <option value="">Seleccione opcion</option>
                            @foreach ($satuses as $status)
                            <option value="{{$status->id}}">{{$status->property_status}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 from-group">
                        <label for="property_legal_status_id">Estado legal:</label>
                        <select class="form-control" id="property_legal_status_id" name="property_legal_status_id"
                            required autofocus>
                            <option value="">Seleccione opcion</option>
                            @foreach ($legalSatuses as $legalSatus)
                            <option value="{{$legalSatus->id}}">{{$legalSatus->property_legal_status}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 from-group">
                        <label for="country">Estado:</label>
                        <select class="form-control" id="state_id" name="state_id" required autofocus>
                            <option value="">Seleccione opcion</option>
                            @foreach ($states as $state)
                            <option value="{{$state->id}}">{{$state->state}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="box-footer">
                </div>
            </div>
        </div>
    </div>
    <!--Information Property -->
    <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-8 offset-2">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Caracteristicas principales:</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-3 form-group">
                        <label for="bedrooms">Cuartos:</label>
                        <input name="bedrooms" type="number" class="form-control" id="bedrooms"
                            value="{{old("bedrooms")}}" required autofocus>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="bathrooms">Baños:</label>
                        <input name="bathrooms" type="number" class="form-control" value="{{old("bathrooms")}}"
                            id="bathrooms" required autofocus>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="parking_lots">Estacionamiento:</label>
                        <input name="parking_lots" type="number" class="form-control" id="parking_lots"
                            value="{{old("parking_lots")}}" required autofocus>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="antiquity">Antiguedad de la casa:</label>
                        <input name="antiquity" type="number" class="form-control" id="antiquity"
                            value="{{old("antiquity")}}" required autofocus>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="price">Precio:</label>
                        <input name="price" type="number" class="form-control" id="price" value="{{old("price")}}"
                            required autofocus>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="maintenance">Costo de reparacion:</label>
                        <input name="maintenance" type="number" class="form-control" id="maintenance" min="0" step=0.01
                            value="{{old("maintenance")}}" required autofocus>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="area">Terreno construido:</label>
                        <input name="area" type="number" class="form-control" id="area" min="0" step=0.01
                            value="{{old("area")}}" required autofocus>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="total_area_lot">Terreno:</label>
                        <input name="total_area_lot" type="number" class="form-control" id="total_area_lot" min="0"
                            step=0.01 value="{{old("total_area_lot")}}" required autofocus>
                    </div>
                    <div class="col-md-12 ">
                        <label for="address">Direccion:</label>
                        <input name="address" type="text" class="form-control" id="address" value="{{old("address")}}"
                            required autofocus>
                    </div>
                    <div class="box-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--property_services -->
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3>Marque los servicios disponibles:</h3>
                </div>
                <div class="box-body">
                    @foreach ($services as $service)
                    <div class="col-md-1">
                        <label class="font-weight-bold"><input type="checkbox" name="services[]" class="mx-1"
                                value="{{$service->id}}" />{{$service->service}}</span>
                    </div>
                    @endforeach
                </div>
                <div class="box-footer"></div>
            </div>
        </div>
    </div>

    <!-- Property Localization -->
    <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-8">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3>Marque la ubicacion:</h3>
                </div>
                <div class="box-body">
                    <div id="map" style="height:300px"></div>
                </div>
                <div class="box-footer"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3>Mensaje de venta:</h3>
                </div>
                <div class="box-body">
                    <textarea class="form-control" rows="4" cols="50" name="sale_message" id="sale_message" required
                        autofocus> {{old("sale_message")}}</textarea>
                </div>
                <div class="box-footer"></div>
            </div>
        </div>
    </div>
    <!--Property_photos -->
    <div class="row">
        <div class="col-md-2">
        </div>
            <div class="col-md-8">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3>Agregar fotos:</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-6 form-group">
                            <label for="images">Fotos de la casa:</label>
                            <input type="file" class="form-control-file" id="images" name="images[]" multiple>
                        </div>
                    </div>
                    <div class="box-footer text-right">
                        <button class="btn btn-success" type="submit">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <input type="text" name="latitude" id="Lat" style="display:none">
    <input type="text" name="length" id="Lng" style="display:none">
</form>
@endsection


<script>
    var marker;
        function initMap() {
            //ingreso de cordenadas de cd juarez
            var cdjuarez = {lat: 31.7000, lng: -106.4410}
            //creacion del mapa por google
            map = new google.maps.Map(document.getElementById('map'), {
              center: cdjuarez,
              zoom: 16
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