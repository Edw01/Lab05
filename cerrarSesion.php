<?php

// Inicio la sesión
session_start();

// Destruyo la sesión
session_destroy();

//Y me voy al inicio
header("Location: index.php");
exit();

?>