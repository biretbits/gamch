<?php require("../librerias/headeradmin1.php"); ?>
<?php echo $paciente_rd; ?>
<?php echo $cod_rd; ?>
<div class="container mt-5">
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <div class="card">
        <div class="card-header">
          RESPONSABLE DE FAMILIA
        </div>
        <div class="card-body">
          <form>
            <input type="text" name="paciente_rd" id="paciente_rd" value="">
            <input type="text" name="cod_rd" id="cod_rd" value="">
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="Nombre_responsable" class="form-label">Nombre de Responsable</label>
                <input type="text" class="form-control" id="Nombre_responsable" placeholder="Nombre de Responsable">
                <div id="resultado" align='left' class='alert alert-light mb-0 py-0 border-0'>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="ap_responsable" class="form-label">Apellido paterno del Responsable</label>
                <input type="text" class="form-control" id="ap_responsable" placeholder="Ingresa Apellido paterno">
              </div>
              <div class="col-md-4 mb-3">
                <label for="am_responsable" class="form-label">Apellido materno</label>
                <input type="text" class="form-control" id="am_responsable" placeholder="Ingresa Apellido materno">
              </div>
              <div class="col-md-4 mb-3">
                <label for="fecha_nacimiento_responsable" class="form-label">Fecha de Nacimiento del Responsable</label>
                <input type="date" class="form-control" id="fecha_nacimiento_responsable" placeholder="Fecha de Nacimiento">
              </div>
              <div class="col-md-4 mb-3">
                <label for="sexo" class="form-label">Sexo</label>
                <input type="text" class="form-control" id="sexo_responsable" placeholder="Sexo">
              </div>
              <div class="col-md-4 mb-3">
                <label for="ocupacion_responsable" class="form-label">Ocupacion del Responsable</label>
                <input type="string" class="form-control" id="ocupacion_responsable" placeholder="ocupacion">
              </div>
              <div class="col-md-4 mb-3">
                <label for="direccion_responsable" class="form-label">Dirección del Responsable</label>
                <input type="text" class="form-control" id="direccion_responsable" placeholder="Dirección ">
              </div>
              <div class="col-md-4 mb-3">
                <label for="telefono" class="form-label">Telefono del Responsable</label>
  <              <input type="text" class="form-control" id="telefono_resposable" placeholder="Telefono">
              </div>
              <div class="col-md-4 mb-3">
                <label for="comunidad_responsable" class="form-label">Comunidad del Responsable</label>
                <input type="text" class="form-control" id="comunidad_responsable" placeholder="Comunidad">
              </div>
              <div class="col-md-4 mb-3">
                <label for="No_ci" class="form-label">C.I.</label>
                <input type="text" class="form-control" id="ci" placeholder="ci">
              </div>
              <div class="col-md-4 mb-3">
                <label for="N seguro" class="form-label">Numero de Seguro</label>
                <input type="text" class="form-control" id="n_seguro" placeholder="Numero de Seguro">
              </div>
              <div class="col-md-4 mb-3">
                <label for="N carp fam" class="form-label">Numero de Carp Fam</label>
                <input type="text" class="form-control" id="n_carp_fam" placeholder="Numero Carp Fam">
              </div>
            </div>
          </form>
        </div>
        <div class="card-header">
         IDENTIFICACION DEL PACIENTE/USUARIO
        </div>
        <div class="card-body">
          <form>
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fecha_nacimiento" placeholder="Ingresa tu Fecha de Nacimiento">
              </div>
              <div class="col-md-4 mb-3">
                <label for="sexo" class="form-label">Sexo</label>
                <input type="text" class="form-control" id="sexo" placeholder="Sexo">
              </div>
              <div class="col-md-4 mb-3">
                <label for="ocupacion" class="form-label">Ocupacion</label>
                <input type="string" class="form-control" id="ocupacion" placeholder="Ocupacion">
              </div>
              <div class="col-md-4 mb-3">
                <label for="fecha_de_consulta" class="form-label">Fecha de Consulta</label>
                <input type="text" class="form-control" id="fecha_de_consulta" placeholder="Fecha de Consulta">
              </div>

              <div class="col-md-4 mb-3">
                <label for="estadocivil" class="form-label">Estado Civil</label>
                <select class="form-select" id="estado_civil" >
                  <?php
                  $ara = ['soltero(a)','casado(a)','divorciado(a)','union estable'];
                    if(isset($fe["estado_civil"]) && is_string($fe["estado_civil"])){
                      for($i = 0;$i<count($ara);$i++){
                        if($ara[$i] == $fe["estado_civil"]){
                          echo "<option selected>".$ara[$i]."</option>";
                        }else{
                          echo "<option>".$ara[$i]."</option>";
                        }
                      }
                    }else{
                  echo "<option>seleccione</option>
                        <option>soltero(a)</option>
                        <option>casado(a)</option>
                        <option>divorciado(a)</option>
                        <option>union estable</option>";
                    }
                   ?>
                </select>
              </div>
              <div class="col-md-4 mb-3">
                <label for="escolaridad" class="form-label">Escolaridad</label>
                <input type="text" class="form-control" id="escolaridad" placeholder="Seleccione">
              </div>
            </div>
            <button type="button" class="btn btn-primary" onclick="RegistroHistorial()">Registrar</button>
          </form>
        </div>
        <div class="card-footer text-muted">
          © 2024 Centro de Salud
        </div>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">

