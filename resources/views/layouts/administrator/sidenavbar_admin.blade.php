<ul class="list-group">
  <li class="list-group-item active">Administrator Section</li>
  <li  class="list-group-item list-group-item-action" data-toggle="collapse" href="#collapseSubList">Security & Social Areas

    <ul class="list-group list-group-flush collapse" id="collapseSubList">
      <li class="list-group-item"><a href="{{ route('security_social.index') }}" >Security & Social Map</a></li>
      <li class="list-group-item"><a href="{{ route('security_social.create') }}" >Security & Social Create</a></li>
    </ul>
  </li>
 
  <a href="{{ route('legal_status.index') }}" class="list-group-item list-group-item-action">Property legal status</a>
  <a href="{{ route('property_status.index') }}" class="list-group-item list-group-item-action">Property status</a>
  <a href="{{ route('property_types.index') }}" class="list-group-item list-group-item-action">Property Types</a>
  <a href="{{ route('states.index') }}" class="list-group-item list-group-item-action">States</a>
  <a href="{{ route('services.index') }}" class="list-group-item list-group-item-action">Services</a>
  <a href="{{ route('property.index') }}" class="list-group-item list-group-item-action">Real State</a>
</ul>