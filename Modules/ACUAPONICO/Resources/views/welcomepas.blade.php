@extends('acuaponico::layouts.masterpa')

@push('breadcrumbs')
    <li class="breadcrumb-item active">Dashboard</li>
@endpush
@section('content2')
<h1>
    Hola, {{ auth()->user()->name }}! Bienvenido al Dashboard de Acuaponico
</h1>
@endsection