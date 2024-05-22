<?php
require_once '../modelo/usuario.php';
require "sesion.controlador.php";
$ins=new sesionControlador();
$ins->StarSession();
//si esto esta vacio no puede ingresar nadies directamente no s llevara index
if(isset($_SESSION["tipo_usuario"])==""){
    $ins->Redireccionar_inicio();
}
class UsuarioControlador{

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
            echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>";
              echo "<button type='button' class='btn btn-info' title='Editar' onclick='accionBtnEditar(".$pagina.",".$listarDeCuanto.",\"".$fi["cod_usuario"]."\")'><img src='../imagenes/edit.ico' height='17' width='17' class='rounded-circle'></button>";
              if($fi["estado"] == "activo" && $fi["tipo_usuario"] != "admin"){
                echo "<button type='button' class='btn btn-danger' title='Desactivar Usuario' onclick='accionBtnActivar(\"activo\",".$pagina.",".$listarDeCuanto.",".$fi["cod_usuario"].")'><img src='../imagenes/drop.ico' height='17' width='17' class='rounded-circle'></button>";
              }else if($fi["tipo_usuario"] != "admin"){
                echo "<button type='button' class='btn btn-danger' title='Activar Usuario' onclick='accionBtnActivar(\"desactivo\",".$pagina.",".$listarDeCuanto.",".$fi["cod_usuario"].")'><img src='../imagenes/activar.ico' height='17' width='17' class='rounded-circle'></button>";
              }
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

    public function activarUsuario($accion,$pagina,$listarDeCuanto,$buscar,$cod_usuario){
        $usu = new Usuario();
        $re = $usu->desactivarUsuario($cod_usuario,$accion);
        if($re != ""){//si se actualizo el estado entonces mostramos la tabla
          $this->BuscarUsuarios($buscar,$pagina,$listarDeCuanto);
        }else{//solo mostramo un alert con error
          echo "error";
        }
    }

	public function v_index(){
			header("location: ../index.php");
	}
  public function visualizarinterfazUsuario(){
    require("../vista/admin/registroUsuarios.php");
  }
  public function insertarUsuario($usuario,$nombre_usuario,$ap_usuario,$am_usuario,$ci,$telefono_usuario,$direccion_usuario,$profesion_usuario,
  $especialidad_usuario,$tipo_usuario,$contraseña_usuario,$cod_usuario,$accion){
    $usu = new Usuario();
    $resp = $usu->insertarUpdateUsuarios($usuario,$nombre_usuario,$ap_usuario,$am_usuario,$telefono_usuario,$direccion_usuario,$profesion_usuario,
    $especialidad_usuario,$tipo_usuario,$contraseña_usuario,$ci,$cod_usuario,$accion);
    if($resp != ""){
        if($accion == 1){
          echo "correcto";
        }else{
           echo "correcto";
        }
    }else{
         echo "error";
    }
  }
  //despues de actualizar los datos llamamos esta funcion
  public function visualizarTablaUsuarios($pagina,$listarDeCuanto,$buscar){
    if(!is_numeric($pagina) && !is_numeric($listarDeCuanto)){
        $this->v_index();
    }
    $u = new Usuario();
    $resultodoUsuarios = $u->SelectPorBusqueda("",false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;
    // Verificar si la consulta devuelve resultados
    $resul = $u->SelectPorBusqueda("",$inicioList,$listarDeCuanto);
    require("../vista/admin/tablaUsuarios.php");
  }

  //funcion pra modificar los datos del usuario
  public function modificarUsuario($cod_usuario){
    $usu = new Usuario();
    $re = $usu->selectDatosUsuario($cod_usuario);
    if ($re && $re->num_rows > 0) {//se encontro el usuario buscado ahora lo mostramos en el formulario de registro
      echo "correcto";
    }else{
      echo "error";
    }
  }
  //visulizar formulario de acturalizar registros con los datos del cod_usuario buscado
  public function FormularioModificar($pagina,$listarDeCuanto,$buscar,$cod_usuario){
    if(!is_numeric($pagina) && !is_numeric($listarDeCuanto)){
      	$this->v_index();
    }
    $usu = new Usuario();
    $re = $usu->selectDatosUsuario($cod_usuario);
    require("../vista/admin/registroUsuarios.php");
  }

  public function ConfirmarPass($pass,$usuario){
    $us1 = new Usuario();
    $resultado = $us1->validarBD($usuario);
    $filas = mysqli_fetch_array($resultado);
    if(password_verify($pass,$filas['contrasena_usuario'])){
      echo $filas['contrasena_usuario'];
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
          $_POST["contraseña_usuario"],
          $_POST["cod_usuario"],
          $_POST["accion"]
          );
  }
  //no se puede eliminar poreso solo lo desactivaremos al usuario
  if(isset($_GET["accion"]) && $_GET["accion"] == "del"){
    $uc->activarUsuario($_POST["accion"],$_POST["pagina"],$_POST["listarDeCuanto"],$_POST["buscar"],$_POST["cod_usuario"]);
  }
  //para editar los datos del usuario
  if(isset($_GET["accion"]) && $_GET["accion"] == "ed"){
    $uc->modificarUsuario($_POST["cod_usuario"]);
  }
  //para editar los datos del usuario
  if(isset($_GET["accion"]) && $_GET["accion"] == "fm"){
    $uc->FormularioModificar($_POST["pagina"],$_POST["listarDeCuanto"],$_POST["buscar"],$_POST["cod_usuario"]);
  }
  //para verificar copntrasena
  if(isset($_GET["accion"]) && $_GET["accion"] == "vy"){
    $uc->ConfirmarPass($_POST["confirmarcontrasena"],$_POST["usuario"]);
  }
  //despues de ya haber registradp ahora tenemos que llamar a la tabla con estos parametros
  if(isset($_GET["accion"]) && $_GET["accion"] == "fm2"){
    $uc->visualizarTablaUsuarios($_POST["pagina"],$_POST["listarDeCuanto"],$_POST["buscar"]);
  }

?>
