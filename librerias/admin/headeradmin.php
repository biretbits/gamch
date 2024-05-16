
<!DOCTYPE html>
<html>
<head>
    <title></title>

    	<meta charset="utf-8">

     		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <link rel="stylesheet" type="text/css" href="activos/bootstrap/css/bootstrap.min.css">
        <script src="activos/js/jquery-3.7.1.js"></script>
        <script src="activos/bootstrap/js/bootstrap.min.js"></script>
        <script src="activos/js/Chart.min.js"></script>
        <script src="activos/js/sweetAlert2/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="activos/js/sweetAlert2/sweetalert2.min.css">
        <link href="activos/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="imagenes/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<style>.CodeMirror {border-top: 1px solid black; border-bottom: 1px solid black;}</style>
<style type="text/css">

body{
  background-image: url("imagenes/agu/f1b.jpg");
	margin: 0;
  margin-bottom: 40px;
}
html {
  min-height: 100%;
  position: relative;
}
</style>
</head>
<body>
  <div class="container">
  	<br><br>
<?php
$name = "";
if(isset($_SESSION["tipo_usuario"]) && $_SESSION["tipo_usuario"] != ""){
  $name = $_SESSION["usuario"];
}

echo "<nav class='navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm'>
    <div class='container'>
        <a href='#' class='navbar-brand'><img src='imagenes/icono/cds.png' height='30' width='30' class='rounded-circle'></a>

        <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
        </button>
        <div class='collapse navbar-collapse' id='navbarNav'>
            <ul class='navbar-nav me-auto mb-2 mb-lg-0'>

                <li class='nav-item' title='Inicio'>
                    <a class='nav-link btn btn-outline-secondary' href='controlador/logeo.controlador.php?accion=ix'><i class='fas fa-home'></i></a>
                </li>
                <li class='nav-item ms-2' title='Usuarios'>
                    <a class='nav-link btn btn-outline-warning' href='controlador/usuario.controlador.php?accion=vut'> <i class='fas fa-user'></i></a>
                </li>

            </ul>
            <ul class='navbar-nav ms-auto'>
                <li class='nav-item dropdown' title='Nombre Usuario'>
                  <a class='nav-link dropdown-toggle btn btn-outline-success' href='#' id='navbarDropdown2' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                      hola ".$name."
                  </a>
                  <ul class='dropdown-menu' aria-labelledby='navbarDropdown2'>
                      <li class='nav-item' title='Cerrar sesión' style='color:green'>
                        <a class='nav-link text-info btn btn-outline-warning' href='#'>Editar</a>
                      </li>
                      <li><hr class='dropdown-divider'></li>
                      <li class='nav-item' title='Cerrar sesión' style='color:green'>
                        <a class='nav-link text-primary btn btn-outline-danger' href='controlador/logeo.controlador.php?accion=salir'><i class='fas fa-power-off'></i></a>
                      </li>
                  </ul>
              </li>
            </ul>
        </div>
    </div>
</nav>
";


?>
