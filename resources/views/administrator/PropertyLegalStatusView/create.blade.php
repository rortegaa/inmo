@extends('layouts.administrator.admin')

@section('title')
Aminnova Estatus legales
@endsection

@section('content')


<div class="row">
    <div class="col-md-6 col-md-offset-3">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Agrega Estatus Legales </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
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
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" id="createButtonForm" class="btn btn-primary pull-right">Enviar</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>


    </div>
    <div class="col-md-1"></div>
</div>

@endsection

@section('js')
<script>
    function validate(event) {
        createButtonForm.disabled = true;
    }
    
</script>
@endsection