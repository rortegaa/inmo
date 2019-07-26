@extends('layouts.administrator.app')
@section('content')

<!--Pagina encargada de crear el nuevo registro para un estado legal de la propiedad-->
<div class="row justify-content-md-center">
    <div class="col-md-10">

        <div class="card shadow">
            <div class="card-header ">
                <h5>Agrega estatus legales de las propiedades </h5>
            </div>
            
            <div class="card-body">
                <!--Forma encargada de regitrar en la base de datos la informacion-->
                <form id="createForm" role="form" method="POST" action="{{route('legal_status.store')}}"
                    onsubmit="validate(event);">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="property_legal_status">Estatus legal</label>

                            <input type="text" class="form-control" id="propertyLegalStatus" name="property_legal_status"
                                placeholder="Estatus legal" required autofocus>
                        </div>
                    </div>
                    <button  type="submit"  id="createButtonForm" class="btn btn-success float-right">Guardar</button>
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