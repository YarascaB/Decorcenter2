@extends('layouts.plantilla')

@section('title', 'Variación de Stock')

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

<h1>Reporte de Variación de Stock (por Fecha y Producto)</h1>

<table>
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Producto</th>
            <th>Entradas</th>
            <th>Salidas</th>
            <th>Stock Actual</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($logs as $item)
            <tr>
                <td>{{ $item->fecha }}</td>
                <td>{{ strtoupper($item->producto) }}</td>
                <td>{{ $item->entradas }}</td>
                <td>{{ $item->salidas }}</td>
                <td>{{ $stocksActuales[$item->producto] ?? 'N/A' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('dashboard') }}" class="btn-volver">Volver al Dashboard</a>
@endsection
