@extends('layouts.administrator.admin')


@section('title')
Aminnova Categorias de Puntos de Interes
@endsection

<!-- Pagina en desarrollo -->
@section('content')
<div class="row">
    <div class="col-md-4">

        <div class="info-box pull-right">
            <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Total de registros</span>
                <span class="info-box-number">{{ $types->count() }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
</div>
<div class="box">

    <div class="box-header">
        <h4 class="box-title"> Categorias de puntos de interes</h4>
        <a href=" {{ route('type_of_interest_point.create') }} " class="btn bg-maroon  margin pull-right">Nuevo registro</a>
    </div>
    <div class="box-body">
        <table id="records" class="table table-striped table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Insertado por</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @if ($types->count() > 0)
                @foreach ($types as $key => $type)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td> {{ $type->type_name }} </td>
                    <td> {{ $type->inserted_by }} </td>
                    <td>

                        <a href="" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Editar
                        </a>

                    </td>
                    <td>
                        <form action="">
                            <button type="button" class="btn btn-danger">
                                <i class="fa fa-trash"></i> Borrar
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
                @else

                @endif
            </tbody>
        </table>
    </div>

</div>



@endsection

@section('js')

<script>
    $('#records').DataTable();   
</script>

@endsection