<?php require("../librerias/headeradmin1.php"); ?>
<?php $Registro=$_SERVER["REQUEST_URI"];
      $diario = $_SESSION["diario"];
?>
<div class="container main-content">
<div class="container">
  <?php
  echo "<div id='color1'><a href='$diario'id='co'>Registro Diario</a>><a href='$Registro'id='co'>Registrar</a>></div>"; ?>
  <div class="row" >
     <div class="col-12">
       <hr>
     </div>
   </div>
  <div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
        <div class="card-header">
          FORMULARIO DE REGISTRO DIARIO
        </div>
        <div class="card-body">
          <form>
            <div class="row">
              <input type="hidden" name="cod_usuario" id="cod_usuario" value="">
              <input type="hidden" name="cd_admision" id="cd_admision" value="">
              <input type="hidden" name="cd_medico" id="cd_medico" value="">
              <div class="col-md-4 mb-3">
                <label for="Nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Ingresa tu nombre" onkeyup="buscarExitepaciente()" autocomplete="off">
                <div id="resultado" align='left' class='alert alert-light mb-0 py-0 border-0 encimaElTexto'>
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
                <input type="date" class="form-control" id="fecha_nacimiento" placeholder="Ingresa tu Fecha de Nacimiento" onchange="calcularEdad()">
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
                <select id='servicio' name="servicio" class="form-select">
                    <option value="">Seleccione servicio</option>
                  <?php
                    while($row=mysqli_fetch_array($servicios)){
                      echo "<option value='".$row['cod_servicio']."'>".$row['nombre_servicio']."</option>";
                    }
                   ?>
                </select>
              </div>
              <div class="col-md-4 mb-3">
                <label for="Signos y Sintomas" class="form-label">Signos y Sintomas</label>
                <input type="text" class="form-control" id="signos_sintomas" placeholder="signos y Sintomas">
              </div>
              <div class="col-md-4 mb-3">
                <label for="personal que brinda la atencion" class="form-label">personal que brinda la atencion</label>
                <input type="text" class="form-control" id="personalatencion" placeholder="personal que brinda la atencion" onkeyup= "atencionMedico()" autocomplete="off">
                <div id="resultadomedico" align='left' class='alert alert-light mb-0 py-0 border-0 encimaElTexto'>
              </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="resp. admision" class="form-label">resp. admision</label>
                <input type="text" class="form-control" id="respadmision" placeholder="responsable de Admision" onkeyup="buscarResponsableAdmision()" autocomplete="off">
                <div id="resultadoadmision" align='left' class='alert alert-light mb-0 py-0 border-0 encimaElTexto'>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="fecha de retorno de Historia" class="form-label">fecha de retorno de Historia</label>
                <input type="date" class="form-control" id="fechaderetornodeHistoria" placeholder="fecha de retorno de Historia">
              </div>

              <div class="col-md-4 mb-3">
                <label for="Historia clinica" class="form-label"></label>
                <input type="hidden" class="form-control" id="historiaclinica" placeholder="Historia clinica">
              </div>
            </div>
            <button type="button" class="btn btn-primary" onclick="insertardatosus()">Registrar</button>
          </form>
        </div>
        <div class="card-footer text-muted">
          © Centro de Salud
        </div>
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
width: 30%;
transform: translateY(-5px);
}
</style>
<script type="text/javascript">
//funcion para buscar si existe el Paciente
  function buscarExitepaciente(){
    vaciarDESPUESdeUNtiempo();
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
                document.getElementById("nombre").value = nombre;
                if(nombre != ''){
                  document.getElementById("nombre").disabled = true;
                }
                document.getElementById("ap_usuario").value = ap;
                if(ap != ''){
                  document.getElementById("ap_usuario").disabled = true;
                }
                document.getElementById("am_usuario").value = am;
                if(am!=''){
                  document.getElementById("am_usuario").disabled = true;
                }
                var fecha = new Date(fn); // Puedes modificar esta fecha según tus necesidades

                // Formatear la fecha como una cadena para asignarla al campo de tipo date
                var fechaFormateada = fecha.toISOString().split('T')[0];
                document.getElementById("fecha_nacimiento").value = fechaFormateada;
                if(fechaFormateada == null || fechaFormateada=='0000-00-00'){
                  document.getElementById("fecha_nacimiento").disabled = false;
                }else{
                  document.getElementById("fecha_nacimiento").disabled = true;
                }
                document.getElementById("edad").value = ed;
                if(ed == 0){
                  document.getElementById("edad").disabled = false;
                }else{
                  document.getElementById("edad").disabled = true;
                }
                document.getElementById("direccion_usuario").value = d;
                if(d == ''){
                  document.getElementById("direccion_usuario").disabled = false;
                }else {
                  document.getElementById("direccion_usuario").disabled = true;
                }
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
        vaciarDESPUESdeUNtiempoAdmision();
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
      vaciarDESPUESdeUNtiempoMedico();
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

        function insertardatosus(){
        	//alert(accion);
          var cod_usuario = document.getElementById("cod_usuario").value;
        	var nombre = document.getElementById("nombre").value;
        	var ap_usuario = document.getElementById("ap_usuario").value;
        	var am_usuario = document.getElementById("am_usuario").value;
        	var fecha_nacimiento = document.getElementById("fecha_nacimiento").value;
          var edad = parseInt(document.getElementById("edad").value);
        	var direccion_usuario = document.getElementById("direccion_usuario").value;
        	var servicio = document.getElementById("servicio").value;
          var signos_sintomas = document.getElementById("signos_sintomas").value;
          var historiaclinica = document.getElementById("historiaclinica").value;
        	var cd_atencion = document.getElementById("cd_medico").value;
        	var cd_admision = document.getElementById("cd_admision").value;
        	var fechaderetornodeHistoria = document.getElementById("fechaderetornodeHistoria").value;

          const hoy = new Date();
          const fechaNacimiento = new Date(document.getElementById("fecha_nacimiento").value);
          if (!fechaNacimiento.getTime()) {
              fECHAnOVALIDO();
              return;
          }
          if (fechaNacimiento > hoy) {
              fECHAnOVALIDO();
              return;
          }

          // Mostrar el resultado
          if(edad < 0){
            fECHAnOVALIDO();
            return;
          }
         	if(nombre==""||ap_usuario==""||am_usuario==""||fecha_nacimiento==""||direccion_usuario==""
          ||signos_sintomas==""||personalatencion==""||respadmision==""){
        		ingreseNPdatos();
        		return;
        	}

          if(servicio == "Seleccione servicio" || servicio == ""){
            seleccione();
            return
          }
        /*
        	var pagina="";
        	var listarDeCuanto="";
        	var buscar="";
        	var cod_usuario="";
        	if(accion == 1){//1 es actualizae 0 es registrar
        		if(contrasena_usuario == "" && confirmar_contrasena_usuario == ""){
        		}else{
        			if(contrasena_usuario != confirmar_contrasena_usuario){
        				confirmarcontrasena();
        				return;
        			}
        		}
         		 pagina = document.getElementById("pagina").value;
        	 	 listarDeCuanto = document.getElementById("listarDeCuanto").value;
        		 buscar = document.getElementById("buscar").value;
        		 cod_usuario = document.getElementById("cod_usuario").value;
        	}else{
        	}*/
        	var datos = new FormData(); // Crear un objeto FormData vacío
        	datos.append("cod_usuario",cod_usuario);
        	datos.append("nombre",nombre);
        	datos.append("ap_usuario",ap_usuario);
        	datos.append("am_usuario",am_usuario);
        	datos.append("fecha_nacimiento",fecha_nacimiento);
        	datos.append("edad",edad);
        	datos.append("direccion_usuario",direccion_usuario);
        	datos.append("servicio",servicio);
        	datos.append("signos_sintomas",signos_sintomas);
        	datos.append("historiaclinica",historiaclinica);
        	datos.append("personalatencion",cd_atencion);
        	datos.append("respadmision",cd_admision);
        	datos.append("fechaderetornodeHistoria",fechaderetornodeHistoria);
          alert(
  "Código de Usuario: " + cod_usuario + "\n" +
  "Nombre: " + nombre + "\n" +
  "Apellido Paterno: " + ap_usuario + "\n" +
  "Apellido Materno: " + am_usuario + "\n" +
  "Fecha de Nacimiento: " + fecha_nacimiento + "\n" +
  "Edad: " + edad + "\n" +
  "Dirección: " + direccion_usuario + "\n" +
  "Servicio: " + servicio + "\n" +
  "Signos y Síntomas: " + signos_sintomas + "\n" +
  "Historia Clínica: " + historiaclinica + "\n" +
  "Código de Atención: " + cd_atencion + "\n" +
  "Código de Admisión: " + cd_admision + "\n" +
  "Fecha de Retorno: " + fechaderetornodeHistoria
);

          $.ajax({
            url: "../controlador/registroDiario.controlador.php?accion=rNp",
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
            },error:function(r){
              alert("Ocurrió un error: " + JSON.stringify(r));
            }
          });
        }
        function seleccione(){
          Swal.fire({
           icon: 'error',
           title: '¡Error!',
           text: '¡Seleccione!',
           showConfirmButton: false,
           timer: 1500
         });
        }

        //funcion para ir al index cuando ingrese un usuario del sistema
        function vaciarDESPUESdeUNtiempo(){
          setTimeout(() => {
            $('#resultado').html("");
          }, 5000);
        }
        function vaciarDESPUESdeUNtiempoMedico(){
          setTimeout(() => {
            $('#resultadomedico').html("");
          }, 5000);
        }
        function vaciarDESPUESdeUNtiempoAdmision(){
          setTimeout(() => {
            $('#resultadoadmision').html("");
          }, 5000);
        }
        //funcion para ir al index cuando ingrese un usuario del sistema
        function IRalLinkTablaRegistroDiario(){
          setTimeout(() => {
            location.href="../controlador/registroDiario.controlador.php?accion=vtd";
           }, 1500);
        }
        function close(pagina,listarDeCuanto,buscar){
          setTimeout(() => {
            formularioS(pagina,listarDeCuanto,buscar);
           }, 1500);
        }
        function formularioS(pagina,listarDeCuanto,buscar){
          var form = document.createElement('form');
           form.method = 'post';
           form.action = '../controlador/usuario.controlador.php?accion=fm2'; // Coloca la URL de destino correcta
           // Agregar campos ocultos para cada dato
           var datos = {
               pagina: pagina,
               listarDeCuanto: listarDeCuanto,
               buscar: buscar
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

        function alertCorrectoUp(){
          Swal.fire({
           icon: 'success',
           title: '¡Correcto!',
           text: '¡Actualización correcta!',
           showConfirmButton: false,
           timer: 1500
         });
        }

        function ingresedatosPro(){
          Swal.fire({
           icon: 'info',
           title: '¡Información!',
           text: '¡Es necesario la Profesión y la Especialidad!',
           showConfirmButton: false,
           timer: 2000
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
        function selectUsuario(){
          Swal.fire({
           icon: 'error',
           title: '¡Error!',
           text: '¡Por favor seleccione!',
           showConfirmButton: false,
           timer: 1500
         });
        }
         function confirmarcontrasena(){
           Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: '¡Confirmación de Contraseña incorrecta !',
            showConfirmButton: false,
            timer: 1500
          });
         }

        //funcion para mostrar un aler de bienvenido cuando ingreso un usuario del sistema existente
          function alertCorrecto(){
            Swal.fire({
             icon: 'success',
             title: '¡Correcto!',
             text: '¡registro correcto!',
             showConfirmButton: false,
             timer: 1500
           });
           IRalLink();
          }
          //funcion para ir al index cuando ingrese un usuario del sistema
          function IRalLink(){
            setTimeout(() => {
              location.href="../controlador/usuario.controlador.php?accion=vut";
             }, 1500);
          }
          var cam  = true;
          function CamposContrasena(){
            var con = "";
            if(cam == true){
              con += "<br><div class='input-group'>";
                con += "	<input class='form-control' type='password'  id='contraseña_usuario' name ='contraseña_usuario' placeholder='contraseña nueva'>";
                con += "</div> <br>";
                con += "<div class='input-group'>";
                con += "	<input class='form-control' type='password'  id='confirmar_contraseña_usuario' name ='confirmar_contraseña_usuario' placeholder='confirmar contraseña usuario'>";
                con += "</div>";
              cam = false;
            }else{
              con += "<div class='input-group'>";
                con += "	<input class='form-control' type='hidden'  id='contraseña_usuario' name ='contraseña_usuario' placeholder='contraseña nueva'>";
                con += "</div>";
                con += "<div class='input-group'>";
                con += "	<input class='form-control' type='hidden'  id='confirmar_contraseña_usuario' name ='confirmar_contraseña_usuario' placeholder='confirmar contraseña usuario'>";
                con += "</div>";
              cam = true;
            }
            $("#campo").html(con);
          }
//funcion que permite calcular la edad del paciente en tiempo real cuando seleccione su fecha de nacimiento
function calcularEdad(){
  const hoy = new Date();
  // Obtener la fecha de nacimiento del usuario
  const fechaNacimiento = new Date(document.getElementById("fecha_nacimiento").value);

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
  document.getElementById('edad').value = edad;
}

function fECHAnOVALIDO(){
  document.getElementById("fecha_nacimiento").value='';
  Swal.fire({
   icon: 'info',
   title: '¡Error!',
   text: '¡Por favor, selecciona una fecha de nacimiento válida.!',
   showConfirmButton: false,
   timer: 2000
 });
}
</script>

<?php require ("../librerias/footeruni.php"); ?>
