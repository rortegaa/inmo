@extends('layouts.administrator.app')

@section('content')

<div class="card shadow">

    <div class="card-header">
        <div class="row">
            <div class="col-md-6"> <h5>Estatus legales de las propiedades</h5></div>
            <div class="col-md-6">  <a href="{{route('legal_status.create')}}" class="btn btn-success float-right">Nuevo registro</a></div>               
        </div>
    </div>
    <div class="card-body">
        <table id="records" class="table table-striped table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Estatus legal</th>
                    <th scope="col">Insertado por</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @if ($legalStatus->count() > 0)
                @foreach ($legalStatus as $key => $status)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td> {{ $status->property_legal_status }} </td>
                    <td> {{ $status->inserted_by }} </td>
                    <td>

                        <a href="{{route('legal_status.edit', ['id'=>$status->id])}}" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Editar
                        </a>

                    </td>
                    <td>
                        <form method="POST" action="{{route( 'legal_status.destroy', ['id'=>$status->id])}}"
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

@section('scripts_footer')

<script>
    window.onload = function(){
          $('#records').DataTable(); 
    } 
</script>

@endsection