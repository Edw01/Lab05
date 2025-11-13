<?php
// Iniciar la sesión para poder mostrar mensajes de error
session_start();

$error_login = '';
if (isset($_SESSION['error_login'])) {
    $error_login = $_SESSION['error_login'];
    // Limpiar el error de la sesión
    unset($_SESSION['error_login']);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AniStream // Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* (Estilos de la respuesta anterior) */
        :root { --brand-orange: #F97316; }
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .text-brand-orange { color: var(--brand-orange); }
        .btn-brand-orange { background-color: var(--brand-orange); border-color: var(--brand-orange); color: #fff; }
        .btn-brand-orange:hover { background-color: #EA580C; border-color: #EA580C; }
        .form-control:focus { border-color: var(--brand-orange); box-shadow: 0 0 0 0.25rem rgba(249, 115, 22, 0.25); }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow-lg p-4 rounded-3" style="max-width: 450px; width: 100%;">
        <div class="card-body">
            <div class="text-center mb-4">
                <h1 class="fw-bold text-brand-orange">AniStream</h1>
                <p class="text-muted mt-2">Bienvenido de vuelta. Inicia sesión.</p>
            </div>

            <?php if (!empty($error_login)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo htmlspecialchars($error_login); ?>
                </div>
            <?php endif; ?>

            <form action="valida.php" method="POST">
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario o Correo</label>
                    <input 
                        type="text" 
                        class="form-control p-2" 
                        id="usuario" 
                        name="usuario" placeholder="tu_usuario"
                        required
                    >
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Contraseña</label>
                    <input 
                        type="password" 
                        class="form-control p-2" 
                        id="password" 
                        name="password" placeholder="••••••••"
                        required
                    >
                </div>
                <button type="submit" class="btn btn-brand-orange w-100 p-2 fw-semibold">
                    Iniciar Sesión
                </button>
            </form>
            <div class="text-center small mt-4">
                <a href="#" class="text-brand-orange text-decoration-none">¿Olvidaste tu contraseña?</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>