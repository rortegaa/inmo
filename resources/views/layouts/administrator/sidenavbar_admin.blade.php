<div class="card sidebar shadow">
  <div class="card-header text-center">
    Menu del Administrador
  </div>
  <ul class="list-group">
    <li class="list-group-item list-group-item-action" data-toggle="collapse" href="#submenuarea1"> Factor Seguridad y social
      <ul class="submenu collapse" id="submenuarea1">
        <li> <a href="{{route('security_social.index')}}"> Mostrar </a> </li>
        <li> <a href="{{route('security_social.create')}}"> Crear</a></li>
      </ul>
    </li>
    <li class="list-group-item list-group-item-action" data-toggle="collapse" href="#submenu1">Estatus propiedades
      <ul class="submenu collapse" id="submenu1">
        <li> <a href="{{route('property_status.index')}}"> Mostrar </a> </li>
        <li> <a href="{{route('property_status.create')}}"> Crear</a></li>
      </ul>
    </li>
    <li class="list-group-item list-group-item-action" data-toggle="collapse" href="#submenu2">Estatus legales de las propiedades
      <ul class="submenu collapse" id="submenu2">
        <li> <a href="{{route('legal_status.index')}}"> Mostrar </a> </li>
        <li> <a href="{{route('legal_status.create')}}"> Crear</a></li>
      </ul>
    </li>
    <li class="list-group-item list-group-item-action" data-toggle="collapse" href="#submenu3">Tipos de propiedades
      <ul class="submenu collapse" id="submenu3">
        <li> <a href="{{route('property_types.index')}}"> Mostrar </a> </li>
        <li> <a href="{{route('property_types.create')}}"> Crear</a></li>
      </ul>
    </li>
    <li class="list-group-item list-group-item-action" data-toggle="collapse" href="#submenu4">
      <ul class="submenu collapse" id="submenu4">
        <li> <a href="{{route('property_types.index')}}"> Mostrar </a> </li>
        <li> <a href="{{route('property_types.create')}}"> Crear</a></li>
      </ul>
    </li>
  </ul>
</div>