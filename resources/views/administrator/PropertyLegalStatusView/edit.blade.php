@extends('layouts.administrator.app')

@section('content')


<div class="row justify-content-md-center">
    <div class="col-md-10">

        <div class="card">
            <div class="card-header">
                <h5>Actualizar {{$legalStatus->property_legal_status}} </h5>
            </div>
            <div class="card-body">
                <form id="createForm" role="form" method="POST"
                    action="{{route('legal_status.update', ['id'=>$legalStatus->id])}}" onsubmit="validate(event);">
                    @csrf
                    @method('PATCH')
                    <div class="box-body">
                        <div class="form-group">
                            <label for="propertyStatus">Estatus legal de la propiedad</label>

                            <input type="text" class="form-control" id="propertyLegalStatus" name="property_legal_status"
                                placeholder="Estatus legal de la propiedad" value="{{$legalStatus->property_legal_status}}" required
                                autofocus>
                        </div>
                    </div>
                    <button type="submit" id="createButtonForm" class="btn btn-success float-right">Guardar</button>
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