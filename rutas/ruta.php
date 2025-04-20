
<?php
require_once "../controlador/sesion.controlador.php";
$ins=new sesionControlador();
$ins->StarSession();
require_once "../controlador/index.controlador.php";
require_once "../controlador/logeo.controlador.php";
require_once "../controlador/nosotros.controlador.php";
require_once "../controlador/ley.controlador.php";
    //require('vista/principal/sql.php');
    //include('vista/principal/principalClinica.php');

    $uri = $_SERVER['REQUEST_URI'];
    $base = '/index.php/'; // Ajusta según la carpeta real

    $ruta = str_replace($base, '', $uri);
    $ruta = trim(($ruta));
    echo $ruta;
    if($ruta=="salir"){//esto poner para cada usuario
      sesionControlador::Destroy();
    }else if($ruta=="usuarios/is"){
      LogeoControlador::visualizarInicioSession();
    }else if($ruta=="vcu"){
        LogeoControlador::verificarLogin($_POST["usuario"],$_POST["contrasena"]);
    }else if($ruta=="nst"){
        NosotrosControlador::visualizarPrincipalNosotros();
    }else if($ruta=="ly"){
        LeyControlador::visualizarLey();
    }else if($ruta=="his"){
        NosotrosControlador::visualizarHistoria();
    }else if($ruta=="map"){
        NosotrosControlador::visualizarMapa();
    }else{
       IndexControlador::visualizarPrincipal();
    }
    ?>
