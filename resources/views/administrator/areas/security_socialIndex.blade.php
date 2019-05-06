@extends('layouts.administrator.app') 

@section('custom_styles')

     <style>
        #map {
            height: calc(100vh - 100px);
            width: 99%;
        }
      </style>
    
@endsection

@section('content')

@include('shares.errors')

@include('shares.SuccessBootstrapAlert')

    <div id="root" class="row shadow p-3 mb-5 bg-white rounded">

        <div class="col-md-12">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title">Areas</h5>
                    <div id="map"></div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts_footer')
<script>
        var map;
        var areas_color = {'high':'#34bf56','medium':'#e8b630', 'low':'#ff3030'};
        var areas_colorHover = {'high':'#33c475','medium':'#dca40e', 'low':'#dc2d0e'};
        /*   var infoWindow; */
    
            function initMap() {
    
                map = new google.maps.Map(document.getElementById('map'), {
                    center: new google.maps.LatLng(-34.397, 150.644),
                    zoom: 7
                });         
    
                var infoWindow = new google.maps.InfoWindow; 
                
                var data = @json($localization);
                            
                data.forEach((element,index) => {
                    let coordinates = [];                   
                    element.localization.forEach(element => {                        
                        coordinates.push({'lat': element.latitude, 'lng': element.length});
                       
                    });
                    
                    console.log(element);
                    let div = `
                    <div class="card text-left">
                    <div class="card-body">
                        <h5 class="card-title">Area: ${element.area_name}</h5>
                            <ul class="list-group list-group-flush ">
                                <li><strong>Security Level:</strong> ${element.security}</li>
                                <li><strong>Social Status:</strong> ${element.social_status}</li>
                            </ul><br>
                        <a href="#" class="btn btn-outline-primary">Update</a>   <a href="#" class="btn btn-outline-danger">Delete</a>
                    </div>
                    </div>                
                    `;

                    var infowincontent = document.createElement('div');
                    var strong = document.createElement('strong');
                    strong.textContent = 'Area';
                    infowincontent.appendChild(strong);
                    infowincontent.appendChild(document.createElement('br'));
                    var area_name = document.createElement('p');
                    area_name.textContent = element.area_name; 
                    infowincontent.appendChild(area_name);
                    var updatebutton = document.createElement('a');
                    updatebutton.textContent = 'Actualizar';
                    updatebutton.setAttribute('class','btn btn-sm btn-primary');
                    updatebutton.setAttribute('style','color: white');
                    infowincontent.appendChild(updatebutton);
                    updatebutton.addEventListener('click', function(){
                    location.href = '{{ url('') }}/'+element.id+'/edit';
                    });
                    var deletebutton = document.createElement('a');
                    deletebutton.textContent = 'Eliminar';
                    deletebutton.setAttribute('class','btn btn-sm btn-danger');
                    deletebutton.setAttribute('style','color: white');
                    deletebutton.addEventListener('click', function(){
                        confirmation_delete(element.area_name, element.id);
                    });
                    infowincontent.appendChild(deletebutton);           
                    
                    var area = new google.maps.Polygon({
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
        
                    area.addListener('mouseover', function(event){
                        this.setOptions({
                            fillColor: setColorHover(element.security)
                        });
                    });
        
                    area.addListener('mouseout', function(event){
                        this.setOptions({
                            fillColor: setColor(element.security)
                        });
                    });
                
        
                    google.maps.event.addListener(area, 'click', function (event) {                               
                        infoWindow.setPosition(event.latLng)
                        infoWindow.setContent(div); 
                        infoWindow.open(map, area);
                    });  
                    
                    
            });          
    
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
         
            function confirmation_delete(area, id){
                Swal.fire({
                    title: 'Quieres Eliminar el area: '+area+' ?',
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
    
            function delete_area(area){
                console.log('entro al delete');
                console.log(area);
                var route = '{{ url('areas') }}/'+area;
                
                console.log(route);
                 try {       
                    $.ajax({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'DELETE',
                    url: '{{ url('areas') }}/'+area,
                    data: { id: area },  
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
                       console.log(data.responseJSON);
                    });
    
                }catch (error) {
                    console.log(error);
                } 
            }
    
    </script>
@endsection