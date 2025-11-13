<!DOCTYPE html>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AniStream // Iniciar Sesión (Bootstrap)</title>
    
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

        /* Variables de color de la marca */
        :root {
            --brand-orange: #F97316;
            --brand-orange-dark: #EA580C;
        }

        /* Clases personalizadas de la marca */
        .text-brand-orange {
            color: var(--brand-orange);
        }
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

        /* Anular el color del focus de Bootstrap para que coincida con la marca */
        .form-control:focus {
            border-color: var(--brand-orange);
            box-shadow: 0 0 0 0.25rem rgba(249, 115, 22, 0.25);
        }
        
        .form-check-input:focus {
             border-color: var(--brand-orange);
             box-shadow: 0 0 0 0.25rem rgba(249, 115, 22, 0.25);
        }
        
        .form-check-input:checked {
            background-color: var(--brand-orange);
            border-color: var(--brand-orange);
        }

    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">

    <!-- Tarjeta de Login -->
    <div class="card shadow-lg p-4 rounded-3" style="max-width: 450px; width: 100%;">
        <div class="card-body">

            <!-- Encabezado -->
            <div class="text-center mb-5">
                <h1 class="fw-bold text-brand-orange">
                    AniStream
                </h1>
                <p class="text-muted mt-2">Bienvenido de vuelta. Inicia sesión.</p>
            </div>

            <!-- Formulario -->
            <form action="home.html">
                <!-- Campo de Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input 
                        type="email" 
                        class="form-control p-2" 
                        id="email" 
                        placeholder="tu@correo.com"
                        required
                    >
                </div>

                <!-- Campo de Contraseña -->
                <div class="mb-4">
                    <label for="password" class="form-label">Contraseña</label>
                    <input 
                        type="password" 
                        class="form-control p-2" 
                        id="password" 
                        placeholder="••••••••"
                        required
                    >
                </div>

                <!-- Botón de Login -->
                <button 
                    type="submit" 
                    class="btn btn-brand-orange w-100 p-2 fw-semibold"
                >
                    Iniciar Sesión
                </button>
            </form>

            <!-- Links Secundarios -->
            <div class="text-center small mt-4">
                <a href="#" class="text-brand-orange text-decoration-none">¿Olvidaste tu contraseña?</a>
                <p class="text-muted mt-2">
                    ¿No tienes cuenta? <a href="#" class="text-brand-orange text-decoration-none">Regístrate aquí</a>.
                </p>
            </div>

        </div>
    </div>

    <form action=”valida.php" method="POST">
        <input type="text" id="usuario" name="usuario" required>
        <input type="password" id="password" name="password" required>
        <input type="submit">
    </form>

    <!-- Bootstrap JS (Opcional, pero recomendado) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>