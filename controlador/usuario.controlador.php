<?php
require_once '../modelo/usuario.php';
require "sesion.controlador.php";
$ins=new sesionControlador();
$ins->StarSession();
//si esto esta vacio no puede ingresar nadies directamente no s llevara index
if(isset($_SESSION["usuario"])==""){
    $ins->Redireccionar_inicio();
}
class UsuarioControlador{

	/*public function visualizarRegistro(){
		  //header("location: ../index.php");
			$contra=password_hash($contrasena, PASSWORD_DEFAULT);

      require("../vista/logeo/registro.php");
	}*/

	public function visualizarprueba($contrasena){
			//header("location: ../index.php");
			$contra=password_hash($contrasena, PASSWORD_DEFAULT);
			require("../vista/prueba/prueba.php");
	}

  public function visualizarRegistro(){
		//si es el admin puede ver el formulario de registro de usuario
		if(isset($_SESSION["tipo_usuario"]) && $_SESSION["tipo_usuario"] !="" && $_SESSION["tipo_usuario"] =="admin"){
			require("../vista/logeo/registro.php");
		}else{//si no directamente solo puede ver el index
			$this->v_index();
		}
	}

  public function visualizarUsuariosTabla(){
		$u = new Usuario();
		$resultodoUsuarios = $u->SelectUsuarios();
    require("../vista/admin/tablaUsuarios.php");
	}

  public function BuscarUsuarios($buscar){
    $u = new Usuario();
    $resul = $u->SelectPorBusqueda($buscar);
    // Verificar si la consulta devuelve resultados
    echo "
    <div class='row'>
      <div class='col'>
        <table class='table'>
          <thead>
            <tr>
              <th scope='Usuario'>#</th>
              <th scope='Usuario'>#</th>
              </tr>
              </thead>
              <tbody> ";
    if ($resul && $resul->num_rows > 0) {
        // Hay resultados, procesarlos
      while($fi=mysqli_fetch_array($resul)){
        echo "<tr>
            <td>".$fi['usuario']."</td>
            <td>".$fi['usuario']."</td>";
        echo "</tr>";
      }
    } else {
        // No hay resultados
        echo "No se encontro resultados";
    }
    echo "</tbody>
        </table>
      </div>
    </div>
  ";
  }

	public function v_index(){
			header("location: ../index.php");
	}
}

	$uc=new  UsuarioControlador();
	if(isset($_GET["accion"]) && $_GET["accion"]=="vr"){
		$uc->visualizarRegistro();
	}

	if(isset($_GET["accion"]) && $_GET["accion"]=="prueba"){
		$uc->visualizarprueba($_GET['contrasena']);
	}

	//visualizar interfaz de registro de  usuario nuevo
	if(isset($_GET["accion"]) && $_GET["accion"]=="vrg"){
		$uc->visualizarFormularioRegistro();
	}
	//visualizar usuarios en una tabla
	if(isset($_GET["accion"]) && $_GET["accion"]=="vut"){
		$uc->visualizarUsuariosTabla();
	}
  //buscar por nombre usuario, etc
	if(isset($_GET["accion"]) && $_GET["accion"]=="bus"){
    echo "buscar   ".$_POST["buscar"];
		$uc->BuscarUsuarios($_POST["buscar"]);
	}

?>
