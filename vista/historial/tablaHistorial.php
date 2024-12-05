<?php require("../librerias/headeradmin1.php"); ?>
<?php $tablahis=$_SERVER["REQUEST_URI"];
      $diario = $_SESSION["diario"];
      $_SESSION['this']=$tablahis;
      $fi = mysqli_fetch_array($re);
      $fecha_nac_paciente1 = $fi['fecha_nac_usuario'];$sexo_paciente1 = $fi["sexo_usuario"];$ocupacion_paciente1=$fi["ocupacion_usuario"];
      $estado_civil_paciente1 = $fi["estado_civil_usuario"];$escolaridad_paciente1 = $fi["escolaridad_usuario"];
      $zona_his1='';
      if ($resul7 && count($resul7) > 0){
        $i = 0;
        foreach ($resul7 as $fi){
          $zona_his1 = $fi["zona_his"];
        }
      }

?>

<div class="container main-content">
<div class="container">
  <div class="row" >
     <div class="col-12">
       <hr>
     </div>
   </div>
  <h4>Historial Clinico</h4>
  <input type="hidden" name="paginas" id='paginas' value="">
  <input type="hidden" name="paciente_rd" id="paciente_rd" value="<?php $ms = (isset($paciente_rd) && is_numeric($paciente_rd))? $paciente_rd:""; echo $ms; ?>">
  <input type="hidden" name="cod_rd" id= "cod_rd" value="<?php $ms = (isset($cod_rd) && is_numeric($cod_rd))? $cod_rd:""; echo $ms; ?>">
  <div class="row align-items-center">
    <label for="selectPage" class="form-label col-auto mb-2">Page</label>
    <div class="col-auto mb-2">
      <select class="form-select" id="selectList" name="selectList" onchange="BuscarRegistrosHistorial(1)">
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


    <div class="col-auto mb-2" title="Nuevo historial">
      <button type="button" class="d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-bs-toggle="modal"
        data-bs-target="#ModalReporteNuevoHistorial" onclick="actualizarhistorialNuevo('','','')">
          <img src='../imagenes/nuevo_historial.png' style='height: 25px;width: 25px;'>
      </button>
    </div>

    <!--<div class="col-auto mb-2" title="Registro de nuevo historial">
      <div class="col-auto mb-2" title="Registrar o Actualizar">
        <button type="button" class="d-sm-inline-block btn btn-sm btn-success shadow-sm" data-bs-toggle="modal"
        data-bs-target="#ModalRegistro"
        onclick="ActualizarHistorial('',<?php //echo $cod_rd; ?>,<?php //echo $paciente_rd; ?>,'','','','',
        '','','','','','',''
        ,'','','<?php //echo $zona_his1; ?>','<?php //echo $fecha_nac_paciente1; ?>','<?php //echo $sexo_paciente1; ?>'
        ,'<?php //echo $ocupacion_paciente1;?>','<?php //echo $estado_civil_paciente1; ?>',
        '<?php //echo $escolaridad_paciente1; ?>','')" <?php //if(count($resul)>0){ echo "disabled";}else{echo "enabled";} ?>>
          <img src='../imagenes/historialClinico.ico' style='height: 25px;width: 25px;'>
        </button>
      </div>
    </div>-->

    <!--<div class="col-auto mb-2" title="Registro de Consulta">
      <div class="col-auto mb-2" title="Registro de Consulta">
        <button type="button" class="d-sm-inline-block btn btn-sm btn-danger shadow-sm" data-bs-toggle="modal"
        data-bs-target="#ModalRegistroMotivoConsulta"
        <?php //if(count($resul)>0){ echo "enable";}else{echo "disabled";} ?>>
          <img src='../imagenes/historialClinico.ico' style='height: 25px;width: 25px;'>
        </button>
      </div>
    </div>-->

    <div class="col-auto mb-2" title="Registro de archivo">
        <button type="button" class="d-sm-inline-block btn btn-sm btn-info shadow-sm" data-bs-toggle="modal"
        data-bs-target="#ModalRegistroDocumentos"
        onclick="actualizarImagen('','','','','','')">
          <img src='../imagenes/file.png' style='height: 25px;width: 25px;'>
        </button>
    </div>

    <div class="col-auto mb-2" title="Reporte">
      <button type="button" class="d-sm-inline-block btn btn-sm btn-warning shadow-sm"  onclick="GenerarReporte()">
        <img src='../imagenes/reporte.ico' style='height: 25px;width: 25px;'>
      </button>
    </div>
    <div class="col-auto mb-2">
      <!-- espacio vacío para mantener el diseño intacto -->
    </div>
    <div class="col mb-2">
      <input type="date" class="form-control"name="fecha"id='fecha' value="" onchange="BuscarRegistrosHistorial(1)">
    </div>

    <div class="col-auto mb-2">
      <input type="Text" name="buscar" id="buscar" value="" class="form-control" onkeyup="BuscarRegistrosHistorial(1)">
    </div>
  </div>
  </div>
  <!-- modal para generar fechas desde seleccionar fechas -->
  <?php
  // Obtener la fecha actual en formato YYYY-MM-DD
    $fechaActual = date('Y-m-d');
  ?>
  <!--registrar un nuevo historial--->
  <div class="modal fade" id="ModalReporteNuevoHistorial" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="miModalLabel">Registro o actualización de un nuevo Historial</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Contenido del modal -->
        <div class="modal-body">
          <div class="card">
          <div class="card-body">
          <form class="form-inline" >
            <div class="row">
              <input type="hidden" name="subnombre" id='subnombre' value="">
              <input type="hidden" name="cod_his_his" id='cod_his_his' value="">

              <div class="col-12 mb-3">
                <label class="form-label">Nombre del historial</label>
                <input type="text" class="form-control" id='nombre_historial' name="nombre_historial" placeholder="Ingrese el nombre del historial">
              </div>
            </div>
          </div>
          </div>
          </form>
        </div>
        <!-- Pie de página del modal -->
        <div class="modal-footer">
          <button type="button"  class="btn btn-success" title = 'Registrar un nuevo Historial' onclick="RegistrarNuevoHistorial()"><img src='../imagenes/aceptar.ico' style='height: 25px;width: 25px;'> Guardar</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><img src='../imagenes/drop.ico' style='height: 25px;width: 25px;'></button>
        </div>

      </div>
    </div>
  </div>

  <!--Modal de registro de motivos de consultas-->
  <div class="modal fade" id="ModalRegistroMotivoConsulta" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="miModalRegistro">Registro o Actualización de motivo de consulta</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Contenido del modal -->
      <div class="modal-body">
        <div class="card">
          <div class="card-header">

          </div>
          <div class="card-body">
            <form>

              <input type="hidden" name="cod_usuario_consulta"  id = "cod_usuario_medico" value="">
              <input type="hidden" name="cod_historial_consulta" id='cod_historial_consulta' value="">
              <div class="row">

                <div class="col-md-4 mb-3">
                  <label  class="form-label">Talla</label>
                  <input type="number" class="form-control" id="talla" placeholder="Ingrese la talla">
                </div>
                <div class="col-md-4 mb-3">
                  <label  class="form-label">Peso</label>
                  <input type="number" class="form-control" id="peso" placeholder="Ingrese el peso">
                </div>
                <div class="col-md-4 mb-3">
                  <label  class="form-label">IMC</label>
                  <input type="text" class="form-control" id="imc" placeholder="Ingrese IMC">
                </div>

                <div class="col-md-4 mb-3">
                  <label  class="form-label">Temperatura</label>
                  <input type="text" class="form-control" id="temperatura" placeholder="Ingrese la temperatura">
                </div>
                <div class="col-md-4 mb-3">
                  <label  class="form-label">F.C.</label>
                  <input type="text" class="form-control" id="fc" placeholder="Ingrese fc">
                </div>
                <div class="col-md-4 mb-3">
                  <label  class="form-label">P.A.</label>
                  <input type="text" class="form-control" id="pa" placeholder="Ingrese el pa">
                </div>
                <div class="col-md-4 mb-3">
                  <label  class="form-label">F.R.</label>
                  <input type="text" class="form-control" id="fr" placeholder="Ingrese el fr">
                </div>

                <div class="col-md-4 mb-3">
                </div>
                <div class="col-md-6 mb-3">
                  <label  class="form-label">Motivo de consulta</label>
                  <textarea class='form-control' id='motivo_consulta'></textarea>
                </div>
                <div class="col-md-6 mb-3">
                  <label  class="form-label">Subjetivo</label>
                  <textarea class='form-control' id='subjetivo'></textarea>
                </div>

                <div class="col-md-6 mb-3">
                  <label  class="form-label">Objetivo</label>
                  <textarea class='form-control' id='objetivo'></textarea>
                </div>

                <div class="col-md-6 mb-3">
                  <label  class="form-label">Analisis</label>
                  <textarea class='form-control' id='analisis'></textarea>
                </div>

                <div class="col-md-6 mb-3">
                  <label  class="form-label">Tratamiento</label>
                  <textarea class='form-control' id='tratamiento'></textarea>
                </div>
                <div class="col-md-6 mb-3">
                  <label  class="form-label">Evaluación de seguimiento</label>
                  <textarea class='form-control' id='evaluacion_seguimiento'></textarea>
                </div>
                <div class="col-md-4 mb-3">
                  <label  class="form-label">Fecha</label>
                  <input type="date" class="form-control" id="fecha_consulta" placeholder="Ingrese la fecha de consulta">
                </div>

                <div class="col-md-4 mb-3">
                  <label  class="form-label">Hora</label>
                  <input type="time" class="form-control" id="hora_consulta" placeholder="Ingrese la hora de consulta">
                </div>

                <div class="col-md-4 mb-3">
                  <label  class="form-label">Medico responsable</label>
                  <input type="text" class="form-control" id="medico_responsable" placeholder="Medico responsable" onkeyup="buscarMedico()">
                  <div id="resultado13" align='left' class='alert alert-light mb-0 py-0 border-0 encimaElTexto'></div>
                </div>
              </div>
              </div>
            </form>
          </div>

        </div><!--car fin 2-->
        <div class="modal-footer">
          <button title='Guardar'type="button" class="btn btn-primary" onclick="registrarHistorialConsulta()"><img src='../imagenes/guardar.ico' style='height: 25px;width: 25px;'></button>
         <button title='cerrar'type="button" class="btn btn-danger" data-bs-dismiss="modal"><img src='../imagenes/drop.ico' style='height: 25px;width: 25px;'></button>
        </div>
      </div><!--fin del modal-->

      </div>

    </div>


  <!--end-->
  <div class="modal fade" id="ModalRegistro" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="miModalRegistro">Registro o Actualización del historial del paciente</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Contenido del modal -->
      <div class="modal-body">
        <div class="card">
          <div class="card-header">
            RESPONSABLE DE FAMILIA
          </div>
          <div class="card-body">
            <form>
              <input type="hidden" name="paciente_rd" id="paciente_rd" value="<?php $m = (isset($paciente_rd) && is_numeric($paciente_rd))? $paciente_rd: ""; echo $m; ?>">
              <input type="hidden" name="cod_rd" id="cod_rd" value="<?php $m = (isset($cod_rd) && is_numeric($cod_rd))? $cod_rd:"";echo $m;  ?>">
              <input type="hidden" name="cod_usuario" id = "cod_usuario" value="">
              <input type="hidden" name="cod_historial"id='cod_historial' value="">
              <div class="row">
                <div class="col-md-4 mb-3">
                  <label  class="form-label">Nombre de Responsable</label>
                  <input type="text" class="form-control" id="Nombre_responsable" placeholder="Nombre de Responsable" onkeyup='buscarExitepaciente()'>
                  <div id="resultado12" align='left' class='alert alert-light mb-0 py-0 border-0'>
                  </div>
                </div>
                <div class="col-md-4 mb-3">
                  <label  class="form-label">Apellido paterno del Responsable</label>
                  <input type="text" class="form-control" id="ap_responsable" placeholder="Ingresa Apellido paterno">
                </div>
                <div class="col-md-4 mb-3">
                  <label  class="form-label">Apellido materno</label>
                  <input type="text" class="form-control" id="am_responsable" placeholder="Ingresa Apellido materno">
                </div>
                <div class="col-md-4 mb-3">
                  <label  class="form-label">Fecha de Nacimiento del Responsable</label>
                  <input type="date" class="form-control" id="fecha_nacimiento_responsable" placeholder="Fecha de Nacimiento" onchange="calcularEdad()">
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label">Sexo</label>
                  <select class="form-control" id="sexo_responsable">
                    <option value="">Seleccione sexo</option>
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                    <option value="otro">Otro</option>
                  </select>
                </div>
                <div class="col-md-4 mb-3">
                  <label  class="form-label">Ocupacion del Responsable</label>
                  <input type="text" class="form-control" id="ocupacion_responsable" placeholder="ocupacion">
                </div>
                <div class="col-md-4 mb-3">
                  <label  class="form-label">Dirección del Responsable</label>
                  <input type="text" class="form-control" id="direccion_responsable" placeholder="Dirección ">
                </div>
                <div class="col-md-4 mb-3">
                  <label  class="form-label">Telefono del Responsable</label>
                  <input type="number" class="form-control" id="telefono_resposable" placeholder="Telefono">
                </div>
                <div class="col-md-4 mb-3">
                  <label  class="form-label">Comunidad del Responsable</label>
                  <input type="text" class="form-control" id="comunidad_responsable" placeholder="Comunidad">
                </div>
                <div class="col-md-4 mb-3">
                  <label  class="form-label">C.I.</label>
                  <input type="number" class="form-control" id="ci" placeholder="ci">
                </div>
                <div class="col-md-4 mb-3">
                  <label  class="form-label">Numero de Seguro</label>
                  <input type="text" class="form-control" id="n_seguro" placeholder="Numero de Seguro">
                </div>
                <div class="col-md-4 mb-3">
                  <label  class="form-label">Numero de Carp Fam</label>
                  <input type="text" class="form-control" id="n_carp_fam" placeholder="Numero Carp Fam">
                </div>
                <div class="col-md-4 mb-3">
                  <label  class="form-label">Zona his</label>
                  <input type="text" class="form-control" id="zona_his" placeholder="zona his"value="<?php $m = (isset($zona_his1))? $zona_his1: ""; echo $m; ?>">
                </div>

              </div>
            </form>
          </div>
          </div>
          <div class="card">
          <div class="card-header">
           IDENTIFICACION DEL PACIENTE/USUARIO
            <h6>Complete los datos del paciente <?php echo $fi["nombre_usuario"]." ".$fi["ap_usuario"]." ".$fi["am_usuario"]; ?></h6>
          </div>
          <div class="card-body">
            <form>
              <div class="row">
                <div class="col-md-4 mb-3">
                  <label  class="form-label">Fecha de Nacimiento</label>
                  <input type="date" class="form-control" id="fecha_nacimiento"  placeholder="Ingresa tu Fecha de Nacimiento"value="<?php $m = (isset($fecha_nac_paciente1))? $fecha_nac_paciente1: ""; echo $m; ?>" disabled>
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label">Sexo</label>
                  <select class="form-control" id="sexo">
                    <option value="">Seleccione sexo</option>
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                    <option value="otro">Otro</option>

                  </select>
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label">Ocupacion</label>
                  <input type="string" class="form-control" id="ocupacion" placeholder="Ocupacion"value="<?php $m = (isset($ocupacion_paciente1) && is_numeric($ocupacion_paciente1))? $ocupacion_paciente1: ""; echo $m; ?>">
                </div>
                <div class="col-md-4 mb-3">
                  <label  class="form-label">Fecha de Consulta</label>
                  <input type="date" class="form-control" id="fecha_de_consulta" placeholder="Fecha de Consulta"value="<?php $m = (isset($fecha_de_consulta1))? $fecha_de_consulta1: ""; echo $m; ?>">
                </div>

                <div class="col-md-4 mb-3">
                  <label class="form-label">Estado Civil</label>
                  <select class="form-select" id="estado_civil" >
                    <option value=''>Seleccione</option>
                    <?php
                    $ara = ['soltero(a)','casado(a)','divorciado(a)','union estable'];
                      if(isset($estado_civil_paciente1) && is_string($estado_civil_paciente1)){
                        for($i = 0;$i<count($ara);$i++){
                          if($ara[$i] == $estado_civil_paciente1){
                            echo "<option selected value='".$ara[$i]."'>".$ara[$i]."</option>";
                          }else{
                            echo "<option value='".$ara[$i]."'>".$ara[$i]."</option>";
                          }
                        }
                      }else{
                        echo "
                          <option value='soltero(a)'>soltero(a)</option>
                          <option value='casado(a)'>casado(a)</option>
                          <option value='divorciado(a)'>divorciado(a)</option>
                          <option value='union estable'>union estable</option>";
                      }
                     ?>
                  </select>
                </div>
                <div class="col-md-4 mb-3">
                  <label  class="form-label">Escolaridad</label>
                  <select class="form-select" id="escolaridad" >
                    <option value=''>Seleccione</option>
                    <?php $are = ['Educación Primaria sin concluir','Educación Primaria concluido','Educación Secundaria sin concluir','Educación Secundaria concluido','Educación Superior'];
                          $ares = ['No Primaria','Primaria','No Secundaria','Secundaria','Superior'];
                      if(isset($escolaridad_paciente1) && is_string($escolaridad_paciente1)){

                        for($i = 0;$i<count($are);$i++){
                          if($ares[$i] == $escolaridad_paciente1){
                            echo "<option selected value='".$ares[$i]."'>".$are[$i]."</option>";
                          }else{
                            echo "<option value='".$ares[$i]."'>".$are[$i]."</option>";
                          }
                        }
                      }else{
                        echo "
                        <option value='No Primaria'>Educación Primaria sin concluir</option>
                        <option value='Primaria'>Educación Primaria concluido</option>
                        <option value='No Secundaria'>Educación Secundaria sin concluir</option>
                        <option value='Secundaria'>Educación Secundaria concluido</option>
                        <option value='Superior'>Educación Superior</option>";
                      }

                     ?>

                  </select>
                </div>
              </div>

            </form>
          </div>
        </div><!--car fin 2-->
      </div><!--fin del modal-->
      <div class="modal-footer">
        <button title='Guardar'type="button" class="btn btn-primary" onclick="RegistroHistorial()"><img src='../imagenes/guardar.ico' style='height: 25px;width: 25px;'></button>
       <button title='cerrar'type="button" class="btn btn-danger" data-bs-dismiss="modal"><img src='../imagenes/drop.ico' style='height: 25px;width: 25px;'></button>
      </div>
      </div>

    </div>
  </div>
