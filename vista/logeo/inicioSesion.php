
<?php require("../librerias/headeradmin1.php"); ?>
<br><br><br><br>
<div class="container">
    <div class="row" >
				<div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-12">
				 <div class="modal-content" style='padding:20px 15px;background: linear-gradient(to right, gray, white);' >
					<center>
					<h3 Style='color:blue;text-shadow: 2px 2px 2px black;'>Acceso</h3></center>
                    <center>
                    <img src="../imagenes/acceso.png"class="img-circle"  height='100' width='110'/>
					</center>
          <br>
            <form method="POST">
							<div class='input-group'>
								<input class="form-control" style="color:black" type="text"  id="usuario" name ="usuario" placeholder=" Nombre usuario" >
									<span class='input-group-addon' id='grupo_user'></span>
							</div>
							<span id="text_user"></span>
		           <br>

							<div class='input-group'>
								<input class="form-control" style="color:black" type='password' id="contrasena" name ="contrasena" placeholder="Contraseña"><br>
                <button class="btn btn-outline-secondary che" type="button" id="che" onclick="mostrar()">
                  <img src='../imagenes/ojo.ico'style='height: 25px;width: 25px;'>
                </button>
							</div>
							<br>
              <button type="button" class="btn btn-warning" id="submit" value="Ingresar" onclick="VerificarDatos();"><img src='../imagenes/entrar.ico' height='25' width='25' alt='Imagen centrada'>  Ingresar</button>

							<br>
						</form>
						<br>
				</div>
			</div>
		</div>
    <br>
    <div class="row">
      <div class="col-6">
        <div class="container px-5 text-center" style='background-color:DarkKhaki; border-radius: 3%;'>
                <div style='color:black'>"Más vale prevenir que curar."</div>
        </div>
      </div>
      <div class="col-6">
        <div class="container px-5 text-center" style='background-color:Khaki; border-radius: 3%;'>
                <div style='color:black'>"El que tiene salud, lo tiene todo."</div>
        </div>
      </div>
    </div>
<br>
<script type="text/javascript">


  document.querySelector('#contrasena').addEventListener ('keypress',function(e){
  validar(e);
  })
  document.querySelector('#usuario').addEventListener ('keypress',function(e){
  validar(e);
  })
  //funcion para validar se  haya pulsado enter incluyendo dispositivos moviles

  function validar(e) {
  let tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13) VerificarDatos();
  }
//funcion para visualizar la contrasena
  function mostrar() {
    var contrasena = document.getElementById("contrasena");
    var bx = document.querySelector(".che");
    if(contrasena.type === 'password'){
      contrasena.type = 'text';
    }else{
      contrasena.type = 'password';
    }
  }

  function VerificarDatos(){
    var usuario = document.getElementById("usuario").value;
    var contrasena = document.getElementById("contrasena").value;

      var datos=new  FormData();
      datos.append("usuario",usuario);
      datos.append("contrasena",contrasena);

      $.ajax({
        type: "POST", //type of submit
        cache: false, //important or else you might get wrong data returned to you
        url: "../controlador/logeo.controlador.php?accion=vcu", //destination
        datatype: "html", //expected data format from process.php
        data: datos, //target your form's data and serialize for a POST
        contentType:false,
        processData:false,
        success: function(r){
        //alert(r);

          r=$.trim(r);
          if(r == "admin"){
            alertCorrecto();
          }else if(r == "medico"){
            alertCorrecto();
          }else if(r == "admision"){
            alertCorrecto();
          }else if(r == "farmacia"){
            alertCorrecto();
          }else if(r == 'Falta_inicio_sesion_admin'){
            Swal.fire({
             icon: 'info',
             title: '¡Información!',
             text: '¡Espere a que inicie sesión el Administrador!',
             showConfirmButton: false,
             timer: 2000
           });
          }else{
            Swal.fire({
             icon: 'error',
             title: '¡Error!',
             text: '¡Hubo un problema al iniciar sesión!',
             showConfirmButton: false,
             timer: 1500
           });
          }
        }
      });

  }
//funcion para mostrar un aler de bienvenido cuando ingreso un usuario del sistema existente
  function alertCorrecto(){
    Swal.fire({
     icon: 'success',
     title: '¡Bienvenido!',
     text: '¡Inicio de session correcto!',
     showConfirmButton: false,
     timer: 1500
   });
   IRalLink();
  }
  //funcion para ir al index cuando ingrese un usuario del sistema
  function IRalLink(){
    setTimeout(() => {
      location.href="../index.php";
     }, 1500);
  }
  /*function close(){
    setTimeout(() => {
       swal.close();
     }, 1500);
  }*/
</script>

</div>

<style>
	body{
    background: url(../imagenes/bosque.jpg) no-repeat center center fixed;
    background-size: cover;
  }

</style>


<?php
//require_once "../view/footer.php";
?>
<?php require("../librerias/footeruni.php"); ?>
