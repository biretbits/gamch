<?php require ("../librerias/headeradmin1.php");
	//existe seleccionado un usario para editar o no si no existe visualizamos el formulario normal
	if(isset($re) && $re->num_rows > 0){
		$fe = mysqli_fetch_array($re);//si hay entonces guardamos los datos en una variable
	}

?>
<br>
<div class="modal-dialog text-center" >
	<div class="panel-body col-xl-10 col-lg-10 col-md-9">
    <div class="modal-content" style='padding:20px 10px'>
    	<center>
        <h2 Style='color:blue;text-shadow: 2px 2px 2px black;'>
					<?php $smg = "";$msg = (isset($fe["cod_usuario"]) && is_numeric($fe["cod_usuario"])) ? "Actualizar usuario" : "Registro de usuario"; echo $msg;?></h2>
			</center>
          <div class="card-body">
						<input type="hidden" name="pagina" id="pagina" value='<?php $smg = ""; $msg = (isset($pagina) && is_numeric($pagina)) ? $pagina :""; echo $msg;?>'>
						<input type="hidden" name="listarDeCuanto" id="listarDeCuanto" value='<?php $smg = ""; $msg = (isset($listarDeCuanto) && is_string($listarDeCuanto)) ? $listarDeCuanto :""; echo $msg;?>'>
						<input type="hidden" name="buscar" id="buscar"  value='<?php $smg = ""; $msg = (isset($buscar) && $buscar != "") ? $buscar :""; echo $msg;?>'>
						<input type="hidden" name="cod_usuario" id="cod_usuario" value='<?php $smg = ""; $msg = (isset($cod_usuario) && is_numeric($cod_usuario)) ? $cod_usuario :""; echo $msg;?>'>
        		<div class='input-group'>
            <input class="form-control" type="text"  id="usuario" name ="usuario" placeholder="Usuario" value='<?php $smg = ""; $msg = (isset($fe["usuario"]) && is_string($fe["usuario"])) ? $fe["usuario"] :""; echo $msg;?>'>
            </div> <br>
            <div class='input-group'>
              <input class="form-control" type="text"  id="nombre_usuario" name ="nombre_usuario" placeholder="Nombre" value='<?php $smg = ""; $msg = (isset($fe["nombre_usuario"]) && is_string($fe["nombre_usuario"])) ? $fe["nombre_usuario"] :""; echo $msg;?>'>
            </div> <br>
            <div class='input-group'>
              <input class="form-control" type="text"  id="ap_usuario" name ="ap_usuario" placeholder="Apellido paterno" value='<?php $smg = ""; $msg = (isset($fe["ap_usuario"]) && is_string($fe["ap_usuario"])) ? $fe["ap_usuario"] :""; echo $msg;?>'>
            </div> <br>
            <div class='input-group'>
              <input class="form-control" type="text"  id="am_usuario" name ="am_usuario" placeholder="Apellido materno" value='<?php $smg = ""; $msg = (isset($fe["am_usuario"]) && is_string($fe["am_usuario"])) ? $fe["am_usuario"] :""; echo $msg;?>'>
            </div> <br>
						<div class='input-group'>
              <input class="form-control" type="number"  id="ci" name ="am_usuario" placeholder="C.I." value='<?php $smg = ""; $msg = (isset($fe["ci_usuario"]) && is_string($fe["ci_usuario"])) ? $fe["ci_usuario"] :""; echo $msg;?>'>
            </div> <br>
            <div class='input-group'>
              <input class="form-control" type="number"  id="telefono_usuario" name ="telefono_usuario" placeholder="Telefono" value='<?php $smg = ""; $msg = (isset($fe["telefono_usuario"]) && is_string($fe["telefono_usuario"])) ? $fe["telefono_usuario"] :""; echo $msg;?>'>
            </div> <br>
            <div class='input-group'>
              <input class="form-control" type="text"  id="direccion_usuario" name ="direccion_usuario" placeholder="Dirección" value='<?php $smg = ""; $msg = (isset($fe["direccion_usuario"]) && is_string($fe["direccion_usuario"])) ? $fe["direccion_usuario"] :""; echo $msg;?>'>
            </div> <br>
            <div class='input-group'>
              <input class="form-control" type="text"  id="profesion_usuario" name ="profesion_usuario" placeholder="Profesion" value='<?php $smg = ""; $msg = (isset($fe["profesion_usuario"]) && is_string($fe["profesion_usuario"])) ? $fe["profesion_usuario"] :""; echo $msg;?>'>
            </div> <br>
            <div class='input-group'>
              <input class="form-control" type="text"  id="especialidad_usuario" name ="especialidad_usuario" placeholder="Especialidad" value='<?php $smg = ""; $msg = (isset($fe["especialidad_usuario"]) && is_string($fe["especialidad_usuario"])) ? $fe["especialidad_usuario"] :""; echo $msg;?>'>
            </div> <br>
            <div class='input-group'>
							<select class="form-select" id="tipo_usuario" >
								<?php
								$ara = ['medico','encargado','paciente','admision'];
									if(isset($fe["tipo_usuario"]) && is_string($fe["tipo_usuario"])){
										for($i = 0;$i<count($ara);$i++){
											if($ara[$i] == $fe["tipo_usuario"]){
												echo "<option selected>".$ara[$i]."</option>";
											}else{
												echo "<option>".$ara[$i]."</option>";
											}
										}
									}else{
								echo "<option>seleccione</option>
				          		<option>medico</option>
				          		<option>encargado</option>
											<option>admision</option>
				          		<option>paciente</option>";
									}
								 ?>
			        </select>
            </div> <br>
						<?php
								if(isset($fe["cod_usuario"]) && is_numeric($fe["cod_usuario"])){
									echo "<center>";
										echo "<input class='btn btn-warning'  type='button' id='submit' value = 'Cambiar Contraseña' onclick='CamposContrasena()'>";
									echo "</center>";
								}else{
						 ?>
			            <div class='input-group'>
			              <input class="form-control" type="password"  id="contraseña_usuario" name ="contraseña_usuario" placeholder="contraseña_usuario" onkeyup="comprovando()"value='<?php $smg = ""; $msg = (isset($fe["contrasena_usuario"]) && is_string($fe["contrasena_usuario"])) ? $fe["contrasena_usuario"] :""; echo $msg;?>'>
										<button class="btn btn-outline-secondary che" type="button" id="che" onclick="mostrar()">
											<img src='../imagenes/ojo.ico'style='height: 25px;width: 25px;'>
										</button>

								  </div>
										<span id="message" class="error"></span>
									<div id='validandoContrasena'>

									</div>
									<div class='input-group'>
											<input class="form-control" type="password"  id="confirmar_contraseña_usuario" name ="confirmar_contraseña_usuario" onkeyup="validarIguales()" placeholder="confirmar_contraseña_usuario">

									</div>	<span id='message_conf'></span>
					<?php } ?>
					<div id="campo">

					</div>
					</div>
					<?php  $dato = "";$dato = (isset($fe["cod_usuario"]) && is_numeric($fe["cod_usuario"])) ? 1 : 0;?>
        		<input class="btn btn-primary"  type="button" id="submit" value="<?php $smg = "";$msg = (isset($fe["cod_usuario"]) && is_numeric($fe["cod_usuario"])) ? "Actualizar" : "Registrar"; echo $msg;?>" onclick= "insertardatosus('<?php echo $dato; ?>')">

      </div>
		</div>
