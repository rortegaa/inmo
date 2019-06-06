@extends('layouts.administrator.admin')
@section('content')
@include('shares.errors')
@include('shares.SuccessBootstrapAlert')
<h5>Inmobiliarios</h5>

<div class="row">
    @foreach ($property as $item)
    <div class="col-md-4">
      <div class="box box-default">
        <div class="box-header with-border">
          <h4>{{$item->propertyType->property_type}} - {{$item->propertyLocalization->address}}</h4>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-2">

            </div>
            <div class="col-md-8">
                <img src="{{$item->propertyPhotos[0]->url}}" height="200px" width="325px">
            </div>
          </div>

        </div>
        <div class="box-footer">
          Price: {{$item->propertyInformation->price}}
          <br>
          Rooms: {{$item->propertyInformation->bedrooms}}
          <br>
          Terreain {{$item->propertyInformation->total_area_lot}} m2
          <br>
          <a class="btn btn-sm btn-primary" href='{{url('admin/property')}}/${value.id}/edit'>Edit</a>
          <input type="button" value="Delete" class="btn btn-sm btn-danger"
            onclick="confirmation_delete(${value.id})">
        </div>
      </div>
    </div>
    @endforeach
</div>



<!-- TABPANEEE
<div class="shadow p-3 bg-white rounded">
  <a type="button" class="btn btn-primary" href="{{route('property.create')}}">Agregar</a>
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
        aria-selected="true">Mapa</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
        aria-selected="false">Lista</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    </div>
  </div>

  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    @foreach ($property as $item )
    <div class="container py-3">
      <div class="card">
        <div class="row">
          <div class="col-md-4">
            <img src="{{$item->propertyPhotos[0]->url}}" class="w-100">
          </div>
          <div class="col-md-8 px-3 py-3">
            <div class="card-block px-3">
              <h4 class="card-title">{{$item->propertyType->property_type}} - {{$item->propertyLocalization->address}}
              </h4>
              <p class="card-text">Price: {{$item->propertyInformation->price}}, Rooms:
                {{$item->propertyInformation->bedrooms}}, Terreain {{$item->propertyInformation->total_area_lot}} m2
              </p>
              <p class="card-text">Estatus: {{$item->propertyLegalStatus->property_legal_status}} </p>
              <br>
              <a class="btn btn-sm btn-primary" href='{{url('admin/property')}}/${value.id}/edit'>Edit</a>
              <input type="button" value="Delete" class="btn btn-sm btn-danger"
                onclick="confirmation_delete(${value.id})">
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  -->
</div>
@endsection


<script src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<!--
<script>
  var map;
    var timeout;
    var mouseOverInfoWindow = false;
    var property = @json($property);
    var data = @json($localization);
    var areas_color = {'high':'#34bf56','medium':'#e8b630', 'low':'#ff3030'};
    var areas_colorHover = {'high':'#33c475','medium':'#dca40e', 'low':'#dc2d0e'};
    function initMap() {
        //ingreso de cordenadas de cd juarez
        var cdjuarez = {lat: 31.7000, lng: -106.4410}
              //creacion del mapa por google
              map = new google.maps.Map(document.getElementById('map'), {
                center: cdjuarez,
                zoom: 16
              });
              data.forEach((element,index) => {
                    var coordinates = [];                   
                    element.localization.forEach(element => {                        
                        coordinates.push({'lat': element.latitude, 'lng': element.length});
                    });
                    let area = new google.maps.Polygon({
                        paths: coordinates,
                        id: element.id,
                        strokeColor: setColorBorder(element.security),
                        strokeOpacity: 0.8,
                        strokeWeight: 3,
                        fillColor: setColor(element.security) ,
                        fillOpacity: 0.35,
                        clickable:true
                    });
        
                    area.setMap(map);  
              });
              $.each(property, function(key,value) {
                var cords = {lat: value.property_localization.latitude, lng: value.property_localization.length };
                //creacion del marker por cordenada
                var marcador = new google.maps.Marker({position: cords ,map: map});
                var img = value.property_photos[0].url
                //creacion de la informacion  
                var informacion = new google.maps.InfoWindow({
                  content: 
                  `
                  <div class="">
                    <img src="${img}" class="card-img-top" style="width:100px;heigth:125px;">
                    <div class="">
                    </br>
                        <i class="fas fa-dollar-sign"></i> <label>${parseInt((""+value.property_information.price).substring(0,3))}</label>
                        <i class="fas fa-vector-square"></i> <label>${parseInt((""+value.property_information.area).substring(0,3))}</label>
                        <i class="fas fa-bed"></i> <label>${value.property_information.bedrooms}</label>
                        </div>   
                      </div>
                      </br>
                      <div class="row">
                      <a class="btn btn-sm btn-primary"  href='{{url('admin/property')}}/${value.id}/edit'>Editar </a>
                      <input type="button" value="Eliminar" class="btn btn-sm btn-danger"  onclick="confirmation_delete(${value.id})">
                      </div>
                    `,
                 maxWidth: 175,
                 //disableAutoPan : true
                });
                //evento para llamar a la informacion hover
                marcador.addListener('mouseover', function(){
                  if(timeout) clearTimeout(timeout);
                  informacion.open(marcador.get('map'), marcador);
                  var infoWindowElement = document.querySelector('.gm-style .gm-style-iw');
                  infoWindowElement.addEventListener('mouseleave', function() {
                    informacion.close();
                    mouseOverInfoWindow = false;
                  });
                  infoWindowElement.addEventListener('mouseenter', function() {
                    mouseOverInfoWindow = true;
                  });
                });
                marcador.addListener('mouseout',function(){
                  timeout = setTimeout(function(){
                    
                    if(!mouseOverInfoWindow){
                      informacion.close();
                    }
                  },800);
                });
               
                map.addListener('zoom_changed', function() {
                
                if (map.getBounds().contains(marcador.getPosition())) {
                  console.log(marcador.getPosition().lat() + marcador.getPosition().lng());
                }
                });
              });
            }
    function confirmation_delete(id)
      {
        Swal.fire({
          title: '¿Quieres eliminar la casa?',
          text: "Una vez eliminado, no podra ser recuperado!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Borrar!'
          }).then((result) => {
            if (result.value) {
              delete_area(id);
            }
          })
      }
    function delete_area(id){
             try {       
                $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: 'DELETE',
                url: 'property/'+id,
                data: { id: id},  
                }).done(function(item){
                  if (item.data == true) {
                    Swal.fire({
                        type: 'success',
                        title: 'Registro eliminado correctamente',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    initMap();
                  };
                }).fail(function(data) {
                   console.log(data);
                });
            }catch (error) {
                console.log(error);
            } 
        }
      
    function setColorBorder(level){
                if(level <= 5 ){
                    return areas_color.low;
                }else if(level > 5 && level < 8){
                    return areas_color.medium;
                }else if(level >8){
                    return areas_color.high;
                } 
            }
    function setColorHover(level){
                if(level <= 5 ){
                    return areas_color.low;
                }else if(level > 5 && level < 8){
                    return areas_color.medium;
                }else if(level >8){
                    return areas_color.high;
                }
            }
    
    function setColor(level){
                if(level <= 5 ){
                    return areas_color.low;
                }else if(level > 5 && level < 8){
                    return areas_color.medium;
                }else if(level >8){
                    return areas_color.high;
                }
                
            } 
</script> 
-->