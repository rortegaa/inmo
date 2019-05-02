@extends('layouts.administrator.app') 

@section('content')

@include('shares.errors')

@include('shares.SuccessBootstrapAlert')

<div id="root">
    <p>
        <a class="btn btn-primary btn-sm " data-toggle="collapse" href="#collapsePropertyType" role="button" aria-expanded="false" aria-controls="collapsePropertyType">
            <i class="fas fa-plus-square"></i> Add New
        </a>
    </p>
    <div class="collapse" id="collapsePropertyType">
        <div class="shadow p-3 mb-5 bg-white rounded">

                <form class="form-inline" method="POST" action=" {{ route('property_types.store') }} ">
                
                    @csrf
                    <div class="form-group">
                        <label for="state">Add Property Type</label>
                        <input type="text" id="property_type" name="property_type" class="form-control mx-sm-3" aria-describedby="types" value="{{old('property_type')}}" v-model="clickedTypes" required autofocus>
                        <button type="submit" class="btn btn-primary my-1">Submit</button>
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
                    <th scope="col">Property Types</th>
                    <th scope="col">Inserted By</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                   @foreach ($types as $key => $type)
                   <tr>
                       <th scope="row">{{ $key + 1 }}</th>
                       <td> {{ $type->property_type }} </td>
                       <td> {{ $type->inserted_by }} </td>
                       <td class="text-center">
                           <div class="d-flex justify-content-center bd-highlight">                                
                                    <button id="{{ $type->property_type }}" class="btn btn-outline-primary btn-sm" @click="updateAlert"><i class="fas fa-pen"></i></button>                       
                                <form id="delete {{ $type->property_type }}" method="POST" action=" {{ route('property_types.destroy',['state'=>$type->property_type]) }}">
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
                        <form id="update${type}"  method="POST" action="${url}/admin/property_types/${type}">
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