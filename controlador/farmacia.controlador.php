<?php
require_once '../modelo/farmacia.php';
require_once '../modelo/usuario.php';
require "sesion.controlador.php";
$ins=new sesionControlador();
$ins->StarSession();
if(isset($_SESSION["tipo_usuario"])==""){
    $ins->Redireccionar_inicio();
}
date_default_timezone_set('America/La_Paz');
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
    $rp=$fa->seleccionarP();
    $rc=$fa->seleccionarC();
    //$resul = $this->Uniendo($resul,$fa);
    require("../vista/farmacia/farmaciaNombreGenerico.php");
  }

   function Uniendo($resul, $rdi) {
      $ar = [];
      while ($fi = mysqli_fetch_array($resul)) {
          // Añadir cada fila al array con una estructura correcta
          $entry = [
              "cod_generico" => $fi["cod_generico"],
              "codigo" => $fi["codigo"],
              "nombre" => $fi["nombre"],
              "enfermedad" => $fi["enfermedad"],
              "vitrina" => $fi["vitrina"],
              "stockmin" => $fi["stockmin"],
              "stockmin" => $fi["stockmin"],
              "cod_forma" => $fi["cod_forma"],
              "cod_conc" => $fi["cod_conc"],
              "concentracion" => $fi["concentracion"],
              "estado" => $fi["estado"],
          ];
          $ar[] = $entry; // Agregar la entrada al array principal
      }
      return $ar; // Devolver el array completo fuera del bucle
    }

     function Uniendo789($resul, $rdi) {
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

  public function BuscarNombreGenerico($pagina,$listarDeCuanto,$buscar){
    $fa =new Farmacia();
    $listarDeCuanto = $listarDeCuanto;$pagina = $pagina;$buscar = $buscar;
    $resul1 = $fa->SeleccionarNombreGenerico(false,false,$buscar);

    if(is_string($resul1)){
      echo "<h6>Ocurrio un error, $resul1</h6>";
    }else{
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
              <th>Codigo</th>
              <th>Nombre generico</th>
              <th>Forma de presentación</th>
              <th>Concentración unidad de medida</th>
              <th>Enfermedad</th>
              <th>Vitrina</th>
              <th>Stock minimo</th>
              <th>Stock</th>
              <th>Estado</th>
              <th>Encargado</th>
              <th>Acción</th>
            </tr>
          </thead>
      <tbody>";
      if (mysqli_num_rows($resul) > 0){
        $i = $inicioList;
        foreach ($resul as $fi){
            echo "<tr>";
            echo "<td>".($i+1)."</td>";
            echo "<td>".$fi['codigo']."</td>";
            echo "<td>".$fi['nombre']."</td>";
            echo "<td>".$fi['nombre_forma']."</td>";
            echo "<td>".$fi['concentracion']."</td>";
            echo "<td>".$fi['enfermedad']."</td>";
            echo "<td>".$fi['vitrina']."</td>";
            echo "<td>".$fi['stockmin']."</td>";
            echo "<td>".$fi['cantidad_total']."</td>";
            if($fi['stock_producto'] == 'si'){
              echo "<td style='background-color:#ffafaf;color:red;text-align:center;font-size:13px'>Stock bajo</td>";
            }else{
              echo "<td style='background-color:#bfffaf;color:green;text-align:center;font-size:13px'>Stock Adecuado</td>";
            }
            echo "<td>".$fi['nombre_usuario']." ".$fi['ap_usuario']."</td>";
            echo "<td>";
              echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>";
              $dd = "<button type='button' class='btn btn-info' title='Editar' onclick='ActualizarNombreGenerico(".$fi['cod_generico'].", \"".($fi['nombre'])."\",\"".($fi['enfermedad'])."\",\"".($fi['vitrina'])."\",\"".$fi['stockmin']."\",\"".$fi['stockmax']."\",";
              $dd.="\"".$fi['cod_forma']."\",\"".$fi['cod_conc']."\")' data-bs-toggle='modal' data-bs-target='#ModalRegistro'><img src='../imagenes/edit.ico' height='17' width='17' class='rounded-circle'></button>";
              echo $dd;
              if($fi["estado"] == "activo"){
                echo "<button type='button' class='btn btn-danger' title='Desactivar' onclick='accionBtnActivar(\"activo\",".$pagina.",".$listarDeCuanto.",\"".$buscar."\",".$fi['cod_generico'].")'><img src='../imagenes/drop.ico' height='17' width='17' class='rounded-circle'></button>";
              }else{
                echo "<button type='button' class='btn' style='background-color:#f1948a' title='Activar' onclick='accionBtnActivar(\"desactivo\",".$pagina.",".$listarDeCuanto.",\"".$buscar."\",".$fi['cod_generico'].")'><img src='../imagenes/activar.ico' height='17' width='17' class='rounded-circle'></button>";
             }
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

  }

  public function registrarNombreGenerico($generico,$cod_generico,$enfermedad,$vitrina,$stockmin,$stockmax,$cod_forma,$cod_conc,$codigo){
    $fa =new Farmacia();
    $usuario=$_SESSION["cod_usuario"];
    $resul = $fa->InsertarActualizarNombreGenerico($generico,$cod_generico,$enfermedad,$vitrina,$stockmin,$stockmax,$cod_forma,$cod_conc,$usuario,$codigo);
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
    $listarDeCuanto = 5;$pagina = 1;$buscar = "";$fechai=false;$fechaf=false;$estadoProducto=false;
    $resul1 = $fa->SeleccionarProducto(false,false,$buscar,false,false,false);
    $num_filas_total = mysqli_num_rows($resul1);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;
    // Verificar si la consulta devuelve resultados
    $res = $fa->SeleccionarProducto($inicioList,$listarDeCuanto,$buscar,false,false,false);
    //$resul = $this->Uniendo($res,$fa);*/
    //$r = $fa->p();
    $resul = $this->UniendoProducto($res,$fa);
    $rng=$fa->seleccionarNG();
    $rc=$fa->seleccionarC();
    $rp=$fa->seleccionarP();
    require("../vista/farmacia/farmaciaProducto.php");
  }

  function UniendoProducto($resul, $fa){
    $ar = [];
    if(($resul)!=''){
      while ($fi = mysqli_fetch_array($resul)) {
      // Añadir cada fila al array con una estructura correcta
          $entry = [
              "cod_entrada" => $fi["cod_entrada"],
              "cantidad" => $fi["cantidad"],
              "vencimiento" => $fi["vencimiento"],
              "fecha" => $fi["fecha"],
              "manipulado" => $fi["manipulado"],
              "cod_generico" => $fi["cod_generico"],
              "estado_producto" => $fi["estado_producto"],
                "codigo" => $fi["codigo"],
                "nombre" => $fi["nombre"],
                "cod_forma" => $fi["cod_forma"],
                "cod_usuario"=>$fi["cod_usuario"],
                "nombre_usuario"=>$fi["nombre_usuario"],
                "ap_usuario"=>$fi["ap_usuario"],
                "am_usuario"=>$fi["am_usuario"],
                "nombre_forma" => $fa->seleccionarPID($fi['cod_forma']),
                "cod_conc" => $fi["cod_conc"],
                "concentracion" => $fa->seleccionarCID($fi['cod_conc']),
                "estado" => $fi["estado"],
              ];
              $ar[] = $entry; // Agregar la entrada al array principal
          }

        }
        return $ar; // Devolver el array completo fuera del bucle
      }

    public function insertarDatosEntrada($cod_producto,$cantidad,$vencimiento,$cod_entrada){
      $fechaActual = date('Y-m-d');
      $hora = date('H:i:s');
      $fa =new Farmacia();
      $usuario=$_SESSION["cod_usuario"];

      $resul=$fa->InsertEntradaProducto($cantidad,$vencimiento,$fechaActual,$cod_producto,$cod_entrada,$usuario,$hora);
      $this->ActualizarCantidadEnentrada($fechaActual,$fa);
      echo $resul;
    }
    public function visualizarBusquedaFarmacia($pagina,$listarDeCuanto,$buscar,$fechai,$fechaf,$estadoProducto){
      $fa =new Farmacia();
      $listarDeCuanto = $listarDeCuanto;$pagina = $pagina;$buscar = $buscar;$fechai=$fechai;$fechaf=$fechaf;$estadoProducto=$estadoProducto;
      if($fechai!=''&&$fechaf==''){
        $fechaf=$fechai;
      }else if($fechai==''&&$fechaf!=''){
        $fechai=$fechaf;
      }
      if($fechai>$fechaf){
        $aux=$fechai;
        $fechai=$fechaf;
        $fechaf=$aux;
      }

      $resul1 = $fa->SeleccionarProducto(false,false,$buscar,$fechai,$fechaf,false);
      if(is_string($resul1)){
        echo "<h6>Ocurrio un error, $resul1</h6>";
      }else{
      $num_filas_total = mysqli_num_rows($resul1);
      $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
              //calculamos el registro inicial
      $inicioList = ($pagina - 1) * $listarDeCuanto;
      // Verificar si la consulta devuelve resultados
      $res = $fa->SeleccionarProducto($inicioList,$listarDeCuanto,$buscar,$fechai,$fechaf,$estadoProducto);
      //$resul = $this->Uniendo($res,$fa);*/
      //$r = $fa->p();
      $resul = $this->UniendoProducto($res,$fa);
      $rng=$fa->seleccionarNG();
      $rc=$fa->seleccionarC();
      $rp=$fa->seleccionarP();
      echo "<div class='row'>
        <div class='col'>
          <div class='table-responsive'>
          <table class='table'>
            <thead style='font-size:12px'>
              <tr>
                <th>N°</th>
                <th>Codigo</th>
                <th>Nombre Generico</th>
                <th>Forma presentación</th>
                <th>Concentración unidad medida</th>
                <th>Cantidad</th>
                <th>vencimiento</th>
                <th>Fecha</th>
                <th>Estado producto</th>
                <th>Encargado</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody>";
        if ($resul && count($resul) > 0) {
          $i = $inicioList;
          foreach ($resul as $fi){
              echo "<tr>";
                echo "<td>".($i+1)."</td>";
                echo "<td>".$fi['codigo']."</td>";
                echo "<td>".$fi['nombre']."</td>";

                $forma = $fi['nombre_forma'];
                $formaa = "";
                echo "<td>";
                foreach ($forma as $form) {
                  echo $form["nombre_forma"];
                  $formaa=$form["nombre_forma"];
                }
                echo "</td>";
                $concentracion = $fi['concentracion'];
                $concentra="";
                echo "<td>";
                foreach ($concentracion as $conc) {
                  echo $conc["concentracion"];
                  $concentra=$conc["concentracion"];
                }
                echo "</td>";

                echo "<td>".$fi['cantidad']."</td>";
                echo "<td>".$fi['vencimiento']."</td>";
                echo "<td>".$fi['fecha']."</td>";

                if($fi['estado_producto'] == 'activo'){
                  echo "<td style='color:green;background-color:#dbffaf;text-align:center'>".$fi['estado_producto']."</td>";
                }else if($fi['estado_producto'] == 'vencido'){
                  echo "<td style='color:red;background-color:#ffc8af;text-align:center'>".$fi['estado_producto']."</td>";
                }
                echo "<td>".$fi['nombre_usuario']." ".$fi["ap_usuario"]."</td>";

                $unir = $fi['nombre']." ".$formaa." ".$concentra;
                $enable = '';$title='Editar';
                if($fi['estado_producto']=='vencido'){
                    $enable='disabled';
                    $title='El producto esta vencido';
                }
                if($fi['manipulado'] == 'si'){
                  $enable = 'disabled';
                  $title='El producto ya se uso';
                }
                echo "<td>";
                  echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>";
                  echo "<button type='button' class='btn btn-info' title='$title' onclick='ActualizarEntrada(".$fi['cod_entrada'].",".$fi['cantidad'].",\"".$fi['vencimiento']."\",".$fi['cod_generico'].",\"".$unir."\")' data-bs-toggle='modal' data-bs-target='#ModalRegistro' $enable><img src='../imagenes/edit.ico' height='17' width='17' class='rounded-circle'></button>";
                  if($fi["estado"] == "activo"){
                    echo "<button type='button' class='btn btn-danger' title='Desactivar' onclick='accionBtnActivar(\"activo\",".$pagina.",".$listarDeCuanto.",\"".$buscar."\",".$fi['cod_entrada'].",\"".$fechai."\",\"".$fechaf."\")'><img src='../imagenes/drop.ico' height='17' width='17' class='rounded-circle'></button>";
                  }else{
                    echo "<button type='button' class='btn' style='background-color:#f1948a' title='Activar' onclick='accionBtnActivar(\"desactivo\",".$pagina.",".$listarDeCuanto.",\"".$buscar."\",".$fi['cod_entrada'].",\"".$fechai."\",\"".$fechaf."\")'><img src='../imagenes/activar.ico' height='17' width='17' class='rounded-circle'></button>";
                  }
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

    public function buscarProductoFarmaceutico($nombre_producto){
      $fa =new Farmacia();
      $re = $fa->buscarProductoFar($nombre_producto);
      $datos = array();
      if ($re->num_rows > 0) {
     // Recoger los resultados en un array
       while($row = $re->fetch_assoc()) {
        $datos[] = $row;
      }
          echo json_encode($datos);
      } else {
          echo json_encode([]);
      }
    }

    public function buscarPacienteFarmacia($nombre_paciente){
      $fa =new Farmacia();
      $re = $fa->buscarPacienteFar($nombre_paciente);
      $datos = array();
      if ($re->num_rows > 0) {
     // Recoger los resultados en un array
       while($row = $re->fetch_assoc()) {
        $datos[] = $row;
      }
          echo json_encode($datos);
      } else {
          echo json_encode([]);
      }
    }
    public function VisualizarSalidaFarmacia(){
      $fa =new Farmacia();
      $listarDeCuanto = 5;$pagina = 1;$buscar = "";
      $resul1 = $fa->SeleccionarSalida(false,false,$buscar,false,false);
      $num_filas_total = mysqli_num_rows($resul1);
      $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
              //calculamos el registro inicial
      $inicioList = ($pagina - 1) * $listarDeCuanto;
      // Verificar si la consulta devuelve resultados
      $res = $fa->SeleccionarSalida($inicioList,$listarDeCuanto,$buscar,false,false);
      //$resul = $this->Uniendo($res,$fa);*/
      //$r = $fa->p();
      $resul = $this->UniendoSalida($res,$fa);
      $rng=$fa->seleccionarNG();
      $rc=$fa->seleccionarC();
      $rp=$fa->seleccionarP();
      require("../vista/farmacia/farmaciaSalida.php");
    }

    public function VisualizarSalidaFarmaciaTabla($pagina,$listarDeCuanto,$buscar,$fechai,$fechaf){
      $fa =new Farmacia();
      $listarDeCuanto = $listarDeCuanto;$pagina = $pagina;$buscar = $buscar;$fechai=$fechai;$fechaf=$fechaf;
      if($fechai =='' or $fechaf == '')
      {
        $fechai=false;$fechaf=false;
      }else{
        if($fechai!=''&&$fechaf==''){
          $fechaf=$fechai;
        }else if($fechai==''&&$fechaf!=''){
          $fechai=$fechaf;
        }
        if($fechai>$fechaf){
          $aux=$fechai;
          $fechai=$fechaf;
          $fechaf=$aux;
        }
      }
      $resul1 = $fa->SeleccionarSalida(false,false,$buscar,$fechai,$fechaf);
      if(is_string($resul1)){
        echo "<h6>Ocurrio un error, $resul1</h6>";
      }else{
        $num_filas_total = mysqli_num_rows($resul1);
        $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
                //calculamos el registro inicial
        $inicioList = ($pagina - 1) * $listarDeCuanto;
        // Verificar si la consulta devuelve resultados
        $res = $fa->SeleccionarSalida($inicioList,$listarDeCuanto,$buscar,$fechai,$fechaf);
        //$resul = $this->Uniendo($res,$fa);*/
        //$r = $fa->p();
        $resul = $this->UniendoSalida($res,$fa);
        echo "<div class='row'>
          <div class='col'>
            <div class='table-responsive'>
            <table class='table'>
              <thead style='font-size:12px'>
                <tr>
                  <th>N°</th>
                  <th>Codigo</th>
                  <th>Nombre Generico</th>
                  <th>Paciente</th>
                  <th>Encargado Farmacia</th>
                  <th>Cantidad Obtenida</th>
                  <th>Fecha</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>";
          if ($resul && count($resul) > 0) {
            $i = $inicioList;
            foreach ($resul as $fi){
                echo "<tr>";
                  echo "<td>".($i+1)."</td>";
                  echo "<td>".$fi['codigo']."</td>";
                  echo "<td>".$fi['nombre']."</td>";

                  $paciente = $fi['cod_paciente'];
                  $cod_paciente = '';
                  echo "<td>";
                  foreach ($paciente as $form) {
                    $datos_paciente = $form["nombre_usuario"]." ".$form["ap_usuario"]." ".$form["am_usuario"];
                    echo $form["nombre_usuario"]." ".$form["ap_usuario"]." ".$form["am_usuario"];
                    $cod_paciente=$form["cod_usuario"];
                  }
                  echo "</td>";
                  $Encargado = $fi['cod_usuario'];
                  $cod_usuario = "";
                  echo "<td>";
                  foreach ($Encargado as $conc) {
                    echo $conc["nombre_usuario"]." ".$conc["ap_usuario"]." ".$conc["am_usuario"];
                    $cod_usuario =$conc['cod_usuario'];
                  }
                  echo "</td>";

                  echo "<td>".$fi['cantidad_salida']."</td>";
                  echo "<td>".$fi['fecha']."</td>";

                  echo "<td>";
                    echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>";
                  //echo $fi['cod_salida'].",".$fi['cantidad_salida'].",".$datos_paciente.",".$fi['nombre'].",".$fi["cantidad_total"].",".$cod_paciente.",".$fi['cod_generico'];
                    echo "<button type='button' class='btn btn-info' title='Editar' onclick='ActualizarSalida(".$fi['cod_salida'].",".$fi['cantidad_salida'].",\"".$datos_paciente."\",\"".$fi['nombre']."\",".$fi["cantidad_total"].",".$cod_paciente.",".$fi['cod_generico'].")' data-bs-toggle='modal' data-bs-target='#ModalRegistro'><img src='../imagenes/edit.ico' height='17' width='17' class='rounded-circle'></button>";
                    echo "<button type='button' class='btn btn-danger' title='Eliminar' onclick='eliminar(".$fi['cod_salida'].")'><img src='../imagenes/drop.ico' height='17' width='17' class='rounded-circle'></button>";
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
            echo "
            </tbody>
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

      function UniendoSalida($resul, $fa){
        $ar = [];
        $u = new Usuario();
        if($resul !=""){
          while ($fi = mysqli_fetch_array($resul)) {
          // Añadir cada fila al array con una estructura correcta
           $entry = [
                  "cod_salida" => $fi["cod_salidad"],
                  "cantidad_salida" => $fi["cantidad_salida"],
                  "cod_generico" => $fi["cod_generico"],
                  "cod_paciente" => $u->selectDatosUsuario($fi["cod_paciente"]),
                  "cod_usuario" => $u->selectDatosUsuario($fi["cod_usuario"]),
                  "fecha" => $fi["fecha"],
                  "estado" => $fi["estado"],
                  "codigo" => $fi["codigo"],
                    "nombre" => $fi["nombre"],
                    "enfermedad" => $fi["enfermedad"],
                    "vitrina" => $fi["vitrina"],
                    "stockmin" => $fi["stockmin"],
                    "stockmax" => $fi["stockmax"],
                    "cod_forma" => $fi["cod_forma"],
                    "stock_producto"=> $fi['stock_producto'],
                    "cantidad_total"=>$fi["cantidad_total"],
                  ];
                  $ar[] = $entry; // Agregar la entrada al array principal
              }

            }
            return $ar; // Devolver el array completo fuera del bucle
          }
    public function EliminarNG($accion,$pagina,$listarDeCuanto,$buscar,$cod_generico){
      $fa =new Farmacia();
      $resul=$fa->UpdateNG($accion,$cod_generico);
      if($resul!=''){
        $this->BuscarNombreGenerico($pagina,$listarDeCuanto,$buscar);
      }else{
        echo "error";
      }
    }

    public function EliminarEF($accion,$pagina,$listarDeCuanto,$buscar,$cod_entrada,$fechai,$fechaf,$estadoProducto){
      $fa =new Farmacia();
      $resul=$fa->UpdateEF($accion,$cod_entrada);
      if($resul=='ya_se_uso'){
        echo "ya_se_uso";
      }else{
        if($resul=='correcto'){
          $this->visualizarBusquedaFarmacia($pagina,$listarDeCuanto,$buscar,$fechai,$fechaf,$estadoProducto);
        }else{
          echo "error";
        }
      }
    }

   public function InsertarActualizarSalida($cod_producto,$cantidad,$cod_salida,$id_paciente){
     $fa =new Farmacia();
     $fechaActual = date('Y-m-d');
     $hora = date('H:i:s');
     $cc=0;
     //echo "cod_salida  ".$cod_salida;
     if(is_numeric($cod_salida)){//si existe el cod_salida esta queriendo editar
       $cc = $fa->actualizar_datos_entrada($cod_salida);
       if($cc==0){
         $re = $fa->seleccionarCantEntrada($cod_salida);
         $codigos = $re[0];
         $cantiEntra = $re[1];
         $fa->SumasActualizar($codigos,$cantiEntra);
       }
     }
     if($cc == 0){
       $resultado = $fa->entradaTodo($fechaActual,$cod_producto);//seleccionar todas las entradas pero desde una fecha y de un producto
       $retorno = $this->disminuir_stock($resultado,$fa,$cantidad);//funcion para dsminuir la cantidad
       $codigos = $retorno[0];//codigos separado por comas
       $cat_res = $retorno[1];//cantidades restado separado por comas
       $this->ActualizarEntradas($fechaActual,$fa);//funcion para actualizar el vencimiento
       $this->ActualizarCantidadEnentrada($fechaActual,$fa);//funcion para actualizar la cantidad total en producto
       $usuario=$_SESSION["cod_usuario"];

       $resul=$fa->insertarNuevoRegistroSalida($cod_producto,$cantidad,$cod_salida,$id_paciente,$codigos,$usuario,$fechaActual,$cat_res,$hora);
       if($resul!=''){
         echo "correcto";
       }else{
         echo "error";
       }
     }else{
       echo "fecha_vencido";
     }
   }

   function disminuir_stock($r, $f, $cantidad) {
     // Inicializamos arrays para almacenar los códigos y las cantidades restantes
     $codigos = array();
     $cant_resta = array();

     while ($fila = mysqli_fetch_array($r)) {
         $cantidad_entrada = $fila["cantidad"];
         $cod_entrada = $fila["cod_entrada"];
         $resul = 0;
         $cat = 0;
         //echo $cantidad_entrada." ddd ".$cantidad."<br>";
         if ($cantidad_entrada != 0) {
             if ($cantidad_entrada > $cantidad) {
                 $resul = $cantidad_entrada - $cantidad;
                 $cat = $cantidad;
                 $cantidad = 0;
             } else if ($cantidad_entrada < $cantidad) {//30  80 se requiere
                 $resta = $cantidad - $cantidad_entrada;//50=80-30
                 $res2 = $cantidad - $resta;//80-50=30
                 $resul = $cantidad_entrada - $res2;//30-30=0
                 $cat = $res2;
                $cantidad = $resta;
             } else {
                 $resul = 0;
                 $cat = $cantidad;
                 $cantidad = 0;
             }

              // Agregamos el código y la cantidad restante a los arrays
              $codigos[] = $cod_entrada;
              $cant_resta[] = $cat;
              //echo "resul = ".$resul." === ".$fila['cod_entrada']."<br>";
              // Llamada a función para actualizar la cantidad
              $this->actualizar_Cantidad($resul, $fila['cod_entrada'], $f);

             if ($cantidad <= 0) {
                 break;
             }

        }
     }
     // Convertimos los arrays a cadenas separadas por comas
     $codigos = implode(",", $codigos);
     $cant_resta = implode(",", $cant_resta);
     // Devolvemos los resultados
     return array($codigos, $cant_resta);
   }


    function actualizar_Cantidad($nueva_cantidad,$cod_entrada,$f){
      $f->actualizarCantidad($nueva_cantidad,$cod_entrada);
    }
    function ActualizarEntradas($fechaActual,$f){
      $da=$f->seleccionarEntradas();
      $fecha1_time = strtotime($fechaActual);
      while($fi=mysqli_fetch_array($da)){
        $fechaVencimiento = $fi['vencimiento'];
        $fecha2_time = strtotime($fechaVencimiento);
        if($fecha1_time>=$fecha2_time){
        //  echo $fecha1_time.">=".$fecha2_time." vencido";
          $f->ProductoVencido($fi['cod_entrada']);
        }
      }
    }

    function ActualizarCantidadEnentrada($fechaActual,$f){
      $da=$f->SeleccionarProductosTodo();
      $new = array();
      while($fila = mysqli_fetch_array($da)){
        $new[$fila["cod_generico"]]=array("total" => 0);
      }
      $da1=$f->seleccionarEntradas();
      $fecha2_time = strtotime($fechaActual);
      while($fi=mysqli_fetch_array($da1)){
        $fecha1_time = strtotime($fi['vencimiento']);
        if($fecha1_time>$fecha2_time){
          $new[$fi["cod_generico"]]["total"]=$new[$fi["cod_generico"]]["total"]+$fi['cantidad'];
          //echo "aaaa".$new[$fi["cod_generico"]]["total"]."<br>";
        }
      }

    	$da2=$f->SeleccionarProductosTodo();
      while($fil = mysqli_fetch_array($da2)){
        $sql = '';
        if($new[$fil['cod_generico']]['total']<=$fil["stockmin"]){
            $f->actualizarCantidadNuevo('si',$new[$fil['cod_generico']]['total'],$fil["cod_generico"]);
        }else{
            $f->actualizarCantidadNuevo('no',$new[$fil['cod_generico']]['total'],$fil["cod_generico"]);
        }
      }
    }

    public function EliminarSalida($cod_salida,$pagina,$listarDeCuanto,$buscar,$fechai,$fechaf){
      $fa =new Farmacia();
      $cc=0;$fechaActual = date('Y-m-d');
      if(is_numeric($cod_salida)){//si existe el cod_salida esta queriendo editar
        $cc = $fa->actualizar_datos_entrada($cod_salida);//slo verificamos si esta vencido o no
      }
      if($cc == 0){//no esta vencido el producto se puede eliminar
        $re = $fa->seleccionarCantEntrada($cod_salida);
        $codigos = $re[0];
        $cantiEntra = $re[1];
        $fa->SumasActualizar($codigos,$cantiEntra);
        $this->ActualizarEntradas($fechaActual,$fa);//funcion para actualizar el vencimiento
        $this->ActualizarCantidadEnentrada($fechaActual,$fa);//funcion para actualizar la cantidad total en producto
        $resul = $fa->eliminarRegistro($cod_salida);
        //$resul = 'correcto';
        if($resul!=''){
          $this->VisualizarSalidaFarmaciaTabla($pagina,$listarDeCuanto,$buscar,$fechai,$fechaf);
        }else{
          echo "error";
        }
      }else{//producto vencido no se puede eliminar
          echo "fecha_vencido";
      }
    }

    function ReporteConcentracionUnidadMedida($buscar){
      $fa =new Farmacia();
      $fechaActual = date('Y-m-d');
      $resul = $fa->SeleccionarConcentracion('','',$buscar);
      require("../vista/farmacia/ReporteConcetracion.php");
    }

    function ReportePresentacion($buscar){
      $fa =new Farmacia();
      $fechaActual = date('Y-m-d');
      $resul = $fa->SeleccionarPresentacion('','',$buscar);
      require("../vista/farmacia/ReportePresentacion.php");
    }

    function ReporteNombreGenerico($buscar){
      $fa =new Farmacia();
      $fechaActual = date('Y-m-d');
      $resul = $fa->SeleccionarNombreGenerico('','',$buscar);
      require("../vista/farmacia/ReporteNombreGenerico.php");
    }

    function ReporteProductoEntrada($buscar,$fechai,$fechaf,$estadoProducto){
      $fa =new Farmacia();
      $fechaActual = date('Y-m-d');
      if($fechai==''&&$fechaf==''){
        $fechai=$fechaActual;$fechaf=$fechaActual;
      }else{
        if($fechai!=''&&$fechaf==''){
          $fechaf=$fechai;
        }else if($fechai==''&&$fechaf!=''){
          $fechai=$fechaf;
        }
        if($fechai>$fechaf){
          $aux=$fechai;
          $fechai=$fechaf;
          $fechaf=$aux;
        }
      }

      $res = $fa->SeleccionarProducto('','',$buscar,$fechai,$fechaf,$estadoProducto);
      $resul = $this->UniendoProducto($res,$fa);
      
      require("../vista/farmacia/ReporteEntrada.php");
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
    $f->registrarNombreGenerico($_POST["generico"],$_POST["cod_generico"],$_POST['enfermedad'],$_POST['vitrina'],$_POST['stockmin'],$_POST['stockmax'],$_POST['cod_forma'],$_POST['cod_conc'],$_POST['codigo']);
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
  if(isset($_GET["accion"]) && $_GET["accion"]=="rpe"){
    $f->insertarDatosEntrada($_POST["cod_producto"],$_POST["cantidad"],$_POST["vencimiento"],$_POST['cod_entrada']);
	}

  if(isset($_GET["accion"]) && $_GET["accion"]=="bft"){
		$f->visualizarBusquedaFarmacia($_POST["pagina"],$_POST["listarDeCuanto"],$_POST["buscar"],$_POST['fechai'],$_POST['fechaf'],$_POST['estadoProducto']);
	}
  if(isset($_GET["accion"]) && $_GET["accion"]=="bcp"){
		$f->buscarProductoFarmaceutico($_POST['cod_producto']);
	}
  if(isset($_GET["accion"]) && $_GET['accion']=='vsf'){
    $f->VisualizarSalidaFarmacia();
	}
  if(isset($_GET["accion"]) && $_GET['accion']=='dNg'){
    $f->EliminarNG($_POST["accion"],$_POST["pagina"],$_POST["listarDeCuanto"],$_POST["buscar"],$_POST["cod_generico"]);
	}

  if(isset($_GET["accion"]) && $_GET['accion']=='dbe'){
    $f->EliminarEF($_POST["accion"],$_POST["pagina"],$_POST["listarDeCuanto"],$_POST["buscar"],$_POST["cod_entrada"],$_POST["fechai"],$_POST["fechaf"],$_POST['estadoProducto']);
	}
  if(isset($_GET["accion"]) && $_GET['accion']=='resf'){
    $f->InsertarActualizarSalida($_POST["cod_producto"],$_POST["cantidad"],$_POST["cod_salida"],$_POST["id_paciente"]);
  }

  if(isset($_GET["accion"]) && $_GET["accion"]=="buf"){
		$f->buscarPacienteFarmacia($_POST['cod_paciente']);
	}
  if(isset($_GET["accion"]) && $_GET["accion"]=="efs"){
		$f->EliminarSalida($_POST['cod_salida'],$_POST["pagina"],$_POST["listarDeCuanto"],$_POST["buscar"],$_POST['fechai'],$_POST['fechaf']);
	}
  if(isset($_GET["accion"]) && $_GET["accion"]=="vsta"){
		$f->VisualizarSalidaFarmaciaTabla($_POST["pagina"],$_POST["listarDeCuanto"],$_POST["buscar"],$_POST['fechai'],$_POST['fechaf']);
	}
  if(isset($_GET["accion"]) && $_GET["accion"]=="rcu"){
  	$f->ReporteConcentracionUnidadMedida($_POST['buscar']);
  }
  if(isset($_GET["accion"]) && $_GET["accion"]=="rpr"){
  	$f->ReportePresentacion($_POST['buscar']);
  }
  if(isset($_GET["accion"]) && $_GET["accion"]=="rpg"){
    $f->ReporteNombreGenerico($_POST['buscar']);
  }
  if(isset($_GET["accion"]) && $_GET["accion"]=="rpng"){
    $f->ReporteProductoEntrada($_POST['buscar'],$_POST["fechai"],$_POST["fechaf"],$_POST["estadoProducto"]);
  }
?>
