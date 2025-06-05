@extends('layouts.plantilla')

@section('title', 'Usuarios Registrados')

@section('content')
<style>
    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    th, td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: center;
    }

    th {
        background-color: #34495e;
        color: white;
    }

    .btn-volver {
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #2980b9;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        display: inline-block;
    }

    .btn-volver:hover {
        background-color: #3498db;
    }

    h1 {
        margin-top: 40px;
        color: #2c3e50;
    }
</style>

<h1>Reporte de Usuarios Registrados</h1>

<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Fecha de Registro</th>
            <th>Rol</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->email }}</td>
                <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
                <td>{{ $usuario->getRoleNames()->first() ?? 'Sin rol' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('dashboard') }}" class="btn-volver">Volver al Dashboard</a>
@endsection
