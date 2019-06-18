@extends('layouts.administrator.app') 

@section('custom_styles')

     <style>
        #map {
          height: 600px;
          width: 100%;
        }
      </style>
    
@endsection

@section('content')

@include('shares.errors')

@include('shares.SuccessBootstrapAlert')

    <div id="root" class="row shadow p-3 mb-5 bg-white rounded">
            <div class="col-lg-4">
                
                    <div class="card">
                    <form  action="{{ route('security_social.update', ['id'=>$localization->id]) }}" method="POST">
                        <div class="card-header  text-center ">
                                Update Area: <strong> {{ $localization->area_name }}</strong>
                        </div>
                        <div class="card-body">
                                        
                                @csrf

                                <div class="form-group">
                                    <label for="area_name">Area Name</label>
                                    <input type="text" class="form-control" name="area_name" id="area_name" placeholder="Area Name" value="{{ $localization->area_name }}">
                                </div>

                                <div class="form-group">
                                    <label for="security">Security level</label>
                                    <select class="form-control" name="security" id="security">
                                        <option value="">Select Option</option>

                                        @for ($i = 0; $i <= 10; $i++)
                                            <option value="{{ $i }}"
                                            
                                                @if ($localization->security == $i)
                                                    {{_('selected')}}
                                                @endif

                                            >{{ $i }}</option>
                                        @endfor
                                       
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="social_status">Social status</label>
                                    <input type="text" class="form-control" name="social_status" id="social_status" placeholder="social status" value="{{ $localization->social_status }}">
                                </div>

                                <button type="update" class="btn btn-primary">submit</button>
                                <input type="button" id="reset" class="btn btn-danger" value="clean" disabled/>
                        
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
       
        let area;
            function initMap() {
               
                    let map = new google.maps.Map(document.getElementById('map'), {
                        disableDefaultUI: true,
                        center: {
                        lat: -34.397,
                        lng: 150.644
                        },
                        zoom: 8
                    })   
                    
                    
                var infoWindow = new google.maps.InfoWindow; 
                
                var element = @json($localization);
              
                            
               
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
                            </ul>
                    </div>
                    </div>                
                    `;          
                    
                    area = new google.maps.Polygon({
                        paths: coordinates,
                        id: element.id,
                        strokeColor: '#DC026C',
                        strokeOpacity: 0.8,
                        strokeWeight: 3,
                        fillColor:  '#9B0070',
                        fillOpacity: 0.35,
                        clickable:true,
                        editable: true,
                        draggable: true
                    });
        
                    area.setMap(map);                  
        
                    google.maps.event.addListener(area, 'click', function (event) {                               
                        infoWindow.setPosition(event.latLng)
                        infoWindow.setContent(div); 
                        infoWindow.open(map, area);
                    });  

                    google.maps.event.addListener(area.getPath(), "insert_at", getPolygonCoords);
                    google.maps.event.addListener(area.getPath(), "set_at", getPolygonCoords);      
                    
                    
                     
  
             }

               function getPolygonCoords(){
                $('#container_hidden').empty();
                var vertices = area.getPath();
                for (var i=0; i < vertices.getLength(); i++) {
                    var xy = vertices.getAt(i);
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
    
         
    
    </script>
@endsection