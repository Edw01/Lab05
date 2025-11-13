<?php
// 1. INICIAR LA SESIÓN
session_start();

// 2. VERIFICAR QUE SE RECIBIERON DATOS POR POST (con comillas estándar)
if (!isset($_POST['usuario']) || !isset($_POST['password'])) {
    $_SESSION['error_login'] = "Acceso no autorizado.";
    header("Location: index.php");
    exit();
}

// Obtener y limpiar los datos del formulario (con comillas estándar)
$usuario_ingresado = trim($_POST['usuario']);
$password_ingresada = $_POST['password'];

// 3. CONECTARSE A LA BD (con comillas estándar)
// ******** IMPORTANTE: REEMPLAZA CON TUS CREDENCIALES REALES *********
$db = mysqli_connect("db.inf.uct.cl", "enecul", "adominacion01#.");

// Verificar conexión
if (mysqli_connect_errno()) {
    $_SESSION['error_login'] = "Error al conectar con la base de datos.";
    header("Location: index.php");
    exit();
}

// 4. PREVENIR INYECCIÓN SQL CON PREPARED STATEMENTS
// NOTA: Tu consulta original usaba 'uer'. La he cambiado a 'usuario'.
// Si tu columna en la base de datos se llama 'uer', CAMBIA 'usuario = ?' por 'uer = ?'
$password_md5 = md5($password_ingresada); // Calculamos el hash MD5 (como en tu lógica original)
$sql = "SELECT * FROM users WHERE usuario = ? AND password = ?";

// Preparar la consulta
if ($stmt = mysqli_prepare($db, $sql)) {
    
    // Vincular parámetros (dos strings: "ss", usuario y password con md5)
    mysqli_stmt_bind_param($stmt, "ss", $usuario_ingresado, $password_md5);
    
    // Ejecutar la consulta
    mysqli_stmt_execute($stmt);
    
    // Obtener el resultado
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) > 0) {
        // ¡Éxito! Usuario y contraseña coinciden
        $_SESSION['estado'] = "logueado";
        $_SESSION['usuario'] = $usuario_ingresado;
        header("Location: admin.php"); // Redirige a admin.php
        exit(); // Terminar el script después de redirigir

    } else {
        // Si no hay filas, el login falló (usuario no existe o contraseña incorrecta)
        $_SESSION['error_login'] = "Usuario o contraseña incorrectos.";
        header("Location: index.php");
        exit();
    }

} else {
    // Error al preparar la consulta
    $_SESSION['error_login'] = "Error en el sistema. Intente más tarde.";
    header("Location: index.php");
    exit();
}

// Cerrar statement y conexión
mysqli_stmt_close($stmt);
mysqli_close($db);

?>