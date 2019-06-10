@if ($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-ban"></i> Errores encontrados!</h4>
    <ul>
        @foreach ($errors->all() as $error)
        <li><strong>{{ $error }}</strong></li>
        @endforeach
    </ul>
    </button>
</div>
@endif