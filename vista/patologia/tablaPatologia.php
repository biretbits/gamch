<?php require("../librerias/headeradmin1.php"); ?>

<div class="container main-content">
<div class="container">
<h4>Registros del Patologias</h4>
<div class="row" >
     <div class="col-12">
       <hr>
     </div>
   </div>


          <div class="row">
              <div class="col-lg-12">
                  <!-- Mashead text and app badges-->
                  <div class="sticky-col">

                   <br>
                  </div>

                </div>
                  <!-- Masthead device mockup feature-->
                  <div class="masthead-device-mockup">
                    <input type="hidden" name="cod_generico" id="cod_generico" value="<?php $ms = (isset($paciente_rd) && is_numeric($paciente_rd))? $paciente_rd:""; echo $ms; ?>">
                    <input type="hidden" name="paginas" id='paginas' value="">
                    <div class="row align-items-center">
                      <label for="selectPage" class="form-label col-auto mb-2">Page</label>
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

                      </div>

                      <div class="col-auto mb-2" title="Reporte">
                        <button type="button" class="d-sm-inline-block btn btn-sm btn-warning shadow-sm" onclick="reporte()">
                          <img src='../imagenes/reporte.ico' style='height: 25px;width: 25px;'>
                        </button>
                      </div>
                      <div class="col-auto mb-2" title="Registro o actualizar">
                        <button type="button" class="d-sm-inline-block btn btn-sm btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#ModalRegistro"
                        onclick="ActualizarNombreGenerico('','','','','')">
                          <img src='../imagenes/new.ico' style='height: 25px;width: 25px;'>
                        </button>
                      </div>

                      <div class="col-auto mb-2">
                        <!-- espacio vacío para mantener el diseño intacto -->
                      </div>
                      <div class="col mb-2">
                        <input type="text" name="buscar" id='buscar'class="form-control" placeholder="Buscar por /nombre/descripción" onkeyup="Buscar(1)">
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
                          <h6 class="modal-title" id="miModalRegistro">Registro o Actualización de Patologias</h6>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- Contenido del modal -->
                        <div class="modal-body">
                          <div class="card shadow-lg">
                           <div class="card-body">
                            <form class="form-inline" >
                              <div class="row mb-3">
                                <div class="input-group">
                                  <input type="hidden" class="form-control"name="cod_pat" id='cod_pat' value="">
                                </div>
                              </div>
                              <div class="row mb-3">
                                <label for="">Nombre de patología</label>
                                <div class="input-group">
                                  <input type="text" class="form-control"name="nombre" id='nombre'value="" placeholder="Ponga la patología">
                                </div>
                              </div>
                              <div class="row mb-3">
                                <label for="">Descripción</label>
                                <div class="input-group">
                                  <textarea name="descripcion" id='descripcion' rows="8" cols="80" class="form-control"></textarea>
                                </div>
                              </div>
                              <div class="row mb-3">
                                <label for="">Sintomas</label>
                                <div class="input-group">
                                  <input type="text" class="form-control"name="sintomas" id='sintomas'value="" placeholder="Ponga el sintomas de la patología">
                                </div>
                              </div>
                              <div class="row mb-3">
                                <label for="">Tratamiento</label>
                                <div class="input-group">
                                  <input type="text" class="form-control"name="tratamiento" id='tratamiento'value="" placeholder="Ponga el tratamiento">
                                </div>
                              </div>

                            </form>
                         </div>

                      </div>
                   </div>
                        <!-- Pie de página del modal -->
                        <div class="modal-footer">
                          <button title='Guardar'type="button" class="btn btn-primary" onclick="registrar()"><img src='../imagenes/guardar.ico' style='height: 25px;width: 25px;'></button>
                         <button title='cerrar'type="button" class="btn btn-danger" data-bs-dismiss="modal"><img src='../imagenes/drop.ico' style='height: 25px;width: 25px;'></button>
                         </div>
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
                          <table class="table">
                            <thead style="font-size:12px">
                              <tr>
                                <th>N°</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Sintomas</th>
                                <th>Tratamiento</th>
                                <th>Fecha</th>
                                <th>Acción</th>
                              </tr>
                            </thead>
                            <tbody>

                        <?php

                        if (mysqli_num_rows($resul) > 0){
                            $i = $inicioList;
                          while($fi=mysqli_fetch_array($resul)){
                              echo "<tr>";
                                echo "<td>".($i+1)."</td>";
                                echo "<td>".$fi['nombre']."</td>";
                                echo "<td>".$fi['descripcion']."</td>";
                                echo "<td>".$fi['sintomas']."</td>";
                                echo "<td>".$fi['tratamiento']."</td>";
                                echo "<td>".$fi['fecha_registro']."</td>";
                                echo "<td>";
                                  echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>";
                                  $dd = "<button type='button' class='btn btn-info' title='Editar' onclick='ActualizarNombreGenerico(".$fi["cod_pat"].",\"".$fi["nombre"]."\",
                                  \"".$fi["descripcion"]."\",\"".$fi["sintomas"]."\",\"".$fi["tratamiento"]."\",\"".$fi["fecha_registro"]."\")' data-bs-toggle='modal' data-bs-target='#ModalRegistro'><img src='../imagenes/edit.ico' height='17' width='17' class='rounded-circle'></button>";
                                  echo $dd;
                                  if($fi["estado"] == 'activo'){
                                    echo "<button type='button' class='btn btn-danger' title='Desactivar' onclick='accionBtnActivar(".$fi["cod_pat"].",\"".$fi["estado"]."\")'><img src='../imagenes/drop.ico' height='17' width='17' class='rounded-circle'></button>";
                                  }else{
                                    echo "<button type='button' class='btn btn-danger' title='Activar' onclick='accionBtnActivar(".$fi["cod_pat"].",\"".$fi["estado"]."\")'><img src='../imagenes/activar.ico' height='17' width='17' class='rounded-circle'></button>";
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
    //alert(buscar);
    //ponerFechactualAlModalDeReporte(listarDeCuanto,buscar,page,fecha);
    var datos = new FormData(); // Crear un objeto FormData vacío
    datos.append('pagina', page);
    datos.append('listarDeCuanto',listarDeCuanto);
    datos.append("buscar",buscar);
      $.ajax({
        url: "../controlador/patologias.controlador.php?accion=bpt",
        type: "POST",
        data: datos,
        contentType: false, // Deshabilitar la codificación de tipo MIME
        processData: false, // Deshabilitar la codificación de datos
        success: function(data) {
        //  alert(data+"dasdas");
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
      var cod_pat = document.getElementById("cod_pat").value;
      var nombre = document.getElementById("nombre").value;
      var descripcion = document.getElementById("descripcion").value;
      var sintomas = document.getElementById("sintomas").value;
      var tratamiento = document.getElementById("tratamiento").value;

      var datos = new FormData(); // Crear un objeto FormData vacío
      datos.append("cod_pat",cod_pat);
      datos.append("nombre",nombre);
      datos.append("descripcion",descripcion);
      datos.append("sintomas",sintomas);
      datos.append("tratamiento",tratamiento);

        $.ajax({
          url: "../controlador/patologias.controlador.php?accion=rpat",
          type: "POST",
          data: datos,
          contentType: false, // Deshabilitar la codificación de tipo MIME
          processData: false, // Deshabilitar la codificación de datos
          success: function(data) {
            //alert(data+"dasdas");
            if(data == 'correcto'){
              Correcto();
            }else{
              Error1();
            }
            IRalLink(cod_pat);
          }
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

    function IRalLink(cod_pat){
      //alert(cod_pat);
      if(cod_pat!=''){//existe
        setTimeout(() => {
          var pagina = document.getElementById("paginas").value;
          if(pagina==''){pagina=1;}
          Buscar(pagina);
          document.getElementById("cod_pat").value='';
          document.getElementById("nombre").value='';
          document.getElementById("descripcion").value='';
          document.getElementById("sintomas").value='';
          document.getElementById("tratamiento").value='';
            $('#ModalRegistro').modal('hide');
        }, 1500);
      }else{
        setTimeout(() => {
          location.href="../controlador/patologias.controlador.php?accion=vtp";
            $('#ModalRegistro').modal('hide');
        }, 1500);
      }
    }
    function ActualizarNombreGenerico(cod_pat,nombre,descripcion,sintomas,tratamiento,fecha_registro){
      document.getElementById("cod_pat").value=cod_pat;
      document.getElementById("nombre").value=nombre;
      document.getElementById("descripcion").value=descripcion;
      document.getElementById("sintomas").value=sintomas;
      document.getElementById("tratamiento").value=tratamiento;
    }
    function reporte(){
      var buscar = document.getElementById("buscar").value;
      var form = document.createElement('form');
       form.method = 'post';
       form.action = '../controlador/patologias.controlador.php?accion=reppat'; // Coloca la URL de destino correcta
       // Agregar campos ocultos para cada dato
       var datos = {
         buscar:buscar,
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

    function accionBtnActivar(cod_pat,estado){
        var datos = new FormData(); // Crear un objeto FormData vacío
        datos.append("cod_pat",cod_pat);
        datos.append("estado",estado);
        //alert(cod_cons);
        //alert(estado+"  "+cod_pat);
          $.ajax({
            url: "../controlador/patologias.controlador.php?accion=DcP",
            type: "POST",
            data: datos,
            contentType: false, // Deshabilitar la codificación de tipo MIME
            processData: false, // Deshabilitar la codificación de datos
            success: function(data) {
              //alert(data+"dasdas");
              if(data == 'correcto'){
                Correcto();
                IRalLink(cod_pat);
              }else{
                Error1();
              }
            }
          });
    }
  </script>
<?php require("../librerias/footeruni.php"); ?>
