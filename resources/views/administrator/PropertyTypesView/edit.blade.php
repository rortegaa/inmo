@extends('layouts.administrator.app')

@section('content')


<div class="row justify-content-md-center">
    <div class="col-md-10">

        <div class="card shadow">
            <div class="card-header">
                <h5>Actualizar {{$type->property_type}} </h5>
            </div>
            <div class="card-body">
                <form id="createForm" role="form" method="POST"
                    action="{{route('property_types.update', ['id'=>$type->id])}}" onsubmit="validate(event);">
                    @csrf
                    @method('PATCH')
                    <div class="box-body">
                        <div class="form-group">
                            <label for="propertyStatus">Tipo de propiedad</label>

                            <input type="text" class="form-control" id="propertyType" name="property_type"
                                placeholder="Tipo de de la propiedad" value="{{$type->property_type}}" required
                                autofocus>
                        </div>
                    </div>
                    <button type="submit" id="createButtonForm" class="btn btn-success float-right">Actualizar</button>
                </form>

            </div>
        </div>


    </div>
</div>

@endsection

@section('scripts_footer')
<script>
    function validate(event) {
        createButtonForm.disabled = true;
    }
    
</script>
@endsection