<?php
require_once '../modelo/registroDiario.php';
require "sesion.controlador.php";
$ins=new sesionControlador();
$ins->StarSession();
if(isset($_SESSION["tipo_usuario"])==""){
    $ins->Redireccionar_inicio();
}
class RegistroDiarioControlador{

	public function visualizarTablaRegistroDiario(){
		$rdi =new RegistroDiario();
    $listarDeCuanto = 5;$pagina = 1;
    $resultodoUsuarios = $rdi->SelectPorBusquedaRegistroDiario("",false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;
    // Verificar si la consulta devuelve resultados
    $res = $rdi->SelectPorBusquedaRegistroDiario("",$inicioList,$listarDeCuanto);
    $resul = $this->Uniendo($res,$rdi);
    require ("../vista/registroDiario/tablaRegistroDiario.php");
  }
  //funciones para encontrar los nombres de los usuarios como doctor y el de admision
  function Uniendo($resul, $rdi) {
    $ar = [];
    while ($fi = mysqli_fetch_array($resul)) {
        // Añadir cada fila al array con una estructura correcta
        $entry = [
            "cod_usuario" => $fi["cod_usuario"],
            "ci_usuario" => $fi["ci_usuario"],
            "usuario" => $fi["usuario"],
            "nombre_usuario" => $fi["nombre_usuario"],
            "ap_usuario" => $fi["ap_usuario"],
            "am_usuario" => $fi["am_usuario"],
            "fecha_nac_usuario" => $fi["fecha_nac_usuario"],
            "edad_usuario" => $fi["edad_usuario"],
            "telefono_usuario" => $fi["telefono_usuario"],
            "direccion_usuario" => $fi["direccion_usuario"],
            "profesion_usuario" => $fi["profesion_usuario"],
            "especialidad_usuario" => $fi["especialidad_usuario"],
            "tipo_usuario" => $fi["tipo_usuario"],
            "contrasena_usuario" => $fi["contrasena_usuario"],
            "cod_cds" => $fi["cod_cds"],
            "estado_usuario" => $fi["estado"],
            "cod_rd" => $fi["cod_rd"],
            "fecha_rd" => $fi["fecha_rd"],
            "hora_rd" => $fi["hora_rd"],
            "servicio_rd" => $fi["servicio_rd"],
            "signo_sintomas_rd" => $fi["signo_sintomas_rd"],
            "historial_clinico_rd" => $fi["historial_clinico_rd"],
            "fecha_retorno_historia_rd" => $fi["fecha_retorno_historia_rd"],
            "pe_brinda_atencion_rd" => $fi["pe_brinda_atencion_rd"],
            "medico_nombre" => $rdi->selectNombreUsuario($fi["pe_brinda_atencion_rd"]),
            "resp_admision_rd" => $fi["resp_admision_rd"],
            "admision_nombre" => $rdi->selectNombreUsuario($fi["resp_admision_rd"]),
            "paciente_rd" => $fi["paciente_rd"],
            "cod_cds" => $fi["cod_cds"],
            "estado_rd" => $fi["estado"],
        ];
        $ar[] = $entry; // Agregar la entrada al array principal
    }
    return $ar; // Devolver el array completo fuera del bucle
}


	public function v_index(){
	    header("location: ../index.php");
	}
}

	$rd=new  RegistroDiarioControlador();

	if(isset($_GET["accion"]) && $_GET["accion"]=="vtd"){
		$rd->visualizarTablaRegistroDiario();
	}
  if(isset($_GET["accion"]) && $_GET["accion"]=="brd"){
		$rd->visualizarTablaRegistroDiario();
	}

?>
