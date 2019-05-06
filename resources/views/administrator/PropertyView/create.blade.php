@extends('layouts.administrator.app') 
@section('content')
    @include('shares.errors')
    @include('shares.SuccessBootstrapAlert')


    <form method="POST" action="{{ route('property.store') }}" role="form" enctype="multipart/form-data">
        {{ csrf_field() }}
        <!--Property Gral -->
        <div class="row my-2">
            <div class="col-3 from-group">
                <label for="property_type_id">House Type:</label>
                <select class="form-control" id="property_type_id" name="property_type_id">
                    <option value="">Seleccione opcion</option>
                    @foreach ($propertyTypes as $propertyType)
                        <option value="{{$propertyType->id}}">{{$propertyType->property_type}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-3 from-group">
                <label for="property_status_id">House Status:</label>
                <select class="form-control" id="property_status_id" name="property_status_id">
                    <option value="">Seleccione opcion</option>
                    @foreach ($propertySatuses as $propertyStatus)
                        <option value="{{$propertyStatus->id}}">{{$propertyStatus->property_status}}</option>
                     @endforeach
                </select>
            </div>
            <div class="col-3 from-group">
                <label for="property_legal_status_id">House Legal Status:</label>
                <select class="form-control" id="property_legal_status_id" name="property_legal_status_id">
                <option value="">Seleccione opcion</option>
                @foreach ($propertyLegalSatuses as $propertyLegalSatus)
                    <option value="{{$propertyLegalSatus->id}}">{{$propertyLegalSatus->property_legal_status}}</option>
                @endforeach
                </select>
            </div>
            <div class="col-3 from-group">
                <label for="country">State:</label>
                <select class="form-control" id="state_id" name="state_id">
                <option value="">Seleccione opcion</option>
                @foreach ($states as $state)
                    <option value="{{$state->id}}">{{$state->state}}</option>
                @endforeach
                </select>
            </div>
        </div>
        <!--Information Property -->
        <div class="row my-2">
            <div class="col-3 form-group">
                <label for="bedrooms">Rooms:</label>
                <input name="bedrooms" type="number" class="form-control" id="bedrooms ">
            </div>
            <div class="col-3 form-group">
                <label for="bathrooms">Bathrooms:</label>
                <input name="bathrooms" type="number" class="form-control" id="bathrooms">
            </div>
            <div class="col-3 form-group">
                <label for="parking_lots">Parking Spots:</label>
                <input name="parking_lots" type="text" class="form-control" id="parking_lots">
            </div>
            <div class="col-3 form-group">
                <label for="antiquity">House antiquity:</label>
                <input name="antiquity" type="number" class="form-control" id="antiquity">
            </div>
        </div>
        <div class="row my-2">
            <div class="col-3 form-group">
                <label for="price">Price:</label>
                <input name="price" type="number" class="form-control" id="price">
            </div>
            <div class="col-3 form-group">
                <label for="maintenance">Reparation Cost:</label>
                <input name="maintenance" type="number" class="form-control" id="maintenance" min="0" step=0.01>
            </div>
            <div class="col-3 form-group">
                <label for="area">House Construction m2:</label>
                <input name="area" type="number" class="form-control" id="area" min="0" step=0.01>
            </div>
            <div class="col-3 form-group">
                <label for="total_area_lot">Terrain:</label>
                <input name="total_area_lot" type="number" class="form-control" id="total_area_lot" min="0" step=0.01>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-12 form-group">
                <label for="sale_message">Sale Message:</label>
                <textarea class="form-control" rows="4" cols="50" name="sale_message" id="sale_message"></textarea>
            </div>
        </div>
        <!-- Property Localization -->
        <div class="row my-2">
            <div class="col-12 ">
                <div id="map" style="height:300px"></div>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-12 ">
                <label for="address">Address:</label>
                <input name="address" type="text" class="form-control" id="address">
            </div>
        </div>
        <input type="text" name="latitude" id="Lat" style="display:none">
        <input type="text" name="length" id="Lng" style="display:none">
        <!--Property_photos -->
        <div class="row my-2">
            <div class="col-6 form-group">
                <label for="images">House Images:</label>
                <input type="file" class="form-control-file" id="images" name="images[]" multiple>
            </div>
            <div class="col-6 form-group">
                <input type="submit" class="btn btn btn-primary" value="Guardar">
            </div>
        </div>
    </form>
@endsection



<script
  src="https://code.jquery.com/jquery-3.4.0.js"
  integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
  crossorigin="anonymous"></script>
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
