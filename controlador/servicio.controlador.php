<?php
require_once '../modelo/servicio.php';
require_once '../modelo/registroDiario.php';
require "sesion.controlador.php";
$ins=new sesionControlador();
$ins->StarSession();
$abi = $ins->verificarSession();
//echo "<br><br><br><br><br><br><br><br><br><br><br><br>".$abi;
if($abi!='' and $abi=='cerrar'){
  $ins->Destroy();
  //$ins->Redireccionar_inicio();
}
if(isset($_SESSION["tipo_usuario"])==""){
    $ins->Redireccionar_inicio();
}
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

  function VisualizarServiciosContandoPorSexo(){
    $s=new Servicio();
    $re=new RegistroDiario();
    $servicios = $s->Selecionar_servicios();
    $servicios1 = $s->Selecionar_servicios();

    $servicios2 = $s->Selecionar_servicios();
    $servicios3 = $s->Selecionar_servicios();
    $fechai = '';$fechaf='';
    $regDiario =$re->seleccionarRegistrosDiarioPorSexo('masculino',$fechai,$fechaf);
    $regDiario1 =$re->seleccionarRegistrosDiarioPorSexo('femenino',$fechai,$fechaf);
    require("../vista/servicio/ServiciosFechaSexo.php");
  }

  function BuscarPORfechaServicioSexo($fechai,$fechaf){
    //echo "fechai ".$fechai." fechaf ".$fechaf;
    $s=new Servicio();
    $re=new RegistroDiario();
    $servicios = $s->Selecionar_servicios();
    $servicios1 = $s->Selecionar_servicios();

    $servicios2 = $s->Selecionar_servicios();
    $servicios3 = $s->Selecionar_servicios();
    $regDiario =$re->seleccionarRegistrosDiarioPorSexo('masculino',$fechai,$fechaf);
    $regDiario1 =$re->seleccionarRegistrosDiarioPorSexo('femenino',$fechai,$fechaf);
    echo "<h6 align='center'><b>CANTIDAD DE PACIENTES MASCULINOS ATENDIDOS</b></h6>";
        $ser = array();
        while($fi=mysqli_fetch_array($servicios))
        {
          $ser[$fi['cod_servicio']]=array('contar' =>0 ,'nombre_servicio'=> $fi['nombre_servicio']);
        }
        while($fi=mysqli_fetch_array($regDiario)){
          $ser[$fi['servicio_rd']]['contar']+=1;
        }
      $suma = 0;
          echo "<div class='row'>
                <div class='col'>
                  <div class='table-responsive'>
                    <table class='table'>
                      <thead style='font-size:12px'>
                        <tr>
                          <th>N°</th>
                          <th>Servicio</th>
                          <th>Pacientes</th>
                        </tr>
                      </thead>
                      <tbody>";
                      $k = 1;
                      while($fi=mysqli_fetch_array($servicios1)){
                        echo "<tr>";
                        echo "<td>".$k."</td>";

                        echo "<td>".$ser[$fi['cod_servicio']]['nombre_servicio']."</td>";
                        echo "<td>".$ser[$fi['cod_servicio']]['contar']."</td>";
                        $suma+=$ser[$fi['cod_servicio']]['contar'];
                        echo "</tr>";
                        $k+=1;
                      }
                      echo "<tr>";
                      echo "<td align='center' colspan='2'>Total Pacientes</td>";
                        echo "<td >".$suma."</td>";
                      echo "</tr>";
              echo "  </tbody>
                </table>
              </div>
            </div>  </div>";

     echo "<h6 align='center'><b>CANTIDAD DE PACIENTES FEMENINOS ATENDIDOS</b></h6>";
         $ser = array();
         while($fi=mysqli_fetch_array($servicios2))
         {
           $ser[$fi['cod_servicio']]=array('contar' =>0 ,'nombre_servicio'=> $fi['nombre_servicio']);
         }
         while($fi=mysqli_fetch_array($regDiario1)){
           $ser[$fi['servicio_rd']]['contar']+=1;
         }
      ?>
       <?php
       $suma = 0;
           echo "<div class='row'>
                 <div class='col'>
                   <div class='table-responsive'>
                     <table class='table'>
                       <thead style='font-size:12px'>
                         <tr>
                           <th>N°</th>
                           <th>Servicio</th>
                           <th>Pacientes</th>
                         </tr>
                       </thead>
                       <tbody>";
                       $k = 1;
                       while($fi=mysqli_fetch_array($servicios3)){
                         echo "<tr>";
                         echo "<td>".$k."</td>";

                         echo "<td>".$ser[$fi['cod_servicio']]['nombre_servicio']."</td>";
                         echo "<td>".$ser[$fi['cod_servicio']]['contar']."</td>";
                         $suma+=$ser[$fi['cod_servicio']]['contar'];
                         echo "</tr>";
                         $k+=1;
                       }
                       echo "<tr>";
                       echo "<td align='center' colspan='2'>Total Pacientes</td>";
                         echo "<td >".$suma."</td>";
                       echo "</tr>";
               echo "  </tbody>
                 </table>
               </div>
             </div>  </div>";

    }

      function GenerarReporteFechaSexo($fechai,$fechaf){
        $s=new Servicio();
        $re=new RegistroDiario();
        $servicios = $s->Selecionar_servicios();
        $servicios1 = $s->Selecionar_servicios();

        $servicios2 = $s->Selecionar_servicios();
        $servicios3 = $s->Selecionar_servicios();
        $regDiario =$re->seleccionarRegistrosDiarioPorSexo('masculino',$fechai,$fechaf);
        $regDiario1 =$re->seleccionarRegistrosDiarioPorSexo('femenino',$fechai,$fechaf);

        require("../vista/servicio/ReporteServicioFechaSexo.php");
      }

      function BuscarPorFechasEdades(){
        $s=new Servicio();
        $re=new RegistroDiario();
        $servicios = $s->Selecionar_servicios();
        $servicios1 = $s->Selecionar_servicios();
        $fechai='';$fechaf='';$edadi=0;$edadf=140;
        $regDiario =$re->seleccionarRegistrosDiarioPorEdad($edadi,$edadf,$fechai,$fechaf);
        if(mysqli_num_rows($regDiario)>0)
        {
          $v = $this->contarServicioEdades($edadi,$edadf);
          $re = $this->RellenarDeDatos($v,$regDiario);
          mysqli_data_seek($regDiario, 0);
          $edades = $this->SoloEdades($regDiario);
        }
        require("../vista/servicio/ServiciosFechaEdades.php");
      }

      function SoloEdades($regDiario){
        $eda = array();
        while($fil = mysqli_fetch_array($regDiario)){
          $eda[]=$fil["edad_usuario"];
        }
        $eda = array_unique($eda);
        return $eda;
      }

      function RellenarDeDatos($v,$regDiario){
        $s=new Servicio();
        while($fil = mysqli_fetch_array($regDiario)){
            $v[$fil["edad_usuario"]][$fil["servicio_rd"]]=$v[$fil["edad_usuario"]][$fil["servicio_rd"]]+1;
            //echo $v[$fil["edad_usuario"]][$fil["servicio_rd"]]."    ".$fil["edad_usuario"]."  ".$fil["servicio_rd"]."<br>";
        }
        return $v;
      }

      function contarServicioEdades($edad1,$edad2){
        $s=new Servicio();
        $v = array();
        //echo $edad1."     ".$edad2;
        for ($i = $edad1; $i <= $edad2; $i++) {
        // Inicializa el array para la edad actual
          $v[$i] = array();
          // Recorre los servicios
          $servicios = $s->Selecionar_servicios();
          while ($f = mysqli_fetch_array($servicios)) {
              // Inicializa el contador para cada servicio en 0
              $v[$i][$f["cod_servicio"]] = 0;
          }
          // Reinicia el puntero interno del resultado de la consulta
        }
        return $v;
      }

    public function GenerarReporteDeEdades($fechai,$fechaf,$graficos,$edades){
      require("../vista/servicio/ReporteServicioFechaEdades.php");
    }

    public function BuscarDatosServiciosPorEdad($fechai,$fechaf,$edadi,$edadf){
      $s=new Servicio();
      $re=new RegistroDiario();
      $servicios = $s->Selecionar_servicios();
      $servicios1 = $s->Selecionar_servicios();
      $fechai=$fechai;$fechaf=$fechaf;$edadi=$edadi;$edadf=$edadf;
      if($edadi>$edadf){
        $aux=$edadi;
        $edadi=$edadf;
        $edadf=$aux;
      }
      $regDiario =$re->seleccionarRegistrosDiarioPorEdad($edadi,$edadf,$fechai,$fechaf);
      if(mysqli_num_rows($regDiario)>0)
      {
        $v = $this->contarServicioEdades($edadi,$edadf);
        $re = $this->RellenarDeDatos($v,$regDiario);
        mysqli_data_seek($regDiario, 0);
        $edades = $this->SoloEdades($regDiario);
      }

      echo "<div class='row'>";
      if(mysqli_num_rows($regDiario)>0){
        foreach($edades as $e){
            echo "<textarea  name='graficosI".$e."' id='graficosI".$e."' hidden></textarea >";
        }

            function generateRandomColor() {
              $r = rand(0, 255);
              $g = rand(0, 255);
              $b = rand(0, 255);
              return rgbToHex($r, $g, $b);
          }

          function rgbToHex($r, $g, $b) {
              return sprintf("#%02x%02x%02x", $r, $g, $b);
          }
          $c= 0;
          foreach($edades as $e){
            echo "<div class='col-12 col-sm-6 col-lg-6 mb-6'>";
            echo "<center><b>CANTIDAD DE PACIENTES DE $e AÑOS ATENDIDOS</b>";
            echo "<canvas id='grafica".$e."'></canvas>";
            echo "</center>
            </div>";
          }
          $labeles = '';
          $labeles.="var labels = [";
          mysqli_data_seek($servicios, 0);
          $filass = mysqli_num_rows($servicios);
          $i = 0;
          mysqli_data_seek($servicios, 0);
          while($f = mysqli_fetch_array($servicios)){
            if($filass-1 == $i){
              $labeles.="'".$f["nombre_servicio"]."'";
          }else{
              $labeles.="'".$f["nombre_servicio"]."',";
            }
            $i=$i+1;
          }
          $labeles.="];";
          echo "<script>";
          echo $labeles;

          foreach($edades as $e)
          {
            $numColors = $filass;
            $colors = [];
            for ($i = 0; $i < $numColors; $i++) {
                $colors[] = generateRandomColor();
            }
            echo "var colors = [";
            $i = 0;
            foreach ($colors as $color) {
                if($filass-1 == $i){
                  echo "'$color'";
                }else {
                  echo "'$color',";
                }
                $i=$i+1;
            }
            echo "];"; // Asegúrate de que los colores coincidan con los datasets
            echo "
            var data = {
                labels: labels,
                datasets: [{
                    label: 'Cantidad de pacientes por servicio',
                    data: [";
                    mysqli_data_seek($servicios, 0);
                    $i = 0;
                    while($fii =mysqli_fetch_array($servicios)){
                      if($filass-1 == $i){
                        echo $re[$e][$fii["cod_servicio"]];
                      }else{
                        echo $re[$e][$fii["cod_servicio"]].",";
                      }
                      $i=$i+1;
                    }
                    echo "],
                    backgroundColor: colors
                }]
            };";
            echo "
            var Options = {
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                },
                responsive: true
            };";
            echo "var pieChartCanvas = document.getElementById('grafica".$e."').getContext('2d');
            var pieChart = new Chart(pieChartCanvas, {
                type: 'bar',
                data: data,
                options: Options,
            });";
          }
          echo "</script>";
        }else{
          echo "<center>No se encontro resultados</center>";
        }
        echo "</div>";
    }
}
$se =new ServicioControlador();
if(isset($_SESSION["tipo_usuario"]) && $_SESSION["tipo_usuario"]=="admin")
{
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
}else if(isset($_SESSION["tipo_usuario"]) && $_SESSION["tipo_usuario"]=="admision")
{
  //echo "<br><br><br><br><br>holllldafds".$_SESSION["tipo_usuario"];
  if(isset($_GET["accion"]) && $_GET["accion"]=="vTs"){
    $se->VisualizarServiciosContando();
  }
  if(isset($_GET["accion"]) && $_GET["accion"]=="bfs"){
    $se->BuscarPORfechaServicio($_POST['fechai'],$_POST['fechaf']);
  }
  if(isset($_GET["accion"]) && $_GET["accion"]=="gfrs"){
    $se->GenerarReporteFecha($_POST['fechai'],$_POST['fechaf']);
  }
  if(isset($_GET["accion"]) && $_GET["accion"]=="rtsx"){
    $se->VisualizarServiciosContandoPorSexo();
  }
  if(isset($_GET["accion"]) && $_GET["accion"]=="bfsx"){
    $se->BuscarPORfechaServicioSexo($_POST['fechai'],$_POST['fechaf']);
  }
  if(isset($_GET["accion"]) && $_GET["accion"]=="gfrsx"){
    $se->GenerarReporteFechaSexo($_POST['fechai'],$_POST['fechaf']);
  }
  if(isset($_GET["accion"]) && $_GET["accion"]=="rGE"){
    $se->BuscarPorFechasEdades();
  }
  if(isset($_GET["accion"]) && $_GET["accion"]=="gfred"){
    $graficos = array();
    for($i=0;$i<140;$i++){
      $campo = 'imagen' . $i;
     if (isset($_POST[$campo])) {
         $graficos[] = $_POST[$campo];
     }
    }
    $edades = array();
    for($i=0;$i<140;$i++){
      $campo = $i;
     if (isset($_POST[$campo])) {
         $edades[] = $_POST[$campo];
     }
    }
    $se->GenerarReporteDeEdades($_POST['fechai'],$_POST['fechaf'],$graficos,$edades);
  }
  if(isset($_GET["accion"]) && $_GET["accion"]=="bfep"){
    $se->BuscarDatosServiciosPorEdad($_POST['fechai'],$_POST['fechaf'],$_POST['edadi'],$_POST['edadf']);
  }
}else{
    //echo "<br><br><br><br><br>llllellglglglglglgllglg";
    $ins->Redireccionar_inicio();
}
