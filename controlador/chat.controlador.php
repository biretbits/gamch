<?php
require_once '../modelo/chat.php';
require "sesion.controlador.php";
$ins=new sesionControlador();
$ins->StarSession();
$abi = $ins->verificarSession();
if($abi!='' and $abi=='cerrar'){
  $ins->Destroy();
  $ins->Redireccionar_inicio();
}

class ChatControlador{

  public function VisualizarTablaChat(){
    $ch = new Chat();
    $listarDeCuanto = 5;$pagina = 1;$buscar = "";
    $resul1 = $ch->SeleccionarChat($buscar,false,false);
    $num_filas_total = mysqli_num_rows($resul1);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;

    $resul = $ch->SeleccionarChat($buscar,$inicioList,$listarDeCuanto);

    require("../vista/chat/tablaChat.php");
  }

  public function buscarYvisualizarTabla($pagina,$listarDeCuanto,$buscar){
    $ch = new Chat();
    $resul1 = $ch->SeleccionarChat($buscar,false,false);
    if(is_string($resul1)){
      echo "<h6>Ocurrio un error, $resul1</h6>";
    }else{
      $num_filas_total = mysqli_num_rows($resul1);
      $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
              //calculamos el registro inicial
      $inicioList = ($pagina - 1) * $listarDeCuanto;

      $resul = $ch->SeleccionarChat($buscar,$inicioList,$listarDeCuanto);
      echo "<div class='row'>
        <div class='col'>
          <div class='table-responsive'>
          <table class='table'>
            <thead style='font-size:12px'>
              <tr>
                <th>N°</th>
                <th>Consulta</th>
                <th>Respuesta</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody>";

        if (mysqli_num_rows($resul) > 0){
            $i = $inicioList;
          while($fi=mysqli_fetch_array($resul)){
              echo "<tr>";
                echo "<td>".($i+1)."</td>";
                echo "<td>".$fi['consulta']."</td>";
                echo "<td>".$fi['respuesta_consulta']."</td>";
                echo "<td>";
                  echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>";
									$dd = "<button type='button' class='btn btn-info' title='Editar' onclick='ActualizarNombreGenerico(".$fi["cod_cons"].",\"".$fi["consulta"]."\",\"".$fi["respuesta_consulta"]."\")' data-bs-toggle='modal' data-bs-target='#ModalRegistro'><img src='../imagenes/edit.ico' height='17' width='17' class='rounded-circle'></button>";
									echo $dd;
                //  echo "<button type='button' class='btn btn-danger' title='Desactivar' onclick='accionBtnActivar(".$fi["cod_cons"].")'><img src='../imagenes/drop.ico' height='17' width='17' class='rounded-circle'></button>";

                  echo "</div>";
              echo "</td>";

              echo "</tr>";
              $i++;
            }
          }else{
            echo "<tr>";
            echo "<td colspan='15' align='center'>No se encontraron resultados</td>";
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
          echo "<li class='page-item'><a class='page-link'  onclick=\"Buscar(1)\"><span aria-hidden='true'>&laquo;</span></a></li>";
        }
        if($pagina==1) {
          echo "<li class='page-item'><a class='page-link text-muted'>$anterior</a></li>";
        } else if($pagina==2) {
          echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"Buscar(1)\" class='page-link'>$anterior</a></li>";
        }else {
          echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"Buscar($pagina-1)\">$anterior</a></li>";

        }
        // first label
        if($pagina>($adjacents+1)) {
          echo "<li class='page-item'><a href='javascript:void(0);' class='page-link' onclick=\"Buscar(1)\">1</a></li>";
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
            echo"<li class='page-item'><a href='javascript:void(0);' class='page-link'onclick=\"Buscar(1)\">$i</a></li>";
          }else {
            echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"Buscar(".$i.")\" class='page-link'>$i</a></li>";
          }
        }

        // interval

        if($pagina<($TotalPaginas-$adjacents-1)) {
          echo "<li class='page-item'><a class='page-link'>...</a></li>";
        }
        // last

        if($pagina<($TotalPaginas-$adjacents)) {
          echo "<li class='page-item'><a href='javascript:void(0);'class='page-link ' onclick=\"Buscar($TotalPaginas)\">$TotalPaginas</a></li>";
        }
        // next

        if($pagina<$TotalPaginas) {
          echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"Buscar($pagina+1)\">$siguiente</a></li>";
        }else {
          echo "<li class='page-item'><a class='page-link text-muted'>$siguiente</a></li>";
        }
        if ($pagina != $TotalPaginas) {
          echo "<li class='page-item'><a class='page-link' onclick=\"Buscar($TotalPaginas)\"><span aria-hidden='true'>&raquo;</span></a></li>";
        }

        echo "</ul>";
        echo "</div>";

  echo "</div>
      </div>";
      }
    }
  }



  public function EditarRegistrar($cod_conc,$consulta,$respuesta){
    $ch = new Chat();
		$consulta= strtolower($this->removeAccents($consulta));
		$respuesta= strtolower($this->removeAccents($respuesta));
    $resul = $ch->InsertarOactualizar($cod_conc,$consulta,$respuesta);
    if($resul != ''){
      echo "correcto";
    }else{
      echo "error";
    }
  }
	function removeAccents($text) {
		$acentos = [
        'á' => 'a', 'Á' => 'A',
        'é' => 'e', 'É' => 'E',
        'í' => 'i', 'Í' => 'I',
        'ó' => 'o', 'Ó' => 'O',
        'ú' => 'u', 'Ú' => 'U',
        'ü' => 'u', 'Ü' => 'U',
        'ñ' => 'ñ', 'Ñ' => 'ñ'
    ];
    // Reemplaza cada carácter acentuado con su versión sin tilde
    $text = strtr($text, $acentos);
    return $text;
}

	public function ReporteBuscarChat($buscar){
		$ch = new Chat();
		$resul = $ch->SeleccionarChat($buscar,false,false);
		require("../vista/chat/ReporteChat.php");
	}

}


	$uc=new  ChatControlador();


if(isset($_SESSION["tipo_usuario"]) && $_SESSION["tipo_usuario"]=="admin"){
  if(isset($_GET["accion"]) && $_GET["accion"]=="msu"){
    $uc->MensajeUsuario($_POST["mensaje"]);
  }
    if(isset($_GET["accion"]) && $_GET["accion"]=="tcb"){
        $uc->VisualizarTablaChat();
  	}
    if(isset($_GET["accion"]) && $_GET["accion"]=="bcmt"){

        $uc->buscarYvisualizarTabla($_POST["pagina"],$_POST["listarDeCuanto"],$_POST["buscar"]);
    }
    if(isset($_GET["accion"]) && $_GET["accion"]=="rcpma"){
      $uc->EditarRegistrar($_POST["cod_conc"],$_POST["consulta"],$_POST["respuesta"]);
    }
  	if(isset($_GET["accion"]) && $_GET["accion"]=="rch"){
      $uc->ReporteBuscarChat($_POST['buscar']);
    }
}else{
    $ins->Redireccionar_inicio();
}
?>
