
<?php require("vista/esquema/header.php"); ?>
<div class="container-mt">
  <div class="d-flex flex-column justify-content-center" id="login-box">
          <div class="login-box-header">
              <h4 style="color:rgb(139,139,139);margin-bottom:0px;font-weight:400;font-size:27px;">Login</h4>
          </div>
          <div class="login-box-content">
              <div class="fb-login box-shadow"><a class="d-flex flex-row align-items-center social-login-link" href="#"><i class="fa fa-facebook" style="margin-left:0px;padding-right:20px;padding-left:22px;width:56px;"></i>Login with Facebook</a></div>
              <div class="gp-login box-shadow"><a class="d-flex flex-row align-items-center social-login-link" style="margin-bottom:10px;" href="#"><i class="fa fa-google" style="color:rgb(255,255,255);width:56px;"></i>Login with Google+</a></div>
          </div>
          <div class="d-flex flex-row align-items-center login-box-seperator-container">
              <div class="login-box-seperator"></div>
              <div class="login-box-seperator-text">
                  <p style="margin-bottom:0px;padding-left:10px;padding-right:10px;font-weight:400;color:rgb(201,201,201);">or</p>
              </div>
              <div class="login-box-seperator"></div>
          </div>
          <div class="email-login" style="background-color:#ffffff;">
            <div class="input-group mb-3">
                <input class="form-control" style="color:black" type="text" id="usuario" name="usuario" placeholder="Usuario">
                <span class="input-group-addon" id="grupo_user"></span>
            </div>
            <span id="text_user"></span>

            <div class="input-group mb-3">
                <input class="form-control" style="color:black" type="password" id="contrasena" name="contrasena" placeholder="Contraseña"><br>
                <button class="btn btn-outline-secondary" type="button" id="che" onclick="mostrar()">
                  <i class="fas fa-eye"></i> <!-- Icono de ojo -->
                </button>
            </div>
          <div class="submit-row" style="margin-bottom:8px;padding-top:0px;"><a class="btn btn-primary d-block box-shadow w-100" role="button" id="submit-id-submit"  onclick="VerificarDatos();">Login</a>
              <div class="d-flex justify-content-between">
                  <div class="form-check form-check-inline" id="form-check-rememberMe"><input class="form-check-input" type="checkbox" id="formCheck-1" for="remember" style="cursor:pointer;" name="check"><label class="form-check-label" for="formCheck-1"><span class="label-text">Remember Me</span></label></div><a id="forgot-password-link" href="#">Forgot Password?</a>
              </div>
          </div>
          <div id="login-box-footer" style="padding:10px 20px;padding-bottom:23px;padding-top:18px;">
              <p style="margin-bottom:0px;">Don't you have an account?<a id="register-link" href="#">Sign Up!</a></p>
          </div>
      </div>


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
        url: "/vcu", //destination
        datatype: "html", //expected data format from process.php
        data: datos, //target your form's data and serialize for a POST
        contentType:false,
        processData:false,
        success: function(r){
          r=$.trim(r);
          //alert(r);
          console.log(r);
          if(r == "correcto"){
            alertCorrecto();
          }else{
            Swal.fire({
             icon: 'error',
             title: '¡Error!',
             text: '¡Hubo un problema al iniciar sesión!',
             showConfirmButton: false,
             timer: 1500
           });
          }
        },error: function(r){
          alert("Ocurrió un error: " + JSON.stringify(r));
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
      location.href="/panel";
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
    background: url(imagenes/bosque.jpg) no-repeat center center fixed;
    background-size: cover;
  }

</style>


<?php
//require_once "../view/footer.php";
?>
<?php require("vista/esquema/footeruni.php"); ?>
