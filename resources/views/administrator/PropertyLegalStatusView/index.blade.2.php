@extends('layouts.administrator.admin')

@section('content')
@include('vendor.adminlte.partials.alerts')
@include('vendor.adminlte.partials.errors')

<div class="row">
       
    <div class="col-md-12">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Agrega Estatus Legales </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action=" {{ route('legal_status.store') }} ">
                    @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="legal_status" class="col-sm-2 control-label">Estatus legal</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="legal_status" placeholder="Estatus legal" >
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-default">Regresar</button>
                    <button type="submit" class="btn btn-primary pull-right">Enviar</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>


    </div>
</div>

@endsection