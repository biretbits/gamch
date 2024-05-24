<?php require("../librerias/headeradmin1.php"); ?>
<div class="container mt-5">
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <div class="card">
        <div class="card-header">
          FORMULARIO DE REGISTRO DIARIO
        </div>
        <div class="card-body">
          <form>
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="Nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Ingresa tu nombre" onkeyup="buscarExitepaciente()">
                <div id="resultado" align='left' class='alert alert-light mb-0 py-0 border-0'>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="ap_usuario" class="form-label">Apellido paterno</label>
                <input type="text" class="form-control" id="ap_usuario" placeholder="Ingresa Apellido paterno">
              </div>
              <div class="col-md-4 mb-3">
                <label for="am_usuario" class="form-label">Apellido materno</label>
                <input type="text" class="form-control" id="am_usuario" placeholder="Ingresa Apellido materno">
              </div>
              <div class="col-md-4 mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="text" class="form-control" id="fecha_nacimiento" placeholder="Ingresa tu Fecha de Nacimiento">
              </div>
              <div class="col-md-4 mb-3">
                <label for="edad" class="form-label">Edad</label>
                <input type="text" class="form-control" id="edad" placeholder="Ingresa Tu Edad">
              </div>
              <div class="col-md-4 mb-3">
                <label for="direccion_usuario" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion_usuario" placeholder="Ingresa Tu Dirección">
              </div>
            </div>
          </form>
        </div>
        <div class="card-body">
          <form>
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="servicio" class="form-label">Servicio</label>
                <input type="text" class="form-control" id="servicio" placeholder="servicio">
              </div>
              <div class="col-md-4 mb-3">
                <label for="Signos y Sintomas" class="form-label">Signos y Sintomas</label>
                <input type="text" class="form-control" id="ap_usuario" placeholder="signos y Sintomas">
              </div>
              <div class="col-md-4 mb-3">
                <label for="personal que brinda la atencion" class="form-label">personal que brinda la atencion</label>
                <input type="text" class="form-control" id="personalquebrindalaatencion" placeholder="personal que brinda la atencion">
              </div>
              <div class="col-md-4 mb-3">
                <label for="Historia clinica" class="form-label">Historia clinica</label>
                <input type="text" class="form-control" id="historiaclinica" placeholder="Historia clinica">
              </div>
              <div class="col-md-4 mb-3">
                <label for="resp. admision" class="form-label">resp. admision</label>
                <input type="text" class="form-control" id="respadmision" placeholder="responsable de Admision">
              </div>
              <div class="col-md-4 mb-3">
                <label for="fecha de retorno de Historia" class="form-label">fecha de retorno de Historia</label>
                <input type="text" class="form-control" id="fechaderetornodeHistoria" placeholder="fecha de retorno de Historia">
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
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
#resultado{
position: absolute;
z-index: 999;
overflow-y: auto;
width: 100%;
transform: translateY(-5px);
}
</style>
<script type="text/javascript">
//funcion para buscar si existe el Paciente
  function buscarExitepaciente(){
    var nombre = document.getElementById("nombre").value;
    if(nombre != ""){
    $.ajax({
  		url: "../controlador/registroDiario.controlador.php?accion=bp",
  		type: "POST",
  		data: {nombre:nombre},
  		dataType: "json",
      success: function(data) {
        if(data!=""){
          var unir="";
          for (let i = 0; i < data.length; i++) {
            var usuario = data[i];
            unir+="<div><div id='u' style=' display: inline-block;'>"+data[i].nombre_usuario+"</div></div>";
                //  unir+="<div id='cin' style=' display: inline-block;display:none' >"+data[i].am_usuario+"</div> </div>";
          }
          visualizarUser(unir);
                /*$('#resultado div').on('click', function() {
                  //obtenemos los datos que tiene el estudiante
                 var studendnombre = $(this).children().eq(0).text();
                 var studentci = $(this).children().eq(1).text();
              //dentro de un div guardamos el nombres, curso, ci y el id del estudiante
            });*/
        }else{
          $('#resultado').html("<div class='alert alert-light' role='alert'>No se encontro resultados</div>");
        }

  		}
  	});
  }else{
    $('#resultado').html("");
  }
}
  function visualizarUser(unir){

  $('#resultado').html(unir);
  //colocamos un color de css
  $('#resultado').css({
   'cursor': 'pointer',
   'font-size':'15px'
   });
   // Obtener el elemento div con el id "results"
  /* const divResults = document.getElementById('results');   // Cambiar la clase del div
  divResults.setAttribute('class', 'alert alert-primary mb-0 py-0 border-0');
*/
}
</script>


<?php require ("../librerias/footeruni.php"); ?>
