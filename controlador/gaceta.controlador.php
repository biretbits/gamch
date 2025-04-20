<?php

class GacetaControlador{
  public static function gaceta(){
    require("vista/gaceta/cliente/gaceta_municipal.php");
  }

  public static function documentos_visualizar($ruta){
    require("vista/gaceta/cliente/gaceta_documentos.php");
  }
}


?>
