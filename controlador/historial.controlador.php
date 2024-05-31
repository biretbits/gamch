<?php
require_once '../modelo/historial.php';
require "sesion.controlador.php";
$ins=new sesionControlador();
$ins->StarSession();
if(isset($_SESSION["tipo_usuario"])==""){
    $ins->Redireccionar_inicio();
}
class HistorialControlador{
	public function verTablaHistorial($paciente_rd,$cod_rd){
    $rdi =new Historial();
    $listarDeCuanto = 5;$pagina = 1;$buscar = "";$fecha = date('Y-m-d');
    $resultodoUsuarios = $rdi->SelectPorBusquedaHistorial(false,false,false,$paciente_rd,false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;
    // Verificar si la consulta devuelve resultados
    $res = $rdi->SelectPorBusquedaHistorial(false,false,false,$paciente_rd,false,false);
    $resul = $this->Uniendo($res,$rdi);
    require ("../vista/historial/tablaHistorial.php");
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
            "cod_his" => $fi["cod_his"],
            "zona_his" => $fi["zona_his"],
            "cod_rd" => $fi["cod_rd"],
            "paciente_rd" => $fi["paciente_rd"],
            "cod_cds" => $fi["cod_cds"],
            "cod_responsable_familia_his" => $fi["cod_responsable_familia_his"],
            "datos_responsable_familia" => $rdi->selectDatosUsuarios($fi["cod_responsable_familia_his"]),
            "estado_h" => $fi["estado"]

        ];
        $ar[] = $entry; // Agregar la entrada al array principal
    }
    return $ar; // Devolver el array completo fuera del bucle
}
public function verFormRegistroHistorial($paciente_rd,$cod_rd){
  require ("../vista/historial/RegistroHistorial.php");
}

public function registroDatosResponsablePaciente($Nombre_responsable,$ap_responsable,$am_responsable,$fecha_nacimiento_responsable,$sexo_responsable,
$ocupacion_responsable,$direccion_responsable,$telefono_resposable,$comunidad_responsable,$ci,$n_seguro,$n_carp_fam,$nombre,$ap_usuario,
$am_usuario,$fecha_nacimiento,$sexo,$ocupacion,$fecha_de_consulta,$estado_civil,$escolaridad){
  $rnp= new RegistroDiario();
  //echo $cod_usuario;
  $resp = $rnp->insertarNewpacientes();
  //echo $cod_usuario;
  if($resp != ""){
      echo "correcto";
  } else{
      echo "error";
  }
}


}

  $hc = new HistorialControlador();
  if(isset($_GET["accion"]) && $_GET["accion"]=="vht"){
		$hc->verTablaHistorial($_POST["paciente_rd"],$_POST["cod_rd"]);
	}
  if(isset($_GET["accion"]) && $_GET["accion"]=="visFH"){
    $hc->verFormRegistroHistorial($_POST["paciente_rd"],$_POST["cod_rd"]);
  }
  if(isset($_GET["accion"]) && $_GET["accion"]=="visFH"){
    $hc->registroDatosResponsablePaciente(

      $_POST["Nombre_responsable"],
      $_POST["ap_responsable"],
      $_POST["am_responsable"],
      $_POST["fecha_nacimiento_responsable"],
      $_POST["sexo_responsable"],
      $_POST["ocupacion_responsable"],
      $_POST["direccion_responsable"],
      $_POST["telefono_resposable"],
      $_POST["comunidad_responsable"],
      $_POST["ci"],
      $_POST["n_seguro"],
      $_POST["n_carp_fam"],
      $_POST["nombre"],
      $_POST["ap_usuario"],
      $_POST["am_usuario"],
      $_POST["fecha_nacimiento"],
      $_POST["sexo"],
      $_POST["ocupacion"],
      $_POST["fecha_de_consulta"],
      $_POST["estado_civil"],
      $_POST["escolaridad"]);
  }

?>
