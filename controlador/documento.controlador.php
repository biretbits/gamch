<?php
require "modelo/documento.php";
class DocumentoControlador{
  public static function registroDocumento(){
    $us = new Documento();  // Creando una nueva instancia de la clase Usuario
    $listarDeCuanto = 5;$pagina = 1;
    $resultodoUsuarios = $us->SelectPorBusqueda("",false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;

    $resul = $us->SelectPorBusqueda('',$inicioList,$listarDeCuanto);
    require("vista/gaceta/servidor/crudDocumento.php");
  }

  public static function documentos_visualizar($ruta){
    require("vista/gaceta/cliente/gaceta_documentos.php");
  }
}


?>
