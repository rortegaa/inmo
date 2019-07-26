@extends('layouts.administrator.app') 

@section('content')

@include('shares.errors')

@include('shares.SuccessBootstrapAlert')

<!--Pagina encargada de la creacion, actualizacion y eliminacion de servicios-->
<div id="root">
    <p>
        <a class="btn btn-primary btn-sm " data-toggle="collapse" href="#collapseService" role="button" aria-expanded="false" aria-controls="collapseService">
            <i class="fas fa-plus-square"></i> Add New
        </a>
    </p>
    <div class="collapse" id="collapseService">
        <div class="shadow p-3 mb-5 bg-white rounded">
                <!--Forma encargada de ingresar un nuevo registro a la base de datos.-->
                <form class="form-inline" method="POST" action=" {{ route('services.store') }} ">
                
                    @csrf
                    <div class="form-group">
                        <label for="state">Add Service</label>
                        <input type="text" id="service" name="service" class="form-control mx-sm-3" aria-describedby="service" value="{{old('service')}}" v-model="clickedService" required autofocus>
                        <button type="submit" class="btn btn-primary my-1">Submit</button>
                    </div>            
                </form>
        </div>
    </div>
    <!--Tabla que contiene todos los servicios registrados en la base de datos.-->
    @if ($services->count() > 0)    

    <div class="shadow p-3 mb-5 bg-white rounded" id="root">

        <table id="records" class="table table-striped table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Service</th>
                    <th scope="col">Inserted By</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                   @foreach ($services as $key => $service)
                   <tr>
                       <th scope="row">{{ $key + 1 }}</th>
                       <td> {{ $service->service }} </td>
                       <td> {{ $service->inserted_by }} </td>
                       <td class="text-center">
                           <div class="d-flex justify-content-center bd-highlight">                                
                                    <button id="{{ $service->service }}" class="btn btn-outline-primary btn-sm" @click="updateAlert"><i class="fas fa-pen"></i></button>                       
                                <form id="delete {{ $service->service }}" method="POST" action=" {{ route('services.destroy',['service'=>$service->service]) }}">
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
                    clickedService:'',
                    formId: ''
                },
                methods: {
                    //Metodo encargado de la eliminacion del servicio
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
                    //Metodo para actualizar el servicio
                    updateAlert(event){
                        event.preventDefault();
                       let service = event.currentTarget.id;      
                       let url = '{{ url('') }}'; 

                        Swal.fire({
                        title: 'Update service',
                        html: `
                        <form id="update${service}"  method="POST" action="${url}/admin/services/${service}">
                            @method('PUT')
                            @csrf  
                            <input type="text" id="service" name="service" class="swal2-input" value="${service}" required autofocus>   
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
                    $('#collapseService').collapse({
                    toggle: true
                    })      
                    $('#records').DataTable();              
                },  
            }) 
        }
    </script>
@endsection