function RegistroHistorial(){
//responsable de familia
var Nombre_responsable =document.getElementById("Nombre_responsable").value
var ap_responsable =document.getElementById("ap_responsable").value
var am_responsable =document.getElementById("am_responsable").value
var fecha_nacimiento_responsable =document.getElementById("fecha_nacimiento_responsable").value
var sexo_responsable =document.getElementById("sexo_responsable").value
var ocupacion_responsable =document.getElementById("ocupacion_responsable").value
var direccion_responsable =document.getElementById("direccion_responsable").value
var telefono_resposable =document.getElementById("telefono_resposable").value
var comunidad_responsable =document.getElementById("comunidad_responsable").value
var ci =document.getElementById("ci").value
var n_seguro =document.getElementById("n_seguro").value
var n_carp_fam =document.getElementById("n_carp_fam").value
//identificacion del paciente
var paciente_rd = document.getElementById("paciente_rd").value
var cod_rd = document.getElementById("$cod_rd").value
var fecha_nacimiento = document.getElementById("fecha_nacimiento").value
var sexo = document.getElementById("sexo").value
var ocupacion = document.getElementById("ocupacion").value
var fecha_de_consulta = document.getElementById("fecha_de_consulta").value
var estado_civil = document.getElementById("estado_civil").value
var escolaridad = document.getElementById("escolaridad").value

if(Nombre_responsable==""||ap_responsable==""||am_responsable==""||fecha_nacimiento_responsable==""||sexo_responsable==""||ocupacion_responsable==""
||direccion_responsable==""||comunidad_responsable==""||ci==""||nombre==""||ap_usuario==""||am_usuario==""||fecha_nacimiento==""
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

datos.append("paciente_rd",paciente_rd);
datos.append("cod_rd",cod_rd);
datos.append("fecha_nacimiento",fecha_nacimiento);
datos.append("sexo",sexo);
datos.append("ocupacion",ocupacion);
datos.append("fecha_de_consulta",fecha_de_consulta);
datos.append("estado_civil",estado_civil);
datos.append("escolaridad",escolaridad);

$.ajax({
  url: "../controlador/hisorial.controlador.php?accion=rhRyP",
  type: "POST",
  data: datos,
  contentType: false, // Deshabilitar la codificación de tipo MIME
  processData: false, // Deshabilitar la codificación de datos
  success: function(data) {
    //alert(data+"dasdas");
    data=$.trim(data);
    if(data == "correcto"){

      //if(accion == 1){
        //  alertCorrectoUp();
          // close(pagina,listarDeCuanto,buscar);
      //}else{
        alertCorrecto();
      //}
      IRalLinkTablaRegistroDiario();
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


function ingreseNPdatos(){
  Swal.fire({
   icon: 'error',
   title: '¡Error!',
   text: '¡Ingrese los Datos!',
   showConfirmButton: false,
   timer: 1500
 });
}

}
</script>
<?php require("../librerias/footeruni.php"); ?>
