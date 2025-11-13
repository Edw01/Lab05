<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// 1. INICIAR LA SESIÓN
session_start();

// 2. VERIFICAR QUE SE RECIBIERON DATOS POR POST
if (!isset($_POST['usuario']) || !isset($_POST['password'])) {
    $_SESSION['error_login'] = "Acceso no autorizado.";
    header("Location: index.php");
    exit();
}

// 3. OBTENER DATOS DEL FORMULARIO
$usuario_ingresado = trim($_POST['usuario']);
$password_ingresada = $_POST['password'];

// 4. CONECTARSE A LA BD
$db_servidor = "db.inf.uct.cl";
$db_usuario  = "enecul";
$db_pass     = "adominacion01#.";
$db_nombre   = "A2025_enecul";

$db = mysqli_connect($db_servidor, $db_usuario, $db_pass, $db_nombre);

// Verificar conexión
if (mysqli_connect_errno()) {
    // Si la conexión falla, muestra un error en el login
    $_SESSION['error_login'] = "Error al conectar con la base de datos.";
    header("Location: index.php");
    exit();
}

// 5. PREVENIR INYECCIÓN SQL CON PREPARED STATEMENTS
$password_md5 = md5($password_ingresada);

$sql = "SELECT * FROM users WHERE usuario = ? AND password = ?";

// Preparar la consulta
if ($stmt = mysqli_prepare($db, $sql)) {

    // Vincular parámetros (dos strings: "ss")
    mysqli_stmt_bind_param($stmt, "ss", $usuario_ingresado, $password_md5);

    // Ejecutar la consulta
    mysqli_stmt_execute($stmt);

    // Obtener el resultado
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // ¡Éxito!
        $_SESSION['estado'] = "logueado";
        $_SESSION['usuario'] = $usuario_ingresado;
        header("Location: admin.php"); // Redirige a admin.php
        exit();

    } else {
        // Fallo (usuario no existe o contraseña incorrecta)
        $_SESSION['error_login'] = "Usuario o contraseña incorrectos.";
        header("Location: index.php"); // Redirige a index.php
        exit();
    }

} else {
    // Error al preparar la consulta
    $_SESSION['error_login'] = "Error en el sistema. Intente más tarde.";
    header("Location: index.php"); // Redirige a index.php
    exit();
}

// Cerrar statement y conexión
mysqli_stmt_close($stmt);
mysqli_close($db);

?>