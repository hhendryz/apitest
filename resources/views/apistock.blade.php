@extends('adminlte::page')

@section('title', 'Product Stock')

@section('content_header')
    <h1>Product Stock</h1>
@stop

@section('content')
    <p>{{ $res }}</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('product stock page'); </script>
@stop

@section('plugins.Datatables', true)