</div>
<style media="screen">

	 .checkmark {
		 display: none;
		 font-size: 20px;
	 }
	 .checkmark.visible {
		 display: inline;
		 color: green;
		 animation: fadeIn 0.5s;
	 }
	 .list-item.validated {
		 animation: popIn 0.5s;
	 }
	 @keyframes fadeIn {
		 from { opacity: 0; }
		 to { opacity: 1; }
	 }
	 @keyframes popIn {
		 0% { transform: scale(0.5); opacity: 0; }
		 100% { transform: scale(1); opacity: 1; }
	 }
</style>
<script type="text/javascript">
function insertardatosus(accion){
	//alert(accion);

	var usuario = document.getElementById("usuario").value;
	var nombre_usuario = document.getElementById("nombre_usuario").value;
	var ap_usuario = document.getElementById("ap_usuario").value;
	var am_usuario = document.getElementById("am_usuario").value;
	var ci = document.getElementById("ci").value;
	var telefono_usuario = document.getElementById("telefono_usuario").value;
	var direccion_usuario = document.getElementById("direccion_usuario").value;
	var profesion_usuario = document.getElementById("profesion_usuario").value;
	var especialidad_usuario = document.getElementById("especialidad_usuario").value;
	var tipo_usuario = document.getElementById("tipo_usuario").value;
	var contrasena_usuario = document.getElementById("contraseña_usuario").value;
	var confirmar_contrasena_usuario = document.getElementById("confirmar_contraseña_usuario").value;
	if(usuario==""||nombre_usuario==""||ap_usuario==""||am_usuario==""
		 	||direccion_usuario==""){
		ingresedatos();
		return;
	}
	if(tipo_usuario == "seleccione"){
		selectUsuario();
		return;
	}
	if(tipo_usuario == "medico" || tipo_usuario == "encargado"){
	 if(profesion_usuario == "" || especialidad_usuario =="" ||telefono_usuario==""||ci==""){
		 ingresedatosPro();
		 return;
		}
	}

	var result = validarLetras()
	if(result == 0){
		eliminar();
		return;
	}
	eliminar();
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
		if(contrasena_usuario != confirmar_contrasena_usuario && contrasena_usuario != "" && confirmar_contrasena_usuario !=""){
			confirmarcontrasena();
			return;
		}
	}
	var datos = new FormData(); // Crear un objeto FormData vacío
	datos.append("usuario",usuario);
	datos.append("nombre_usuario",nombre_usuario);
	datos.append("ap_usuario",ap_usuario);
	datos.append("am_usuario",am_usuario);
	datos.append("ci",ci);
	datos.append("telefono_usuario",telefono_usuario);
	datos.append("direccion_usuario",direccion_usuario);
	datos.append("profesion_usuario",profesion_usuario);
	datos.append("especialidad_usuario",especialidad_usuario);
	datos.append("tipo_usuario",tipo_usuario);
	datos.append("contraseña_usuario",contrasena_usuario);
	datos.append("cod_usuario",cod_usuario);
	datos.append("accion",accion);

	$.ajax({
		url: "../controlador/usuario.controlador.php?accion=insUsu",
		type: "POST",
		data: datos,
		contentType: false, // Deshabilitar la codificación de tipo MIME
		processData: false, // Deshabilitar la codificación de datos
		success: function(data) {
			//alert(data+"dasdas");
			data=$.trim(data);
			if(data == "correcto"){

				if(accion == 1){
						alertCorrectoUp();
						 close(pagina,listarDeCuanto,buscar);
				}else{
					alertCorrecto();
				}
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
function ingresedatos(){
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
				con += "	<input class='form-control' type='password'  id='contraseña_usuario' name ='contraseña_usuario' onkeyup='comprovando()' placeholder='contraseña nueva'>";
				con += "<button class='btn btn-outline-secondary che' type='button' id='che' onclick='mostrar()'>";
				con += "<img src='../imagenes/ojo.ico'style='height: 25px;width: 25px;'>";
				con += "</button></div>";
				con += "<span id='message' class='error'></span>";
				con += "<div id='validandoContrasena'></div>";
				con += "<div class='input-group'>";
				con += "	<input class='form-control' type='password'  id='confirmar_contraseña_usuario' name ='confirmar_contraseña_usuario' onkeyup='validarIguales()'placeholder='confirmar contraseña usuario'>";
				con += "</div><span id='message_conf'></span>";
			cam = false;
		}else{
			con = '';
			cam = true;
		}
		$("#campo").html(con);
		if(cam == false){
				ver();
		}

	}
	ver();
	function comprovando(){
		const passwordInput = document.getElementById('contraseña_usuario');
    const uppercaseCheck = document.getElementById('check-uppercase');
    const lowercaseCheck = document.getElementById('check-lowercase');
    const numberCheck = document.getElementById('check-number');
    const specialCheck = document.getElementById('check-special');
		 const lengthCheck = document.getElementById('check-length');

    const uppercaseItem = document.getElementById('uppercase');
    const lowercaseItem = document.getElementById('lowercase');
    const numberItem = document.getElementById('number');
    const specialItem = document.getElementById('special');
		const lengthItem = document.getElementById('length');
    passwordInput.addEventListener('input', function() {
      const password = passwordInput.value;
			const hasMinLength = password.length >= 8;
      const hasUpperCase = /[A-Z]/.test(password);
      const hasLowerCase = /[a-z]/.test(password);
      const hasNumbers = /[0-9]/.test(password);
      const hasSpecialChars = /[!@#$%^&*(),.?":{}|<>]/.test(password);

      // Actualizar estado visual de cada criterio
      updateCheckmark(hasUpperCase, uppercaseCheck, uppercaseItem);
      updateCheckmark(hasLowerCase, lowercaseCheck, lowercaseItem);
      updateCheckmark(hasNumbers, numberCheck, numberItem);
      updateCheckmark(hasSpecialChars, specialCheck, specialItem);

	    updateCheckmark(hasMinLength, lengthCheck, lengthItem);
    });


	}
	function updateCheckmark(condition, checkmarkElement, listItemElement) {
		if (condition) {
			checkmarkElement.classList.add('visible');
			listItemElement.classList.add('validated');
		} else {
			checkmarkElement.classList.remove('visible');
			listItemElement.classList.remove('validated');
		}
	}

	function validarLetras(){
		const password = document.getElementById("contraseña_usuario").value;
		 const hasUpperCase = /[A-Z]/.test(password);
		 const hasLowerCase = /[a-z]/.test(password);
		 const hasNumbers = /[0-9]/.test(password);
		 const hasSpecialChars = /[!@#$%^&*(),.?":{}|<>]/.test(password);
		 var c = 1;
		 if (!hasUpperCase || !hasLowerCase || !hasNumbers || !hasSpecialChars) {
			  $("#message").html("<div class = 'alert alert-danger'>La contraseña debe contener mayúsculas, minúsculas, números, caracteres especiales y al menos 8 caracteres.</div>");
			 event.preventDefault();
			 c = 0;
		 } else {
			 $("#message").html("<div class = 'alert alert-success'>La contraseña es valida</div>");
			 c= 1;
		 }
		 return c;
	}
	function eliminar(){
		setTimeout(function() {
			 $("#message").html("");
		}, 3000);
	}
	function mostrar() {
    var contrasena = document.getElementById("contraseña_usuario");
    var bx = document.querySelector(".che");
    if(contrasena.type === 'password'){
      contrasena.type = 'text';
    }else{
      contrasena.type = 'password';
    }
  }
	function validarIguales(){
		  var contrasena = document.getElementById("contraseña_usuario").value;
			var conf_contrasena = document.getElementById("confirmar_contraseña_usuario").value;
			if(contrasena == conf_contrasena){
					$("#message_conf").html("<div class = 'alert alert-success'>La confirmación es correcta</div>");
						eliminarConfirmar();
			}else{
					$("#message_conf").html("<div class = 'alert alert-danger'>La confirmación no es correcto</div>");
			}

	}
	function eliminarConfirmar(){
		setTimeout(function() {
			 $("#message_conf").html("");
		}, 3000);
	}
	function ver(){
		var con = '';
		con +="<ul style='font-size:12px'>";
		con +=" La contraseña debe contener:";
		con +="	<li id='uppercase'>Letras mayúscula <span class='checkmark' id='check-uppercase'>&#10003;</span></li>";
		con +="	<li id='lowercase'>Letras minúscula <span class='checkmark' id='check-lowercase'>&#10003;</span></li>";
		con +="	<li id='number'>Números <span class='checkmark' id='check-number'>&#10003;</span></li>";
		con +="	<li id='special'>Carácteres especiales <span class='checkmark' id='check-special'>&#10003;</span></li>";
		con += "<li id='length' class='list-item'>Al menos 8 caracteres <span class='checkmark' id='check-length'>&#10003;</span></li>";
    con +="	</ul>";
		$("#validandoContrasena").html(con);
	}
</script>
<?php require ("../librerias/footeruni.php"); ?>
