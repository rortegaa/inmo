@extends('layouts.administrator.app') 

@section('content')

@include('shares.errors')

@include('shares.SuccessBootstrapAlert')

<div id="root">
<p>
    <a class="btn btn-primary" data-toggle="collapse" href="#collapseState" role="button" aria-expanded="false" aria-controls="collapseState">
        Add new state
    </a>
</p>
<div class="collapse" id="collapseState">
    <div class="shadow-sm p-3 mb-5 bg-white rounded">

            <form class="form-inline" method="POST" action=" {{ route('states.store') }} ">
             
                @csrf
                <div class="form-group">
                    <label for="state">Add State</label>
                    <input type="text" id="state" name="state" class="form-control mx-sm-3" aria-describedby="state" value="{{ old('state') }}" v-model="clickedState" required autofocus>
                    <button type="submit" class="btn btn-primary my-1">Submit</button>
                </div>            
            </form>
    
    </div>
</div>

@if ($states->count() > 0)

  
    @foreach ($states as $key => $state)
        @if ($key % 4 == 0)
        <div class="card-group">            
        @endif

        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"> {{ ($key+1) .')  '. $state->state }}</h5>
                <div class="d-flex flex-row-reverse bd-highlight">
                    <a href="#" id="{{ $state->state }}" class="btn btn-outline-primary btn-sm" @click="updateState"><i class="fas fa-pen"></i></a>
                    <form id=" {{ $state->state }}" method="POST" action=" {{ route('states.destroy',['state'=>$state->state]) }}"  >
                        @method('DELETE')
                        @csrf
                    <button class="btn btn-outline-danger btn-sm" @click="onDeleteRecord"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </div>
            </div>
        </div>

        @php
          
        @endphp
        @if (($key+1) % 4 == 0)
            </div>
        @endif
    @endforeach
  
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
                  
                    clickedState:'',
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
                    updateState(event){
                      event.preventDefault();
                      this.clickedState = event.currentTarget.id;
                                                     

                    Swal.fire({
                    title: 'Update state',
                    html: `
                    <form id="update${this.clickedState}"  method="POST" action=" {{ route('states.store') }} ">
                        @method('PATCH')
                        @csrf  
                        <input type="text" id="state" name="state" class="swal2-input" value="${this.clickedState}" required autofocus>         
                    </form>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Update',
                    showLoaderOnConfirm: true
                    }).then((result) => {
                        if (result.value) {
                            let updateForm = document.getElementById('update'+this.clickedState);
                            updateForm.submit();
                        }
                    });
                }
                },
                mounted() {
                    $('#collapseState').collapse({
                    toggle: true
                    })
                    
                },  
            }) 
        }
    
    </script>
@endsection