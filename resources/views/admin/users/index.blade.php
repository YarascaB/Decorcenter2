@extends('layouts.plantilla')

@section('title', 'Administración de Roles')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #f8f9fa, #e0eafc);
    }

    .fade-in {
        animation: fadeIn 0.8s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .card-glass {
        background: linear-gradient(to bottom right, #ffffffcc, #f0f0f0cc);
        backdrop-filter: blur(12px);
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        border: 1px solid rgba(255,255,255,0.3);
    }

    .heading-icon {
        font-size: 2.5rem;
        animation: popIn 0.6s ease forwards;
        color: #0d6efd;
    }

    @keyframes popIn {
        0% { transform: scale(0.8); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }

    .table thead {
        background: linear-gradient(to right, #0d6efd, #6610f2);
        color: white;
    }

    .table-hover tbody tr:hover {
        background-color: #e9f0ff;
        transition: background-color 0.3s;
    }

    .btn-edit {
        background: linear-gradient(to right, #4e54c8, #8f94fb);
        border: none;
        color: white;
        font-weight: 500;
        transition: transform 0.2s ease;
    }

    .btn-edit:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .alert-success {
        background: #d4edda;
        border-left: 5px solid #28a745;
        font-weight: 500;
    }
</style>

<div class="container mt-5 fade-in">
    <div class="card-glass">
        <h2 class="mb-4 text-center heading-icon">👥 Administración de Roles</h2>

        @if(session('success'))
            <div class="alert alert-success text-center fade-in">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-hover align-middle fade-in">
            <thead>
                <tr class="text-center">
                    <th>👤 Nombre</th>
                    <th>📧 Correo</th>
                    <th>🔐 Rol actual</th>
                    <th>⚙️ Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $usuario)
                    <tr>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>
                            <span class="badge bg-info text-dark">
                                {{ $usuario->roles->pluck('name')->first() ?? 'Sin rol' }}
                            </span>
                        </td>
                        <td class="text-center d-flex gap-2 justify-content-center">
                            <a href="{{ route('admin.users.editRole', $usuario) }}" class="btn btn-sm btn-edit">
                                ✏️ Editar rol
                            </a>
                        
                            <form action="{{ route('admin.users.destroy', $usuario) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    🗑️ Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
