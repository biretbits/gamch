<?php
require_once '../modelo/farmacia.php';
require "sesion.controlador.php";
$ins=new sesionControlador();
$ins->StarSession();
if(isset($_SESSION["tipo_usuario"])==""){
    $ins->Redireccionar_inicio();
}
class FarmaciaControlador{

  //funcion de presentacion date_create_from_format

  public function visualizarPresentacion(){
    $fa =new Farmacia();
    $listarDeCuanto = 5;$pagina = 1;$buscar = "";
    $resul1 = $fa->SeleccionarPresentacion(false,false,$buscar);
    $num_filas_total = mysqli_num_rows($resul1);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;
    // Verificar si la consulta devuelve resultados
    $resul = $fa->SeleccionarPresentacion($inicioList,$listarDeCuanto,$buscar);
    require("../vista/farmacia/farmaciaPresentacion.php");
  }


    public function BuscarPresentacion($pagina,$listarDeCuanto,$buscar){
      $fa =new Farmacia();
      $listarDeCuanto = $listarDeCuanto;$pagina = $pagina;$buscar = $buscar;
      $resul1 = $fa->SeleccionarPresentacion(false,false,$buscar);
      $num_filas_total = mysqli_num_rows($resul1);
      $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
              //calculamos el registro inicial
      $inicioList = ($pagina - 1) * $listarDeCuanto;
      // Verificar si la consulta devuelve resultados
      $resul = $fa->SeleccionarPresentacion($inicioList,$listarDeCuanto,$buscar);
      echo "<div class='row'>
        <div class='col'>
          <div class='table-responsive'>
          <table class='table'>
            <thead style='font-size:12px'>
              <tr>
                <th>N°</th>
                <th>Forma presentación</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody>";
        if (mysqli_num_rows($resul) > 0){
          $i = $inicioList;
          foreach ($resul as $fi){
              echo "<tr>";
                echo "<td>".($i+1)."</td>";
                echo "<td>".$fi['nombre_forma']."</td>";
                echo "<td>";
                  echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>";
                  echo "<button type='button' class='btn btn-info' title='Editar' onclick='ActualizarNombreGenerico(" . $fi['cod_forma'] . ", \"" .($fi['nombre_forma']) . "\")'data-bs-toggle='modal' data-bs-target='#ModalRegistro'><img src='../imagenes/edit.ico' height='17' width='17' class='rounded-circle'></button>";
  //echo "<button type='button' class='btn btn-danger' title='Desactivar Usuario' onclick='accionBtnActivar(\"activo\",".$pagina.",".$listarDeCuanto.",".$fi["cod_usuario"].")'><img src='../imagenes/drop.ico' height='17' width='17' class='rounded-circle'></button>";
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
        if($pagina>($adjacents+1)) {
          echo "<li class='page-item'><a href='javascript:void(0);' class='page-link' onclick=\"Buscar(1)\">1</a></li>";
        }
        if($pagina>($adjacents+2)) {
          echo"<li class='page-item'><a class='page-link'>...</a></li>";
        }
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

        if($pagina<($TotalPaginas-$adjacents-1)) {
          echo "<li class='page-item'><a class='page-link'>...</a></li>";
        }
        if($pagina<($TotalPaginas-$adjacents)) {
          echo "<li class='page-item'><a href='javascript:void(0);'class='page-link ' onclick=\"Buscar($TotalPaginas)\">$TotalPaginas</a></li>";
        }
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

  //funcion para seleccionar la visualizarConcentracion
  public function visualizarConcentracion(){
    $fa =new Farmacia();
    $listarDeCuanto = 5;$pagina = 1;$buscar = "";
    $resul1 = $fa->SeleccionarConcentracion(false,false,$buscar);
    $num_filas_total = mysqli_num_rows($resul1);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;
    // Verificar si la consulta devuelve resultados
    $resul = $fa->SeleccionarConcentracion($inicioList,$listarDeCuanto,$buscar);
    require("../vista/farmacia/farmaciaConcentracion.php");
  }

  public function BuscarConcentracion($pagina,$listarDeCuanto,$buscar){
    $fa =new Farmacia();
    $listarDeCuanto = $listarDeCuanto;$pagina = $pagina;$buscar = $buscar;
    $resul1 = $fa->SeleccionarConcentracion(false,false,$buscar);
    $num_filas_total = mysqli_num_rows($resul1);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;
    // Verificar si la consulta devuelve resultados
    $resul = $fa->SeleccionarConcentracion($inicioList,$listarDeCuanto,$buscar);
    echo "<div class='row'>
      <div class='col'>
        <div class='table-responsive'>
        <table class='table'>
          <thead style='font-size:12px'>
            <tr>
              <th>N°</th>
              <th>Concentración</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>";
      if (mysqli_num_rows($resul) > 0){
        $i = $inicioList;
        foreach ($resul as $fi){
            echo "<tr>";
              echo "<td>".($i+1)."</td>";
              echo "<td>".$fi['concentracion']."</td>";
              echo "<td>";
                echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>";
                echo "<button type='button' class='btn btn-info' title='Editar' onclick='ActualizarNombreGenerico(" . $fi['cod_conc'] . ", \"" .($fi['concentracion']) . "\")'  data-bs-toggle='modal' data-bs-target='#ModalRegistro'><img src='../imagenes/edit.ico' height='17' width='17' class='rounded-circle'></button>";
//echo "<button type='button' class='btn btn-danger' title='Desactivar Usuario' onclick='accionBtnActivar(\"activo\",".$pagina.",".$listarDeCuanto.",".$fi["cod_usuario"].")'><img src='../imagenes/drop.ico' height='17' width='17' class='rounded-circle'></button>";
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
      if($pagina>($adjacents+1)) {
        echo "<li class='page-item'><a href='javascript:void(0);' class='page-link' onclick=\"Buscar(1)\">1</a></li>";
      }
      if($pagina>($adjacents+2)) {
        echo"<li class='page-item'><a class='page-link'>...</a></li>";
      }
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

      if($pagina<($TotalPaginas-$adjacents-1)) {
        echo "<li class='page-item'><a class='page-link'>...</a></li>";
      }
      if($pagina<($TotalPaginas-$adjacents)) {
        echo "<li class='page-item'><a href='javascript:void(0);'class='page-link ' onclick=\"Buscar($TotalPaginas)\">$TotalPaginas</a></li>";
      }
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
  //funcion para seleccionar los nombres genericos todo
  public function visualizarNombreGenerico(){
    $fa =new Farmacia();
    $listarDeCuanto = 5;$pagina = 1;$buscar = "";
    $resul1 = $fa->SeleccionarNombreGenerico(false,false,$buscar);
    $num_filas_total = mysqli_num_rows($resul1);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;
    // Verificar si la consulta devuelve resultados
    $resul = $fa->SeleccionarNombreGenerico($inicioList,$listarDeCuanto,$buscar);
    require("../vista/farmacia/farmaciaNombreGenerico.php");
  }

  public function BuscarNombreGenerico($pagina,$listarDeCuanto,$buscar){
    $fa =new Farmacia();
    $listarDeCuanto = $listarDeCuanto;$pagina = $pagina;$buscar = $buscar;
    $resul1 = $fa->SeleccionarNombreGenerico(false,false,$buscar);
    $num_filas_total = mysqli_num_rows($resul1);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;
    // Verificar si la consulta devuelve resultados
    $resul = $fa->SeleccionarNombreGenerico($inicioList,$listarDeCuanto,$buscar);
    echo "<div class='row'>
      <div class='col'>
        <div class='table-responsive'>
        <table class='table'>
          <thead style='font-size:12px'>
            <tr>
              <th>N°</th>
              <th>Nombre generico</th>
              <th>Enfermedad</th>
              <th>Vitrina</th>
              <th>Stock minimo</th>
                <th>Stock maximo</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>";
      if (mysqli_num_rows($resul) > 0){
        $i = $inicioList;
        foreach ($resul as $fi){
            echo "<tr>";
              echo "<td>".($i+1)."</td>";
              echo "<td>".$fi['nombre']."</td>";
              echo "<td>".$fi['enfermedad']."</td>";
              echo "<td>".$fi['vitrina']."</td>";
              echo "<td>".$fi['stockmin']."</td>";
              echo "<td>".$fi['stockmax']."</td>";
              echo "<td>";
                echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>";
                echo "<button type='button' class='btn btn-info' title='Editar' onclick='ActualizarNombreGenerico(".$fi['cod_generico'].", \"".($fi['nombre'])."\",\"".($fi['enfermedad'])."\",\"".($fi['vitrina'])."\",\"".$fi['stockmin']."\",\"".$fi['stockmax']."\")' data-bs-toggle='modal' data-bs-target='#ModalRegistro'><img src='../imagenes/edit.ico' height='17' width='17' class='rounded-circle'></button>";
  //echo "<button type='button' class='btn btn-danger' title='Desactivar Usuario' onclick='accionBtnActivar(\"activo\",".$pagina.",".$listarDeCuanto.",".$fi["cod_usuario"].")'><img src='../imagenes/drop.ico' height='17' width='17' class='rounded-circle'></button>";
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
      if($pagina>($adjacents+1)) {
        echo "<li class='page-item'><a href='javascript:void(0);' class='page-link' onclick=\"Buscar(1)\">1</a></li>";
      }
      if($pagina>($adjacents+2)) {
        echo"<li class='page-item'><a class='page-link'>...</a></li>";
      }
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

      if($pagina<($TotalPaginas-$adjacents-1)) {
        echo "<li class='page-item'><a class='page-link'>...</a></li>";
      }
      if($pagina<($TotalPaginas-$adjacents)) {
        echo "<li class='page-item'><a href='javascript:void(0);'class='page-link ' onclick=\"Buscar($TotalPaginas)\">$TotalPaginas</a></li>";
      }
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

  public function registrarNombreGenerico($generico,$cod_generico,$enfermedad,$vitrina,$stockmin,$stockmax){
    $fa =new Farmacia();
    $resul = $fa->InsertarActualizarNombreGenerico($generico,$cod_generico,$enfermedad,$vitrina,$stockmin,$stockmax);
    if($resul != ""){
        echo "correcto";
    } else{
        echo "error";
    }
  }
  public function registrarConcentracion($generico,$cod_generico){
    $fa =new Farmacia();
    $resul = $fa->InsertarActualizarConcentracion($generico,$cod_generico);
    if($resul != ""){
        echo "correcto";
    } else{
        echo "error";
    }
  }
  public function registrarPresentacion($generico,$cod_generico){
    $fa =new Farmacia();
    $resul = $fa->InsertarActualizarPresentacion($generico,$cod_generico);
    if($resul != ""){
        echo "correcto";
    } else{
        echo "error";
    }
  }

  public function visualizarProductoFarmacia(){
    $fa =new Farmacia();
    $listarDeCuanto = 5;$pagina = 1;$buscar = "";
    $resul1 = $fa->SeleccionarProducto(false,false,$buscar);
    $num_filas_total = mysqli_num_rows($resul1);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;
    // Verificar si la consulta devuelve resultados
    $resul = $fa->SeleccionarProducto($inicioList,$listarDeCuanto,$buscar);
    //$resul = $this->Uniendo($res,$fa);*/
    //$r = $fa->p();
    //$ret = $this->Uniendo($resul,$fa);
    $rng=$fa->seleccionarNG();
    $rc=$fa->seleccionarC();
    $rp=$fa->seleccionarP();
    require("../vista/farmacia/farmaciaProducto.php");
  }

 function Uniendo($resul, $rdi) {
    $ar = [];
    while ($fi = mysqli_fetch_array($resul)) {
        // Añadir cada fila al array con una estructura correcta
        $entry = [
            "cod_producto" => $fi["cod_producto"],
            "codigo" => $fi["codigo"],
            "cod_generico" => $fi["cod_generico"],
            "cod_forma" => $fi["cod_forma"],
            "cod_conc" => $fi["cod_conc"],
            "enfermedad" => $fi["enfermedad"],
            "estado" => $fi["estado"],
            "cod_generico" => $fi["cod_generico"],
            "nombre" => $fi["nombre"],
            "estado" => $fi["estado"],
            "cod_forma" => $fi["cod_forma"],
            "nombre_forma" => $fi["nombre_forma"],
            "estado" => $fi["estado"],
            "cod_conc" => $fi["cod_conc"],
            "concentracion" => $fi["concentracion"],
            "estado" => $fi["estado"],
        ];
        $ar[] = $entry; // Agregar la entrada al array principal
    }
    return $ar; // Devolver el array completo fuera del bucle
  }


}

  $f = new FarmaciaControlador();
  if(isset($_GET["accion"]) && $_GET["accion"]=="ngf"){
		$f->visualizarNombreGenerico();
	}
  if(isset($_GET["accion"]) && $_GET["accion"]=="bngt"){
		$f->BuscarNombreGenerico($_POST["pagina"],$_POST["listarDeCuanto"],$_POST["buscar"]);
	}
  if(isset($_GET["accion"]) && $_GET["accion"]=="rfnt"){
    $f->registrarNombreGenerico($_POST["generico"],$_POST["cod_generico"],$_POST['enfermedad'],$_POST['vitrina'],$_POST['stockmin'],$_POST['stockmax']);
  }
  if(isset($_GET["accion"]) && $_GET["accion"]=="vtf"){
		$f->visualizarConcentracion();
	}
  if(isset($_GET["accion"]) && $_GET["accion"]=="bct"){
    $f->BuscarConcentracion($_POST["pagina"],$_POST["listarDeCuanto"],$_POST["buscar"]);
  }
  if(isset($_GET["accion"]) && $_GET["accion"]=="rfc"){
    $f->registrarConcentracion($_POST["generico"],$_POST["cod_generico"]);
  }

  if(isset($_GET["accion"]) && $_GET["accion"]=="vfp"){
		$f->visualizarPresentacion();
	}
  if(isset($_GET["accion"]) && $_GET["accion"]=="bpt"){
		$f->BuscarPresentacion($_POST["pagina"],$_POST["listarDeCuanto"],$_POST["buscar"]);
	}
  if(isset($_GET["accion"]) && $_GET["accion"]=="rp"){
    $f->registrarPresentacion($_POST["generico"],$_POST["cod_generico"]);
  }
  if(isset($_GET["accion"]) && $_GET["accion"]=="vpf"){
		$f->visualizarProductoFarmacia();
	}

?>
