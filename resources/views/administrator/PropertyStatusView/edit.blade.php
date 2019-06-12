@extends('layouts.administrator.admin')

@section('title')
Aminnova Estatus legales
@endsection

@section('content')


<div class="row">
    <div class="col-md-6 col-md-offset-3">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Actualizar {{ $propertyStatus->property_status }} </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="createForm" role="form" method="POST"
                action="{{route( 'legal_status.update', ['id'=>$propertyStatus->id])}}" onsubmit="validate(event);">
                @csrf
                @method('PATCH')
                <div class="box-body">
                    <div class="form-group">
                        <label for="propertyStatus">Estatus propiedad</label>


                        <input type="text" class="form-control" id="property_status" name="property_legal_status"
                            placeholder="Estatus propiedad" value="{{ $propertyStatus->property_status }}" required
                            autofocus>

                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" id="createButtonForm" class="btn btn-primary pull-right">Actualizar</button>
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