@extends('layouts.administrator.admin')
@section('content')
@include('shares.errors')
@include('shares.SuccessBootstrapAlert')
<!--Vista encargada de mostrar una informacion resumida del-->
<div class="shadow p-3 bg-white rounded">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4> Se {{$property->propertyStatus->property_status}} {{$property->propertyType->property_type}}
                        Precio: $ {{$property->propertyInformation->price}} </h4>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner" id="allImages">
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3>Caracteristicas:</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Cuartos: {{$property->propertyInformation->bedrooms}}<label>
                        </div>
                        <div class="col-md-12">
                            <label>Baños: {{$property->propertyInformation->bathrooms}}<label>
                        </div>
                        <div class="col-md-12">
                            <label>Estacionamiento: {{$property->propertyInformation->parking_lots}} lugares<label>
                        </div>
                        <div class="col-md-12">
                            <label>Antiguedad: {{$property->propertyInformation->antiquity}} años<label>
                        </div>
                        <div class="col-md-12">
                            <label>Precio por m2: $ {{$property->propertyInformation->price_per_area}}<label>
                        </div>
                        <div class="col-md-12">
                            <label>Mantenimiento: $ {{$property->propertyInformation->maintenance}}<label>
                        </div>
                        <div class="col-md-12">
                            <label>M2 Construidos: {{$property->propertyInformation->area}}<label>
                        </div>
                        <div class="col-md-12">
                            <label>M2 totales: {{$property->propertyInformation->total_area_lot}}<label>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <h5>Servicios:</h5>
                    <div class="row">
                        <ul>
                            @foreach ($property->propertyServices as $services)
                            <li>{{$services->service}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Mensaje de venta:</h5>
                            <label> {{$property->propertyInformation->sale_message}}<label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-8">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3>Ubiacion:</h3>
                </div>
                <div class="box-body">
                    <div class="col-12">
                        <div id="map" style="height:200px;"></div>
                    </div>
                    <h5>Direccion:</h5>
                    <label> {{$property->propertyLocalization->address}}<label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="dropdown-divider"></div>
<div class="row">
    <div class="col-12">

    </div>
</div>
<div class="row">

</div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.4.0.js" integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
    crossorigin="anonymous"></script>
<script>
    var map;
    var marker;
    var property = @json($property);
    var constrImages = ``;
    //Funcion en proceso que genera el mapa y las fotos de la casa en un carrusel (Estilo presentacion)
        $(function() {
            var img = property.property_photos;
            console.log(img);
            $.each(img, function(key,value) {
                constrImages = `<div class="carousel-item active"><img class="d-block w-100" src="${value.url}"></div>` + constrImages;
            });
            $('#allImages').append(constrImages);
        });
        function initMap() {
            //ingreso de cordenadas de cd juarez
            var locationHouse = {lat: parseFloat(property.property_localization.latitude), lng: parseFloat(property.property_localization.length)}
            //creacion del mapa por google
            map = new google.maps.Map(document.getElementById('map'), {
              center: locationHouse,
              zoom: 16
            });
            marker = new google.maps.Marker({
                position: locationHouse,
                map: map
            });
            
        }
</script>