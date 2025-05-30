
<?php
require ("vista/esquema/globales.php");
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
require_once "controlador/contacto.controlador.php";
require_once "controlador/empleado.controlador.php";
require_once "controlador/turismo.controlador.php";
require_once "controlador/cultura.controlador.php";
require_once "controlador/servicio.controlador.php";
require_once "controlador/normativa.controlador.php";
require_once "controlador/transparente.controlador.php";
require_once "controlador/secretaria.controlador.php";
require_once "controlador/chat.controlador.php";
    //require('vista/principal/sql.php');
    //include('vista/principal/principalClinica.php');


if(isset($_GET["accion"])){
$_GET["accion"]=$_GET["accion"];
}else{
  $_GET["accion"]="";
}

if (isset($_SESSION["usuario"]) && $_SESSION["usuario"] !='') {
  if($_GET["accion"] == "panel"){
    UsuarioControlador::panelUsuario();return;
  }else if($_GET["accion"] == "Normas"){
    NormativaControlador::DatosDeTablaNormativa();return;
  } else if($_GET["accion"] == "regDocNormativa"){
     $a=array("id"=>$_POST["id"],
     "categoria"=>$_POST["categoria"],
     "cod"=>$_POST["cod"],
     "descripcion"=>$_POST["descripcion"],
     "fecha_creacion"=>$_POST["fecha_creacion"],
     "nombre_documento"=>$_POST["nombre_documento"],
     "publicar"=>$_POST["publicar"],
      "estado"=> $_POST["estado"],);
     NormativaControlador::registrarNormativas($a);return;
  }
  else if($_GET["accion"] == "Transparente"){
    TransparenteControlador::DatosDeTablaTransparente();return;
  } else if($_GET["accion"] == "regDocTransparente"){
     $a=array("id"=>$_POST["id"],
     "categoria"=>$_POST["categoria"],
     "cod"=>$_POST["cod"],
     "descripcion"=>$_POST["descripcion"],
     "fecha_creacion"=>$_POST["fecha_creacion"],
     "nombre_documento"=>$_POST["nombre_documento"],
     "publicar"=>$_POST["publicar"],
      "estado"=> $_POST["estado"],);
     TransparenteControlador::registrarTransparente($a);return;
  }
  else if($_GET["accion"] == "usuarios"){
      UsuarioControlador::listraUsuarios();return;
    }
    else
    if($_GET["accion"] == "buscandoPermiso"){
      UsuarioControlador::buscandoPermisos($_POST["buscar"]);return;
    }
    else
    if($_GET["accion"] == "buscandoRolUsuario"){
      UsuarioControlador::buscandoRolUsuarios($_POST["buscar"]);return;
    }
    if($_GET["accion"] == "buscandoEmpleado"){
      UsuarioControlador::buscandoEmpleadoAhora($_POST["buscar"]);return;
    }else
    if($_GET["accion"] == "buscandoNombre"){
      UsuarioControlador::BuscarInformacionUsuario($_POST["buscar"]);return;
    }else
    if($_GET["accion"] == "permisosUser"){
      UsuarioControlador::panelPermisosUsuario();return;
    }else
    if($_GET["accion"] == "permisos"){
      UsuarioControlador::panelPermisos();return;
    }
    elseif ($_GET["accion"] == "rol") {
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
    }else if ($_GET["accion"] == "RolUsuarioReg") {
        $a = array(
            "id" => $_POST["id"],
            "usuario_id" => $_POST["usuario_id"],
            "id_rol" => $_POST["id_rol"]
        );
        UsuarioControlador::RegistrarRolUsuario($a); return;
    }else if ($_GET["accion"] == "regstrarDatosUsuario") {
      $a = array(
            "id" => $_POST["id"],
            "id_empleado" => $_POST["id_empleado"],
            "usuario" => $_POST["usuario"],
            "contrasena" => $_POST["contrasena"]
        );
        UsuarioControlador::RegistrarNuevoUsuario($a); return;
    }

    else if ($_GET["accion"] == "PermisoUsuarioReg") {
       $a = array(
           "id" => $_POST["id"],
           "id_usuario" => $_POST["id_usuario"],
           "id_permiso" => $_POST["id_permiso"],
       );
       UsuarioControlador::RegistrarPermisosUsuario($a); return;
   }

    else if ($_GET["accion"] == "buscarDocNormas") {
        NormativaControlador::BuscarNormativas($_POST["pagina"], $_POST["listarDeCuanto"], $_POST["buscar"]); return;
    }else if ($_GET["accion"] == "buscarDocTransparente") {
        TransparenteControlador::BuscarTransparente($_POST["pagina"], $_POST["listarDeCuanto"], $_POST["buscar"]); return;
    }
    else if ($_GET["accion"] == "BuscarEmpleadoB") {
        EmpleadoControlador::BuscarEmpleadoTodo($_POST["pagina"], $_POST["listarDeCuanto"], $_POST["buscar"]); return;
    }
    else if ($_GET["accion"] == "bpth") {
        UsuarioControlador::BuscarUsuarioTabla($_POST["pagina"], $_POST["listarDeCuanto"], $_POST["buscar"]); return;
    }
    else if ($_GET["accion"] == "busPermisosUsuario") {
        UsuarioControlador::BuscarPermisoUsuario($_POST["pagina"], $_POST["listarDeCuanto"], $_POST["buscar"]); return;
    }

    else if ($_GET["accion"] == "BuscarUsuarioUno") {
        UsuarioControlador::BuscarUsuarioUno($_POST["pagina"], $_POST["listarDeCuanto"], $_POST["buscar"]); return;
    }

     else if ($_GET["accion"] == "Doc") {
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
    }else if($_GET["accion"] == "RegNot"){
      DocumentoControlador::FormularioNoticia(); return;
    }else if($_GET["accion"] == "regNoticia"){
       $a=array("id"=>$_POST["id"],
       "titulo"=>$_POST["titulo"],
       "contenido"=>$_POST["contenido"],
       "fecha"=>$_POST["fecha"],
       "ruta"=>$_POST["ruta"],
     );
       DocumentoControlador::registrarNoticia($a);return;
    }else if($_GET["accion"] == "buscarNoticias"){
      DocumentoControlador::BuscarNoticiaSeXISTEN($_POST["pagina"], $_POST["listarDeCuanto"], $_POST["buscar"]); return;
    }else if($_GET["accion"] == "buscandoRolesUsuario"){
      UsuarioControlador::BuscarRolesUsuarios($_POST["pagina"], $_POST["listarDeCuanto"], $_POST["buscar"]); return;
    }
    else if($_GET["accion"] == "busPermisos"){
      UsuarioControlador::BuscarPermisos($_POST["pagina"], $_POST["listarDeCuanto"], $_POST["buscar"]); return;
    }
    else if ($_GET["accion"] == "RolReg") {
        $a = array(
            "id" => $_POST["id"],
            "nombre" => $_POST["nombre"],
            "slug" => $_POST["slug"],
            "descripcion" => $_POST["descripcion"] );
        UsuarioControlador::RegistrarPermiso($a); return;
    }else if($_GET["accion"] == "empleado"){
      EmpleadoControlador::VistaTablaEmpleado();return;
    }
    if($_GET["accion"] == "buscandoCargoNuevo"){
      EmpleadoControlador::buscandoCargoDeEmpleado($_POST["buscar"]);return;
    }
    if($_GET["accion"] == "registrarDatosEmpleado"){
      $campos = ["id", "id_nivel", "id_cargo",  "empleado", "nombre", "apellido_p", "apellido_m", "sexo", "direccion", "telefono", "gmail"];
      $datos = [];

      foreach ($campos as $campo) {
         $datos[$campo] = $_POST[$campo];
      }
       EmpleadoControlador::RegistrarDatosEmpleadosNuevo($datos); // Cambia esto si usas otro método o clase
       return;

    }

    if($_GET["accion"] == "gTurismo"){
      TurismoControlador::VisualizarTurismo();return;
    }

    if($_GET["accion"] == "registrarTurismo"){
      $campos = ["id", "nombre_destino", "descripcion", "tipo_destino", "actividades_disponibles", "ubicacion", "contacto", "enlace_web"];
      $datos = [];

      foreach ($campos as $campo) {
          $datos[$campo] = $_POST[$campo];
      }
      // Llamada al controlador (ajusta según tu arquitectura)
      TurismoControlador::RegistrarDatosTurismo($datos); // Cambia esto por tu clase y método real
      return;

    }

    if($_GET["accion"] == "buscarTurismo"){
        TurismoControlador::BuscarTurismo($_POST["pagina"], $_POST["listarDeCuanto"], $_POST["buscar"]); return;
    }
    if($_GET["accion"] == "gCultura"){
      CulturaControlador::visualizarCultura();return;
    }

    if ($_GET["accion"] == "registrarActividadCultural") {
        $campos = [
            "id",
            "nombre_actividad",
            "descripcion",
            "tipo_actividad",
            "fecha_inicio",
            "fecha_fin",
            "ubicacion",
            "contacto",
            "enlace_web"
        ];

        $datos = [];
        foreach ($campos as $campo) {
            $datos[$campo] = $_POST[$campo];
        }
        // Llama al controlador correspondiente
        CulturaControlador::Registrar($datos); // Cambia por tu clase real si es necesario
        return;
    }

    if($_GET["accion"] == "buscarCultura"){
      CulturaControlador::buscarCultura($_POST["pagina"], $_POST["listarDeCuanto"], $_POST["buscar"]); return;
    }

    if($_GET["accion"] == "desabilitasUsuario"){
      UsuarioControlador::DesabilitarUsuario($_POST["id"],$_POST["estado"]);return;
    }

    if($_GET["accion"] == "eliminarRolUsuario"){
      UsuarioControlador::EliminarRolUsuarioo($_POST["id"]);return;
    }
    if($_GET["accion"] == "eliminarRoles"){
      UsuarioControlador::EliminarRolesNuevos($_POST["id"]);return;
    }
    if($_GET["accion"] == "eliminarDocumentos"){
      DocumentoControlador::eliminarDocumentosGac($_POST["id"]);return;
    }
    if($_GET["accion"] == "eliminarDocumentosNormativas"){
      NormativaControlador::eliminarDocumentosNor($_POST["id"]);return;
    }
    if($_GET["accion"] == "eliminarDocumentosTransparente"){
      TransparenteControlador::eliminarDocumentosTra($_POST["id"]);return;
    }
}


