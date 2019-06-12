@extends('layouts.administrator.admin')


@section('title')
Aminnova Estatus propiedades
@endsection

@section('content')

@include('vendor.adminlte.partials.counterData', ['totalRegisters'=>$propertyStatus->count()])

<div class="box">

    <div class="box-header">
        <h4 class="box-title"> Estatus legales de las propiedades</h4>
        <a href=" {{ route('property_status.create') }} " class="btn bg-maroon  margin pull-right">Nuevo registro</a>
    </div>
    <div class="box-body">
        <table id="records" class="table table-striped table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Estatus legal</th>
                    <th scope="col">Insertado por</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @if ($propertyStatus->count() > 0)
                @foreach ($propertyStatus as $key => $status)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td> {{ $status->property_status }} </td>
                    <td> {{ $status->inserted_by }} </td>
                    <td>

                        <a href="{{ route('property_status.edit', ['id'=>$status->id]) }}" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Editar
                        </a>

                    </td>
                    <td>
                        <form method="POST" action="{{ route( 'property_status.destroy', ['id'=>$status->id] ) }}"
                            onsubmit="return confirm('Deseas eliminar este registro?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" id="submitDelete" class="btn btn-danger">
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