@extends('layouts.plantilla')

@section('title', 'Lista de productos')

@section('content')
<style>
    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    th, td {
        padding: 8px 12px;
        border: 1px solid #ddd;
        text-align: center;
    }

    th {
        background-color: #34495e;
        color: white;
    }

    .btn-agregar, .btn-regresar, .btn-salir {
        margin-top: 10px;
        padding: 10px 20px;
        color: white;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-agregar {
        background-color: #27ae60;
    }

    .btn-agregar:hover {
        background-color: #2ecc71;
    }

    .btn-regresar {
        background-color: #2980b9;
    }

    .btn-regresar:hover {
        background-color: #3498db;
    }

    .btn-salir {
        background-color: #c0392b;
    }

    .btn-salir:hover {
        background-color: #e74c3c;
    }

    .botones-navegacion {
        margin-top: 20px;
    }
</style>

<h1>Lista de Productos</h1>

@role('admin|editor')
<a href="{{ route('productos.create') }}" class="btn-agregar">Agregar Producto</a>
@endrole

<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Stock</th>
            <th>Precio</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productos as $producto)
            <tr>
                <td>{{ strtoupper($producto->name) }}</td>
                <td>{{ $producto->category }}</td>
                <td>{{ $producto->stock }}</td>
                <td>${{ number_format($producto->price, 2) }}</td>
                <td>{{ $producto->description }}</td>
                <td>
                    @role('admin|vendedor')
                    <a href="{{ route('productos.vender.form', $producto->id) }}" class="btn-agregar" style="background-color: #f39c12;">
                        Vender
                    </a>
                    @endrole
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="botones-navegacion">
    <a href="{{ url()->previous() }}" class="btn-regresar">Regresar</a>
    <a href="{{ route('home') }}" class="btn-salir">Salir</a>
</div>
@endsection
