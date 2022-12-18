@extends('adminlte::page')

@section('title', 'API User')

@section('content_header')
    <h1>API User</h1>
@stop

@section('content')
    <p>{!! json_encode($jsondata) !!}</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('api user page'); </script>
@stop
