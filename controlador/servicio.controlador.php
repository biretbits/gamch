<?php
require_once '../modelo/servicio.php';
require_once '../modelo/registroDiario.php';
require "sesion.controlador.php";
$ins=new sesionControlador();
$ins->StarSession();
/**
 *
 */
class ServicioControlador
{
  public function registroServicio($cod_servicio,$servicio,$descripcion){
    $s=new Servicio();
    $re = $s->insertarServicio($cod_servicio,$servicio,$descripcion);
    if($re != ""){
      echo "correcto";
    }else{
      echo "error";
    }
  }
  public function VerServicios(){
    $s=new Servicio();
    $listarDeCuanto = 5;$pagina = 1;$buscar = "";$fecha = date('Y-m-d');
    $resultodoUsuarios = $s->Selecionar_servicios_buscar('',false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;
    $servicios = $s->Selecionar_servicios_buscar('',$inicioList,$listarDeCuanto);
    $serv = $s->Selecionar_servicios();
    require("../vista/servicio/RegistroServicio.php");
  }

  public function VerServiciosTabla($paginacion,$listarDeCuanto,$id_servicio){
    $s=new Servicio();
    $listarDeCuanto = $listarDeCuanto;$pagina = $paginacion;
    $resultodoUsuarios = $s->Selecionar_servicios_buscar($id_servicio,false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;
    $servicios = $s->Selecionar_servicios_buscar($id_servicio,$inicioList,$listarDeCuanto);
    echo "<div class='row'>
      <div class='col'>
        <div class='table-responsive'>
        <table class='table'>
          <thead style='font-size:12px'>
            <tr>
              <th>N°</th>
              <th>Nombre servicio</th>
              <th>Descripción</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>";

      if (mysqli_num_rows($servicios) > 0){
          $i = 0;
        foreach ($servicios as $fi){
            echo "<tr>";
              echo "<td>".($i+1)."</td>";
              echo "<td>".$fi['nombre_servicio']."</td>";
              echo "<td>".$fi['descripcion_servicio']."</td>";

              echo "<td>";
                echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>";
                echo "<button type='button' class='btn btn-info' title='Editar' onclick='Actualizar_servicio(".$fi['cod_servicio'].",\"".$fi['nombre_servicio']."\",\"".$fi['descripcion_servicio']."\")'><img src='../imagenes/edit.ico' height='17' width='17' class='rounded-circle'></button>";
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

      // previous label
      if ($pagina != 1) {
        echo "<li class='page-item'><a class='page-link'  onclick=\"buscar(1)\"><span aria-hidden='true'>&laquo;</span></a></li>";
      }
      if($pagina==1) {
        echo "<li class='page-item'><a class='page-link text-muted'>$anterior</a></li>";
      } else if($pagina==2) {
        echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"buscar(1)\" class='page-link'>$anterior</a></li>";
      }else {
        echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"buscar($pagina-1)\">$anterior</a></li>";

      }
      // first label
      if($pagina>($adjacents+1)) {
        echo "<li class='page-item'><a href='javascript:void(0);' class='page-link' onclick=\"buscar(1)\">1</a></li>";
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
          echo"<li class='page-item'><a href='javascript:void(0);' class='page-link'onclick=\"buscar(1)\">$i</a></li>";
        }else {
          echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"buscar(".$i.")\" class='page-link'>$i</a></li>";
        }
      }

      // interval

      if($pagina<($TotalPaginas-$adjacents-1)) {
        echo "<li class='page-item'><a class='page-link'>...</a></li>";
      }
      // last

      if($pagina<($TotalPaginas-$adjacents)) {
        echo "<li class='page-item'><a href='javascript:void(0);'class='page-link ' onclick=\"buscar($TotalPaginas)\">$TotalPaginas</a></li>";
      }
      // next

      if($pagina<$TotalPaginas) {
        echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"buscar($pagina+1)\">$siguiente</a></li>";
      }else {
        echo "<li class='page-item'><a class='page-link text-muted'>$siguiente</a></li>";
      }
      if ($pagina != $TotalPaginas) {
        echo "<li class='page-item'><a class='page-link' onclick=\"buscar($TotalPaginas)\"><span aria-hidden='true'>&raquo;</span></a></li>";
      }

      echo "</ul>";
      echo "</div>";

echo "</div>
    </div>";
  }
}

  function GenerarReporte($id_servicio){
    $s=new Servicio();
    $servicios = $s->Selecionar_servicios_buscar($id_servicio,false,false);
    require("../vista/servicio/ReporteServicio.php");
  }

  function VisualizarServiciosContando(){
    $s=new Servicio();
    $re=new RegistroDiario();
    $servicios = $s->Selecionar_servicios();
    $servicios1 = $s->Selecionar_servicios();
    $fechai = '';$fechaf='';
    $regDiario =$re->seleccionarRegistrosDiario($fechai,$fechaf);
    require("../vista/servicio/ServiciosFecha.php");
  }

  function BuscarPORfechaServicio($fechai,$fechaf){
    //echo "fechai ".$fechai." fechaf ".$fechaf;
    $s=new Servicio();
    $re=new RegistroDiario();
    $servicios = $s->Selecionar_servicios();
    $servicios1 = $s->Selecionar_servicios();
    $regDiario =$re->seleccionarRegistrosDiario($fechai,$fechaf);
    echo "<h6 align='center'>Cantidad de pacientes atendidos por servicio";

    echo "</h6>";
        $ser = array();
        while($fi=mysqli_fetch_array($servicios))
        {
          $ser[$fi['cod_servicio']]=array('contar' =>0 ,'nombre_servicio'=> $fi['nombre_servicio']);
        }
        while($fi=mysqli_fetch_array($regDiario)){
          $ser[$fi['servicio_rd']]['contar']+=1;
        }
           echo "<div class='row'>
                <div class='col'>
                  <div class='table-responsive'>
                    <table class='table'>
                      <thead style='font-size:12px'>
                        <tr>
                          <th>N°</th>
                          <th>Servicio</th>
                          <th>Pacientes atendidos</th>
                        </tr>
                      </thead>
                      <tbody>";
                      $k = 1;$suma = 0;
                      while($fi=mysqli_fetch_array($servicios1)){
                        echo "<tr>";
                        echo "<td>".$k."</td>";

                        echo "<td>".$ser[$fi['cod_servicio']]['nombre_servicio']."</td>";
                        echo "<td>".$ser[$fi['cod_servicio']]['contar']."</td>";
                        echo "</tr>";
                        $suma+=$ser[$fi['cod_servicio']]['contar'];
                        $k+=1;
                      }
                      echo "<tr>";
                      echo "<td align='center'></td>";
                      echo "<td align='center'>Total Pacientes</td>";
                        echo "<td  colspan='11'>".$suma."</td>";
                      echo "</tr>";
              echo "  </tbody>
                </table>
              </div>
            </div>  </div>";
      }
  function GenerarReporteFecha($fechai,$fechaf){
    $s=new Servicio();
    $re=new RegistroDiario();
    $servicios = $s->Selecionar_servicios();
    $servicios1 = $s->Selecionar_servicios();
    $regDiario =$re->seleccionarRegistrosDiario($fechai,$fechaf);
    require("../vista/servicio/ReporteServicioFecha.php");
  }
}
$se =new ServicioControlador();

if(isset($_GET["accion"]) && $_GET["accion"] == "rse"){
  $se->registroServicio($_POST["cod_servicio"],$_POST["servicio"],$_POST["descripcion"]);
}

if(isset($_GET["accion"]) && $_GET["accion"] == "rsr"){
  $se->VerServicios();
}
if(isset($_GET["accion"]) && $_GET["accion"] == "bs"){
  $se->VerServiciosTabla($_POST["paginacion"],$_POST["listarDeCuanto"],$_POST["id_servicio"]);
}
if(isset($_GET["accion"]) && $_GET["accion"] == "grser"){
  echo $_POST["id_servicio"];
  $se->GenerarReporte($_POST["id_servicio"]);
}
if(isset($_GET["accion"]) && $_GET["accion"]=="vTs"){
  $se->VisualizarServiciosContando();
}
if(isset($_GET["accion"]) && $_GET["accion"]=="bfs"){
  $se->BuscarPORfechaServicio($_POST['fechai'],$_POST['fechaf']);
}
if(isset($_GET["accion"]) && $_GET["accion"]=="gfrs"){
  $se->GenerarReporteFecha($_POST['fechai'],$_POST['fechaf']);
}
