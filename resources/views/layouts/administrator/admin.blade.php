@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
   @yield('content_header')
@stop

@section('content')
    @yield('content')
@stop

@section('css')

@stop

@section('js')

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfQfZXUMkqhAZPYFpgIxw09MOrkXJzL3k&libraries=drawing&callback=initMap"
    async defer>
</script>

@stop