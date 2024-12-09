<?php require("../librerias/headeradmin1.php"); ?>

<div class="container main-content">
<div class="container">

  <?php
  /*echo "<div id='color1'><a href='$diario'id='co'>Registro Diario</a>><a href='#'
   onclick='accionHitorialVer($paciente_rd,$cod_rd)'
   id='co'>Historial</a>></div>"; */

   ?>

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
  /* Ajusta la apariencia de Select2 para que coincida con Bootstrap */
.select2-container .select2-selection--single {
    height: calc(2.25rem + 2px); /* Ajusta la altura */
    padding: 0.1rem; /* Padding similar a form-select */
    font-size: 1rem;
    line-height: 1.5;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    display: flex;
    align-items: center; /* Centra el texto verticalmente */
}

/* Centra el texto verticalmente pero lo alinea a la izquierda */
.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 1.5rem; /* Ajusta la altura de la línea */
    text-align: left; /* Alinea el texto a la izquierda */
    color: #495057; /* Color de texto similar a Bootstrap */
    margin-left: 0.375rem; /* Añade un pequeño margen izquierdo */
}

/* Alinea la flecha correctamente */
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 100%; /* Alinea la flecha con el campo */
    right: 0.5rem; /* Ajusta el espacio de la flecha */
}

/* Efectos de enfoque */
.select2-container--default .select2-selection--single:focus,
.select2-container--default .select2-selection--single:hover {
    border-color: #80bdff;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

/* Estiliza el dropdown de la lista de opciones */
.select2-container .select2-dropdown {
    border-radius: 0.25rem;
    border: 1px solid #ced4da;
}

</style>

<h4>Entrada de Productos Farmacéuticos</h4>
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
                      <label for="selectPage" class="form-label col-auto mb-2">Listar</label>
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
                        <button type="button" class="d-sm-inline-block btn btn-sm btn-warning shadow-sm" onclick="reporte()">
                          <img src='../imagenes/reporte.ico' style='height: 25px;width: 25px;'>
                        </button>
                      </div>
                      <div class="col-auto mb-2" title="Registrar o Actualizar">
                        <button type="button" class="d-sm-inline-block btn btn-sm btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#ModalRegistro" onclick="ActualizarEntrada('','','','','','','','','','','',
                        '','','','','','','','')">
                          <img src='../imagenes/new.ico' style='height: 25px;width: 25px;'>
                        </button>
                      </div>

                      <div class="col-auto mb-2">
                          <select class="form-select" id="estadoProducto" name="estadoProducto" onchange="Buscar(1)">
                              <option value=''>E. Producto</option>
                              <option value='activo'>Activos</option>
                              <option value='vencido'>Vencidos</option>
                            </select>
                      </div>
                      <div class="col mb-2">
                        <input type="text" name="buscar" id='buscar'class="form-control" placeholder="Buscar....." onkeyup="Buscar(1)">
                      </div>
                    </div>
                    </div>
                    <!-- modal para generar fechas desde seleccionar fechas -->
                    <?php
                    // Obtener la fecha actual en formato YYYY-MM-DD
                      $fechaActual = date('Y-m-d');
                    ?>


                    <div class="modal fade" id="ModalRegistro"  aria-labelledby="miModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
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
                               <div class="row">
                                 <input type="hidden" name="cod_producto"id='cod_producto' value="">
                                 <input type="hidden" name="cod_entrada" id='cod_entrada' value="">
                                 <input type="hidden" name="cod_proveedor" id='cod_proveedor' value="">

                                  <div class="col-md-4 mb-3">
                                    <label for="">N° Doc</label>
                                    <input type="text" name="nrodoc" id='nrodoc' class="form-control" value="">
                                  </div>
                                  <div class="col-md-4 mb-3">
                                    <label for="">Programa de salud</label>
                                    <input type="text" name="programa_salud" id='programa_salud' class="form-control"value="">
                                  </div>
                                  <div class="col-md-4 mb-3">
                                    <label for="">N°</label>
                                    <input type="text" name="nro" id='nro' class="form-control"value="">
                                  </div>
                                  <div class="col-md-4 mb-3">
                                    <label for="">Fuente de reposición</label>
                                    <input type="text" name="fuente_reposicion" id='fuente_reposicion' class="form-control"value="">
                                  </div>
                                  <div class="col-md-4 mb-3">
                                    <label for="">Proveedor es</label>
                                    <select id="proveedor" class="select2-container" style="width: 100%;">
                                        <option value="" disabled selected>Buscar proveedor</option>
                                    </select>
                                  </div>

                                  <div class="col-md-4 mb-3">
                                    <label for="">Representante</label>
                                    <input type="text" name="representante" id='representante' class="form-control"value="" disabled>
                                  </div>

                                  <div class="col-md-4 mb-3">
                                    <label for="">Producto</label>
                                    <select id="nombre_producto" class="select2-container" style="width: 100%;">
                                        <option value="" disabled selected>Buscar Producto</option>
                                    </select>
                                  </div>
                                  <div class="col-md-4 mb-3">
                                    <label for="">Costo valorado</label>
                                    <input type="text" name="costo_valorado" id='costo_valorado' class="form-control"value="">
                                  </div>
                                  <div class="col-md-4 mb-3">
                                    <label for="">Saldo</label>
                                    <input type="text" name="saldo" id='saldo' class="form-control"value="">
                                  </div>
                                  <div class="col-md-4 mb-3">
                                    <label for="">N° de Lote</label>
                                    <input type="text" name="nrolote" id='nrolote' class="form-control"value="">
                                  </div>
                                  <div class="col-md-4 mb-3">
                                    <label for="">Lote Generico</label>
                                    <input type="text" name="lote_generico" id='lote_generico' class="form-control"value="">
                                  </div>
                                  <div class="col-md-4 mb-3">
                                    <label for="">Lote Nacional</label>
                                    <input type="text" name="lote_nacional" id='lote_nacional' class="form-control"value="">
                                  </div>
                                  <div class="col-md-4 mb-3">
                                    <label for="name" class="form-label">Cantidad</label>
                                    <input type="number" class="form-control" id="cantidad" name='cantidad' min='1' value='1' placeholder="Cantidad">
                                  </div>

                                 <div class="col-md-4 mb-3">
                                   <label for="name" class="form-label">Costo Unitario</label>
                                   <input type="number" class="form-control" id="unitario" name='unitario' placeholder="Costo unitario">
                                 </div>
                                 <div class="col-md-4 mb-3">
                                   <label for="name" class="form-label">Costo Total</label>
                                   <input type="number" class="form-control" id="total" name='total' placeholder="Costo Total" disabled>
                                 </div>
                                 <div class="col-md-4 mb-3">
                                   <label for="vencimiento" class="form-label">Vencimiento</label>
                                   <input type="date" class="form-control" id="vencimiento" name='vencimiento' placeholder="Vencimiento">
                                 </div>

                               </div>
                             </form>
                           </div>
                         </div>
                        <!-- Pie de página del modal -->
                      </div>
                        <div class="modal-footer">
                          <button title='Guardar'type="button" class="btn btn-primary" onclick="registrar()"><img src='../imagenes/guardar.ico' style='height: 25px;width: 25px;'></button>
                         <button title='cerrar'type="button" class="btn btn-danger" data-bs-dismiss="modal"><img src='../imagenes/drop.ico' style='height: 25px;width: 25px;'></button>
                        </div>

                      </div>
                    </div>
                  </div>

                    <div class="row" >
                         <div class="col-12">
                           <hr>
                         </div>
                       </div>
                    <div class="verDatos" id="verDatos">
                      <div class="row">
                        <div class="col">
                          <div class="table-responsive">
                          <table class="table" style='font-size:12px'>
                            <thead style="font-size:12px">
                              <tr>
                                <th>N°</th>
                                <th>Código</th>
                                <th>Nombre Genérico</th>
                                <th>Forma farmaceútica</th>
                                <th>Concentración</th>
                                <th>N° de Lote</th>
                                <th>Fecha Vencimiento</th>
                                <th>Cantidad</th>
                                <th>Costo/Unitario</th>
                                <th>Costo/Total</th>
                                <th>Fecha</th>
                                <th>Estado producto</th>
                                <th>Encargado</th>
                                <th>Proveedor y representante</th>
                                <th>Acción</th>
                              </tr>
                            </thead>
                            <tbody style='font-size:12px'>

                        <?php
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
                                $concentra = "";
                                echo "<td>";
                                foreach ($concentracion as $conc) {
                                  echo $conc["concentracion"];
                                  $concentra =$conc['concentracion'];
                                }
                                echo "</td>";
                                echo "<td>".$fi['nrolote']."</td>";
                                echo "<td>".$fi['vencimiento']."</td>";
                                echo "<td>".$fi['cantidad']."</td>";
                                echo "<td>".$fi['costounitario']."</td>";
                                echo "<td>".$fi['costototal']."</td>";
                                echo "<td>".$fi['fecha']."</td>";
                                $son = '';
                                $proveedorRepresentante = $fi["proveedorRepre"];
                                $proveedor =""; $nombresApellidos ="";
                                foreach ($proveedorRepresentante as $prov) {
                                  $son = $prov["nombre"]."-".$prov["nombre_apellidos"];
                                  $proveedor = $prov["nombre"];$nombresApellidos= $prov["nombre_apellidos"];
                                }
                                if($fi['estado_producto'] == 'activo'){
                                  echo "<td style='color:green;background-color:#dbffaf;text-align:center'>".$fi['estado_producto']."</td>";
                                }else if($fi['estado_producto'] == 'vencido'){
                                  echo "<td style='color:red;background-color:#ffc8af;text-align:center'>".$fi['estado_producto']."</td>";
                                }else if($fi['estado_producto'] == 'mes'){
                                  echo "<td style='color:gold;background-color:lightyellow;text-align:center'>Vence en 1 mes</td>";
                                }else if($fi['estado_producto'] == 'menos_mes'){
                                  echo "<td style='color:orange;background-color:cornsilk;text-align:center'>Vence en menos de 1  mes</td>";
                                }
                                echo "<td>".$fi['nombre_usuario']." ".$fi["ap_usuario"]."</td>";
                                echo "<td>".$son."</td>";
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
                                  echo "<button type='button' class='btn btn-info' title='$title' onclick='ActualizarEntrada(\"".$fi["cod_generico"]."\",\"".$fi["cod_entrada"]."\",\"".$fi["cod_proveedor"]."\",
                                  \"".$fi["nrodoc"]."\",\"".$fi["programa_salud"]."\",\"".$fi["nro"]."\"
                                  , \"".$fi["fuente_reposicion"]."\",
                                  \"".$son."\",\"".$nombresApellidos."\",\"".$unir."\",\"".$fi["costo_valorado"]."\",\"".$fi["saldo"]."\",
                                  \"".$fi["nrolote"]."\",\"".$fi["lote_generico"]."\",\"".$fi["lote_nacional"]."\",\"".$fi["cantidad"]."\",\"".$fi["costounitario"]."\",\"".$fi["costototal"]."\",
                                  \"".$fi["vencimiento"]."\")' data-bs-toggle='modal' data-bs-target='#ModalRegistro' $enable><img src='../imagenes/edit.ico' height='17' width='17' class='rounded-circle'></button>";
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
<script type="text/javascript">
  // Seleccionamos el campo de entrada por su ID
  var unitario1 = document.getElementById("unitario");
  var cantidad1 = document.getElementById("cantidad");
  // Asignamos la función al evento onkeyup del elemento
  unitario.onkeyup = funcionCalcular;
  cantidad.onkeyup = funcionCalcular;
  function funcionCalcular(){
    var unitarioValor = unitario1.value * cantidad1.value;
    // Calculamos el total y lo asignamos al campo 'total'
    document.getElementById("total").value = unitarioValor.toFixed(2);
    //alert(document.getElementById("total").value+" ,");
  }

  $(document).ready(function() {
    $('#proveedor').select2({
        dropdownParent: $('#ModalRegistro'), // Mantiene el dropdown dentro del modal
        placeholder: "Buscar proveedor",
        ajax: {
            url:"../controlador/farmacia.controlador.php?accion=bupr", // Archivo PHP que procesará la búsqueda
            type: 'POST',
            dataType: 'json',
            delay: 250, // Tiempo de espera en ms para la solicitud AJAX
            data: function(params) {
              //alert(params.term);
                return {
                    proveedor: params.term // Término de búsqueda ingresado por el usuario
                };
            },
            processResults: function(data) {

                return {
                    results: $.map(data, function(item) {
                        return {
                            id: item.cod_prov, // ID del proveedor desde la BD
                            text: item.nombre+" - "+item.nombre_apellidos, // Nombre del proveedor desde la BD
                            cod_proveedor: item.cod_prov,
                            nombre_apellidos: item.nombre_apellidos
                        };
                    })
                };
            },

            cache: true,
            success: function(response) {
            console.log("Respuesta recibida desde el servidor:", response);
          },
          error: function(xhr, status, error) {
            console.error("Error en la solicitud:", error);
            console.log("Detalles del error:", xhr.responseText);
            //alert("Ocurrió un error al obtener los datos. Revisa la consola para más detalles.");
        }
        },
        minimumInputLength: 1 // Mínimo de caracteres antes de hacer la búsqueda
    }).on('select2:select', function(e) { // Evento de selección dentro del bloque select2
        var selectedData = e.params.data; // Obtiene los datos seleccionados
        $('#cod_proveedor').val(selectedData.cod_proveedor); // Coloca el cod_prov en el input deseado
        $('#representante').val(selectedData.nombre_apellidos); //
    });
  });

  $(document).ready(function() {
    $('#nombre_producto').select2({
        dropdownParent: $('#ModalRegistro'), // Mantiene el dropdown dentro del modal
        placeholder: "Buscar nombre producto",
        ajax: {
            url: "../controlador/farmacia.controlador.php?accion=bcp",
            type: "POST",
            dataType: 'json',
            delay: 250, // Tiempo de espera en ms para la solicitud AJAX
            data: function(params) {
              //alert(params.term);
                return {
                    cod_producto: params.term // Término de búsqueda ingresado por el usuario
                };
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            id: item.cod_generico, // ID del proveedor desde la BD
                            text: item.nombre+" - "+item.nombre_forma+" - "+item.concentracion, // Nombre del proveedor desde la BD
                            cod_producto: item.cod_generico,
                            nombre_apellidos: item.nombre_apellidos
                        };
                    })
                };
            },

            cache: true,
            success: function(response) {
            console.log("Respuesta recibida desde el servidor:", response);
          },
          error: function(xhr, status, error) {
            console.error("Error en la solicitud:", error);
            console.log("Detalles del error:", xhr.responseText);
            //alert("Ocurrió un error al obtener los datos. Revisa la consola para más detalles.");
        }
        },
        minimumInputLength: 1 // Mínimo de caracteres antes de hacer la búsqueda
    }).on('select2:select', function(e) { // Evento de selección dentro del bloque select2
        var selectedData = e.params.data; // Obtiene los datos seleccionados
        $('#cod_producto').val(selectedData.cod_producto); // Coloca el cod_prov en el input deseado
    });
  });

