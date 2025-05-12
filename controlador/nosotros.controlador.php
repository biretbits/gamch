<?php
class NosotrosControlador{
  public static function visualizarPrincipalNosotros(){
    require("vista/nosotros/nosotros.php");
  }
  public static function visualizarHistoria(){
    require("vista/nosotros/historia.php");
  }
  public static function visualizarMapa(){
    require("vista/nosotros/mapa.php");
  }

  public static function visualizarmISIONvision(){
    require("vista/nosotros/mision_vision.php");
  }

  public static function visualizarOrganigrama(){
    require("vista/nosotros/organigrama.php");
  }

  public static function visualizarSUBALCALDIAS(){
    require("vista/nosotros/subalcaldia.php");
  }

}


?>
