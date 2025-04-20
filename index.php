
<?php
require_once("config.php");
require_once "controlador/sesion.controlador.php";
$ins=new sesionControlador();
$ins->StarSession();
require_once "controlador/index.controlador.php";
require_once "controlador/logeo.controlador.php";
require_once "controlador/nosotros.controlador.php";
require_once "controlador/ley.controlador.php";
require_once "controlador/usuario.controlador.php";
require_once "controlador/gaceta.controlador.php";
require_once "controlador/documento.controlador.php";
    //require('vista/principal/sql.php');
    //include('vista/principal/principalClinica.php');


if(isset($_GET["accion"])){
$_GET["accion"]=$_GET["accion"];
}else{
  $_GET["accion"]="";
}

//phpinfo();
if (isset($_SESSION["usuario"]) && $_SESSION["nombre_role"] == 'Admin') {
    if ($_GET["accion"] == "rol") {
        UsuarioControlador::visualizarRol(); return;
    } else if ($_GET["accion"] == "RolReg") {
        $a = array(
            "id" => $_POST["id"],
            "nombre" => $_POST["nombre"],
            "slug" => $_POST["slug"],
            "descripcion" => $_POST["descripcion"],
            "especial" => $_POST["especial"]
        );
        UsuarioControlador::RegistrarRol($a); return;
    } else if ($_GET["accion"] == "bpth") {
        UsuarioControlador::BuscarUsuarioTabla($_POST["pagina"], $_POST["listarDeCuanto"], $_POST["buscar"]); return;
    } else if ($_GET["accion"] == "Doc") {
        DocumentoControlador::registroDocumento(); return;
    } else if ($_GET["accion"] == "rolU") {
        UsuarioControlador::visualizarRolUsuario(); return;
    } else if($_GET["accion"] == "regDoc"){
       $a=array("id"=>$_POST["id"],
       "categoria"=>$_POST["categoria"],
       "cod"=>$_POST["cod"],
       "entidad"=>$_POST["entidad"],
       "descripcion"=>$_POST["descripcion"],
       "fecha_creacion"=>$_POST["fecha_creacion"],
       "nombre_documento"=>$_POST["nombre_documento"],
       "dato_documento"=>$_POST["dato_documento"],
       "publicar"=>$_POST["publicar"],
        "estado"=> $_POST["estado"],
        "ruta"=>$_POST["ruta"]);
       DocumentoControlador::registrarDocumentos($a);return;
    }else if($_GET["accion"] == "CrearTablasDeNuevo"){
      UsuarioControlador::CrearTablaUsuarioGamch();
      return;
    }else if($_GET["accion"] == "buscarDoc"){
      DocumentoControlador::BuscarDoc($_POST["pagina"], $_POST["listarDeCuanto"], $_POST["buscar"]); return;
    }
}

if ($_GET["accion"] == "salir") {
    sesionControlador::Destroy();
} else if ($_GET["accion"] == "iniciar") {
    LogeoControlador::visualizarInicioSession();
} else if ($_GET["accion"] == "vcu") {
    LogeoControlador::verificarLogin($_POST["usuario"], $_POST["contrasena"]);
} else if ($_GET["accion"] == "nst") {
    NosotrosControlador::visualizarPrincipalNosotros();
} else if ($_GET["accion"] == "ly") {
    LeyControlador::visualizarLey();
} else if ($_GET["accion"] == "his") {
    NosotrosControlador::visualizarHistoria();
} else if ($_GET["accion"] == "map") {
    NosotrosControlador::visualizarMapa();
}
/* todo de la gaceta */
else if ($_GET["accion"] == "gac") {
    GacetaControlador::gaceta();
} else if (
    $_GET["accion"] == "RESOLUCIONES-MUNICIPALES" ||
    $_GET["accion"] == "AUDITORIA-INTERNA" ||
    $_GET["accion"] == "DOCUMENTOS-IMPORTANTES" ||
    $_GET["accion"] == "LEYES-MUNICIPALES" ||
    $_GET["accion"] == "DECRETOS-EDILES" ||
    $_GET["accion"] == "DECRETOS-MUNICIPALES" ||
    $_GET["accion"] == "INFORME-DE-GESTION" ||
    $_GET["accion"] == "TRANSPARENCIA" ||
    $_GET["accion"] == "RESOLUCIONES-MUNICIPALES-ADMINISTRATIVOS"
) {
    DocumentoControlador::documentos_visualizar($_GET["accion"]);
} else {
    IndexControlador::visualizarPrincipal();
}

?>
