<?php
// 1. INICIAR LA SESIÓN
session_start();

// 2. VERIFICAR LA SESIÓN (con comillas estándar y chequeo de 'logueado')
if (!isset($_SESSION['estado']) || $_SESSION['estado'] != 'logueado') {
    // Si no hay sesión, se redirige y se termina la ejecución del script
    header("Location: index.php");
    exit();
}

// 3. RECUPERAR DATOS DEL USUARIO (para el saludo)
// Usamos htmlspecialchars para prevenir ataques XSS al imprimir el nombre
$nombre_usuario = htmlspecialchars($_SESSION['usuario']);
$inicial_usuario = strtoupper(substr($nombre_usuario, 0, 1));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AniStream // Catálogo (Bootstrap)</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa; /* bg-light de Bootstrap */
        }
        :root {
            --brand-orange: #F97316;
            --brand-orange-dark: #EA580C;
        }
        .text-brand-orange { color: var(--brand-orange); }
        .bg-brand-orange { background-color: var(--brand-orange); }
        .btn-brand-orange {
            background-color: var(--brand-orange);
            border-color: var(--brand-orange);
            color: #fff;
        }
        .btn-brand-orange:hover {
            background-color: var(--brand-orange-dark);
            border-color: var(--brand-orange-dark);
            color: #fff;
        }
        .form-control:focus {
            border-color: var(--brand-orange);
            box-shadow: 0 0 0 0.25rem rgba(249, 115, 22, 0.25);
        }
        .nav-link:hover, .nav-link.active {
            color: var(--brand-orange) !important;
        }
        .hero-section {
            position: relative;
            height: 50vh;
            border-radius: 0.5rem;
            overflow: hidden;
        }
        .hero-section img { width: 100%; height: 100%; object-fit: cover; }
        .hero-section .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        }
        .hero-section .hero-content {
            position: absolute;
            bottom: 2rem;
            left: 2rem;
            color: #fff;
        }
        .anime-row {
            display: flex;
            overflow-x: auto;
            padding-bottom: 1rem;
            gap: 1rem;
        }
        .anime-card {
            flex-shrink: 0;
            width: 12rem;
            transition: transform 0.2s ease-in-out;
        }
        .anime-card:hover { transform: scale(1.05); }
        .anime-card img { height: 18rem; object-fit: cover; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body>

    <!-- Barra de Navegación Superior -->
    <header class="navbar navbar-expand-md bg-white shadow-sm sticky-top">
        <nav class="container-fluid px-4">
            <!-- Logo y Links Principales -->
            <a class="navbar-brand fw-bold text-brand-orange fs-4" href="#">AniStream</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Series</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Películas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Mi Lista</a>
                    </li>
                </ul>

                <!-- Búsqueda y Perfil -->
                <div class="d-flex align-items-center">
                    <form class="d-none d-sm-flex me-3">
                        <input 
                            class="form-control rounded-pill" 
                            type="search" 
                            placeholder="Buscar anime..." 
                            aria-label="Buscar"
                        >
                    </form>

                    <!-- 
                        Icono de Perfil CORREGIDO:
                        1. Convertido en un Dropdown de Bootstrap.
                        2. Muestra la inicial del usuario.
                        3. El dropdown muestra el nombre de usuario completo.
                        4. El dropdown contiene el enlace a "cerrarSesion.php".
                    -->
                    <div class="dropdown">
                        <button class="btn btn-brand-orange rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px;" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $inicial_usuario; ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li><span class="dropdown-item-text">Logueado como:<br><b><?php echo $nombre_usuario; ?></b></span></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="cerrarSesion.php">Cerrar Sesión</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </nav>
    </header>

    <!-- Contenido Principal -->
    <main class="container my-4 my-md-5">

        <!-- Sección "Hero" / Destacado -->
        <section class="mb-5 shadow-lg hero-section">
            <img src="https://placehold.co/1200x600/333333/FFFFFF?text=Anime+Destacado" alt="Anime Destacado" onerror="this.src='https://placehold.co/1200x600/333333/FFFFFF?text=Fallback+Image'">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <!-- SALUDO AL USUARIO AÑADIDO (aquí o en la barra de nav) -->
                <h2 class="display-5 fw-bold mb-2">¡Bienvenido, <?php echo $nombre_usuario; ?>!</h2>
                <p class="col-lg-8 fs-6 mb-3">
                    Disfruta del mejor anime, como este destacado de la semana.
                </p>
                <a href="#" class="btn btn-brand-orange btn-lg fw-semibold">
                    Ver Ahora
                </a>
            </div>
        </section>

        <!-- Fila de Catálogo: Nuevos Episodios -->
        <section class="mb-5">
            <h3 class="fs-4 fw-semibold text-dark mb-3">Nuevos Episodios</h3>
            <div class="anime-row no-scrollbar">
                
                <!-- Tarjeta de Anime 1 -->
                <div class="card shadow-sm anime-card">
                    <img src="https://placehold.co/300x450/1A2941/6FFFE9?text=Shingeki" class="card-img-top" alt="Shingeki no Kyojin" onerror="this.src='https://placehold.co/300x450/1A2941/6FFFE9?text=Fallback+Image'">
                    <div class="card-body p-3">
                        <h6 class="card-title fw-semibold text-dark text-truncate mb-0">Shingeki no Kyojin</h6>
                        <p class="card-text text-muted small">Subtitulado</p>
                    </div>
                </div>
                
                <!-- Tarjeta de Anime 2 -->
                <div class="card shadow-sm anime-card">
                    <img src="https://placehold.co/300x450/1A2941/6FFFE9?text=Spy+x+Family" class="card-img-top" alt="Spy x Family" onerror="this.src='https://placehold.co/300x450/1A2941/6FFFE9?text=Fallback+Image'">
                    <div class="card-body p-3">
                        <h6 class="card-title fw-semibold text-dark text-truncate mb-0">Spy x Family</h6>
                        <p class="card-text text-muted small">Subtitulado</p>
                    </div>
                </div>

                <!-- ... más tarjetas ... -->
            </div>
        </section>

        <!-- Fila de Catálogo: Populares Ahora -->
        <section class="mb-5">
            <h3 class="fs-4 fw-semibold text-dark mb-3">Populares Ahora</h3>
            <div class="anime-row no-scrollbar">
                <!-- Tarjeta de Anime 1 -->
                <div class="card shadow-sm anime-card">
                    <img src="https://placehold.co/300x450/1A2941/6FFFE9?text=Demon+Slayer" class="card-img-top" alt="Demon Slayer" onerror="this.src='https://placehold.co/300x450/1A2941/6FFFE9?text=Fallback+Image'">
                    <div class="card-body p-3">
                        <h6 class="card-title fw-semibold text-dark text-truncate mb-0">Demon Slayer</h6>
                        <p class="card-text text-muted small">Subtitulado</p>
                    </div>
                </div>
                <!-- ... más tarjetas ... -->
            </div>
        </section>

    </main>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>