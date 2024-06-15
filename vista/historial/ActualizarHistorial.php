<?php require("../librerias/headeradmin1.php");
if ($resul && count($resul) > 0){
    $i = 0;
  foreach ($resul as $fi){
    $datosResponsable = $fi['datos_responsable_familia'];
    foreach ($datosResponsable as $resFamiliar) {
      echo $resFamiliar["nombre_usuario_re"]." ".$resFamiliar["ap_usuario_re"]." ".$resFamiliar["am_usuario_re"];
    }
    $datospaciente=$fi["paciente_rd_nombre"];
    foreach ($datospaciente as $paciente) {
      echo $paciente["nombre_usuario_re"]." ".$paciente["ap_usuario_re"]." ".$paciente["am_usuario_re"];
    }
  }
}
?>
<?php
    $regHis = $_SERVER["REQUEST_URI"];
    $tablahis=$_SESSION['this'];
      $diario = $_SESSION["diario"];
?>
<div class="container mt-5">
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <?php echo "<div style='background-color:beige;color:red'>ruta: / <a href='$diario'>Registro Diario</a> / <a href='#' onclick='accionHitorialVer($paciente_rd,$cod_rd)'>Historial</a> / <a href='#'onclick='RegistroHistorial($paciente_rd,$cod_rd)'>Registro Historial</a></div>"; ?>

      <div class="card">

        <div class="card-header">

          RESPONSABLE DE FAMILIA
        </div>
        <div class="card-body">
          <form>
            <input type="text" name="paciente_rd" id="paciente_rd" value="<?php $m = (isset($paciente_rd) && is_numeric($paciente_rd))? $paciente_rd: ""; echo $m; ?>">
            <input type="text" name="cod_rd" id="cod_rd" value="<?php $m = (isset($cod_rd) && is_numeric($cod_rd))? $cod_rd:"";echo $m;  ?>">
            <input type="text" name="cod_usuario" id = "cod_usuario" value="">

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
                <input type="date" class="form-control" id="fecha_nacimiento_responsable" placeholder="Fecha de Nacimiento">
              </div>
              <div class="col-md-4 mb-3">
                <label  class="form-label">Sexo</label>
                <input type="text" class="form-control" id="sexo_responsable" placeholder="Sexo">
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
                <input type="text" class="form-control" id="zona_his" placeholder="zona his">
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
                <input type="date" class="form-control" id="fecha_nacimiento" placeholder="Ingresa tu Fecha de Nacimiento">
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Sexo</label>
                <input type="text" class="form-control" id="sexo" placeholder="Sexo">
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Ocupacion</label>
                <input type="string" class="form-control" id="ocupacion" placeholder="Ocupacion">
              </div>
              <div class="col-md-4 mb-3">
                <label  class="form-label">Fecha de Consulta</label>
                <input type="date" class="form-control" id="fecha_de_consulta" placeholder="Fecha de Consulta">
              </div>

              <div class="col-md-4 mb-3">
                <label class="form-label">Estado Civil</label>
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
                <label  class="form-label">Escolaridad</label>
                <select class="form-select" id="escolaridad" >
                  <option>seleccione</option>
                  <option value="Inicial">Educación Inicial</option>
        <option value="Primaria">Educación Primaria</option>
        <option value="Secundaria">Educación Secundaria</option>
        <option value="Superior">Educación Superior</option>
                </select>
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
<style media="screen">
#resultado12{
position: absolute;
z-index: 999;
color: black;
overflow-y: auto;
width: 30%;
transform: translateY(-5px);
}
</style>

<script type="text/javascript">

function RegistroHistorial(){
//responsable de familia

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

if(Nombre_responsable==""||ap_responsable==""||am_responsable==""||fecha_nacimiento_responsable==""||sexo_responsable==""||ocupacion_responsable==""
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
$.ajax({
  url: "../controlador/historial.controlador.php?accion=rhRyP",
  type: "POST",
  data: datos,
  contentType: false, // Deshabilitar la codificación de tipo MIME
  processData: false, // Deshabilitar la codificación de datos
  success: function(data) {
   alert(data+"dasdas");
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
function vaciarDESPUESdeUNtiempo(){
  setTimeout(() => {
    $('#resultado12').html("");
  }, 5000);
}

//funcion para buscar si existe el Paciente
  function buscarExitepaciente(){
    vaciarDESPUESdeUNtiempo();
    var nombre = document.getElementById("Nombre_responsable").value;
    if(nombre != ""){
      alert(nombre);
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


function RegistroHistorial(paciente_rd,cod_rd){

var form = document.createElement('form');
 form.method = 'post';
 form.action = "../controlador/historial.controlador.php?accion=visFH"; // Coloca la URL de destino correcta
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
</script>
<?php require("../librerias/footeruni.php"); ?>