function Buscar(page){
    var obt_lis = document.getElementById("selectList").value;
    var listarDeCuanto = verificarList(obt_lis);
    var buscar = document.getElementById("buscar").value;
    document.getElementById("paginas").value=page;
    var fechai=document.getElementById("fechai").value;
    var fechaf=document.getElementById("fechaf").value;
    var estadoProducto=document.getElementById("estadoProducto").value;
    //alert(buscar);
    //ponerFechactualAlModalDeReporte(listarDeCuanto,buscar,page,fecha);
    var datos = new FormData(); // Crear un objeto FormData vacío
    datos.append('pagina', page);
    datos.append('listarDeCuanto',listarDeCuanto);
    datos.append("buscar",buscar);
    datos.append("fechai",fechai);
    datos.append("fechaf",fechaf);
    datos.append("estadoProducto",estadoProducto);
      $.ajax({
        url: "../controlador/farmacia.controlador.php?accion=bft",
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
  /*  var cod_producto = document.getElementById("cod_producto").value;
    var cantidad = document.getElementById("cantidad").value;
    var vencimiento = document.getElementById("vencimiento").value;
    var cod_entrada = document.getElementById("cod_entrada").value;*/

    var cod_producto = document.getElementById("cod_producto").value;
    var cod_entrada = document.getElementById("cod_entrada").value;
    var cod_proveedor = document.getElementById("cod_proveedor").value;
    var nrodoc = document.getElementById("nrodoc").value;
    var programa_salud = document.getElementById("programa_salud").value;
    var nro = document.getElementById("nro").value;
    var fuente_reposicion = document.getElementById("fuente_reposicion").value;
    var proveedor = document.getElementById("proveedor").value;
    var representante = document.getElementById("representante").value;
    var nombre_producto = document.getElementById("nombre_producto").value;
    var costo_valorado = document.getElementById("costo_valorado").value;
    var saldo = document.getElementById("saldo").value;
    var nrolote = document.getElementById("nrolote").value;
    var lote_generico = document.getElementById("lote_generico").value;
    var lote_nacional = document.getElementById("lote_nacional").value;
    var cantidad = document.getElementById("cantidad").value;
    var unitario = document.getElementById("unitario").value;
    var total = document.getElementById("total").value;
    var vencimiento = document.getElementById("vencimiento").value;
    if(cod_producto == "" || cantidad == "" ||vencimiento=="" || unitario=="" || cod_proveedor==""){
      Vacio();
      return;
    }
    var datos = new FormData(); // Crear un objeto FormData vacío
    datos.append("cod_producto",cod_producto);
    datos.append("cod_entrada",cod_entrada);
    datos.append("cod_proveedor",cod_proveedor);
    datos.append("nrodoc",nrodoc);
    datos.append("programa_salud",programa_salud);
    datos.append("nro",nro);
    datos.append("fuente_reposicion",fuente_reposicion);
    datos.append("proveedor",proveedor);
    datos.append("representante",representante);
    datos.append("nombre_producto",nombre_producto);
    datos.append("costo_valorado",costo_valorado);
    datos.append("saldo",saldo);
    datos.append("nrolote",nrolote);
    datos.append("lote_generico",lote_generico);
    datos.append("lote_nacional",lote_nacional);
    datos.append("cantidad",cantidad);
    datos.append("unitario",unitario);
    datos.append("total",total);
    datos.append("vencimiento",vencimiento);
    var r = VerificarFechaVencimiento(vencimiento);
    if(r == 1){//si es 1 lo cortamos y esto quiere decir que se ingreso una fecha menor a la fecha actual
      FechaNoValida();
      return;
    }
      $.ajax({
        url: "../controlador/farmacia.controlador.php?accion=rpe",
        type: "POST",
        data: datos,
        contentType: false, // Deshabilitar la codificación de tipo MIME
        processData: false, // Deshabilitar la codificación de datos
        success: function(data) {
        //alert(data+"dasdas");
          if(data == 'ya_se_uso'){
            usado();
          }else if(data == 'correcto'){
            Correcto();
          }else if(data == 'error'){
            Error1();
          }else{
            cod_entrada='';
          }
          IRalLink(cod_entrada);
        }
      });
  }

  function VerificarFechaVencimiento(vencimiento){
    // Convertir la fecha del campo y la fecha actual a objetos Date
    const fechaSeleccionada = new Date(vencimiento);
    const fechaActual = new Date();

    // Eliminar la parte de tiempo de la fecha actual para comparar solo las fechas
    fechaActual.setHours(0, 0, 0, 0);

    // Comparar las fechas
    if (fechaSeleccionada <= fechaActual) {
      return 1;
    }else{
      return 0;
    }
  }

      function FechaNoValida(){
        Swal.fire({
         icon: 'info',
         title: '¡Información!',
         text: '¡Fecha de vencimiento no valida!',
         showConfirmButton: false,
         timer: 3000
       });
      }

    function usado(){
      Swal.fire({
       icon: 'info',
       title: '¡Información!',
       text: '¡No se pudo actualizar porque ya se utilizo, le pido que registre como nuevo!',
       showConfirmButton: false,
       timer: 3000
     });
    }

      function usado2(){
          Swal.fire({
           icon: 'info',
           title: '¡Información!',
           text: '¡No se pudo Desactivar, porque ya se uso la cantidad registrada!',
           showConfirmButton: false,
           timer: 3000
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

  function IRalLink(cod_entrada){
    if(cod_entrada!=''){
      setTimeout(() => {
        var pagina = document.getElementById("paginas").value;
        if(pagina==''){pagina=1;}
        Buscar(pagina);
        document.getElementById("cod_entrada").value='';
        document.getElementById("cod_producto").value='';
        document.getElementById("cantidad").value='';
        document.getElementById("vencimiento").value='';
        $('#ModalRegistro').modal('hide');
      }, 1500);
    }else{
      setTimeout(() => {
        location.href="../controlador/farmacia.controlador.php?accion=vpf";
        $('#ModalRegistro').modal('hide');
      }, 1500);
    }
  }


  function ActualizarEntrada(cod_producto,cod_entrada,cod_proveedor,nrodoc,programa_salud,nro,fuente_reposicion,proveedor,representante,nombre_producto,costo_valorado,
  saldo,nrolote,lote_generico,lote_nacional,cantidad,unitario,total,vencimiento){
    document.getElementById("cod_producto").value=cod_producto;
    document.getElementById("cod_entrada").value=cod_entrada;
    document.getElementById("cod_proveedor").value=cod_proveedor;
    document.getElementById("nrodoc").value=nrodoc;
    document.getElementById("programa_salud").value=programa_salud;
    document.getElementById("nro").value=nro;
    document.getElementById("fuente_reposicion").value=fuente_reposicion;
    // Usar .val() para pre-seleccionar el proveedor en select2

    $("#proveedor").find("option[value='" + proveedor + "']").length ||
      $("#proveedor").append(new Option(proveedor, proveedor, true, true));
    $("#proveedor").val(proveedor).trigger('change');
    document.getElementById("representante").value=representante;

    $("#nombre_producto").find("option[value='" + nombre_producto + "']").length ||
      $("#nombre_producto").append(new Option(nombre_producto, nombre_producto, true, true));
    $("#nombre_producto").val(nombre_producto).trigger('change');
    document.getElementById("costo_valorado").value=costo_valorado;
    document.getElementById("saldo").value=saldo;

    document.getElementById("nrolote").value=nrolote;
    document.getElementById("lote_generico").value=lote_generico;
    document.getElementById("lote_nacional").value=lote_nacional;
    document.getElementById("cantidad").value=cantidad;
    document.getElementById("unitario").value=unitario;
    document.getElementById("total").value=total;
    document.getElementById("vencimiento").value=vencimiento;
  }
        function accionBtnActivar(accion,pagina,listarDeCuanto,buscar,cod_entrada,fechai,fechaf){
          var estadoProducto=document.getElementById("estadoProducto").value;
          var buscar = document.getElementById("buscar").value;
          var datos = new FormData(); // Crear un objeto FormData vacío
          datos.append('accion', accion);
          datos.append("pagina",pagina);
          datos.append("listarDeCuanto",listarDeCuanto);
          datos.append("buscar",buscar);
          datos.append("fechai",fechai);
          datos.append("fechaf",fechaf);
          datos.append("estadoProducto",estadoProducto);
          datos.append("cod_entrada",cod_entrada);
          //alert(accion+"   "+buscar+"    "+cod_generico);
        //  alert(cod_entrada);
          $.ajax({
            url: "../controlador/farmacia.controlador.php?accion=dbe",
            type: "POST",
            data: datos,
            contentType: false, // Deshabilitar la codificación de tipo MIME
            processData: false, // Deshabilitar la codificación de datos
            success: function(data) {
      //  alert(data+"dasdas");
              data=$.trim(data);
              if(data == "error"){
                error();
              }else if(data == 'ya_se_uso'){
                usado2();
              }else{
                $("#verDatos").html(data);
              }
            }
          });
        }

      function error(){
        Swal.fire({
         icon: 'error',
         title: '¡Error!',
         text: '¡Ocurrio un error!',
         showConfirmButton: false,
         timer: 1500
       });
      }
      function reporte(){
        var buscar = document.getElementById("buscar").value;
        var fechai = document.getElementById("fechai").value;
        var fechaf = document.getElementById("fechaf").value;
        var estadoProducto = document.getElementById("estadoProducto").value;
        var form = document.createElement('form');
         form.method = 'post';
         form.action = '../controlador/farmacia.controlador.php?accion=rpng'; // Coloca la URL de destino correcta
         // Agregar campos ocultos para cada dato
         var datos = {
           buscar:buscar,
           fechai:fechai,
           fechaf:fechaf,
           estadoProducto:estadoProducto
         };
         for (var key in datos) {
             if (datos.hasOwnProperty(key)) {
                 var input = document.createElement('input');
                 input.type = 'hidden';
                 input.name = key;
                 input.value = datos[key];
                 form.appendChild(input);
             }
         }
       // Agregar el formulario al cuerpo del documento y enviarlo
       document.body.appendChild(form);
       form.submit();
      }
//funcion para buscar proveedorFK1
// Variable para verificar si Select2 ya ha sido inicializado

/*let select2Inicializado = false;

function buscarProveedor() {
    // Obtén el valor del campo "proveedor"
    var proveedor = document.getElementById("proveedor").value;

    // Verifica que el campo tenga un valor y que Select2 no esté ya inicializado
    if (proveedor !== "" && !select2Inicializado) {
        // Inicializa Select2
        $('#proveedor').select2({
            placeholder: "Selecciona un proveedor",
            allowClear: true,
            ajax: {
                url: "../controlador/farmacia.controlador.php?accion=bcp", // URL del archivo PHP
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    // Pasar el valor del proveedor al backend
                    return {
                        proveedor: proveedor // usa el valor actual del input "proveedor"
                    };
                },
                processResults: function(data) {
                    // Mapea los datos y crea el formato personalizado
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.cod_prov,
                                text: `${item.nombre} - ${item.nombre_apellidos}`
                            };
                        })
                    };
                },
                cache: true
            }
        });

        // Marca Select2 como inicializado
        select2Inicializado = true;

        // Abre el menú desplegable después de inicializarlo
        $('#proveedor').select2('open');

        // Maneja la selección de un proveedor
        $('#proveedor').on('select2:select', function(e) {
            var selectedData = e.params.data;
            document.getElementById("cod_proveedor").value = selectedData.id;
            document.getElementById("proveedor").value = selectedData.text;
        });
    }
}

$('#ModalRegistro').on('shown.bs.modal', function () {
       $('#mibuscador').select2({
           placeholder: "Seleccione un país",
           allowClear: true
       });
   });*/
</script>

<?php require("../librerias/footeruni.php"); ?>
