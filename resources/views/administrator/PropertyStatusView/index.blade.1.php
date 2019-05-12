@extends('layouts.administrator.app') 

@section('content')

@include('shares.errors')

@include('shares.SuccessBootstrapAlert')


<p>
    <a class="btn btn-primary" data-toggle="collapse" href="#collapseState" role="button" aria-expanded="false" aria-controls="collapseState">
        <i class="fas fa-plus-square"></i>
    </a>
</p>
<div class="collapse" id="collapseState">
    <div class="shadow-sm p-3 mb-5 bg-white rounded">

        <form class="form-inline" method="POST" action=" {{ route('property_status.store') }} ">
            @csrf
            <div class="form-group">
                <label for="property_status">Add property status</label>
                <input type="text" id="property_status" name="property_status" class="form-control mx-sm-3" aria-describedby="property_status" value="{{ old('property_status') }}" required autofocus>
                <button type="submit" class="btn btn-primary my-1">Submit</button>
            </div>            
        </form>
 
    </div>
</div>




@if ($property_status->count() > 0)
<div id="root">
  
    @foreach ($property_status as $key => $property_status)
        @if ($key % 2 == 0)
        <div class="card-group">            
        @endif

        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"> {{ ($key+1) .')  '. $property_status->property_status }}</h5>
                <div class="d-flex flex-row-reverse bd-highlight">
                    <a href="#" class="btn btn-outline-primary btn-sm"><i class="fas fa-pen"></i></a>
                    <form id=" {{ $property_status->property_status }}" method="POST" action=" {{ route('property_status.destroy',['property_status'=>$property_status->property_status]) }}"  >
                        @method('DELETE')
                        @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm" @click="onDeleteRecord"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </div>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        @php
          
        @endphp
        @if (($key+1) % 2 == 0)
            </div>
        @endif
    @endforeach
  
</div>

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

@section('scripts_footer')
    <script>
    
        
window.onload = function()
{
     const property_status  = new Vue({
        el: '#root',
        data: {
            formId: ''
        },
        methods: {
            onDeleteRecord(event){
                event.preventDefault();
                this.formId = event.currentTarget.form.id;
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.value) {
                      document.getElementById(this.formId).submit();
                    }
                });
            }
        },
    }) 
}
    
    </script>
@endsection