<!--modal de registro de documentos-->
<div class="modal fade" id="ModalRegistroDocumentos" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h6 class="modal-title" id="miModalRegistro">REGISTRO O ACTUALIZACIÓN DE RECIBOS DEL PACIENTE EN IMAGEN</h6>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <!-- Contenido del modal -->
    <div class="modal-body">
      <div class="card">
        <div class="card-header">
          RECIBOS DEL PACIENTE EN IMAGEN
        </div>
        <div class="card-body">
          <form>
            <div class="row">
              <canvas id="CanvasImagen" hidden></canvas>
              <input type="hidden" name="cod_historialD" id='cod_historialD' value="">
              <input type="hidden" name="cod_historialOriginal" id='cod_historialOriginal'value="">
              <input type="hidden" name="titulo_historial" id='titulo_historial' value="">
              <input type="hidden"id="nombreImagen" name="nombreImagen" value="">
              <input type="hidden"id='ruta_imagen' name="ruta_imagen" value="">
              <div class="col-12">
                <label  class="form-label">Nombre del archivo imagen</label>
                <input type="text" class="form-control" id="nombre_imagen" name='nombre_imagen' placeholder="nombre del archivo">
              </div>
              <div class="col-12">
                <label  class="form-label">Imagen</label>
                <input type="file" class="form-control" id="imagenSelect" name='imagenSelect' placeholder="Seleccione la imagen"  accept=".jpg, .jpeg, .png">
              </div>
              <div class="col-12">
                <canvas id="imageSeleccionado" align='center' width="300" height="330"></canvas>
              </div>
            </div>
          </form>
        </div>
        </div>
    </div><!--fin del modal-->
    <div class="modal-footer">
      <button title='Guardar'type="button" class="btn btn-primary" onclick="RegistroImagen()"><img src='../imagenes/guardar.ico' style='height: 25px;width: 25px;'></button>
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
              <input type="text" name="cod_historial_repor" id='cod_historial_repor' value="">
              <label for="fecha1" class="form-label">Mostrar desde la pagina hasta la pagina</label>
              <div class="input-group">
                <input type="text" id="hoja" name="hoja" value="<?php echo $minPag."-".$maxPag; ?>" class="form-control">
              </div>
            </div>
            <div class="for-control alert alert-light">
              Nota:
              Seleccione desde que hoja del historial quiere ver para imprimir
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

  <div class="verDatos" id="verDatos">
    <div class="row">
      <div class="col">
        <div class="table-responsive">
        <table class="table">
          <thead style="font-size:12px">
            <tr>
              <th>N°</th>
              <th>Fecha</th>
              <th>N° historial</th>
              <th>Titulo</th>
              <th>Paciente</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
      <input type="hidden" name="paginaMax" id="paginaMax" value="<?php $ms = (isset($maxPag) && is_numeric($maxPag))? $maxPag:""; echo $ms; ?>">
      <input type="hidden" name="paginaMin" id="paginaMin" value="<?php $ms = (isset($minPag) && is_numeric($minPag))? $minPag:""; echo $ms; ?>">
      <?php
      if ($resul && count($resul) > 0){
          $i = 0;

        foreach ($resul as $fi){
            echo "<tr>";
              echo "<td>".($i+1)."</td>";
              echo "<td>".$fi['fecha']."</td>";
              echo "<td>".$fi['titulo']."</td>";
              if($fi["tipoHistorial"]=='tiene_herencia')
              {
                echo "<td><a href='#'  onclick='verHistorial(".$fi["cod_his"].")'>".$fi['subtitulo']."</a></td>";
              }else {
                echo "<td>".$fi['subtitulo']."</td>";
              }
              $datospaciente = $fi['paciente_rd_nombre'];
              echo "<td>";
              $fecha_nac_paciente = '';$sexo_paciente = '';$ocupacion_paciente='';
              $estado_civil_paciente = '';$escolaridad_paciente = '';
              foreach ($datospaciente as $datos) {
                $fecha_nac_paciente=$datos["fn_usuario_re"];
                $sexo_paciente=$datos["sexo_usuario"];$ocupacion_paciente=$datos["ocupacion_usuario"];
                $estado_civil_paciente=$datos["estado_civil_usuario"];$escolaridad_paciente=$datos["escolaridad_usuario"];
                echo $datos["nombre_usuario_re"]." ".$datos["ap_usuario_re"]." ".$datos["am_usuario_re"];
              }
              echo "</td>";

              echo "<td>";
                echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>";
                  if($fi["tipoHistorial"]=='tiene_herencia')
                  {//si el historial tiene herencia entonces se mostrara el boton editar y vidualizar la herencia
                    echo "<button type='button' class='d-sm-inline-block btn btn-sm btn-success shadow-sm' data-bs-toggle='modal' data-bs-target='#ModalReporteNuevoHistorial' title='Editar'
                     onclick='actualizarhistorialNuevo(".$fi['cod_his']."
                    ,\"".$fi["subtitulo"]."\",\"".$fi["titulo"]."\")'>
                    <img src='../imagenes/edit.ico' height='17' width='17' class='rounded-circle'></button>";
                    echo "<button type='button' class='d-sm-inline-block btn btn-sm btn-info shadow-sm' data-bs-toggle='modal' data-bs-target='#ModalReporteNuevoHistorial' title='Vizualizar historial'
                     onclick='verHistorial(".$fi['cod_his'].")'>
                    <img src='../imagenes/ojo.ico' height='17' width='17' class='rounded-circle'></button>";

                  }else{
                    $datoEs = $fi["datos"];
                    $cod_his_dat='';$cod_rd='';$paciente_rd='';$cod_cds='';$zona_his='';
                    $descripcion='';$hoja='';$nombre_imagen='';$ruta_imagen='';$tipoDato = '';
                    foreach ($datoEs as $dimagen) {
                      $cod_his_dat=$dimagen["cod_his_dat"];$cod_rd=$dimagen["cod_rd"];$paciente_rd=$dimagen["paciente_rd"];$cod_cds=$dimagen["cod_cds"];$zona_his=$dimagen["zona_his"];
                      $descripcion=$dimagen["descripcion"];$hoja=$dimagen["hoja"];$nombre_imagen=$dimagen["nombre_imagen"];$ruta_imagen=$dimagen["ruta_imagen"];
                      $tipoDato=$dimagen["tipoDato"];
                    }
                    //si no se mostrar el boton de editar la imagen y imprimir la imagen
                    echo "<button type='button' class='d-sm-inline-block btn btn-sm btn-secondary shadow-sm' data-bs-toggle='modal' data-bs-target='#ModalRegistroDocumentos' title='Editar'
                    onclick='actualizarImagen(\"".$fi['cod_his']."\",\"".$cod_his_dat."\"
                   ,\"".$descripcion."\",\"".$nombre_imagen."\",\"".$ruta_imagen."\",\"".$fi["titulo"]."\")'>
                   <img src='../imagenes/edit.ico' height='17' width='17' class='rounded-circle'></button>";
                   echo "<button type='button' class='d-sm-inline-block btn btn-sm btn-warning' title='Imprimir' onclick='imprimir(".$cod_his_dat.",\"".$tipoDato."\")'><img src='../imagenes/imprimir.png' height='17' width='17' class='rounded-circle'></button>";

                  }
                    //echo "<button type='button' class='d-sm-inline-block btn btn-sm btn-warning' title='Imprimir' onclick='imprimir(".$fi['cod_his'].",\"".$fi["tipoDato"]."\")'><img src='../imagenes/imprimir.png' height='17' width='17' class='rounded-circle'></button>";
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
        echo "<li class='page-item'><a class='page-link'  onclick=\"BuscarRegistrosHistorial(1)\"><span aria-hidden='true'>&laquo;</span></a></li>";
      }
      if($pagina==1) {
        echo "<li class='page-item'><a class='page-link text-muted'>$anterior</a></li>";
      } else if($pagina==2) {
        echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"BuscarRegistrosHistorial(1)\" class='page-link'>$anterior</a></li>";
      }else {
        echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"BuscarRegistrosHistorial($pagina-1)\">$anterior</a></li>";

      }
      // first label
      if($pagina>($adjacents+1)) {
        echo "<li class='page-item'><a href='javascript:void(0);' class='page-link' onclick=\"BuscarRegistrosHistorial(1)\">1</a></li>";
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
          echo"<li class='page-item'><a href='javascript:void(0);' class='page-link'onclick=\"BuscarRegistrosHistorial(1)\">$i</a></li>";
        }else {
          echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"BuscarRegistrosHistorial(".$i.")\" class='page-link'>$i</a></li>";
        }
      }

      // interval

      if($pagina<($TotalPaginas-$adjacents-1)) {
        echo "<li class='page-item'><a class='page-link'>...</a></li>";
      }
      // last

      if($pagina<($TotalPaginas-$adjacents)) {
        echo "<li class='page-item'><a href='javascript:void(0);'class='page-link ' onclick=\"BuscarRegistrosHistorial($TotalPaginas)\">$TotalPaginas</a></li>";
      }
      // next

      if($pagina<$TotalPaginas) {
        echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"BuscarRegistrosHistorial($pagina+1)\">$siguiente</a></li>";
      }else {
        echo "<li class='page-item'><a class='page-link text-muted'>$siguiente</a></li>";
      }
      if ($pagina != $TotalPaginas) {
        echo "<li class='page-item'><a class='page-link' onclick=\"BuscarRegistrosHistorial($TotalPaginas)\"><span aria-hidden='true'>&raquo;</span></a></li>";
      }

      echo "</ul>";
      echo "</div>";

