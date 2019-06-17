<div class="card sidebar">
  <div class="card-header text-center">
    Menu del Administrador
  </div>
  <ul class="list-group">
    <li class="list-group-item" data-toggle="collapse" href="#submenu1">Estatus propiedades
      <ul class="submenu collapse" id="submenu1">
        <li> <a href="{{route('property_status.index')}}"> Mostrar </a> </li>
        <li> <a href="{{route('property_status.create')}}"> Crear</a></li>
      </ul>
    </li>
    <li class="list-group-item" data-toggle="collapse" href="#submenu2">Estatus legales de las propiedades
      <ul class="submenu collapse" id="submenu2">
        <li> <a href="{{route('legal_status.index')}}"> Mostrar </a> </li>
        <li> <a href="{{route('legal_status.create')}}"> Crear</a></li>
      </ul>
    </li>
    <li class="list-group-item" data-toggle="collapse" href="#submenu3">Tipos de propiedades
      <ul class="submenu collapse" id="submenu3">
        <li> <a href="{{route('property_types.index')}}"> Mostrar </a> </li>
        <li> <a href="{{route('property_types.create')}}"> Crear</a></li>
      </ul>
    </li>
  </ul>
</div>