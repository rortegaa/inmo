@extends('layouts.administrator.admin')

@section('title')
Aminnova Estatus legales
@endsection

@section('content')


<div class="row">
    <div class="col-md-6 col-md-offset-3">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Agrega Estatus de las propiedades </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="createForm" role="form" method="POST" action="{{route('property_status.store')}}" onsubmit="validate(event);">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="property_status" >Estatus propiedad</label>

                       
                            <input type="text" class="form-control" id="propertyStatus"
                                name="property_status" placeholder="Estatus propiedad" required autofocus>
                    
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" id="createButtonForm" class="btn btn-primary pull-right">Enviar</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>


    </div>
</div>

@endsection

@section('js')
    <script>
    
    function validate(event) {
        createButtonForm.disabled = true;
    }
    
    </script>
@endsection