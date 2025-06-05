@extends('layouts.plantilla')

@section('title', 'Productos Más Vendidos')

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
        background-color: #2c3e50;
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

    h2 {
        margin-top: 40px;
        color: #2c3e50;
    }
</style>

<h1>Reporte de Productos Más Vendidos</h1>

<table>
    <thead>
        <tr>
            <th>Producto</th>
            <th>Total Vendido (unidades)</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productosMasVendidos as $producto)
            <tr>
                <td>{{ strtoupper($producto->name) }}</td>
                <td>{{ $producto->total_vendido }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('dashboard') }}" class="btn-volver">Volver al Dashboard</a>
@endsection
