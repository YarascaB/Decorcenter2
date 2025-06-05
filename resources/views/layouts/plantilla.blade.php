<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Agregar Bootstrap para diseño responsivo -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Estilos generales del body */
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Barra de navegación superior */
        .navbar {
            background-color: #2c3e50;
        }

        .navbar-brand {
            color: #ecf0f1 !important;
        }

        .nav-link {
            color: #ecf0f1 !important;
        }

        .nav-link:hover {
            color: #3498db !important;
        }

        /* Barra lateral */
        .sidebar {
            background-color: #34495e;
            color: white;
            height: 100vh;
            padding: 20px;
            border-radius: 8px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: 250px;
            transition: width 0.3s ease;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            z-index: 1040;
        }

        .sidebar a {
            color: white;
            display: block;
            margin: 10px 0;
            text-decoration: none;
            font-size: 16px;
        }

        .sidebar a:hover {
            background-color: #2980b9;
            border-radius: 5px;
            padding: 10px;
        }

        #toggleSidebar {
            background: none;
            border: none;
            color: #ecf0f1;
            font-size: 1.5rem;
            margin-right: 15px;
            transition: color 0.3s;
            z-index: 1051;
        }

        #toggleSidebar:hover {
            color: #3498db;
        }

        @media (max-width: 768px) {
            #toggleSidebar {
                font-size: 1.3rem;
                margin-right: 10px;
            }
        }
        body.sidebar-visible .sidebar {
            transform: translateX(0);
        }
        body.sidebar-visible .content {
            padding-left: 270px;
        }

        /* Contenido principal */
        .content {
            margin-left: 0px; /* Deja espacio para la barra lateral */
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        /* Pie de página */
        .footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        /* Navbar en dispositivos pequeños */
        .navbar-nav .nav-link {
            margin-left: 20px;
        }

        /* Ajustes responsivos */
        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                height: auto;
                margin-bottom: 20px;
                width: 100%;
            }

            .content {
                margin-left: 0;
            }

            .welcome-box {
                margin-top: 30px;
            }
        }

        /* Mejorar el estilo de los cuadros */
        .row {
            margin-top: 20px;
        }

        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <!-- Barra de navegación superior -->
    <nav class="navbar navbar-expand-lg navbar-dark position-relative">
        <div class="container position-relative">
            <button class="btn btn-outline-light me-3" id="toggleSidebar">
                ☰
            </button>            
            <!-- Marca centrada -->
            <a class="navbar-brand position-absolute start-50 translate-middle-x" href="{{ route('dashboard') }}">
                DECOR CENTER
            </a>
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="navbar-nav">
                    <a class="nav-link" href="{{ route('dashboard') }}">Inicio</a>
                    @if(Auth::check())
                        <a class="nav-link" href="{{ route('profile.edit') }}">Perfil</a>
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-white">Salir</button>
                        </form>
                    @else
                        <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                        <a class="nav-link" href="{{ route('register') }}">Crear cuenta</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>


    <!-- Contenedor principal -->
    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Si el usuario no está autenticado, muestra el cuadro de bienvenida -->
            @guest
            <div class="col-12 welcome-box">
                <h2>Bienvenido a DECOR CENTER</h2>
                <p>Sistema de Inventario</p>
                <!-- Botones de autenticación -->
                <div class="auth-buttons">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Iniciar sesión</a>
                    <a href="{{ route('register') }}" class="btn btn-success btn-lg">Crear cuenta</a>
                </div>
            </div>
            @endguest

            <!-- Contenido de la página para usuarios logueados -->
            @auth
            <div class="sidebar" id="sidebar">
                <h4 class="mt-5">Bienvenido, {{ Auth::user()->name }}</h4>
                <a href="{{ route('dashboard') }}">Panel de Control</a>
                <a href="{{ route('productos.index') }}">Ver Productos</a>
                <a href="{{ route('ventas.crear') }}" class="btn btn-primary">Nueva Venta</a>
                @role('admin|editor')
                <a href="{{ route('productos.create') }}">Agregar Producto</a>
                <a href="{{ route('inventory.logs') }}">Historial de Inventario</a>
                @endrole
                @role('admin')
                <a href="{{ route('clientes.crear') }}" class="btn btn-secondary mt-2">Crear Cliente</a>
                @endrole
                <!-- Desplegable de Reportes -->
                <div class="mt-3">
                    @role('admin')
                    <a class="d-block" data-bs-toggle="collapse" href="#submenuReportes" role="button" aria-expanded="false" aria-controls="submenuReportes">
                        📊 Reportes ▾
                    </a>
                    @endrole
                    <div class="collapse" id="submenuReportes">
                        <a href="{{ route('reportes.ventas_por_mes') }}" class="ms-3 d-block mt-2">📈 Ventas por mes</a>
                        <a href="{{ route('reportes.productos_mas_vendidos') }}" class="ms-3 d-block mt-2">🔥 Productos más vendidos</a>
                        <a href="{{ route('reportes.variacion_stock') }}" class="ms-3 d-block mt-2">⚠️ Variación de Stock</a>
                        <a href="{{ route('reportes.usuarios_registrados') }}" class="ms-3 d-block mt-2">👥 Usuarios Registrados</a>

                    </div>
                </div>
            </div>

            <div class="content">
                @yield('content')
            </div>
            @endauth
        </div>
    </div>

    <!-- Pie de página -->
    <div class="footer">
        <p>&copy; 2025 DECOR CENTER. Todos los derechos reservados.</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function () {
            document.body.classList.toggle('sidebar-visible');
        });
    </script>       
    
</body>
</html>
