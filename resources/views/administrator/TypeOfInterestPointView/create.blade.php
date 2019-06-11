@extends('layouts.administrator.admin')

@section('title')
Aminnova Puntos de Interes Categoria
@endsection

@section('content')


<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Agrega Categoria </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action=" {{ route('type_of_interest_point.store') }} ">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="type_name" class="col-sm-2 control-label">Categoria</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="type_name"
                                name="type_name" placeholder="Categoria" required autofocus>
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Enviar</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>


    </div>
    <div class="col-md-1"></div>
</div>

@endsection