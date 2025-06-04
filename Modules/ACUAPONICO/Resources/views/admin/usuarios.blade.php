@extends('acuaponico::layouts.master')

@section('content')
        <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
    </style>
    <h1 style="text-align:center;">Lista de Usuarios y sus Roles</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Roles</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->name ?? $usuario->nombre ?? 'Sin nombre' }}</td>
                    <td>{{ $usuario->email ?? 'Sin email' }}</td>
                    <td>
                        @foreach($usuario->roles as $rol)
                            {{ $rol->name ?? $rol->rol ?? 'Rol sin nombre' }}@if(!$loop->last), @endif
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @endsection

