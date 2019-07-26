@extends('layouts.administrator.admin')

@section('title')
Aminnova Categorias de Putnos de Interes
@endsection

@section('content')

<!-- Pagina en desarrollo -->
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Editar: Categorias</h3>
            </div>
            <form class="form-horizontal" method="POST" action=" {{ route('type_of_interest_point.store') }} ">
                @csrf
                @method('PUT')
                <div class="box-body">
                    <div class="form-group">
                        <label for="type_name" class="col-sm-2 control-label">Estatus legal</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="type_name"
                                name="type_name" placeholder="Estatus legal" required autofocus>
                        </div>
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Enviar</button>
                </div>
            </form>
        </div>


    </div>
    <div class="col-md-1"></div>
</div>

@endsection