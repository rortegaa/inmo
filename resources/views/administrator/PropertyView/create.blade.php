@extends('layouts.administrator.app') 
@section('content')
@include('shares.errors')
@include('shares.SuccessBootstrapAlert')

<div class="container">
    <div class="row">
        <!--Property Gral -->
        <div class="row">
            <div class="col from-group">
                <label for="property_type_id">Ingrese tipo:</label>
                <select class="form-control" id="property_type_id" name="property_type_id">
                    <option value="">Seleccione opcion</option>
                    @foreach ($propertyTypes as $propertyType)
                        <option value="{{$propertyType->id}}">{{$propertyType->property_type}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col from-group">
                <label for="property_status_id">Ingrese estatus</label>
                <select class="form-control" id="property_status_id" name="property_status_id">
                    <option value="">Seleccione opcion</option>
                    @foreach ($propertySatuses as $propertyStatus)
                        <option value="{{$propertyStatus->id}}">{{$propertyStatus->property_status}}</option>
                     @endforeach
                </select>
            </div>
            <div class="col from-group">
                <label for="property_legal_status_id">Ingrese estado legal:</label>
                <select class="form-control" id="property_legal_status_id" name="property_legal_status_id">
                <option value="">Seleccione opcion</option>
                @foreach ($propertyLegalSatuses as $propertyLegalSatus)
                    <option value="{{$propertyLegalSatus->id}}">{{$propertyLegalSatus->property_legal_status}}</option>
                @endforeach
                </select>
            </div>
            <div class="col from-group">
                <label for="country">Ingrese estado:</label>
                <select class="form-control" id="state_id" name="state_id">
                <option value="">Seleccione opcion</option>
                @foreach ($states as $state)
                    <option value="{{$state->id}}">{{$state->state}}</option>
                @endforeach
                </select>
            </div>
        </div>
        <!--Information Property -->
        <div class="row">
                <div class="col-3 form-group">
                    <label for="beedrooms">Cuartos:</label>
                    <input name="beedrooms" type="number" class="form-control" id="beedrooms">
                </div>
                <div class="col-3 form-group">
                    <label for="bathrooms">Baños:</label>
                    <input name="bathrooms" type="number" class="form-control" id="bathrooms">
                </div>
                <div class="col-3 form-group">
                    <label for="parking_lots">Estacionamiento:</label>
                    <input type="parking_lots" class="form-control" id="parking_lots">
                </div>
                <div class="col-3 form-group">
                    <label for="ReparationCost">Costo de la reparacion:</label>
                    <input name="reparation_cost" type="number" class="form-control" id="ReparationCost" min="0" step=0.01>
                </div>
            </div>
    </div>
</div>
@endsection
