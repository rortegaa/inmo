@extends('layouts.administrator.admin')
@section('title')
Aminnova Puntos de Interes
@endsection
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="info-box pull-right">
            <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total de registros</span>
                <span class="info-box-number">{{ $interestPoints->count() }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="box">
            <div class="box-header">
                <h4 class="box-title"> Puntos de interes</h4>
                <a href=" {{ route('interest_point.create') }} " class="btn bg-maroon  margin pull-right">Nuevo
                    registro</a>
            </div>
            <div class="box-body">
                <div class="">
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('js')

<script>
    $('#records').DataTable();   
</script>

@endsection