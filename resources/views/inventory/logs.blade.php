@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Historial de Inventario</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Producto</th>
                <th>Tipo</th>
                <th>Cantidad</th>
                <th>Usuario</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $log->product->nombre }}</td>
                <td>{{ ucfirst($log->type) }}</td>
                <td>{{ $log->quantity }}</td>
                <td>{{ $log->user->name ?? 'Sistema' }}</td>
                <td>{{ $log->description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $logs->links() }}
</div>
@endsection
