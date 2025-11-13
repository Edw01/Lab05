<?php
// 1. INICIAR LA SESIÓN
session_start();

// 2. VERIFICAR LA SESIÓN (con comillas estándar)
if (!isset($_SESSION['estado']) || $_SESSION['estado'] != 'logueado') {
    header("Location: index.php");
    exit();
}

// 3. RECUPERAR DATOS DEL USUARIO
$nombre_usuario = htmlspecialchars($_SESSION['usuario']);
$inicial_usuario = strtoupper(substr($nombre_usuario, 0, 1));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AniStream // Catálogo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* (Estilos de la respuesta anterior) */
        :root { --brand-orange: #F97316; }
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .text-brand-orange { color: var(--brand-orange); }
        .btn-brand-orange { background-color: var(--brand-orange); border-color: var(--brand-orange); color: #fff; }
        .btn-brand-orange:hover { background-color: #EA580C; border-color: #EA580C; }
        .hero-section { position: relative; height: 50vh; border-radius: 0.5rem; overflow: hidden; }
        .hero-section img { width: 100%; height: 100%; object-fit: cover; }
        .hero-section .hero-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); }
        .hero-section .hero-content { position: absolute; bottom: 2rem; left: 2rem; color: #fff; }
    </style>
</head>
<body>
    <header class="navbar navbar-expand-md bg-white shadow-sm sticky-top">
        <nav class="container-fluid px-4">
            <a class="navbar-brand fw-bold text-brand-orange fs-4" href="#">AniStream</a>
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <button class="btn btn-brand-orange rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $inicial_usuario; ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><span class="dropdown-item-text">Logueado como:<br><b><?php echo $nombre_usuario; ?></b></span></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="cerrarSesion.php">Cerrar Sesión</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container my-4 my-md-5">
        <section class="mb-5 shadow-lg hero-section">
            <img src="https://placehold.co/1200x600/333333/FFFFFF?text=Anime+Destacado" alt="Anime Destacado">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <h2 class="display-5 fw-bold mb-2">¡Bienvenido, <?php echo $nombre_usuario; ?>!</h2>
                <p class="col-lg-8 fs-6 mb-3">
                    Disfruta del mejor anime, como este destacado de la semana.
                </p>
                <a href="#" class="btn btn-brand-orange btn-lg fw-semibold">
                    Ver Ahora
                </a>
            </div>
        </section>
        </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>