@extends('layouts.administrator.app')

@section('content')


<div class="row justify-content-md-center">
    <div class="col-md-10">

        <div class="card shadow">
            <div class="card-header">
                <h5>Actualizar {{ $propertyStatus->property_status }} </h5>
            </div>
            <div class="card-body">
                <form id="createForm" role="form" method="POST"
                    action="{{route('property_status.update', ['id'=>$propertyStatus->id])}}" onsubmit="validate(event);">
                    @csrf
                    @method('PATCH')
                    <div class="box-body">
                        <div class="form-group">
                            <label for="propertyStatus">Estatus propiedad</label>

                            <input type="text" class="form-control" id="property_status" name="property_status"
                                placeholder="Estatus propiedad" value="{{$propertyStatus->property_status}}" required
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