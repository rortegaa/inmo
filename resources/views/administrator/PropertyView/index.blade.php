@extends('layouts.administrator.app') 
    @section('content')
        @include('shares.errors')
        @include('shares.SuccessBootstrapAlert')
        <div class="row">
            <div class="col-md-9">
              <div class="card w-100">
                <div class="card-body">
                  <h5 class="card-title">Inmobiliarios</h5>
                <a type="button" class="btn btn-primary" href="{{route('property.create')}}">Add</a>
                  <div id="map" style="height:500px;">
                    </div>
                </div>
              </div>
            </div>
          </div>
    @endsection

<script src="https://code.jquery.com/jquery-3.4.0.js" integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo=" crossorigin="anonymous"></script>
<script>
  var map;
    var timeout;
    var mouseOverInfoWindow = false;
    var property = @json($property)

    function initMap() {
        //ingreso de cordenadas de cd juarez
        var cdjuarez = {lat: 31.7000, lng: -106.4410}
              //creacion del mapa por google
              map = new google.maps.Map(document.getElementById('map'), {
                center: cdjuarez,
                zoom: 16
              });
              $.each(property, function(key,value) {
                var cords = {lat: value.property_localization.latitude, lng: value.property_localization.length };
                //creacion del marker por cordenada
                var marcador = new google.maps.Marker({position: cords ,map: map});
                var test = value.property_photos[0].url
                console.log(test)
                //creacion de la informacion  
                var informacion = new google.maps.InfoWindow({
                  content: 
                  `
                  <div class="">
                    <img src="${test}" class="card-img-top" style="width:100px;heigth:125px;">
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
</script>
