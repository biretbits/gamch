<?php require("../librerias/headeradmin1.php"); ?>

<div class="container main-content">
<div class="container">
  <?php
  /*echo "<div id='color1'><a href='$diario'id='co'>Registro Diario</a>><a href='#'
   onclick='accionHitorialVer($paciente_rd,$cod_rd)'
   id='co'>Historial</a>></div>"; */

   ?>

<h4>Salida de productos farmaceuticos</h4>
<div class="row" >
     <div class="col-12">
       <hr>
     </div>
   </div>
          <div class="row">
              <div class="col-lg-12">
                  <!-- Masthead device mockup feature-->
                  <div class="masthead-device-mockup">
                    <input type="hidden" name="cod_generico" id="cod_generico" value="<?php $ms = (isset($paciente_rd) && is_numeric($paciente_rd))? $paciente_rd:""; echo $ms; ?>">
                    <input type="hidden" name="paginas" id='paginas' value="">
                    <div class="row align-items-center">
                      <label for="selectPage" class="form-label col-auto mb-2">Pagina</label>
                      <div class="col-auto mb-2">
                        <select class="form-select" id="selectList" name="selectList" onchange="Buscar(1)">
                          <option>--</option>
                          <option>5</option>
                          <option>10</option>
                          <option>25</option>
                          <option>50</option>
                          <option>100</option>
                          <option>250</option>
                          <option>500</option>
                          <option>1000</option>
                        </select>
                      </div>
                      <div class="col-auto mb-2">
                        fecha inicio
                        <input type="date" class="form-control" name="fechai"id='fechai'onchange="Buscar(1)" value="">
                        fecha final
                        <input type="date" class="form-control" name="fechaf"id='fechaf' onchange="Buscar(1)"value="">
                      </div>

                      <div class="col-auto mb-2" title="Reporte">
                        <button type="button" class="d-sm-inline-block btn btn-sm btn-warning shadow-sm" data-bs-toggle="modal" data-bs-target="#ModalReportePorFecha">
                          <img src='../imagenes/reporte.ico' style='height: 25px;width: 25px;'>
                        </button>
                      </div>
                      <div class="col-auto mb-2" title="Registrar o Actualizar">
                        <button type="button" class="d-sm-inline-block btn btn-sm btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#ModalRegistro" onclick="ActualizarSalida('','','','',0,'')">
                          <img src='../imagenes/new.ico' style='height: 25px;width: 25px;'>
                        </button>
                      </div>

                      <div class="col-auto mb-2">
                        <!-- espacio vacío para mantener el diseño intacto -->
                      </div>
                      <div class="col mb-2">
                        <input type="text" name="buscar" id='buscar'class="form-control" placeholder="Buscar por /receta/nombre y apellidos de paciente" onkeyup="Buscar(1)">
                      </div>
                    </div>
                    </div>
                    <!-- modal para generar fechas desde seleccionar fechas -->
                    <?php
                    // Obtener la fecha actual en formato YYYY-MM-DD
                      $fechaActual = date('Y-m-d');
                    ?>
                    <div class="modal fade" id="ModalRegistro" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h6 class="modal-title" id="miModalRegistro">Registro o Actualización, Entrada de productos farmaceuticos</h6>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- Contenido del modal -->
                        <div class="modal-body">
                          <div class="card shadow-lg">
                           <div class="card-body">
                             <form>
                               <input type="hidden" name="cod_producto"id='cod_producto' value="">
                               <input type="hidden" name="cod_salida" id='cod_salida' value="">
                               <input type="hidden" name="usuario_id" id='usuario_id' value="">
                               <input type="hidden" name="codigos" id='codigos'value="">
                               <input type="hidden" name="actualizar" id='actualizar' value="">
                               <div class="mb-3">
                                 <label for="nombre_receta" class="form-label">Nombre receta</label>
                                 <input type="text" class="form-control" id="nombre_receta" placeholder="Nombre de la receta" autocomplete="off">
                              </div>
                               <div class="mb-3">
                                 <label for="cod_paciente" class="form-label">Paciente</label>
                                 <input type="text" class="form-control" id="cod_paciente" placeholder="Busque al paciente" onkeyup="buscarPaciente()"autocomplete="off">
                                 <div id="resultadoPaciente" align='left' class='alert alert-light mb-0 py-0 border-0'>
                                 </div>
                               </div>
                               <div class="mb-3">
                                 <label for="cod_producto" class="form-label">Producto farmaceutico</label>
                                 <input type="text" class="form-control" id="nombre_producto" placeholder="Busque el producto" onkeyup="buscarProductoNuevo()" autocomplete="off">
                                 <div id="resultadoProducto" align='left' class='alert alert-light mb-0 py-0 border-0'>
                                 </div>
                               </div>
                               <div class="mb-3">
                                 <label for="name" class="form-label">Stock Total</label>
                                 <input disabled type="text" class="form-control" id="total_stock" name='total_stock' min='1' value='0' placeholder="Stock Total">
                               </div>
                               <p id='stock_es' class='form-control'></p>
                               <div class="mb-3">
                                 <label for="name" class="form-label">Cantidad</label>
                                 <input type="number" class="form-control" id="cantidad"  min='1' value='1' placeholder="cantidad">
                               </div>
                               <div class="modal-footer">
                                 <button title='Agrega y Guarda el producto'type="button" id='btnr'class="btn btn-primary" onclick="registrar()"><img src='../imagenes/guardar.ico' style='height: 25px;width: 25px;'> Agregar producto</button>
                               </div>
                               <div class="table-responsive">
                                <table class="table" id="tablaProductos">
                                  <thead>
                                    <tr style="font-size:13px">
                                      <th>Codigo</th>
                                      <th>Producto</th>
                                      <th>Cantidad</th>
                                      <th>Acciones</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <!-- Aquí se agregarán las filas dinámicamente -->
                                  </tbody>
                                </table>
                              </div>
                             </form>
                           </div>
                         </div>
                        <!-- Pie de página del modal -->
                      </div>
                        <div class="modal-footer">
                        <button title='Permite guardar el dato como entregado al cliente' type="button" id='btne' class="btn btn-success" onclick="Entregar()"><img src='../imagenes/guardar.ico' style='height: 25px;width: 25px;'> Entregar</button>
                         <button title='cerrar'type="button" class="btn btn-danger" data-bs-dismiss="modal"><img src='../imagenes/drop.ico' style='height: 25px;width: 25px;'></button>
                        </div>
                      </div>
                    </div>
                  </div>
                    <div class="modal fade" id="ModalReportePorFecha" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="miModalLabel">Selección de fechas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <!-- Contenido del modal -->
                          <div class="modal-body">
                            <form class="form-inline" >
                              <input type="hidden" name="pagina1" id='pagina1' value="">
                              <div class="row mb-3">
                                <label for="fecha1" class="form-label">Fecha inicio</label>
                                <div class="input-group">
                                  <input type="date" id="fecha1" name="fecha1" value="<?php echo $fechaActual; ?>" class="form-control">
                                </div>
                              </div>
                              <div class="row mb-3">
                                <label for="fecha1" class="form-label">Fecha final</label>
                                <div class="input-group">
                                  <input type="date" id="fecha2" name="fecha2" value="<?php echo $fechaActual; ?>" class="form-control">
                                </div>
                              </div>
                              <div class="for-control alert alert-light">
                                Nota:
                                Seleccione de que fecha a que fecha quiere generar reporte
                              </div>
                            </form>
                          </div>
                          <!-- Pie de página del modal -->
                          <div class="modal-footer">
                            <button type="button"  class="btn btn-success" title = 'Generar reporte' onclick="GenerarReporte()"><img src='../imagenes/aceptar.ico' style='height: 25px;width: 25px;'> Generar</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><img src='../imagenes/drop.ico' style='height: 25px;width: 25px;'></button>
                          </div>

                        </div>
                      </div>
                    </div>
                    <div class="row" >
                         <div class="col-12">
                           <hr>
                         </div>
                       </div>

                       <div class="modal fade" id="ModalEditar" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
                       <div class="modal-dialog">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h6 class="modal-title" id="miModalRegistro">Actualizar la cantidad del producto solicitado</h6>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <!-- Contenido del modal -->
                           <div class="modal-body">
                             <div class="card shadow-lg">
                              <div class="card-body">
                                <form>
                                  <input type="hidden" name="cod_producto1"id='cod_producto1' value="">
                                  <input type="hidden" name="cod_solicitado1" id='cod_solicitado1' value="">
                                  <input type="hidden" name="codigos1" id='codigos1'value="">
                                  <input type="hidden" name="cantidadRestado1" id='cantidadRestado1' value="">
                                  <input type="hidden" name="codigos_entrada1" id='codigos_entrada1' value="">
                                  <input type="hidden" name="fila" id='fila' value="">
                                  <div class="mb-3">
                                    <label for="nombre_producto1" class="form-label">Producto farmaceutico</label>
                                    <input type="text" class="form-control" id="nombre_producto1" placeholder="Busque el producto" onkeyup="buscarProductoNuevo1()" autocomplete="off">
                                    <div id="resultadoProducto1" align='left' class='alert alert-light mb-0 py-0 border-0'>
                                    </div>
                                  </div>
                                  <div class="mb-3">
                                    <label for="name" class="form-label">Stock Total</label>
                                    <input disabled type="text" class="form-control" id="total_stock1" name='total_stock1' min='1' value='0' placeholder="Stock Total">
                                  </div>
                                  <p id='stock_es1' class='form-control'></p>
                                  <div class="mb-3">
                                    <label for="name" class="form-label">Cantidad</label>
                                    <input type="number" class="form-control" id="cantidad1"  min='1' value='1' placeholder="cantidad" >
                                  </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                           <!-- Pie de página del modal -->
                           <div class="modal-footer">
                            <button title='Guardar'type="button" class="btn btn-primary" onclick="editarProductoSolicitado()"><img src='../imagenes/guardar.ico' style='height: 25px;width: 25px;'> Guardar Cambios</button>
                            <button title='cerrar'type="button" class="btn btn-danger" data-bs-dismiss="modal"><img src='../imagenes/drop.ico' style='height: 25px;width: 25px;'></button>
                           </div>
                         </div>
                         </div>
                       </div>
                     </div>
                    <div class="verDatos" id="verDatos">
                      <div class="row">
                        <div class="col">
                          <div class="table-responsive">
                          <table class="table">
                            <thead style="font-size:12px">
                              <tr>
                                <th>N°</th>
                                <th>Nombre Receta</th>
                                <th>Paciente</th>
                                <th>Encargado Farmacia</th>
                                <th>Fecha</th>
                                <th>Entregado</th>
                                <th>Acción</th>
                              </tr>
                            </thead>
                            <tbody>

                        <?php
                        //echo "<br><br><br><br><br>".count($resul);
                      if ($resul && count($resul) > 0) {
                          $i = $inicioList;
                          foreach ($resul as $fi){
                              echo "<tr>";
                                echo "<td>".($i+1)."</td>";
                                echo "<td>".$fi['nombre_receta']."</td>";

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

                                echo "<td>".$fi['fechaHora']."</td>";
                                if($fi["entregado"] == 'si'){
                                  echo "<td  style='color:green;background-color:#dbffaf;text-align:center'>Entregado</td>";
                                }else{
                                  echo "<td  style='color:red;background-color:#faa3aA;text-align:center'>No entregado</td>";
                                }
                                echo "<td>";
                                  echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>";
                                //echo $fi['cod_salida'].",".$fi['cantidad_salida'].",".$datos_paciente.",".$fi['nombre'].",".$fi["cantidad_total"].",".$cod_paciente.",".$fi['cod_generico'];
                                  echo "<button type='button' class='btn btn-info' title='Editar' onclick='ActualizarSalida(".$fi['cod_salida'].",".$cod_paciente.",\"".$fi["nombre_receta"]."\",\"".$datos_paciente."\",1,\"".$fi["entregado"]."\")' data-bs-toggle='modal' data-bs-target='#ModalRegistro'><img src='../imagenes/edit.ico' height='17' width='17' class='rounded-circle'></button>";
                                  echo "<button type='button' class='btn btn-danger' title='Elimina todo' onclick='eliminar(".$fi['cod_salida'].")'><img src='../imagenes/drop.ico' height='17' width='17' class='rounded-circle'></button>";
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
                           ?>
                          </tbody>
                        </table>
                        </div>
                      </div>
                    </div>
                    <?php
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
                     ?>
                   </div>

                  </div>
              </div>
          </div>
      </div>
      <style media="screen">
      .colorful-text {
           font-size: 4em;
           font-weight: bold;
           background: linear-gradient(45deg, #f06, #4a90e2, #50e3c2, #f5a623);
           background-clip: text;
           color: transparent;
           text-shadow: 1px 2px 4px rgba(50, 0, 100, 0.3);
           animation: textAnimation 3s infinite linear;

       }
      </style>


 <!-- modal de seleccion de fechas-->
<script type="text/javascript">
function Buscar(page){
    var obt_lis = document.getElementById("selectList").value;
    var listarDeCuanto = verificarList(obt_lis);
    var buscar = document.getElementById("buscar").value;
    document.getElementById("paginas").value=page;
    var fechai=document.getElementById("fechai").value;
    var fechaf=document.getElementById("fechaf").value;
    //alert(buscar);
    //ponerFechactualAlModalDeReporte(listarDeCuanto,buscar,page,fecha);
    var datos = new FormData(); // Crear un objeto FormData vacío
    datos.append('pagina', page);
    datos.append('listarDeCuanto',listarDeCuanto);
    datos.append("buscar",buscar);
    datos.append("fechai",fechai);
    datos.append("fechaf",fechaf);
      $.ajax({
        url: "../controlador/farmacia.controlador.php?accion=vsta",
        type: "POST",
        data: datos,
        contentType: false, // Deshabilitar la codificación de tipo MIME
        processData: false, // Deshabilitar la codificación de datos
        success: function(data) {
        //alert(data+"dasdas");
          $("#verDatos").html(data);
        }
      });
  }

  function verificarList(valor){
    if(valor != "" && valor != "--"){
      return valor;
    }else{
      return 5;
    }
  }

  function registrar(){
    var cod_producto = document.getElementById("cod_producto").value;
    var cod_salida = document.getElementById("cod_salida").value;
    var cantidad = parseInt(document.getElementById("cantidad").value);
    var id_paciente = document.getElementById("usuario_id").value;
    var total = parseInt(document.getElementById("total_stock").value);
    var nombre_producto = document.getElementById("nombre_producto").value;
    var nombre_receta = document.getElementById("nombre_receta").value;
    var actualizar=document.getElementById("actualizar").value;
    var codigos = document.getElementById("codigos").value;
    if(cantidad>total){
      cambie_Cantidad();
      return;
    }
    if(total==0){
      StockBajo();
      return;
    }
    if(cantidad == "" || cod_producto == '' || id_paciente == ''){
      Vacio();
      return;
    }

    var obt_lis = document.getElementById("selectList").value;
    var listarDeCuanto = verificarList(obt_lis);
    var buscar = document.getElementById("buscar").value;
    var page = document.getElementById("paginas").value;
    if(page ==''){
        page=1;
    }
    var fechai=document.getElementById("fechai").value;
    var fechaf=document.getElementById("fechaf").value;
          //alert(buscar+"   "+fechai);
          //ponerFechactualAlModalDeReporte(listarDeCuanto,buscar,page,fecha);
    var datos = new FormData(); // Crear un objeto FormData vacío
    var datos1 = new FormData(); // Crear un objeto FormData vacío

    datos1.append('pagina', page);
    datos1.append('listarDeCuanto',listarDeCuanto);
    datos1.append("buscar",buscar);
    datos1.append("fechai",fechai);
    datos1.append("fechaf",fechaf);

    datos.append("cod_producto",cod_producto);
    datos.append("cantidad",cantidad);
    datos.append("cod_salida",cod_salida);
    datos.append("id_paciente",id_paciente);
    datos.append("nombre_receta",nombre_receta);
    datos.append("actualizar",actualizar);
      $.ajax({
        url: "../controlador/farmacia.controlador.php?accion=resf",
        type: "POST",
        data: datos,
        contentType: false, // Deshabilitar la codificación de tipo MIME
        processData: false, // Deshabilitar la codificación de datos
        success: function(data) {
      //  alert(data+"dasdas");
          if(data == 'fecha_vencido'){
            vencido();
          }else if(data == 'error'){
            Error1();
          }else{
            var separar = data.split(',');
            var fila = verificarFilas();
            var codi1=parseInt(separar[0]);
            var codi2 = parseInt(separar[1]);
            var texto = separar[2];
            if(typeof codi1=== 'number' && typeof codi2 == 'number' && texto == 'correctoEScORRECTO')
            {
              Correcto3();
              agragarFila(codigos,nombre_producto,cantidad,cod_salida,data,'');
              document.getElementById("nombre_producto").value='';
              document.getElementById("cod_producto").value='';
              document.getElementById("cantidad").value='';
              document.getElementById("total_stock").value='';
              document.getElementById("nombre_receta").disabled=true;
              document.getElementById("cod_paciente").disabled=true;
              var es = document.getElementById("stock_es");
              es.textContent ='';
              es.style.backgroundColor = 'white';
              $.ajax({
                url: "../controlador/farmacia.controlador.php?accion=actualizarTabla",
                type: "POST",
                data: datos1,
                contentType: false, // Deshabilitar la codificación de tipo MIME
                processData: false, // Deshabilitar la codificación de datos
                success: function(resul) {
                  $("#verDatos").html(resul);
                }
              });
            }else{
              location.href="../controlador/farmacia.controlador.php?accion=vsf";
            }
          }
          //IRalLink(cod_salida);
        }
      });
  }

  function vencido() {
    Swal.fire({
        icon: 'info',
        title: '¡Información!',
        text: '¡Lo siento, no podrá actualizar, ya que se encontró que en el abastecimiento ya vencieron algunos productos!',
        showConfirmButton: false,
        timer: 2000
    });
}

  function StockBajo() {
    Swal.fire({
        icon: 'info',
        title: '¡Información!',
        text: '¡Lo siento, No se podra actualizar el stock es muy bajo!',
        showConfirmButton: false,
        timer: 2000
    });
}

  function cambie_Cantidad() {
    Swal.fire({
        icon: 'info',
        title: '¡Información!',
        text: '¡La cantidad solicitada supera al stock que se tiene!',
        showConfirmButton: false,
        timer: 2000
    });
}

  function Correcto(){
    Swal.fire({
     icon: 'success',
     title: '¡Correcto!',
     text: '¡La acción se realizo correctamente!',
     showConfirmButton: false,
     timer: 1500
   });
  }

    function Correcto3(){
      Swal.fire({
       icon: 'success',
       title: '¡Correcto!',
       text: '¡Se agrego corretamente el producto farmacéutico!',
       showConfirmButton: false,
       timer: 1500
     });
    }
  function Error1(){
    Swal.fire({
     icon: 'error',
     title: '¡Error!',
     text: '¡Ocurrio algun error!',
     showConfirmButton: false,
     timer: 1500
   });
  }
  function Vacio(){
    Swal.fire({
     icon: 'error',
     title: '¡Error!',
     text: '¡Campo vacio!',
     showConfirmButton: false,
     timer: 1500
   });
  }

  function IRalLink(cod_salida){
    if(cod_salida!=''){
      setTimeout(() => {
        var pagina = document.getElementById("paginas").value;
        if(pagina==''){pagina=1;}
        Buscar(pagina);
        document.getElementById('cod_salida').value="";
        document.getElementById("cantidad").value="";
        document.getElementById("usuario_id").value="";
        document.getElementById("cod_producto").value="";
        document.getElementById("nombre_producto").value="";
        document.getElementById("cod_paciente").value="";
        document.getElementById("total_stock").value="";
        $('#ModalRegistro').modal('hide');
      }, 1500);
    }else{
      setTimeout(() => {
        location.href="../controlador/farmacia.controlador.php?accion=vsf";
        $('#ModalRegistro').modal('hide');
      }, 1500);
    }
  }
  function ActualizarSalida(cod_salida,usuario_id,nombre_receta,cod_paciente,actualizar,entregado){
  //  alert(cod_salida+" "+cantidad_salida+" "+datos_paciente+"  "+nombre+" "+stock_producto+" "+cod_paciente+" "+cod_generico);
    document.getElementById("cod_salida").value=cod_salida;
    document.getElementById("usuario_id").value=usuario_id;
    document.getElementById("nombre_receta").value=nombre_receta;
    document.getElementById("cod_paciente").value=cod_paciente;
    document.getElementById("actualizar").value=actualizar;
    if(actualizar==0){
      document.getElementById("cod_producto").value='';
      document.getElementById("codigos").value='';
      document.getElementById("cod_paciente").value='';
      document.getElementById("nombre_producto").value='';
      document.getElementById("total_stock").value='';
      document.getElementById("cantidad").value='';
      document.getElementById("btnr").disabled=false;
      document.getElementById("btne").disabled=false;
      document.getElementById("nombre_receta").disabled=false;
      document.getElementById("cod_paciente").disabled=false;
      vaciarTabla();
    }else{
      BuscarDatosProductosSolicitados(cod_salida,entregado);
    }
    if(entregado != "" && entregado == 'si'){
      document.getElementById("btnr").disabled=true;
      document.getElementById("btne").disabled=true;
    }else{
      document.getElementById("btnr").disabled=false;
      document.getElementById("btne").disabled=false;
    }
  }


  function buscarProductoNuevo() {
          //vaciarDESPUESdeUNtiempoAdmision();
          var nombre_producto = document.getElementById("nombre_producto").value;
          if (nombre_producto != "") {
              $.ajax({
                  url: "../controlador/farmacia.controlador.php?accion=bcp",
                  type: "POST",
              		data: {cod_producto:nombre_producto},
              		dataType: "json",
                  success: function(data) {
                    //alert(data);
                    if(data!=""){
                      var unir="";
                      for (let i = 0; i < data.length; i++) {
                        var usuario = data[i];

                        unir+="<div>";
                        unir+="<div id='u' style=' display: inline-block;display:none;'>"+(data[i].cod_generico)+"</div> ";
                        unir+="<div id='u' style=' display: inline-block;'>"+(data[i].codigo)+"</div> ";
                        unir+="<div id='u' style=' display: inline-block;'>"+(data[i].nombre)+"</div> ";
                        unir+="<div id='ap' style=' display: inline-block;'> "+(data[i].nombre_forma)+"</div> ";
                        unir+="<div id='ap' style=' display: inline-block;display:none;'> "+(data[i].cantidad_total)+"</div> ";
                        unir+="<div id='ap' style=' display: inline-block;display:none;'> "+(data[i].stock_producto)+"</div> ";
                        unir+="<div id='am' style=' display: inline-block;'> "+(data[i].concentracion)+"</div></div>";

                      }

                      visualizarProducto(unir);
                      $('#resultadoProducto div').on('click', function() {
                              //obtenemos los datos del usuario div resultado
                        var cod_producto = $(this).children().eq(0).text();
                        var codigos = $(this).children().eq(1).text();
                        var nombre = $(this).children().eq(2).text();
                        var nombre_forma = $(this).children().eq(3).text();
                        var total = $(this).children().eq(4).text();
                        var estado = $(this).children().eq(5).text();
                        var concentracion = $(this).children().eq(6).text();
                          //dentro de los id de la vista mostramos los datos que estan en el div resultado
                          if(nombre != ""){

                            document.getElementById("nombre_producto").value = (nombre);
                            document.getElementById("cod_producto").value = cod_producto;
                            document.getElementById("codigos").value=codigos;
                            document.getElementById("total_stock").value=total;
                            var es = document.getElementById("stock_es");
                            if(estado.trim() == 'si'){
                              es.textContent ='Stock bajo';
                              es.style.backgroundColor = 'red';
                            }else{
                              es.textContent ='Stock adecuado';
                              es.style.backgroundColor = 'green';
                            }

                            $('#resultadoProducto').html(""); //para vaciar
                          }
                      });
                    }else{
                      $('#resultadoProducto').html("<div class='alert alert-light' role='alert'>No se encontro resultados</div>");
                    }

              		}
              	});
              }else{
                $('#resultadoProducto').html("");
                document.getElementById("cod_producto").value='';
              }
            }
            function Convertir(t){
              let palabras = t.split(" ");
              let nombreConInicialesMayusculas = "";
               for (let i = 0; i < palabras.length; i++) {
                 nombreConInicialesMayusculas += palabras[i].charAt(0).toUpperCase() + palabras[i].slice(1) + " ";
                }
                 return nombreConInicialesMayusculas.trim();
             }

              function visualizarProducto(unir){

              $('#resultadoProducto').html(unir);
              //colocamos un color de css
              $('#resultadoProducto').css({
               'cursor': 'pointer',
               'font-size':'15px'
               });
      }


  function buscarPaciente() {
          //vaciarDESPUESdeUNtiempoAdmision();
          var nombre_paciente = document.getElementById("cod_paciente").value;
          if (nombre_paciente != "") {
            //alert(nombre_paciente);
              $.ajax({
                  url: "../controlador/farmacia.controlador.php?accion=buf",
                  type: "POST",
              		data: {cod_paciente:nombre_paciente},
              		dataType: "json",
                  success: function(data) {
                    //alert(data);
                    if(data!=""){
                      var unir="";
                      for (let i = 0; i < data.length; i++) {
                        var usuario = data[i];

                        unir+="<div>";
                        unir+="<div id='u' style=' display: inline-block;display:none;'>"+(data[i].cod_usuario)+"</div> ";
                        unir+="<div id='u' style=' display: inline-block;'>CI: "+(data[i].ci_usuario)+"</div> ";
                        unir+="<div id='u' style=' display: inline-block;'>"+(data[i].nombre_usuario)+"</div> ";
                        unir+="<div id='ap' style=' display: inline-block;'> "+(data[i].ap_usuario)+"</div> ";
                        unir+="<div id='am' style=' display: inline-block;'> "+(data[i].am_usuario)+"</div></div>";

                      }

                      visualizarPaciente(unir);
                      $('#resultadoPaciente div').on('click', function() {
                              //obtenemos los datos del usuario div resultado
                        var cod_usuario = $(this).children().eq(0).text();
                        var ci = $(this).children().eq(1).text();
                        var nombre_usuario = $(this).children().eq(2).text();
                        var ap_usuario = $(this).children().eq(3).text();
                        var am_usuario = $(this).children().eq(4).text();
                          //dentro de los id de la vista mostramos los datos que estan en el div resultado
                        if(nombre_usuario != ""){
                          //alert(ci);
                            document.getElementById("usuario_id").value=cod_usuario;
                            document.getElementById("cod_paciente").value =(nombre_usuario)+" "+(ap_usuario)+" "+am_usuario;
                          $('#resultadoPaciente').html(""); //para vaciar
                        }
                      });
                    }else{
                      $('#resultadoPaciente').html("<div class='alert alert-light' role='alert'>No se encontro resultados</div>");
                    }

              		}
              	});
              }else{
                $('#resultadoPaciente').html("");
                document.getElementById("cod_usuario").value='';
              }
            }
            function Convertir(t){
              let palabras = t.split(" ");
              let nombreConInicialesMayusculas = "";
               for (let i = 0; i < palabras.length; i++) {
                 nombreConInicialesMayusculas += palabras[i].charAt(0).toUpperCase() + palabras[i].slice(1) + " ";
                }
                 return nombreConInicialesMayusculas.trim();
             }

              function visualizarPaciente(unir){

              $('#resultadoPaciente').html(unir);
              //colocamos un color de css
              $('#resultadoPaciente').css({
               'cursor': 'pointer',
               'font-size':'15px'
               });
      }
      function eliminar(cod_salida){
        var obt_lis = document.getElementById("selectList").value;
        var listarDeCuanto = verificarList(obt_lis);
        var buscar = document.getElementById("buscar").value;
        var page = document.getElementById("paginas").value;
        if(page ==''){
          page=1;
        }
        var fechai=document.getElementById("fechai").value;
        var fechaf=document.getElementById("fechaf").value;
        //alert(buscar+"   "+fechai);
        //ponerFechactualAlModalDeReporte(listarDeCuanto,buscar,page,fecha);
        var datos = new FormData(); // Crear un objeto FormData vacío
        datos.append("cod_salida",cod_salida);
        datos.append('pagina', page);
        datos.append('listarDeCuanto',listarDeCuanto);
        datos.append("buscar",buscar);
        datos.append("fechai",fechai);
        datos.append("fechaf",fechaf);
        //alert(cod_salida+"  "+page+"   "+listarDeCuanto+"   "+buscar+"    "+fechai+"     "+fechaf);
        //return ;
        Swal.fire({
          title: '¿Estás seguro?',
          text: "Tenga en cuenta que no podrás revertir esto, se eliminara por completo .",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sí, eliminarlo',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
          $.ajax({
             url: "../controlador/farmacia.controlador.php?accion=efs",
             type: "POST",
             data: datos,
             contentType: false, // Deshabilitar la codificación de tipo MIME
             processData: false, // Deshabilitar la codificación de datos
            success: function(data) {
              //alert(data);
              if(data=='error'){
                Error1();
              }else if(data == 'fecha_vencido'){
                vencido();
              }else{
                Correcto();
                setTimeout(() => {
                  $("#verDatos").html(data);
                }, 1500);
              }
             }
           });
         }
       });
      }

        function buscarProductoNuevo1() {
                //vaciarDESPUESdeUNtiempoAdmision();
                var nombre_producto = document.getElementById("nombre_producto1").value;
                if (nombre_producto != "") {
                    $.ajax({
                        url: "../controlador/farmacia.controlador.php?accion=bcp",
                        type: "POST",
                    		data: {cod_producto:nombre_producto},
                    		dataType: "json",
                        success: function(data) {
                          //alert(data);
                          if(data!=""){
                            var unir="";
                            for (let i = 0; i < data.length; i++) {
                              var usuario = data[i];

                              unir+="<div>";
                              unir+="<div id='u' style=' display: inline-block;display:none;'>"+(data[i].cod_generico)+"</div> ";
                              unir+="<div id='u' style=' display: inline-block;'>"+(data[i].codigo)+"</div> ";
                              unir+="<div id='u' style=' display: inline-block;'>"+(data[i].nombre)+"</div> ";
                              unir+="<div id='ap' style=' display: inline-block;'> "+(data[i].nombre_forma)+"</div> ";
                              unir+="<div id='ap' style=' display: inline-block;display:none;'> "+(data[i].cantidad_total)+"</div> ";
                              unir+="<div id='ap' style=' display: inline-block;display:none;'> "+(data[i].stock_producto)+"</div> ";
                              unir+="<div id='am' style=' display: inline-block;'> "+(data[i].concentracion)+"</div></div>";

                            }

                            visualizarProducto1(unir);
                            $('#resultadoProducto1 div').on('click', function() {
                                    //obtenemos los datos del usuario div resultado
                              var cod_producto = $(this).children().eq(0).text();
                              var codigos = $(this).children().eq(1).text();
                              var nombre = $(this).children().eq(2).text();
                              var nombre_forma = $(this).children().eq(3).text();
                              var total = $(this).children().eq(4).text();
                              var estado = $(this).children().eq(5).text();
                              var concentracion = $(this).children().eq(6).text();
                                //dentro de los id de la vista mostramos los datos que estan en el div resultado
                                if(nombre != ""){

                                  document.getElementById("nombre_producto1").value = (nombre);
                                  document.getElementById("cod_producto1").value = cod_producto;
                                  document.getElementById("codigos1").value=codigos;
                                  document.getElementById("total_stock1").value=total;
                                  var es = document.getElementById("stock_es1");
                                  if(estado.trim() == 'si'){
                                    es.textContent ='Stock bajo';
                                    es.style.backgroundColor = 'red';
                                  }else{
                                    es.textContent ='Stock adecuado';
                                    es.style.backgroundColor = 'green';
                                  }

                                  $('#resultadoProducto1').html(""); //para vaciar
                                }
                            });
                            document.getElementById("cod_producto1").value='';
                          }else{
                            $('#resultadoProducto1').html("<div class='alert alert-light' role='alert'>No se encontro resultados</div>");
                          }

                    		},error: function(data){
                          $('#resultadoProducto1').html("<div class='alert alert-light' role='alert'>Ocurrio un error inesperado</div>");
                          document.getElementById("cod_producto1").value='';
                        }
                    	});
                    }else{
                      $('#resultadoProducto1').html("");
                      document.getElementById("cod_producto1").value='';
                    }
                  }


                    function visualizarProducto1(unir){

                    $('#resultadoProducto1').html(unir);
                    //colocamos un color de css
                    $('#resultadoProducto1').css({
                     'cursor': 'pointer',
                     'font-size':'15px'
                     });
            }

    function ActualizarSolicitud(fila,codi,codigo){
      alert(codi+"  "+codigo);
      document.getElementById("cod_solicitado1").value=codi;
      document.getElementById("codigos1").value=codigo;
      document.getElementById("fila").value=fila;

      $.ajax({
          url: "../controlador/farmacia.controlador.php?accion=soli",
          type: "POST",
          data: {cod_solicitado:codi},
          dataType: "json",
          success: function(data) {
            for (let i = 0; i < data.length; i++) {
              var usuario = data[i];
              document.getElementById("cod_producto1").value=data[i].cod_producto;
              document.getElementById("total_stock1").value=data[i].cantidad_total;
              document.getElementById("cantidadRestado1").value=data[i].cantidadRestado;
              document.getElementById("nombre_producto1").value=data[i].nombre;
              document.getElementById("cantidad1").value=data[i].cantidad_solicitada;
              document.getElementById("codigos_entrada1").value=data[i].codigos_entrada;
              var estado=data[i].stock_producto;
              var es = document.getElementById("stock_es1");

              if(estado.trim() == 'si'){
                es.textContent ='Stock bajo';
                es.style.backgroundColor = 'red';
              }else{
                es.textContent ='Stock adecuado';
                es.style.backgroundColor = 'green';
              }
              }
          }
      });
    }

    function agragarFila(codigos,nombre_producto,cantidad,cod_salida,data,disabled){

      var separar = data.split(',');
      var fila = verificarFilas();
      document.getElementById("cod_salida").value=separar[0];
      var codi = separar[1];
      let tbody = document.getElementById('tablaProductos').getElementsByTagName('tbody')[0];
      let nuevaFila = tbody.insertRow();
      let codigo = nuevaFila.insertCell(0);
      let celdaProducto = nuevaFila.insertCell(1);
      let celdaCantidad = nuevaFila.insertCell(2);
      let celdaAcciones = nuevaFila.insertCell(3);
      codigo.innerHTML = codigos;
      celdaProducto.innerHTML =nombre_producto;
      celdaCantidad.innerHTML =cantidad;
      celdaAcciones.innerHTML = `<div class='btn-group' role='group' aria-label='Basic mixed styles example'>
      <button type='button' class='btn btn-info' title='Editar' ${disabled} onclick='ActualizarSolicitud(${fila},${codi},"${codigos}")' data-bs-toggle='modal' data-bs-target='#ModalEditar'>
        <img src='../imagenes/edit.ico' height='17' width='17' class='rounded-circle'>
      </button>
      <button type='button' class='btn btn-danger'title='Eliminar Producto' ${disabled} onclick='eliminarFila(${fila},${codi})'><img src='../imagenes/drop.ico' height='17' width='17' class='rounded-circle'></button>
    </div>`;
/*<button type='button' class='btn btn-danger' onclick='eliminarFila(this)'>Eliminar</button>*/
    }

    //function para guardar los cambios del producto
    function editarProductoSolicitado(){
      var cod_producto1 = document.getElementById("cod_producto1").value;
      var cod_solicitado1 = document.getElementById("cod_solicitado1").value;
      var codigos1 = document.getElementById("codigos1").value;
      var cantidadRestado1 = document.getElementById("cantidadRestado1").value;
      var codigos_entrada1 = document.getElementById("codigos_entrada1").value;
      var nombre_producto1 = document.getElementById("nombre_producto1").value;
      var total_stock1 = parseInt(document.getElementById("total_stock1").value);
      var cantidad1 = parseInt(document.getElementById("cantidad1").value);
      var fila =document.getElementById("fila").value;
      //alert(cantidad1+"    "+total_stock1);
      if(cantidad1>=total_stock1){
        cambie_Cantidad();
        return;
      }
      if(total_stock1==0){
        StockBajo();
        return;
      }
      if(cantidad1== "" || cod_producto1 == ''){
        Vacio();
        return;
      }
      var datos = new FormData(); // Crear un objeto FormData vacío
      datos.append("cod_producto1",cod_producto1);
      datos.append("cod_solicitado1",cod_solicitado1);
      datos.append("cantidad1",cantidad1);
        $.ajax({
          url: "../controlador/farmacia.controlador.php?accion=fips",
          type: "POST",
          data: datos,
          contentType: false, // Deshabilitar la codificación de tipo MIME
          processData: false, // Deshabilitar la codificación de datos
          success: function(data) {
          //alert(data+"dasdas");
            if(data == 'fecha_vencido'){
              vencido();
            }else if(data == 'error'){
              Error1();
            }else{
              Correcto();
              vaciarCamposDeProductoSolicitado();
              actualizarLaFila(fila,codigos1,nombre_producto1,cantidad1,cod_solicitado1);
            }
            //IRalLink(cod_salida);
          }
        });

    }
    function actualizarLaFila(filaIndex,codigos1,nombre_producto1,cantidad1,cod_solicitado1) {
            var tabla = document.getElementById('tablaProductos');
            var fila = tabla.rows[filaIndex];
            fila.cells[0].innerHTML = codigos1;
            fila.cells[1].innerHTML = nombre_producto1;
            fila.cells[2].innerHTML = cantidad1;
            fila.cells[3].innerHTML =  `<div class='btn-group' role='group' aria-label='Basic mixed styles example'>
            <button type='button' class='btn btn-info' title='Editar' onclick='ActualizarSolicitud(${filaIndex},${cod_solicitado1},"${codigos1}")' data-bs-toggle='modal' data-bs-target='#ModalEditar'>
              <img src='../imagenes/edit.ico' height='17' width='17' class='rounded-circle'>
            </button>

            <button type='button' title='Eliminar Producto' class='btn btn-danger' onclick='eliminarFila(${filaIndex},${cod_solicitado1})'><img src='../imagenes/drop.ico' height='17' width='17' class='rounded-circle'></button>
          </div>`;
    }
    function vaciarCamposDeProductoSolicitado(){
      document.getElementById("cod_producto1").value='';
      document.getElementById("cod_solicitado1").value='';
      document.getElementById("codigos1").value='';
      document.getElementById("cantidadRestado1").value='';
      document.getElementById("codigos_entrada1").value='';
      document.getElementById("nombre_producto1").value='';
      document.getElementById("total_stock1").value='';
      document.getElementById("cantidad1").value='';
      document.getElementById("fila").value='';
      $('#ModalEditar').modal('hide');
    }

    function verificarFilas() {
      var tabla = document.getElementById('tablaProductos');
      var numeroDeFilas = tabla.rows.length;
  // Restar 1 para excluir la fila de encabezado
      if(numeroDeFilas===1){//es encabezado
        return 1;
      }else if (numeroDeFilas > 1) {//si es mayor a uno le sumamos una fila mas al insertar
        return (numeroDeFilas);
      }
    }

    function Entregar(){
      var numFilas = verificarFilas();
      if(numFilas===1){
        Info1();
        return;
      }
      var cod_salida = document.getElementById("cod_salida").value;
      if(cod_salida==''){
        vacio();
        return;
      }
      Swal.fire({
        title: '¿Estás seguro?',
        text: "Esta seguro que quiere realizar la entrega.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          var obt_lis = document.getElementById("selectList").value;
          var listarDeCuanto = verificarList(obt_lis);
          var buscar = document.getElementById("buscar").value;
          var page = document.getElementById("paginas").value;
          if(page ==''){
              page=1;
          }
          var fechai=document.getElementById("fechai").value;
          var fechaf=document.getElementById("fechaf").value;
          var datos1 = new FormData(); // Crear un objeto FormData vacío

          datos1.append('pagina', page);
          datos1.append('listarDeCuanto',listarDeCuanto);
          datos1.append("buscar",buscar);
          datos1.append("fechai",fechai);
          datos1.append("fechaf",fechaf);
          datos1.append("cod_salida",cod_salida);
          $.ajax({
            url: "../controlador/farmacia.controlador.php?accion=actualizarEntrega",
            type: "POST",
            data: datos1,
            contentType: false, // Deshabilitar la codificación de tipo MIME
            processData: false, // Deshabilitar la codificación de datos
            success: function(data) {
            //alert(data+"dasdas");
              if(data == 'error'){
                Error1();
              }else if(data == 'correcto'){
                Correcto();
                $.ajax({
                  url: "../controlador/farmacia.controlador.php?accion=actualizarTabla",
                  type: "POST",
                  data: datos1,
                  contentType: false, // Deshabilitar la codificación de tipo MIME
                  processData: false, // Deshabilitar la codificación de datos
                  success: function(data) {
                    $('#ModalRegistro').modal('hide');
                    $("#verDatos").html(data);
                  }
                });
              }else{
                location.href="../controlador/farmacia.controlador.php?accion=vsf";
              }
            }
          });
        }
      });

    }

  function Info1(){
    Swal.fire({
     icon: 'info',
     title: '¡Información!',
     text: '¡No se tiene ningun producto agregado para entregar al paciente o cliente!',
     showConfirmButton: false,
     timer: 3000
   });
  }
  function BuscarDatosProductosSolicitados(cod_salida,entregados){
    var disabled='';
    if(entregados == 'si'){
      disabled='disabled';
    }
    vaciarTabla();
    $.ajax({
        url: "../controlador/farmacia.controlador.php?accion=bfps",
        type: "POST",
        data: {cod_salida:cod_salida},
        dataType: "json",
        success: function(data) {
          for (let i = 0; i < data.length; i++) {
            var ps = data[i];
            var dataa = ps.cod_salida+","+ps.cod_solicitado;
            agragarFila(ps.codigo,ps.nombre,ps.cantidad_solicitada,ps.cod_salida,dataa,disabled);
          }
          if(data.length >0){
            document.getElementById("nombre_receta").disabled=true;
            document.getElementById("cod_paciente").disabled=true;
          }
        }
    });

  }
  function vaciarTabla() {
      const tabla = document.getElementById('tablaProductos').getElementsByTagName('tbody')[0];
      tabla.innerHTML = ''; // Vacía todo el contenido del tbody
  }

  function eliminarFila(fila,cod_solicitado){
    var datos = new FormData(); // Crear un objeto FormData vacío
    datos.append("cod_solicitado",cod_solicitado);
    Swal.fire({
      title: '¿Estás seguro?',
      text: "Tenga en cuenta que no podrás revertir esto, se eliminara por completo .",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, eliminarlo',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
      $.ajax({
         url: "../controlador/farmacia.controlador.php?accion=DelFps",
         type: "POST",
         data: datos,
         contentType: false, // Deshabilitar la codificación de tipo MIME
         processData: false, // Deshabilitar la codificación de datos
        success: function(data) {
          //alert(data);
          if(data=='error'){
            Error1();
          }else if(data == 'fecha_vencido'){
            vencido();
          }else{
            Correcto();
            eliminarFilaTabla(fila);
          }
         }
       });
     }
   });
  }

  function eliminarFilaTabla(index){
    var tabla = document.getElementById('tablaProductos');
    tabla.deleteRow(index);
    var filas = verificarFilas();
    if(filas == 1){

      document.getElementById("nombre_receta").disabled=false;
      document.getElementById("cod_paciente").disabled=false;
    }
  }
</script>
<?php require("../librerias/footeruni.php"); ?>
