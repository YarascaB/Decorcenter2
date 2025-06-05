@extends('layouts.plantilla')

@section('title', 'Reporte de ventas por mes')

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

<h1>Reporte de Ventas</h1>

<h2>Ventas Totales por Mes</h2>
<table>
    <thead>
        <tr>
            <th>Mes</th>
            <th>Total Vendido (S/.)</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ventasPorMes as $venta)
            <tr>
                <td>{{ $venta->mes }}</td>
                <td>S/. {{ number_format($venta->total_ventas, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h2>Ventas por Producto</h2>
<table>
    <thead>
        <tr>
            <th>Producto</th>
            <th>Mes</th>
            <th>Total Vendido (S/.)</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ventasPorProducto as $detalle)
            <tr>
                <td>{{ strtoupper($detalle->producto) }}</td>
                <td>{{ $detalle->mes }}</td>
                <td>S/. {{ number_format($detalle->total_ventas, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('dashboard') }}" class="btn-volver">Volver al Dashboard</a>
@endsection
