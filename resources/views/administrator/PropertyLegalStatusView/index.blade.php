@extends('layouts.administrator.app') 

@section('content')

@include('shares.errors')

@include('shares.SuccessBootstrapAlert')


<p>
    <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#collapsePropertyLegalStatus" role="button" aria-expanded="false" aria-controls="collapsePropertyLegalStatus">
        <i class="fas fa-plus-square"></i> Add New
    </a>
</p>
<div class="collapse" id="collapsePropertyLegalStatus">
    <div class="shadow p-3 mb-5 bg-white rounded">

        <form class="form-inline" method="POST" action=" {{ route('legal_status.store') }} ">
            @csrf
            <div class="form-group">
                <label for="property_legal_status">Add property status</label>
                <input type="text" id="property_legal_status" name="property_legal_status" class="form-control mx-sm-3" aria-describedby="property_legal_status" value="{{ old('property_legal_status') }}" required autofocus>
                <button type="submit" class="btn btn-primary my-1">Submit</button>
            </div>            
        </form>
 
    </div>
</div>


@if ($property_legal_status->count() > 0)

<div class="shadow p-3 mb-5 bg-white rounded" id="root">
  
   
     <table class="table table-hover text-center">
         <thead>
             <tr>
                 <th scope="col">#</th>
                 <th scope="col">Legal Status</th>
                 <th scope="col">Inserted By</th>
                 <th scope="col">Actions</th>
             </tr>
         </thead>
         <tbody>
                @foreach ($property_legal_status as $key => $status)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td> {{ $status->property_legal_status }} </td>
                    <td> {{ $status->inserted_by }} </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center bd-highlight">
                            <a href="#"  class="btn btn-outline-primary btn-sm"><i class="fas fa-pen"></i></a>
                            <form id="{{ $status->property_legal_status }}" method="POST" action="{{ route('legal_status.destroy', ['property_legal_status'=>$status->property_legal_status]) }}" >
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

@include('shares.emptyView')


@endif

@endsection