echo "</div>
    </div>";

  }
   ?>
 </div>
 </div>
 <!-- modal de seleccion de fechas-->
<script type="text/javascript">
function BuscarRegistrosHistorial(page){
    var obt_lis = document.getElementById("selectList").value;
    var listarDeCuanto = verificarList(obt_lis);
    var fecha = document.getElementById("fecha").value;
    var paciente_rd = document.getElementById("paciente_rd").value;
    var cod_rd = document.getElementById("cod_rd").value;
    document.getElementById("paginas").value=page;
    var buscar = document.getElementById("buscar").value;
    //ponerFechactualAlModalDeReporte(listarDeCuanto,buscar,page,fecha);
    var datos = new FormData(); // Crear un objeto FormData vacío
    datos.append('pagina', page);
    datos.append('listarDeCuanto',listarDeCuanto);
    datos.append('fecha',fecha);
    datos.append("paciente_rd",paciente_rd);
    datos.append("cod_rd",cod_rd);
    datos.append("buscar",buscar);
      $.ajax({
        url: "../controlador/historial.controlador.php?accion=bht",
        type: "POST",
        data: datos,
        contentType: false, // Deshabilitar la codificación de tipo MIME
        processData: false, // Deshabilitar la codificación de datos
        success: function(data) {
  //    alert(data+"dasdas");
          $("#verDatos").html(data);
          datosDeImpresion();
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

function accionHitorialVer(paciente_rd,cod_rd){
    var form = document.createElement('form');
     form.method = 'post';
     form.action = '../controlador/historial.controlador.php?accion=vht'; // Coloca la URL de destino correcta
     // Agregar campos ocultos para cada dato
     var datos = {
         paciente_rd:paciente_rd,
         cod_rd:cod_rd
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

function ActualizarHistorial(cod_his,cod_rd,paciente_rd,Nombre_responsable,ap_responsable,am_responsable,cod_resp,
fecha_nac,sexo_usuario,ocupacion_responsable,direccion_responsable,telefono_resposable,comunidad_responsable,ci_resp
,nro_seguro_resp,nro_car_form_resp,zona_his,fecha_nac_paciente,sexo_paciente,ocupacion_paciente,estado_civil_paciente,
escolaridad_paciente,fecha_de_consulta){
  //alert(estado_civil_paciente+"   "+escolaridad_paciente);
  document.getElementById("cod_historial").value=cod_his;
  document.getElementById("cod_rd").value=cod_rd;
  document.getElementById("paciente_rd").value=paciente_rd;
  document.getElementById("Nombre_responsable").value=Nombre_responsable;
  document.getElementById("ap_responsable").value=ap_responsable;
  document.getElementById("am_responsable").value=am_responsable;
  document.getElementById("cod_usuario").value=cod_resp;
  document.getElementById("fecha_nacimiento_responsable").value=fecha_nac;
  document.getElementById("sexo_responsable").value=sexo_usuario;
  document.getElementById("ocupacion_responsable").value=ocupacion_responsable;
  document.getElementById("direccion_responsable").value=direccion_responsable;
  document.getElementById("telefono_resposable").value=telefono_resposable;
  document.getElementById("comunidad_responsable").value=comunidad_responsable;
  document.getElementById("ci").value=ci_resp;
  document.getElementById("n_seguro").value=nro_seguro_resp;
  document.getElementById("n_carp_fam").value=nro_car_form_resp;
  document.getElementById("zona_his").value=zona_his;

  document.getElementById("fecha_nacimiento").value=fecha_nac_paciente;
  document.getElementById("sexo").value=sexo_paciente;
  document.getElementById("ocupacion").value=ocupacion_paciente;
  document.getElementById("fecha_de_consulta").value=fecha_de_consulta;
  document.getElementById("estado_civil").value=estado_civil_paciente;
  document.getElementById("escolaridad").value=escolaridad_paciente;
}
function accionHitorialVer(paciente_rd,cod_rd){
    var form = document.createElement('form');
     form.method = 'post';
     form.action = '../controlador/historial.controlador.php?accion=vht'; // Coloca la URL de destino correcta
     // Agregar campos ocultos para cada dato
     var datos = {
         paciente_rd:paciente_rd,
         cod_rd:cod_rd
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

//funciones de registor de historial

function RegistroHistorial(){
//responsable de familia
var cod_historial=document.getElementById("cod_historial").value;
var Nombre_responsable =document.getElementById("Nombre_responsable").value;
var ap_responsable =document.getElementById("ap_responsable").value;
var am_responsable =document.getElementById("am_responsable").value;
var fecha_nacimiento_responsable =document.getElementById("fecha_nacimiento_responsable").value;
var sexo_responsable =document.getElementById("sexo_responsable").value;
var ocupacion_responsable =document.getElementById("ocupacion_responsable").value;
var direccion_responsable =document.getElementById("direccion_responsable").value;
var telefono_resposable =document.getElementById("telefono_resposable").value;
var comunidad_responsable =document.getElementById("comunidad_responsable").value;
var ci =document.getElementById("ci").value;
var n_seguro =document.getElementById("n_seguro").value;
var n_carp_fam =document.getElementById("n_carp_fam").value;
var zona_his =document.getElementById("zona_his").value;
//identificacion del pacient
var cod_usuario = document.getElementById("cod_usuario").value;
var paciente_rd = document.getElementById("paciente_rd").value;
var cod_rd = document.getElementById("cod_rd").value;
var fecha_nacimiento = document.getElementById("fecha_nacimiento").value;
var sexo = document.getElementById("sexo").value;
var ocupacion = document.getElementById("ocupacion").value;
var fecha_de_consulta = document.getElementById("fecha_de_consulta").value;
var estado_civil = document.getElementById("estado_civil").value;
var escolaridad = document.getElementById("escolaridad").value;

if(Nombre_responsable==""||ap_responsable==""||am_responsable==""||fecha_nacimiento_responsable==""||sexo_responsable==""
||ocupacion_responsable==""
||direccion_responsable==""||comunidad_responsable==""||ci==""||fecha_nacimiento==""
||sexo==""||ocupacion==""||fecha_de_consulta==""||estado_civil==""||escolaridad==""){
  ingreseNPdatos();
  return;
}
var datos = new FormData(); // Crear un objeto FormData vacío
datos.append("Nombre_responsable",Nombre_responsable);
datos.append("ap_responsable",ap_responsable);
datos.append("am_responsable",am_responsable);
datos.append("fecha_nacimiento_responsable",fecha_nacimiento_responsable);
datos.append("sexo_responsable",sexo_responsable);
datos.append("ocupacion_responsable",ocupacion_responsable);
datos.append("direccion_responsable",direccion_responsable);
datos.append("telefono_resposable",telefono_resposable);
datos.append("comunidad_responsable",comunidad_responsable);
datos.append("ci",ci);
datos.append("n_seguro",n_seguro);
datos.append("n_carp_fam",n_carp_fam);
datos.append("zona_his",zona_his);

datos.append("cod_usuario",cod_usuario);
datos.append("paciente_rd",paciente_rd);
datos.append("cod_rd",cod_rd);
datos.append("fecha_nacimiento",fecha_nacimiento);
datos.append("sexo",sexo);
datos.append("ocupacion",ocupacion);
datos.append("fecha_de_consulta",fecha_de_consulta);
datos.append("estado_civil",estado_civil);
datos.append("escolaridad",escolaridad);
datos.append("cod_historial",cod_historial);
$.ajax({
  url: "../controlador/historial.controlador.php?accion=rhRyP",
  type: "POST",
  data: datos,
  contentType: false, // Deshabilitar la codificación de tipo MIME
  processData: false, // Deshabilitar la codificación de datos
  success: function(data) {
  // alert(data+"dasdas");
    data=$.trim(data);
  //  alert(data);
    if(data == "correcto"){

      //if(accion == 1){
        //  alertCorrectoUp();
          // close(pagina,listarDeCuanto,buscar);
      //}else{
        alertCorrecto();
      //}
      IRalLinkTablaRegistroDiario(cod_historial);
    }else {
      Swal.fire({
       icon: 'error',
       title: '¡Error!',
       text: '¡Ocurrio un problema!',
       showConfirmButton: false,
       timer: 1500
     });
    }
  }
});
}

function alertCorrecto(){
    Swal.fire({
     icon: 'success',
     title: '¡Correcto!',
     text: '¡Acción realizado con éxito!',
     showConfirmButton: false,
     timer: 1500
   });
}
function IRalLinkTablaRegistroDiario(cod_historial){
  //alert(historial);
  if(cod_historial!=''){
    setTimeout(() => {
      var pagina = document.getElementById("paginas").value;
      if(pagina==''){pagina=1;}
      BuscarRegistrosHistorial(pagina);
      vaciarCampos();
      $('#ModalRegistro').modal('hide');
    }, 1500);
  }else{
    setTimeout(() => {
      accionHitorialVer();
        $('#ModalRegistro').modal('hide');
    }, 1500);
  }
}

function ingreseNPdatos(){
  Swal.fire({
   icon: 'error',
   title: '¡Error!',
   text: '¡Ingrese los Datos!',
   showConfirmButton: false,
   timer: 1500
 });
}
function vaciarDESPUESdeUNtiempo(resul){
  setTimeout(() => {
    $('#'+resul).html("");
  }, 5000);
}

//funcion para buscar si existe el Paciente
  function buscarExitepaciente(){
    vaciarDESPUESdeUNtiempo("resultado12");
    var nombre = document.getElementById("Nombre_responsable").value;
    if(nombre != ""){
      //alert(nombre);
      $.ajax({
    		url: "../controlador/historial.controlador.php?accion=rbph",
    		type: "POST",
    		data: {nombre:nombre},
    		dataType: "json",
        success: function(data) {

          console.log(data);
          if(data!=""){
            var unir="";
            for (let i = 0; i < data.length; i++) {
              var usuario = data[i];
              unir+="<div><div id='u' style=' display: inline-block;'>"+Convertir(data[i].nombre_usuario)+"</div> ";
              unir+="<div id='ap' style=' display: inline-block;'> "+Convertir(data[i].ap_usuario)+"</div> ";
              unir+="<div id='am' style=' display: inline-block;'> "+Convertir(data[i].am_usuario)+"</div> ";
              unir+="<div id='fn' style=' display: inline-block;'> "+data[i].fecha_nac_usuario+"</div>";
              unir+="<div id='d' style=' display: inline-block;display:none;'>"+data[i].direccion_usuario+"</div>";
              unir+="<div id='d' style=' display: inline-block;display:none;'>"+data[i].sexo_usuario+"</div>";
              unir+="<div id='d' style=' display: inline-block;display:none;'>"+data[i].ocupacion_usuario+"</div>";
              unir+="<div id='d' style=' display: inline-block;display:none;'>"+data[i].telefono_usuario+"</div>";
              unir+="<div id='d' style=' display: inline-block;display:none;'>"+data[i].comunidad_usuario+"</div>";
              unir+="<div id='d' style=' display: inline-block;display:none;'>"+data[i].ci_usuario+"</div>";
              unir+="<div id='d' style=' display: inline-block;display:none;'>"+data[i].nro_seguro_usuario+"</div>";
              unir+="<div id='d' style=' display: inline-block;display:none;'>"+data[i].nro_car_form_usuario+"</div>";
              unir+="<div id='c' style=' display: inline-block;display:none;'>"+data[i].cod_usuario+"</div></div>";
            }
            visualizarUser(unir);
            $('#resultado12 div').on('click', function() {
                    //obtenemos los datos del usuario div resultado12
              var nombre = $(this).children().eq(0).text();
              var ap = $(this).children().eq(1).text();
              var am = $(this).children().eq(2).text();
              var fn = $(this).children().eq(3).text();
              var d = $(this).children().eq(4).text();
              var sexo = $(this).children().eq(5).text();

              var ocu = $(this).children().eq(6).text();
              var tele = $(this).children().eq(7).text();
              var comuni = $(this).children().eq(8).text();
              var ci = $(this).children().eq(9).text();
              var nro_seg = $(this).children().eq(10).text();
              var nro_car = $(this).children().eq(11).text();
              var cd_u = $(this).children().eq(12).text();
                //dentro de los id de la vista mostramos los datos que estan en el div resultado12
                if(nombre != ""){
                  var r1 = (nombre) ? true : false;
                  document.getElementById("Nombre_responsable").disabled = r1;
                  document.getElementById("Nombre_responsable").value = nombre;
                  r1 = (ap) ? true : false;
                  document.getElementById("ap_responsable").disabled = r1;
                  document.getElementById("ap_responsable").value = ap;
                  r1 = (am) ? true : false;
                  document.getElementById("am_responsable").disabled = r1;
                  document.getElementById("am_responsable").value = am;
                  r1 = (fn) ? true : false;
                  document.getElementById("fecha_nacimiento_responsable").disabled = r1;
                  var fecha = new Date(fn); // Puedes modificar esta fecha según tus necesidades

                  // Formatear la fecha como una cadena para asignarla al campo de tipo date
                  var fechaFormateada = fecha.toISOString().split('T')[0];
                  document.getElementById("fecha_nacimiento_responsable").value = fechaFormateada;
                  r1 = (sexo) ? true : false;
                  document.getElementById("sexo_responsable").disabled = r1;
                  document.getElementById("sexo_responsable").value = sexo;
                  r1 = (d) ? true : false;
                  document.getElementById("direccion_responsable").disabled = r1;
                  document.getElementById("direccion_responsable").value = d;
                  r1 = (ocu) ? true : false;
                  document.getElementById("ocupacion_responsable").disabled = r1;
                  document.getElementById("ocupacion_responsable").value = ocu;
                  r1 = (tele && tele != 0) ? true : false;
                  document.getElementById("telefono_resposable").disabled = r1;
                  document.getElementById("telefono_resposable").value = tele;
                  r1 = (comuni) ? true : false;
                  document.getElementById("comunidad_responsable").disabled = r1;
                  document.getElementById("comunidad_responsable").value = comuni;
                  r1 = (ci && ci != 0) ? true : false;
                  document.getElementById("ci").disabled = r1;
                  document.getElementById("ci").value = ci;
                  r1 = (nro_seg && nro_seg !=0) ? true : false;
                  document.getElementById("n_seguro").disabled = r1;
                  document.getElementById("n_seguro").value = nro_seg;
                  r1 = (nro_car && nro_car != 0) ? true : false;
                  document.getElementById("n_carp_fam").disabled = r1;
                  document.getElementById("n_carp_fam").value = nro_car;
                  r1 = (cd_u) ? true : false;
                  document.getElementById("cod_usuario").disabled = r1;
                  document.getElementById("cod_usuario").value = cd_u;
                  $('#resultado12').html(""); //para vaciar
                }
            });
        }else{
          $('#resultado12').html("<div class='alert alert-light' role='alert'>No se encontro resultado12s</div>");
        }
  		}
  	});
  }else{
    $('#resultado12').html("");
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

  function visualizarUser(unir){

  $('#resultado12').html(unir);
  //colocamos un color de css
  $('#resultado12').css({
   'cursor': 'pointer',
   'font-size':'15px'
   });
   // Obtener el elemento div con el id "results"
  /* const divResults = document.getElementById('results');   // Cambiar la clase del div
  divResults.setAttribute('class', 'alert alert-primary mb-0 py-0 border-0');
*/
}
function accionHitorialVer(paciente_rd,cod_rd){
    var form = document.createElement('form');
     form.method = 'post';
     form.action = '../controlador/historial.controlador.php?accion=vht'; // Coloca la URL de destino correcta
     // Agregar campos ocultos para cada dato
     var datos = {
         paciente_rd:paciente_rd,
         cod_rd:cod_rd
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

function vaciarCampos(){
  document.getElementById("cod_historial").value='';
  document.getElementById("Nombre_responsable").value='';
  document.getElementById("ap_responsable").value='';
  document.getElementById("am_responsable").value='';
  document.getElementById("fecha_nacimiento_responsable").value='';
  document.getElementById("sexo_responsable").value='';
  document.getElementById("ocupacion_responsable").value='';
  document.getElementById("direccion_responsable").value='';
  document.getElementById("telefono_resposable").value='';
  document.getElementById("comunidad_responsable").value='';
  document.getElementById("ci").value='';
  document.getElementById("n_seguro").value='';
  document.getElementById("n_carp_fam").value='';
  document.getElementById("zona_his").value='';

  //identificacion del pacient
   document.getElementById("cod_usuario").value='';
   document.getElementById("paciente_rd").value='';
   document.getElementById("cod_rd").value='';
   document.getElementById("fecha_nacimiento").value='';
   document.getElementById("sexo").value='';
   document.getElementById("ocupacion").value='';
   document.getElementById("fecha_de_consulta").value='';
   document.getElementById("estado_civil").value='';
   document.getElementById("escolaridad").value='';
}
function accionHitorialVer(){
    var paciente_rd=document.getElementById("paciente_rd").value;
    var cod_rd=document.getElementById("cod_rd").value;
    var form = document.createElement('form');
     form.method = 'post';
     form.action = '../controlador/historial.controlador.php?accion=vht'; // Coloca la URL de destino correcta
     // Agregar campos ocultos para cada dato
     var datos = {
         paciente_rd:paciente_rd,
         cod_rd:cod_rd
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

function validarFormatoDeHoja(hoja){
  var numero = /^[+-]?\d+$/;

  var regex = /^[0-9]+-[0-9]+$/;
  // Verificar si el valor cumple con el formato
  if (regex.test(hoja)) {
      return true; // La validación es correcta
  } else{
      if(numero.test(hoja)){
        return true;
      }else{
        AlertaUniversal('info','información',"Formato inválido. Debe ser en el formato '1-2'.");
        return false; // La validación es incorrecta
      }
  }
}

function GenerarReporte(){
  //var hoja = document.getElementById("hoja").value;
  //var resultado = validarFormatoDeHoja(hoja);
  /*if(resultado == false){
    return;
  }*/
  /*var sep = hoja.split("-");
  var hoja1 = sep[0];
  var hoja2 = sep[1];
  if(hoja1 != '' && typeof hoja2 === 'undefined'){
    hoja2=hoja1;
  }*/
  var paciente_rd=document.getElementById("paciente_rd").value;
  var cod_rd=document.getElementById("cod_rd").value;
  var cod_his = document.getElementById("cod_historial_repor").value;
  var form = document.createElement('form');
     form.method = 'post';
     form.action = '../controlador/historial.controlador.php?accion=grh'; // Coloca la URL de destino correcta
     // Agregar campos ocultos para cada dato
     var datos = {
         paciente_rd:paciente_rd,
         cod_historial:cod_his,
         cod_rd:cod_rd,
         tipoDato:0
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
function imprimir(cod_his,tipoDato){
  var paciente_rd=document.getElementById("paciente_rd").value;
  var cod_rd=document.getElementById("cod_rd").value;
    var form = document.createElement('form');
     form.method = 'post';
     form.action = '../controlador/historial.controlador.php?accion=ihu'; // Coloca la URL de destino correcta
     // Agregar campos ocultos para cada dato
     var datos = {
         paciente_rd:paciente_rd,
         cod_historial:cod_his,
         cod_rd:cod_rd,
         tipoDato:tipoDato
     };
     //alert(paciente_rd+"     "+cod_rd+"      "+cod_his+"      "+tipoDato);
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

function calcularEdad(){
  const hoy = new Date();
  // Obtener la fecha de nacimiento del usuario
  const fechaNacimiento = new Date(document.getElementById("fecha_nacimiento_responsable").value);

  if (!fechaNacimiento.getTime()) {
      fECHAnOVALIDO();
      return;
  }
  if (fechaNacimiento > hoy) {
      fECHAnOVALIDO();
      return;
  }
  // Calcular la diferencia en años
  let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
  const mes = hoy.getMonth() - fechaNacimiento.getMonth();

  // Ajustar la edad si la fecha de cumpleaños aún no ha pasado este año
  if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
      edad--;
  }
  // Mostrar el resultado
  if(edad <0){
    fECHAnOVALIDO();
    return;
  }
}

function fECHAnOVALIDO(){
  document.getElementById("fecha_nacimiento_responsable").value='';
  Swal.fire({
   icon: 'info',
   title: '¡Error!',
   text: '¡Por favor, selecciona una fecha de nacimiento válida.!',
   showConfirmButton: false,
   timer: 2000
 });
}
function registroActualizarConsulta(numero){
    verificarSihayDatos(numero);
}

function verificarSihayDatos(numero){
  alert(numero);
}
document.getElementById('imagenSelect').addEventListener('change', function() {
  const fileInput = document.getElementById('imagenSelect');
  const file = fileInput.files[0]; // Primer archivo seleccionado

  if (file) {
      // Crear un FileReader para leer el archivo
      const reader = new FileReader();
      // Cuando la lectura se haya completado
      reader.onload = function(event) {
          // El resultado en base64
          const base64String = event.target.result;
          const img = new Image();
          img.src = base64String;
          img.onload = function() {
              const canvas = document.getElementById('imageSeleccionado');
              const ctx = canvas.getContext('2d');
              // Limpiar el canvas antes de dibujar
              ctx.clearRect(0, 0, 300, 330);
              // Dibujar la imagen en el canvas
              ctx.drawImage(img, 0, 0, 300, 330);
          };
      };

      // Leer el archivo como Data URL (Base64)
      reader.readAsDataURL(file);
  } else {
      alert('Por favor selecciona una imagen primero');
  }
});

//alert universal
function AlertaUniversal(tipo,title,texto){
  Swal.fire({
   icon: tipo,
   title: title,
   text: texto,
   showConfirmButton: false,
   timer: 2000
 });
}
//funcion para validar el tipo de archivo que se puede guardar
function validarArchivo(id) {
  const filePath = document.getElementById(id).value;
  // Obtener la extensión del archivo
  if (filePath.split('.').pop().toLowerCase() == 'jpg'||filePath.split('.').pop().toLowerCase() == 'jpeg'||filePath.split('.').pop().toLowerCase() == 'png') {
      return true;
  }
return false;
}
//funcion para registrar imagenes
function RegistroImagen(){
  const fileInput = document.getElementById('imagenSelect');
  const file = fileInput.files[0]; // Primer archivo seleccionado
  var cod_his = document.getElementById("cod_historialD").value;
  var formData = new FormData();
  if(file){
    var res = validarArchivo('imagenSelect');
    if(res == false){
      AlertaUniversal('info','información',"Por favor, Seleccione un archivo valido");
      return;
    }
  }else{
    if(cod_his != ''){

    }else{
      AlertaUniversal('error','Vacio',"Por favor, Seleccione un archivo");
      return;
    }
  }
    var nombre_imagen = document.getElementById("nombre_imagen").value;

    var paciente_rd = document.getElementById("paciente_rd").value;
    var cod_rd = document.getElementById("cod_rd").value;
    var nombreImagen = document.getElementById("nombreImagen").value;
    var ruta_imagen = document.getElementById("ruta_imagen").value;
    var cod_his_original = document.getElementById("cod_historialOriginal").value;
    var titulo_historial = document.getElementById("titulo_historial").value;
    formData.append('file', file);
    formData.append('nombre_imagen',nombre_imagen);
    formData.append("paciente_rd",paciente_rd);
    formData.append("cod_rd",cod_rd);
    formData.append("cod_historial",cod_his);
    formData.append("nombreImagen",nombreImagen);
    formData.append("ruta_imagen",ruta_imagen);
    formData.append("cod_his_original",cod_his_original);
    //alert(cod_his_original+"    "+cod_his);
    formData.append("tipoHistorial",'no_tiene_herencia');
    formData.append("titulo_historial",titulo_historial);
    $.ajax({
      url: "../controlador/historial.controlador.php?accion=rhdochd",
      type: "POST",
      data: formData,
      contentType: false, // Deshabilitar la codificación de tipo MIME
      processData: false, // Deshabilitar la codificación de datos
      success: function(data) {
        //alert(data);
        //console.log(data);
        data=$.trim(data);
        if(data == "correcto"){
          alertCorrecto();
          setTimeout(() => {
            document.getElementById("imagenSelect").value='';
            document.getElementById("nombre_imagen").value='';
            $('#ModalRegistroDocumentos').modal('hide');
            ActualizarResultados();
          }, 2000);
        }else if(data == 'error'){
          AlertaUniversal('error','¡Error!',"Ocurrio un error al realizar la acción.");
        }else if(data == 'maximo'){
          AlertaUniversal('info','información','El archivo es demasiado grande. El tamaño máximo permitido es 2 MB.');
        }else{
          AlertaUniversal('info','información',data);
        }
      },error:function(r){
        alert("Ocurrió un error: " + JSON.stringify(r));
      }
    });

}

function ActualizarResultados(){
  var pagina = document.getElementById("paginas").value;
  if(pagina==''){pagina=1;}
  var paciente_rd = document.getElementById("paciente_rd").value;
  var cod_rd = document.getElementById("cod_rd").value;
  var obt_lis = document.getElementById("selectList").value;
  var buscar = document.getElementById("buscar").value;
  var listarDeCuanto = verificarList(obt_lis);
  var formData = new FormData();
  formData.append('fecha', "null");
  formData.append('pagina',pagina);
  formData.append("paciente_rd",paciente_rd);
  formData.append("cod_rd",cod_rd);
  formData.append("listarDeCuanto",listarDeCuanto);
  formData.append("buscar",buscar);
  $.ajax({
    url: "../controlador/historial.controlador.php?accion=bht",
    type: "POST",
    data: formData,
    contentType: false, // Deshabilitar la codificación de tipo MIME
    processData: false, // Deshabilitar la codificación de datos
    success: function(data) {
        //alert(data);
      $("#verDatos").html(data);
      datosDeImpresion();
    }
  });
}
function actualizarImagen(cod_his,cod_his_dat,descripcion,nombre_imagen,ruta_imagen,titulo){
//alert(ruta_imagen+"   "+nombre_imagen);
  document.getElementById("cod_historialD").value=cod_his_dat;
  document.getElementById("nombre_imagen").value=descripcion;
  document.getElementById("nombreImagen").value=nombre_imagen;
  document.getElementById("ruta_imagen").value=ruta_imagen;
  document.getElementById("cod_historialOriginal").value=cod_his;
  document.getElementById("titulo_historial").value=titulo;

  const img = new Image();
  img.src = ruta_imagen+nombre_imagen;
  const canvas = document.getElementById('imageSeleccionado');
  const ctx = canvas.getContext('2d');
  if(ruta_imagen!='' && nombre_imagen != ''){
    img.onload = function() {
        // Limpiar el canvas antes de dibujar
        ctx.clearRect(0, 0, 300, 330);
        // Dibujar la imagen en el canvas
        ctx.drawImage(img, 0, 0, 300, 330);
    };
  }else{
    ctx.clearRect(0, 0, canvas.width, canvas.height);
  }
}


//funcion para biscar medico_responsable
function buscarMedico(){
  vaciarDESPUESdeUNtiempo("resultado13");
  var nombre = document.getElementById("medico_responsable").value;
  if(nombre != ""){
    //alert(nombre);
    $.ajax({
      url: "../controlador/historial.controlador.php?accion=rhgt",
      type: "POST",
      data: {nombre:nombre},
      dataType: "json",
      success: function(data) {
        //alert(data);
        console.log(data);
        if(data!=""){
          var unir="";
          for (let i = 0; i < data.length; i++) {
            var usuario = data[i];
            unir+="<div><div id='u' style=' display: inline-block;'>"+Convertir(data[i].nombre_usuario)+"</div> ";
            unir+="<div id='ap' style=' display: inline-block;'> "+Convertir(data[i].ap_usuario)+"</div> ";
            unir+="<div id='am' style=' display: inline-block;'> "+Convertir(data[i].am_usuario)+"</div> ";
            unir+="<div id='c' style=' display: inline-block;display:none;'>"+data[i].cod_usuario+"</div></div>";
          }
          visualizarUserMedico(unir);
          $('#resultado13 div').on('click', function() {
                  //obtenemos los datos del usuario div resultado12
            var nombre = $(this).children().eq(0).text();
            var ap = $(this).children().eq(1).text();
            var am = $(this).children().eq(2).text();
            var cod_usuario = $(this).children().eq(3).text();
              //dentro de los id de la vista mostramos los datos que estan en el div resultado12
              if(nombre != ""){
                document.getElementById("medico_responsable").value=nombre+" "+ap+" "+am;
                document.getElementById("cod_usuario_medico").value=cod_usuario;
                $('#resultado13').html(""); //para vaciar
              }
          });
      }else{
        $('#resultado13').html("<div class='alert alert-light' role='alert'>No se encontro resultados</div>");
      }
    }
  });
}else{
  $('#resultado13').html("");
}
}


  function visualizarUserMedico(unir){

  $('#resultado13').html(unir);
  //colocamos un color de css
  $('#resultado13').css({
   'cursor': 'pointer',
   'font-size':'15px'
   });
   // Obtener el elemento div con el id "results"
  /* const divResults = document.getElementById('results');   // Cambiar la clase del div
  divResults.setAttribute('class', 'alert alert-primary mb-0 py-0 border-0');
*/
}

//funcion para ingresar datos un nuevo historial

function RegistrarNuevoHistorial(){
//responsable de familia
var nombre_historial=document.getElementById("nombre_historial").value;
var paciente_rd = document.getElementById("paciente_rd").value;
var cod_rd = document.getElementById("cod_rd").value;
var subnombre = document.getElementById("subnombre").value;
var cod_his_his = document.getElementById("cod_his_his").value;
var datos = new FormData(); // Crear un objeto FormData vacío
datos.append("paciente_rd",paciente_rd);
datos.append("cod_rd",cod_rd);
datos.append("nombre_historial",nombre_historial);
datos.append("subnombre",subnombre);
datos.append("cod_his",cod_his_his);
//alert(nombre_historial+"   "+paciente_rd+"    "+cod_rd+"      "+subnombre+"      "+cod_his_his);
$.ajax({
  url: "../controlador/historial.controlador.php?accion=rnnh",
  type: "POST",
  data: datos,
  contentType: false, // Deshabilitar la codificación de tipo MIME
  processData: false, // Deshabilitar la codificación de datos
  success: function(data) {
  //alert(data+"dasdas");
    data=$.trim(data);
  //  alert(data);
    if(data == "correcto"){
      alertCorrecto();
      setTimeout(() => {
        document.getElementById("nombre_historial").value='';
        document.getElementById("subnombre").value;
        document.getElementById("cod_his_his").value;
        $('#ModalReporteNuevoHistorial').modal('hide');
        ActualizarResultados();
      }, 2000);
    }else {
      Swal.fire({
       icon: 'error',
       title: '¡Error!',
       text: '¡Ocurrio un problema!',
       showConfirmButton: false,
       timer: 1500
     });
    }
  },
  error: function(r){
    console.log("Error detalle:", r); // Esto imprimirá el objeto de error completo en la consola
    alert("Ocurrió un error: " + JSON.stringify(r));
  }
});
}

function actualizarhistorialNuevo(cod_his,subtitulo,titulo){
  document.getElementById("subnombre").value=titulo;
  document.getElementById("cod_his_his").value=cod_his;
  document.getElementById("nombre_historial").value=subtitulo;
}

function verHistorial(cod_historial){
  var paciente_rd = document.getElementById("paciente_rd").value;
  var cod_rd = document.getElementById("cod_rd").value;
  var form = document.createElement('form');
//alert(cod_historial+"    "+cod_rd+"      "+paciente_rd);
   form.method = 'post';
   form.action = '../controlador/historial.controlador.php?accion=Vthdt'; // Coloca la URL de destino correcta
   // Agregar campos ocultos para cada dato
   var datos = {
       paciente_rd:paciente_rd,
       cod_his_original:cod_historial,
       cod_rd:cod_rd
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

function datosDeImpresion(){
  document.getElementById("hoja").value=document.getElementById("paginaMin").value+"-"+document.getElementById("paginaMax").value;
}
</script>
<?php require("../librerias/footeruni.php"); ?>
