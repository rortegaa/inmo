@extends('layouts.administrator.app') 

@section('content')

@include('shares.errors')

@include('shares.SuccessBootstrapAlert')

<div class="root">
    <p>
        <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#collapsePropertyStatus" role="button" aria-expanded="false" aria-controls="collapsePropertyStatus">
            <i class="fas fa-plus-square"></i> Add New
        </a>
    </p>
    <div class="collapse" id="collapsePropertyStatus">
        <div class="shadow p-3 mb-5 bg-white rounded">

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

    <div class="shadow p-3 mb-5 bg-white rounded" id="root">
            
        <table id="records" class="table table-striped table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Property Status</th>
                    <th scope="col">Inserted By</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($property_status as $key => $property_status)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td> {{ $property_status->property_status }} </td>
                        <td> {{ $property_status->inserted_by }} </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center bd-highlight">
                                <button id=" {{$property_status->property_status }}" class="btn btn-outline-primary btn-sm" @click="updateAlert"><i class="fas fa-pen"></i></button>
                                <form id="update {{ $property_status->property_status }}"  method="POST" action=" {{ route('property_status.destroy', ['propertyStatus'=>$property_status->property_status]) }}" >
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
</div>
@else

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
                clickedPropertyStatus:'',
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
                   let propertyStatus = event.currentTarget.id;     
                   let url = '{{ url('') }}'; 
                   let updateForm;
                    console.log(url);

                    Swal.fire({
                    title: 'Update Property Status',
                    html: `
                    <form id="update${propertyStatus}"  method="POST" action="${url}/admin/property_status/${propertyStatus}" >
                        @method('PUT')
                        @csrf  
                        <input type="text" id="state" name="property_status" class="swal2-input" value="${propertyStatus}" required autofocus>   
                        <button type="submit" class="btn btn-primary btn-lg btn-block" >submit</button>
                        <input type="button" class="btn btn-secondary btn-lg btn-block" onclick="Javascript:Swal.close()" value="cancel" required autofocus > </input>
                    </form>
                    `,
                    
                    showCancelButton: false,
                    showConfirmButton: false,
                    })
            }
            },
            mounted() {
                $('#collapsePropertyStatus').collapse({
                toggle: true
                })      
                $('#records').DataTable();              
            },  
        }) 
    }

</script>
@endsection