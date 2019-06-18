@extends('layouts.administrator.app')

@section('content')


<div class="row justify-content-md-center">
    <div class="col-md-10">

        <div class="card shadow">
            <div class="card-header ">
                <h5>Agrega estatus de las propiedades </h5>
            </div>
            
            <div class="card-body">
                <form id="createForm" role="form" method="POST" action="{{route('property_status.store')}}"
                    onsubmit="validate(event);">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="property_status">Estatus propiedad</label>

                            <input type="text" class="form-control" id="propertyStatus" name="property_status"
                                placeholder="Estatus propiedad" required autofocus>
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