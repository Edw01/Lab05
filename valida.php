<?php
// 1. INICIAR LA SESIÓN
session_start();

// 2. VERIFICAR DATOS POST (con comillas estándar)
if (!isset($_POST['usuario']) || !isset($_POST['password'])) {
    $_SESSION['error_login'] = "Acceso no autorizado.";
    header("Location: index.php");
    exit();
}

// 3. OBTENER DATOS (con comillas estándar)
$usuario_ingresado = trim($_POST['usuario']);
$password_ingresada = $_POST['password'];

// 4. CONECTARSE A LA BD (con comillas estándar)
// **** ¡¡AQUÍ ES DONDE PONES TUS VARIABLES!! ****
$db_servidor = "db.inf.uct.cl";
$db_usuario = "enecul"; // Tu usuario de BD
$db_pass = "adominacion01#."; // Tu contraseña de BD
$db_nombre = "enecul"; // El nombre de tu BD (asumo que es tu usuario)

$db = mysqli_connect($db_servidor, $db_usuario, $db_pass, $db_nombre);

// Verificar conexión
if (mysqli_connect_errno()) {
    $_SESSION['error_login'] = "Error al conectar con la base de datos.";
    header("Location: index.php");
    exit();
}

// 5. CONSULTA SEGURA (con comillas estándar)
// NOTA: Tu consulta original usaba 'uer'. La he cambiado a 'usuario'.
// Si tu columna se llama 'uer', CAMBIA 'usuario = ?' por 'uer = ?'
$password_md5 = md5($password_ingresada);
$sql = "SELECT * FROM users WHERE usuario = ? AND password = ?"; // Asumiendo que la columna es 'usuario'

// Preparar la consulta
if ($stmt = mysqli_prepare($db, $sql)) {
    
    // Vincular parámetros
    mysqli_stmt_bind_param($stmt, "ss", $usuario_ingresado, $password_md5);
    
    // Ejecutar
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) > 0) {
        // Éxito
        $_SESSION['estado'] = "logueado";
        $_SESSION['usuario'] = $usuario_ingresado;
        header("Location: admin.php"); // Redirige a admin.php
        exit();

    } else {
        // Fallo
        $_SESSION['error_login'] = "Usuario o contraseña incorrectos.";
        header("Location: index.php");
        exit();
    }
} else {
    $_SESSION['error_login'] = "Error en el sistema (prepare failed).";
    header("Location: index.php");
    exit();
}
?>