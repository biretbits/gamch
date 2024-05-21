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
    $listarDeCuanto = 5;$pagina = 1;
		$resultodoUsuarios = $u->SelectPorBusqueda("",false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;
    // Verificar si la consulta devuelve resultados
    $resul = $u->SelectPorBusqueda("",$inicioList,$listarDeCuanto);
    require("../vista/admin/tablaUsuarios.php");
	}

  public function BuscarUsuarios($buscar,$pagina,$listarDeCuanto){
    $u = new Usuario();
    $resul1 = $u->SelectPorBusqueda($buscar,false,false);
    $num_filas_total = mysqli_num_rows($resul1);
    //ejemplo supongamos que tenemos 100 registros en num_filas_total lo dividimos de cuanto en cuanto queremos
    //que se muesre en la tabla en este caso de 5 entonces dividmos 100/5 = 20 por pagina
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial2
    $inicioList = ($pagina - 1) * $listarDeCuanto;
    // Verificar si la consulta devuelve resultados
    $resul = $u->SelectPorBusqueda($buscar,$inicioList,$listarDeCuanto);
    echo "
    <div class='row'>
      <div class='col'>
        <div class='table-responsive'>
        <table class='table'>
          <thead>
            <tr>
              <th>N°</th>
              <th>C.I.</th>
              <th>Usuario</th>
              <th>Nombre</th>
              <th>Apellido P.</th>
              <th>Apellido M.</th>
              <th>Telefono</th>
              <th>Dirección</th>
              <th>Profesión</th>
              <th>Especialidad</th>
              <th>Tipo</th>
              <th>Acción</th>
            </tr>
          </thead>
        <tbody> ";

    if ($resul && $resul->num_rows > 0) {
        // Hay resultados, procesarlos
      $i = 0;
      while($fi=mysqli_fetch_array($resul)){
        echo "<tr>";
          echo "<td>".($i+1)."</td>";
          echo "<td>".$fi['ci_usuario']."</td>";
          echo "<td>".$fi['usuario']."</td>";
          echo "<td>".$fi['nombre_usuario']."</td>";
          echo "<td>".$fi['ap_usuario']."</td>";
          echo "<td>".$fi['am_usuario']."</td>";
          echo "<td>".$fi['telefono_usuario']."</td>";
          echo "<td>".$fi['direccion_usuario']."</td>";
          echo "<td>".$fi['profesion_usuario']."</td>";
          echo "<td>".$fi['especialidad_usuario']."</td>";
          echo "<td>".$fi['tipo_usuario']."</td>";
          echo "<td>";
            echo "<div class='btn-group'>";
              echo "<button type='button' class='btn btn-success mb-1'><img src='../imagenes/sedit.png' height='30' width='30' class='rounded-circle'></button>";
              echo "<button type='button' class='btn btn-danger'><img src='../imagenes/seli.png' height='30' width='30' class='rounded-circle'></button>";
            echo "</div>";
          echo "</td>";
        echo "</tr>";
        $i++;
      }
    } else {
      echo "<tr>";
        // No hay resultados
        echo "<td></td>";
        echo "<td>No se encontro resultados</td>";
        echo "<td></td>";
      echo "</tr>";
    }
    echo "</tbody>
        </table>
        </div>
      </div>
    </div>";




    if($TotalPaginas!=0){
      $adjacents=1;
      $anterior = "&lsaquo; Anterior";
      $siguiente = "Siguiente &rsaquo;";
  echo "<div class='row'>
        <div class='col'>";

      echo "<div class='d-flex flex-wrap flex-sm-row justify-content-between'>";
        echo '<ul class="pagination">';
          echo "pagina &nbsp;".$pagina."&nbsp;con&nbsp;";
            $total=$inicioList+$pagina;
            if($TotalPaginas > $num_filas_total){
              $TotalPaginas = $num_filas_total;
            }
          echo '<li class="page-item active"><a class=" href="#"> '.($TotalPaginas).' </a></li> ';
          echo " &nbsp;de&nbsp;".$num_filas_total." registros";
        echo '</ul>';

        echo '<ul class="pagination d-flex flex-wrap">';

        // previous label
        if ($pagina != 1) {
          echo "<li class='page-item'><a class='page-link'  onclick=\"BuscarUsuarios(1)\"><span aria-hidden='true'>&laquo;</span></a></li>";
        }
        if($pagina==1) {
          echo "<li class='page-item'><a class='page-link text-muted'>$anterior</a></li>";
        } else if($pagina==2) {
          echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"BuscarUsuarios(1)\" class='page-link'>$anterior</a></li>";
        }else {
          echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"BuscarUsuarios($pagina-1)\">$anterior</a></li>";

        }
        // first label
        if($pagina>($adjacents+1)) {
          echo "<li class='page-item'><a href='javascript:void(0);' class='page-link' onclick=\"BuscarUsuarios(1)\">1</a></li>";
        }
        // interval
        if($pagina>($adjacents+2)) {
          echo"<li class='page-item'><a class='page-link'>...</a></li>";
        }

        // pages

        $pmin = ($pagina>$adjacents) ? ($pagina-$adjacents) : 1;
        $pmax = ($pagina<($TotalPaginas-$adjacents)) ? ($pagina+$adjacents) : $TotalPaginas;
        for($i=$pmin; $i<=$pmax; $i++) {
          if($i==$pagina) {
            echo "<li class='page-item active'><a class='page-link'>$i</a></li>";
          }else if($i==1) {
            echo"<li class='page-item'><a href='javascript:void(0);' class='page-link'onclick=\"BuscarUsuarios(1)\">$i</a></li>";
          }else {
            echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"BuscarUsuarios(".$i.")\" class='page-link'>$i</a></li>";
          }
        }

        // interval

        if($pagina<($TotalPaginas-$adjacents-1)) {
          echo "<li class='page-item'><a class='page-link'>...</a></li>";
        }
        // last

        if($pagina<($TotalPaginas-$adjacents)) {
          echo "<li class='page-item'><a href='javascript:void(0);'class='page-link ' onclick=\"BuscarUsuarios($TotalPaginas)\">$TotalPaginas</a></li>";
        }
        // next

        if($pagina<$TotalPaginas) {
          echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"BuscarUsuarios($pagina+1)\">$siguiente</a></li>";
        }else {
          echo "<li class='page-item'><a class='page-link text-muted'>$siguiente</a></li>";
        }
        if ($pagina != $TotalPaginas) {
          echo "<li class='page-item'><a class='page-link' onclick=\"BuscarUsuarios($TotalPaginas)\"><span aria-hidden='true'>&raquo;</span></a></li>";
        }

        echo "</ul>";
        echo "</div>";

  echo "</div>
      </div>";

    }
}

	public function v_index(){
			header("location: ../index.php");
	}
  public function visualizarinterfazUsuario(){
    require("../vista/admin/registroUsuarios.php");
  }
  public function insertarUsuario($usuario,$nombre_usuario,$ap_usuario,$am_usuario,$ci,$telefono_usuario,$direccion_usuario,$profesion_usuario,
  $especialidad_usuario,$tipo_usuario,$contraseña_usuario){
    $usu = new Usuario();
    $resp = $usu->insertarUsuarios($usuario,$nombre_usuario,$ap_usuario,$am_usuario,$telefono_usuario,$direccion_usuario,$profesion_usuario,
    $especialidad_usuario,$tipo_usuario,$contraseña_usuario,$ci);
    if($resp != ""){
         echo "correcto";
    }else{
         echo "error";
    }
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
    //echo "buscar   ".$_POST["buscar"];buscar
		$uc->BuscarUsuarios($_POST["buscar"],$_POST["page"],$_POST["listarDeCuanto"]);
	}
  if(isset($_GET["accion"]) && $_GET["accion"]=="vfu"){
  		$uc->visualizarinterfazUsuario();
  	}

  if(isset($_GET["accion"]) && $_GET["accion"]=="insUsu"){
    		$uc->insertarUsuario(
          $_POST["usuario"],
          $_POST["nombre_usuario"],
          $_POST["ap_usuario"],
          $_POST["am_usuario"],
          $_POST["ci"],
          $_POST["telefono_usuario"],
          $_POST["direccion_usuario"],
          $_POST["profesion_usuario"],
          $_POST["especialidad_usuario"],
          $_POST["tipo_usuario"],
          $_POST["contraseña_usuario"]
          );
  }
?>
