<br><br><br><br>
<?php
require "controlador/sesion.controlador.php";
$ins=new sesionControlador();
$ins->StarSession();

  if(isset($_SESSION["usuario"]) && $_SESSION["usuario"] =="admin"){
    require_once("librerias/admin/headeradmin.php");
  }else if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]=="medico"){
    require_once("librerias/cabezeraMedico/headermedico.php");

  }else if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]=="encargado"){
    require_once("librerias/cabezeraMedico/headermedico.php");
  }else{
    require_once "header.php";
  }


		//("location: ../index.php");

    include('vista/principal/principalClinica.php');
  //}


?>


<?php
    require_once "footer.php";
?>
<style type="text/css">

  #grafica{

    max-width: 500px;

    max-height: 500px

  }

</style>
