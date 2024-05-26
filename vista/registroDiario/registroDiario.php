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
              <input type="text" name="cod_usuario" id="cod_usuario" value="">
              <input type="text" name="cd_admision" id="cd_admision" value="">
              <input type="text" name="cd_medico" id="cd_medico" value="">
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
                <input type="date" class="form-control" id="fecha_nacimiento" placeholder="Ingresa tu Fecha de Nacimiento">
              </div>
              <div class="col-md-4 mb-3">
                <label for="edad" class="form-label">Edad</label>
                <input type="number" class="form-control" id="edad" placeholder="Ingresa Tu Edad">
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
                <input type="text" class="form-control" id="personalatencion" placeholder="personal que brinda la atencion" onkeyup= "atencionMedico()">
                <div id="resultadomedico" align='left' class='alert alert-light mb-0 py-0 border-0'>
              </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="Historia clinica" class="form-label">Historia clinica</label>
                <input type="text" class="form-control" id="historiaclinica" placeholder="Historia clinica">
              </div>
              <div class="col-md-4 mb-3">
                <label for="resp. admision" class="form-label">resp. admision</label>
                <input type="text" class="form-control" id="respadmision" placeholder="responsable de Admision" onkeyup="buscarResponsableAdmision()">
                <div id="resultadoadmision" align='left' class='alert alert-light mb-0 py-0 border-0'>
                </div>
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
#resultado,#resultadoadmision,#resultadomedico{
position: absolute;
z-index: 999;
color: black;
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
            unir+="<div><div id='u' style=' display: inline-block;'>"+Convertir(data[i].nombre_usuario)+"</div> ";
            unir+="<div id='ap' style=' display: inline-block;'> "+Convertir(data[i].ap_usuario)+"</div> ";
            unir+="<div id='am' style=' display: inline-block;'> "+Convertir(data[i].am_usuario)+"</div> ";
            unir+="<div id='fn' style=' display: inline-block;'> "+data[i].fecha_nac_usuario+"</div>";
            unir+="<div id='ed' style=' display: inline-block;display:none;'>"+data[i].edad_usuario+"</div>";
            unir+="<div id='d' style=' display: inline-block;display:none;'>"+data[i].direccion_usuario+"</div>";
            unir+="<div id='c' style=' display: inline-block;display:none;'>"+data[i].cod_usuario+"</div></div>";

          }

          visualizarUser(unir);
          $('#resultado div').on('click', function() {
                  //obtenemos los datos del usuario div resultado
            var nombre = $(this).children().eq(0).text();
            var ap = $(this).children().eq(1).text();
            var am = $(this).children().eq(2).text();
            var fn = $(this).children().eq(3).text();
            var ed = $(this).children().eq(4).text();
            var d = $(this).children().eq(5).text();
            var c = $(this).children().eq(6).text();

              //dentro de los id de la vista mostramos los datos que estan en el div resultado
              if(nombre != ""){
                document.getElementById("nombre").disabled = true;
                document.getElementById("nombre").value = nombre;
                document.getElementById("ap_usuario").disabled = true;
                document.getElementById("ap_usuario").value = ap;
                document.getElementById("am_usuario").disabled = true;
                document.getElementById("am_usuario").value = am;
                document.getElementById("fecha_nacimiento").disabled = true;
                document.getElementById("fecha_nacimiento").value = fn;
                document.getElementById("edad").disabled = true;
                document.getElementById("edad").value = ed;
                document.getElementById("direccion_usuario").disabled = true;
                document.getElementById("direccion_usuario").value = d;
                document.getElementById("cod_usuario").disabled = true;
                document.getElementById("cod_usuario").value = c;
                $('#resultado').html(""); //para vaciar

              }
          });
        }else{
          $('#resultado').html("<div class='alert alert-light' role='alert'>No se encontro resultados</div>");
        }

  		}
  	});
  }else{
    $('#resultado').html("");
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


function buscarResponsableAdmision() {
        var respadmision = document.getElementById("respadmision").value;
        if (respadmision != "") {
            $.ajax({
                url: "../controlador/registroDiario.controlador.php?accion=bra",
                type: "POST",
            		data: {respadmision:respadmision},
            		dataType: "json",
                success: function(data) {
                  if(data!=""){
                    var unir="";
                    for (let i = 0; i < data.length; i++) {
                      var usuario = data[i];

                      unir+="<div><div id='u' style=' display: inline-block;'>"+Convertir(data[i].nombre_usuario)+"</div> ";
                      unir+="<div id='ap' style=' display: inline-block;'> "+Convertir(data[i].ap_usuario)+"</div> ";
                      unir+="<div id='am' style=' display: inline-block;'> "+Convertir(data[i].am_usuario)+"</div> ";
                      unir+="<div id='p' style=' display: inline-block;'> "+Convertir(data[i].profesion_usuario)+"</div> ";
                      unir+="<div id='c' style=' display: inline-block;display:none;'>"+data[i].cod_usuario+"</div></div>";

                    }

                    visualizarResponsableAdmision(unir);
                    $('#resultadoadmision div').on('click', function() {
                            //obtenemos los datos del usuario div resultado
                      var respadmision = $(this).children().eq(0).text();
                      var ap = $(this).children().eq(1).text();
                      var am = $(this).children().eq(2).text();
                      var c = $(this).children().eq(4).text();
                      var p = $(this).children().eq(3).text();

                        //dentro de los id de la vista mostramos los datos que estan en el div resultado
                        if(respadmision != ""){
                          document.getElementById("respadmision").disabled = true;
                          document.getElementById("respadmision").value = Convertir(respadmision)+" "+Convertir(ap)+" "+Convertir(am)+"   "+Convertir(p);
                          document.getElementById("cd_admision").value = c;
                          $('#resultadoadmision').html(""); //para vaciar

                        }
                    });
                  }else{
                    $('#resultadoadmision').html("<div class='alert alert-light' role='alert'>No se encontro resultados</div>");
                  }

            		}
            	});
            }else{
              $('#resultadoadmision').html("");
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

            function visualizarResponsableAdmision(unir){

            $('#resultadoadmision').html(unir);
            //colocamos un color de css
            $('#resultadoadmision').css({
             'cursor': 'pointer',
             'font-size':'15px'
             });
             // Obtener el elemento div con el id "results"
            /* const divResults = document.getElementById('results');   // Cambiar la clase del div
            divResults.setAttribute('class', 'alert alert-primary mb-0 py-0 border-0');
          */

    }
    function atencionMedico() {

            var personalquebrindalaatencion = document.getElementById("personalatencion").value;
            if ( personalquebrindalaatencion != "") {
                $.ajax({
                    url: "../controlador/registroDiario.controlador.php?accion=bpba",
                    type: "POST",
                		data: {personalquebrindalaatencion:personalquebrindalaatencion},
                		dataType: "json",
                    success: function(data) {
                      if(data!=""){
                        var unir="";
                        for (let i = 0; i < data.length; i++) {
                          var usuario = data[i];

                          unir+="<div><div id='u' style=' display: inline-block;'>"+Convertir(data[i].nombre_usuario)+"</div> ";
                          unir+="<div id='ap' style=' display: inline-block;'> "+Convertir(data[i].ap_usuario)+"</div> ";
                          unir+="<div id='am' style=' display: inline-block;'> "+Convertir(data[i].am_usuario)+"</div> ";
                          unir+="<div id='p' style=' display: inline-block;'> "+Convertir(data[i].profesion_usuario)+"</div> ";
                          unir+="<div id='c' style=' display: inline-block;display:none;'>"+data[i].cod_usuario+"</div></div>";

                        }

                        personalquebrindaatencion(unir);

                        $('#resultadomedico div').on('click', function() {
                                //obtenemos los datos del usuario div resultado
                          var personalquebrindalaatencion = $(this).children().eq(0).text();
                          var ap = $(this).children().eq(1).text();
                          var am = $(this).children().eq(2).text();
                          var c = $(this).children().eq(4).text();
                          var p = $(this).children().eq(3).text();
                //dentro de los id de la vista mostramos los datos que estan en el div resultado
                            if(personalquebrindalaatencion != ""){
                              document.getElementById("personalatencion").disabled = true;
                              document.getElementById("personalatencion").value = Convertir(personalquebrindalaatencion)+" "+Convertir(ap)+" "+Convertir(am)+"   "+Convertir(p);
                              document.getElementById("cd_medico").value = c;
                              $('#resultadomedico').html(""); //para vaciar

                            }
                        });
                      }else{
                        $('#resultadomedico').html("<div class='alert alert-light' role='alert'>No se encontro resultados</div>");
                      }

                		}
                	});
                }else{
                  $('#resultadomedico').html("");
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

                function personalquebrindaatencion(unir){

                $('#resultadomedico').html(unir);
                //colocamos un color de css
                $('#resultadomedico').css({
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
