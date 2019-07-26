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

<!-- Pagina encargada de cargar las areas ingresadas por el usuario-->
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Areas</h5>
                    <div id="map"></div>
                </div>
            </div>
   

@endsection


@section('scripts_footer')
<script>
        let url = '{{ url('') }}'; 
        let map;
        let areas_color = {'high':'#34bf56','medium':'#e8b630', 'low':'#ff3030'};
        let areas_colorHover = {'high':'#33c475','medium':'#dca40e', 'low':'#dc2d0e'};
        /*   let infoWindow; */
            //Inicializacion del mapa de google.
            function initMap() {
    
                map = new google.maps.Map(document.getElementById('map'), {
                    center: new google.maps.LatLng(31.7000, -106.4410),
                    zoom: 7
                });         
    
                let infoWindow = new google.maps.InfoWindow; 
                
                //Obtiene los puntos de cada una de las areas.
                let data = @json($localization);
                
                //Recorre cada uno de los puntos registrados.
                data.forEach((element,index) => {
                    let coordinates = [];                   
                    element.localization.forEach(element => {                        
                        coordinates.push({'lat': element.latitude, 'lng': element.length});
                    });
                    
                    console.log(element);
                    //Crea la ventanda de informacion
                    let div = `
                    <div class="card text-left">
                    <div class="card-body">
                        <h5 class="card-title">Area: ${element.area_name}</h5>
                            <ul class="list-group list-group-flush ">
                                <li><strong>Security Level:</strong> ${element.security}</li>
                                <li><strong>Social Status:</strong> ${element.social_status}</li>
                            </ul><br>
                        <div class="d-flex justify-content-center bd-highlight">        
                            <a href="${url}/admin/security_social_area/edit/${element.id}" class="btn btn-outline-primary btn-sm">Update</a> 
                            <form id="${element.id}" action="${url}/admin/security_social_area/delete/${element.id}" onsubmit="javascript:deleteLocalization(event)"> 
                            <button type="submit" class="btn btn-outline-danger btn-sm"> Delete </button>
                            </form>
                        </div>
                     </div>
                    </div>                
                    `;        
                    //Genera el area y la ingresa al mapa
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
            //Funcion que se encarga de eliminar algun area deseada.
            function deleteLocalization(event)
            {
                event.preventDefault();

                let form = event.target.id; 
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.value) {
                        document.getElementById(form).submit();
                    }
                });
            }
    
    </script>
@endsection