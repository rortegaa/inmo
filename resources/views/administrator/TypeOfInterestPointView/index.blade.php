@extends('layouts.administrator.admin') 

@section('content')

@include('shares.errors')

@include('shares.SuccessBootstrapAlert')

<div id="root">
    <p>
        <a class="btn btn-primary btn-sm " data-toggle="collapse" href="#collapsePropertyType" role="button" aria-expanded="false" aria-controls="collapsePropertyType">
            <i class="fas fa-plus-square"></i> Agregar Nuevo
        </a>
    </p>
    <div class="collapse" id="collapsePropertyType">
        <div class="shadow p-3 mb-5 bg-white rounded">

                <form class="form-inline" method="POST" action=" {{ route('type_of_interest_point.store') }} ">
                
                    @csrf
                    <div class="form-group">
                        <label for="state">Agregar neuva categoria de punto de interes</label>
                        <input type="text" id="type_name" name="type_name" class="form-control mx-sm-3" aria-describedby="types" value="{{old('type_name')}}" v-model="clickedTypes" required autofocus>
                        <button type="submit" class="btn btn-primary my-1">Agregar</button>
                    </div>            
                </form>
        </div>
    </div>

    @if ($types->count() > 0)

    <div class="shadow p-3 mb-5 bg-white rounded" id="root">

        <table id="records" class="table table-striped table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Categorias </th>
                    <th scope="col">Ingresado por:</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                   @foreach ($types as $key => $type)
                   <tr>
                       <th scope="row">{{ $key + 1 }}</th>
                       <td> {{ $type->type_name }} </td>
                       <td> {{ $type->inserted_by }} </td>
                       <td class="text-center">
                           <div class="d-flex justify-content-center bd-highlight">                                
                                    <button id="{{ $type->type_name }}" class="btn btn-outline-primary btn-sm" @click="updateAlert"><i class="fas fa-pen"></i></button>                       
                                <form id="delete {{ $type->type_name }}" method="POST" action=" {{ route('type_of_interest_point.destroy',['state'=>$type->type_name]) }}">
                                    @method('DELETE')
                                    @csrf
                                <button class="btn btn-outline-danger btn-sm" @click="onDeleteRecord"><i class="fas fa-trash-alt"></i></button>
                                </form>
                           </div>
                       </td>
                   </tr>
                   @endforeach
            </tbody>
        </table>
   
   </div>
  
    @else

</div>

    @include('shares.emptyView')

@endif

@endsection

@section('scripts_footer')
    <script>
     
        window.onload = function()
        {
            const app  = new Vue({
                el: '#root',
                data: {                  
                    clickedTypes:'',
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
                    },
                    updateAlert(event){
                        event.preventDefault();
                       let type = event.currentTarget.id;      
                       let url = '{{ url('') }}'; 

                        Swal.fire({
                        title: 'Update state',
                        html: `
                        <form id="update${type}"  method="POST" action="${url}/admin/type_of_interest_point/${type}">
                            @method('PUT')
                            @csrf  
                            <input type="text" id="property_type" name="property_type" class="swal2-input" value="${type}" required autofocus>   
                            <button type="submit" class="btn btn-primary btn-lg btn-block" >submit</button>
                            <input type="button" class="btn btn-secondary btn-lg btn-block" onclick="Javascript:Swal.close()" value="cancel" > </input>
                        </form>
                        `,
                        
                        showCancelButton: false,
                        showConfirmButton: false,
                        })
                }
                },
                mounted() {
                    $('#collapsePropertyType').collapse({
                    toggle: true
                    })      
                    $('#records').DataTable();              
                },  
            }) 
        }
    </script>
@endsection