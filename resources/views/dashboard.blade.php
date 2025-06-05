@extends('layouts.plantilla')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Columna lateral para el color de fondo y mostrar el nombre del usuario -->
        <div class="col-md-3 bg-info py-4 h-auto align-self-start" style="border-radius: 8px;">
            <h4 class="text-white">Bienvenido, {{ Auth::user()->name }}</h4>
            <hr class="border-white">
            <p class="text-white">Panel de Control de Inventario</p>
            <a href="{{ route('productos.index') }}" class="btn btn-primary btn-block mt-3 w-100">Ver Productos</a>
            @role('admin|editor')
            <a href="{{ route('productos.create') }}" class="btn btn-primary btn-block mt-3 w-100">Agregar Producto</a>
            @endrole
            <!-- Botón que abre el modal de Reportes -->
            @role('admin')
            <button type="button" class="btn btn-primary btn-block mt-3 w-100" data-bs-toggle="modal" data-bs-target="#modalReportes">
                📊 Reportes
            </button>
            @endrole
        </div>

        <!-- Columna para mostrar los productos -->
        <div class="col-md-9">
            <h1 class="mb-4 text-center">Bienvenido al Panel de Inventario</h1>
            
            <div class="row mb-3">
                <div class="col text-center">
                    <h3>Productos en Inventario</h3>
                </div>
            </div>

            <!-- Mostramos los productos en tarjetas -->
            <div class="row">
                @foreach ($productos as $producto)
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">{{ strtoupper($producto->name) }}</h5>
                                <p class="card-text">
                                    <strong>Stock:</strong> {{ $producto->stock }} <br>
                                    <strong>Precio:</strong> ${{ number_format($producto->price, 2) }} <br>
                                    <strong>Descripción:</strong> {{ $producto->description }}
                                </p>

                                <!-- Botones de acción -->
                                <div class="d-flex justify-content-between mt-3">
                                    <!-- Editar -->
                                    @role('admin|editor')
                                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    @endrole
                                    @role('admin|editor')
                                    <!-- Eliminar -->
                                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                    @endrole
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Modal de Reportes -->
<div class="modal fade" id="modalReportes" tabindex="-1" aria-labelledby="modalReportesLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="modalReportesLabel">📊 Reportes</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <p>Selecciona el reporte que deseas visualizar:</p>
          <a href="{{ route('reportes.ventas_por_mes') }}" class="btn btn-outline-primary w-100 mb-2">📈 Ventas por mes</a>
          <a href="{{ route('reportes.productos_mas_vendidos') }}" class="btn btn-outline-primary w-100 mb-2">🔥 Productos más vendidos</a>
          <a href="{{ route('reportes.variacion_stock') }}" class="btn btn-outline-primary w-100 mb-2">⚠️ Variación de Stock</a>
          <a href="{{ route('reportes.usuarios_registrados') }}" class="btn btn-outline-primary w-100 mb-2">👥 Usuarios Registrados</a>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>  
@endsection