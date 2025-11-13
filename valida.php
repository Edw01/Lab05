<?php

// 1. INICIAR LA SESIÓN

session_start();

// 2. VERIFICAR QUE SE RECIBIERON DATOS POR POST

if (!isset($_POST['usuario']) || !isset($_POST['password'])) {

    // Si faltan campos, redirigir al login

    $_SESSION['error_login'] = "Acceso no autorizado al script de validación.";

    header("Location: index.php");

    exit();

}

// Obtener y limpiar (sanitizar) los datos del formulario

$usuario_ingresado = trim($_POST['usuario’]);

$password_ingresada = $_POST['password’];

// Comparar usuario y password ingresados con datos en la BD

   //Se conecta a la BD

   $db = mysqli_connect(“db.inf.uct.cl”,”prueba”,”prueba”,”prueba”);

   //Arma la consulta

   $sql = "SELECT * FROM users WHERE uer = ‘$usuario_ingresado’ AND password = MD5(‘$password_ingresada’)";

   // Ejecuta la consulta

   $result = mysqli_query($db, $sql);

   if(mysqli_num_rows($result) >0)  {  // éxito

       // Crea las variables de sesión y redirige al sistema

      $_SESSION['estado'] = "logueado";

      $_SESSION['usuario'] = $usuario_ingresado;

     header("Location: admin.php");

 }

  else   header("Location: index.php");

