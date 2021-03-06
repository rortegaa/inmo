@extends('layouts.administrator.app') 

@section('custom_styles')

     <style>
        #map {
          height: 500px;
          width: 100%;
        }
      </style>
    
@endsection

@section('content')

@include('shares.errors')

@include('shares.SuccessBootstrapAlert')

    <div id="root" class="row shadow p-3 mb-5 bg-white rounded">
            <div class="col-lg-4">
                
                    <div class="card shadow">
                    <form  action="{{ route('security_social.store') }}" method="POST">
                        <div class="card-header  text-center ">
                                Crear Area
                        </div>
                        <div class="card-body">
                                        
                                @csrf

                                <div class="form-group">
                                    <label for="area_name">Nombre del area</label>
                                    <input type="text" class="form-control" name="area_name" id="area_name"   placeholder="Nombre del area" required autofocus>
                                </div>

                                <div class="form-group">
                                    <label for="security">Nivel de seguridad (1 - 10)</label>
                                    <select class="form-control" name="security" id="security" required autofocus>
                                        <option value="">Select Option</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="social_status">Estatus social (1 - 10)</label>
                                    <input type="text" class="form-control" name="social_status" id="social_status" required autofocus>
                                </div>

                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <input type="button" id="reset" class="btn btn-danger" value="Limpiar" disabled/>
                        
                        </div>
                        <div id="container_hidden" class="card-footer  text-muted">
                        </div>
                    </form>
                    </div>
                
        </div>
        <div class="col-lg-8">
            <div id="map"></div>
        </div>
    </div>

@endsection

@section('scripts_footer')
    <script>
        let all_overlays = [];

             function deleteAllShape() {
                for (var i = 0; i < all_overlays.length; i++) {
                    all_overlays[i].overlay.setMap(null);
                }
                all_overlays = [];
            }
        
            function initMap() {
                 let lat = [];
                 let lng = [];
                    let map = new google.maps.Map(document.getElementById('map'), {
                        disableDefaultUI: true,
                        center: {
                        lat: 31.7000,
                        lng: -106.4410
                        },
                        zoom: 8
                    })   
                    
                    
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
                                <li><strong>Security Level:</strong>  <span class="badge badge-pill badge-primary"> ${element.security}</span></li>
                                <li><strong>Social Status:</strong> ${element.social_status}</li>
                            </ul>
                    </div>
                    </div>                
                    `;          
                    
                    var area = new google.maps.Polygon({
                        paths: coordinates,
                        id: element.id,
                        strokeColor: '#DC026C',
                        strokeOpacity: 0.8,
                        strokeWeight: 3,
                        fillColor:  '#9B0070',
                        fillOpacity: 0.35,
                        clickable:true
                    });
        
                    area.setMap(map);                  
        
                    google.maps.event.addListener(area, 'click', function (event) {                               
                        infoWindow.setPosition(event.latLng)
                        infoWindow.setContent(div); 
                        infoWindow.open(map, area);
                    });  
                    
                    
                  });      

                    let drawingManager = new google.maps.drawing.DrawingManager({
                        drawingMode: google.maps.drawing.OverlayType.POLYGON,
                        drawingControl: true,
                        drawingControlOptions: {
                      
                        drawingModes: ['polygon']
                        }
                    });
                        
                    drawingManager.setMap(map);   
                    
                    google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
                        all_overlays.push(event);
                      
                            drawingManager.setDrawingMode(null);                        

                        if (event.type == 'polygon') {
                            reset.disabled = false;
                            drawingManager.setMap(null);  
                            lat=[];
                            lng=[];
                            let latlng = event.overlay;
                            let vertices = latlng.getPath();
                            for (let i=0; i < vertices.getLength(); i++) {
                                let xy = vertices.getAt(i);
                                var container = document.getElementById("container_hidden");
                                var input_text_lat = document.createElement("input");
                                input_text_lat.setAttribute("type", "text");
                                input_text_lat.setAttribute("class", "form-control");
                                input_text_lat.setAttribute("name", `lat[punto${i}]`);
                                input_text_lat.readOnly=true;
                                input_text_lat.value = xy.lat();
                                container.appendChild(input_text_lat);
                                var input_text_lng = document.createElement("input");
                                input_text_lng.setAttribute("type", "text");
                                input_text_lng.setAttribute("class", "form-control");
                                input_text_lng.setAttribute("name", `lng[punto${i}]`);
                                input_text_lng.value = xy.lng();
                                input_text_lng.readOnly=true; 
                                container.appendChild(input_text_lng);
                       
                            }   
                           
                        }
                      
                    });  
                    reset.onclick = () =>{
                        deleteAllShape();
                        drawingManager.setMap(map);   
                        $('#container_hidden').empty();
                    };   
             }
    
         
    
    </script>
@endsection