if($_GET["accion"] == "listarNoticias"){
  DocumentoControlador::ListarNoticasNuevas($_POST["pagina"], $_POST["listarDeCuanto"]); return;
}else
if($_GET["accion"] == "buscarViewTransparente"){
  TransparenteControlador::buscarTransrenciaNuevo($_POST["pagina"], $_POST["listarDeCuanto"], $_POST["buscar"],$_POST["categoria"]); return;
}else
if($_GET["accion"] == "buscarViewNormas"){
  NormativaControlador::buscarNomativaNuevo($_POST["pagina"], $_POST["listarDeCuanto"], $_POST["buscar"],$_POST["categoria"]); return;
}else
if($_GET["accion"] == "Servicios"){
    ServicioControlador::ViewServicios();
}else
if($_GET["accion"] == "cultura"){
    CulturaControlador::ViewCultura();
}else
if($_GET["accion"] == "turismo"){
    TurismoControlador::ViewTurismo();
}else
if($_GET["accion"] == "contacto"){
    ContactoControlador::Contactos();
}else
if($_GET["accion"] == "seguirLey"){
    DocumentoControlador::SeguirLeyendodOCUMENTO($_POST["id"]);
}else
if($_GET["accion"] == "Noticia"){
    DocumentoControlador::ViewNoticias();
}
else if($_GET["accion"] == "buscando"){
    DocumentoControlador::BuscarDocumento($_POST["buscar"]);
}else
if ($_GET["accion"] == "salir") {
    sesionControlador::Destroy();
} else if ($_GET["accion"] == "iniciar" && isset($_SESSION["usuario"]) == '') {
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
}else if ($_GET["accion"] == "MIVI") {
    NosotrosControlador::visualizarmISIONvision();
}else if ($_GET["accion"] == "ORGANIGRAMA") {
    NosotrosControlador::visualizarOrganigrama();
}else if ($_GET["accion"] == "SUBALCALDIA") {
    NosotrosControlador::visualizarSUBALCALDIAS();
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
}else
if (
    $_GET["accion"] == "REGLAMENTOS-ESPECIFICOS" ||
    $_GET["accion"] == "GESTION-DE-PERSONAL" ||
    $_GET["accion"] == "GESTION-TECNICA" ||
    $_GET["accion"] == "GESTION-NORMATIVA" ||
    $_GET["accion"] == "GESTION-ADMINISTRATIVA" ||
    $_GET["accion"] == "MANUALES-ADMINISTRATIVOS" ||
    $_GET["accion"] == "MANUAL-DE-ORGANIZACION-FUNCIONES"
) {
    NormativaControlador::visualizarNormativa($_GET["accion"]);
}else if (
    $_GET["accion"] == "INFORMES-DE-GESTION" ||
    $_GET["accion"] == "REPORTES-DE-EJECUCION" ||
    $_GET["accion"] == "BOLETINES-DE-INFORMACION" ||
    $_GET["accion"] == "PLANES-ESTRATEGICOS" ||
    $_GET["accion"] == "PRESUPUESTO-POA" ||
    $_GET["accion"] == "UNIDAD-DE-AUDITORIA-INTERNA"
) {
    TransparenteControlador::visualizarTransparencia($_GET["accion"]);
}else if($_GET["accion"] == "SDHS"){
  SecretariaControlador::visualizarSDHS();
}else if($_GET["accion"] == "SDP"){
  SecretariaControlador::visualizarSDP();
}else if($_GET["accion"] == "SOP"){
  SecretariaControlador::visualizarSOP();
}else if($_GET["accion"] == "SF"){
  SecretariaControlador::visualizarSF();
}else if($_GET["accion"] == "msu"){
  ChatControlador::MensajeUsuario($_POST["mensaje"]);
}
else if($_GET["accion"] == "ALCALDE"){
  NosotrosControlador::VisualizaRAlcalde();
}
else {
    IndexControlador::visualizarPrincipal();
}

?>
