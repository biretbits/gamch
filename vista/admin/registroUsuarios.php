<?php require ("../librerias/headeradmin1.php"); ?>

<div class="modal-dialog text-center" >
	<div class="panel-body col-xl-10 col-lg-10 col-md-9">
    <div class="modal-content" style='padding:20px 10px'>
    	<center>
        <h2 Style='color:blue;text-shadow: 2px 2px 2px black;'>Registro de Usuario</h2>
			</center>
          <div class="card-body">
        		<div class='input-group'>
            <input class="form-control" type="text"  id="usuario" name ="usuario" placeholder="Usuario">
            </div> <br>
            <div class='input-group'>
              <input class="form-control" type="text"  id="nombre_usuario" name ="nombre_usuario" placeholder="Nombre">
            </div> <br>
            <div class='input-group'>
              <input class="form-control" type="text"  id="ap_usuario" name ="ap_usuario" placeholder="Apellido paterno">
            </div> <br>
            <div class='input-group'>
              <input class="form-control" type="text"  id="am_usuario" name ="am_usuario" placeholder="Apellido materno">
            </div> <br>
						<div class='input-group'>
              <input class="form-control" type="number"  id="ci" name ="am_usuario" placeholder="C.I.">
            </div> <br>
            <div class='input-group'>
              <input class="form-control" type="number"  id="telefono_usuario" name ="telefono_usuario" placeholder="Telefono">
            </div> <br>
            <div class='input-group'>
              <input class="form-control" type="text"  id="direccion_usuario" name ="direccion_usuario" placeholder="Dirección">
            </div> <br>
            <div class='input-group'>
              <input class="form-control" type="text"  id="profesion_usuario" name ="profesion_usuario" placeholder="Profesion">
            </div> <br>
            <div class='input-group'>
              <input class="form-control" type="text"  id="especialidad_usuario" name ="especialidad_usuario" placeholder="Especialidad">
            </div> <br>
            <div class='input-group'>
							<select class="form-select" id="tipo_usuario" >
								<option>seleccione</option>
			          <option>medico</option>
			          <option>encargado</option>
			          <option>paciente</option>
			        </select>
            </div> <br>
            <div class='input-group'>
              <input class="form-control" type="password"  id="contraseña_usuario" name ="contraseña_usuario" placeholder="contraseña_usuario">
            </div> <br>
						<div class='input-group'>
								<input class="form-control" type="password"  id="confirmar_contraseña_usuario" name ="confirmar_contraseña_usuario" placeholder="confirmar_contraseña_usuario">
				   	</div> <br>
     			</div>
        		<input class="btn btn-primary"  type="button" id="submit" value="Registar Usuario" onclick= "insertardatosus()">
        			<h6><a href="usuario.controler.php?accion=ingresar">¿ya tienes una cuenta?</a></h6>
      </div>
		</div>
</div>
<script type="text/javascript">
function insertardatosus(){
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
         //alert(contrasena_usuario+" "+ confirmar_contrasena_usuario);

				 if(tipo_usuario == "seleccione"){
 					selectUsuario();
 					return;
 				}

				 if(tipo_usuario == "medico" || tipo_usuario == "encargado"){
					 if(profesion_usuario == "" || especialidad_usuario ==""){
						 ingresedatosPro();
						 return;
					 }
				 }
				 if(usuario==""||nombre_usuario==""||ap_usuario==""||am_usuario==""||ci==""
 				&&telefono_usuario==""||direccion_usuario==""||contrasena_usuario==""||confirmarcontrasena==""){
           ingresedatos();
 					return;
 				}



        if(contrasena_usuario == confirmar_contrasena_usuario){
					//alert(56544);
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
									alertCorrecto();
								}else {
									Saawal.fire({
									 icon: 'error',
									 title: '¡Error!',
									 text: '¡Ocurrio un problema!',
									 showConfirmButton: false,
									 timer: 1500
								 });
								}
								/*$("#verDatos").html(data);*/
							}
						});
					}else{
            confirmarcontrasena();
					}


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
</script>
<?php require ("../librerias/footeruni.php"); ?>
