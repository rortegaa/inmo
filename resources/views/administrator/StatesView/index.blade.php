@extends('layouts.administrator.app') 

@section('content')

@include('errors')

@if (Session::has('success'))

<div class="alert alert-primary alert-dismissible fade show" role="alert">
   {{ Session::get('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
    
@endif
<div class="shadow-sm p-3 mb-5 bg-white rounded">

        <form class="form-inline" method="POST" action=" {{ route('states.store') }} ">
            @csrf
            <div class="form-group">
                <label for="state">Add State</label>
                <input type="text" id="state" name="state" class="form-control mx-sm-3" aria-describedby="state" value="{{ old('state') }}" required autofocus>
                <button type="submit" class="btn btn-primary my-1">Submit</button>
            </div>            
        </form>
 
</div>



@if ($states->count() > 0)

    @php
    $iterations = 1;
    foreach ($states as $key => $state) {         
        
       $modTrue = $key % 4 == 0 ? true : false;
       
       echo $modTrue ? '<div class="card-group">':'';

       

       echo 
        '<div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">'.$iterations. ')  '. $state->state .'</h5>
                <div class="d-flex flex-row-reverse bd-highlight">
                    <a href="#" class="btn btn-outline-primary btn-sm"><i class="fas fa-pen"></i></a>
                    <form>
                    <a href="#" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                    </form>
                </div>
            </div>
        </div>';
       
        if($iterations % 4 == 0)
        {
            echo '</div>';
        }

        $iterations ++;

    }

    @endphp

@else

<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <h4 class="alert-heading">No existen registros </h4>
    <p>No hay estados registrados para mostrar, favor de agregar</p>
    <hr>
    <p class="mb-0">Cualquier duda o aclaracion , contactar al administrador </p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
    </button>
</div>

@endif
@endsection