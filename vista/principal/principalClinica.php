
<header class="masthead "  style='background: linear-gradient(to right, PapayaWhip, PaleGreen);'>
    <div class="container px-5">
        <div class="row gx-5 align-items-center">
            <div class="col-lg-6 ">
                <!-- Mashead text and app badges-->
                <div class="mb-5 mb-lg-0 text-center text-lg-start">
                    <h1 class="display-1 lh-1 mb-3 colorful-text">Centro de Salud. Cala Cala</h1>
                    <p class="lead fw-normal text-muted mb-5">Bienvenidos a nuestro centro de salud, donde tu bienestar es nuestra prioridad.</p>
                    <div class="d-flex flex-column flex-lg-row align-items-center">
                      <!--  <a class="me-lg-3 mb-4 mb-lg-0" href="#!"><img class="app-badge" src="assets/img/google-play-badge.svg" alt="..." /></a>
                        <a href="#!"><img class="app-badge" src="assets/img/app-store-badge.svg" alt="..." /></a>
                    --></div>
                </div>
            </div>
            <div class="col-lg-6">
                <!-- Masthead device mockup feature-->
                <div class="masthead-device-mockup">
                    <div class="device-wrapper"  style="background-color:rgba(255,255,255,0.5);border-radius:200px">
                              <img src="imagenes/nuevo.png" alt="Imagen Salud" class="screen bg-black img-fluid rounded-circle colorsh"  style="height:400px;max-height: 100%;max-width:100%">

                                <!-- PUT CONTENTS HERE:-->
                                <!-- * * This can be a video, image, or just about anything else.-->
                                <!-- * * Set the max width of your media to 100% and the height to-->
                                <!-- * * 100% like the demo example below.-->
                              <!--  <video muted="muted" autoplay="" loop="" style="max-width: 100%; height: 100%"><source src="assets/img/demo-screen.mp4" type="video/mp4" /></video>-->


                    </div>
                </div>
            </div>
        </div>
    </div>
    <style media="screen">
    .colorful-text {
         font-size: 4em;
         font-weight: bold;
         background: linear-gradient(45deg, #f06, #4a90e2, #50e3c2, #f5a623);
         background-clip: text;
         color: transparent;
         text-shadow: 1px 2px 4px rgba(50, 0, 100, 0.3);
         animation: textAnimation 3s infinite linear;

     }
    </style>
</header>
<!--
<div class="colortex">
  <div class="row">

   <div class="col-3 alert alert-primary border border-primary border-3 " style=" box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.5);">
     <br>
     <img src="imagenes/fig.png" alt="Imagen Salud" class="img-fluid rounded-circle colorsh"  style="max-height: 350px;">
   </div>
   <div class="col-1">

   </div>
   <div class="alert alert-dark border border-dark border-3 col d-flex align-items-center justify-content-center d-flex " style=" box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.5);">
     <div>
       <br>
       <h1 class="display-8  text-center  fondo">Centro de Salud Cala Cala</h1>
       <p class="lead">Bienvenidos a nuestro centro de salud, donde tu bienestar es nuestra prioridad.</p>
       <div class="departamentos_visitados">
         <?php
         /*if(isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == 'admision'){
           $resul =select_registro_diario();
           while($fi=mysqli_fetch_array($resul)){
             //echo " , ".$fi["servicio_rd"];
           }
           echo "<div class='row'>
             <!-- Earnings (Monthly) Card Example -->
             <div class='col-xl-4 col-md-7 mb-5'>
                 <div class='card border-primary shadow h-100 py-2'>
                     <div class='card-body'>
                         <div class='row no-gutters align-items-center'>
                             <div class='col mr-2'>
                                 <div class='text-xs font-weight-bold text-primary text-uppercase'>
                                     Pediatria</div>
                                 <div class='h5 mb-0 font-weight-bold text-gray-800'>50</div>
                             </div><div class='col-md-6 mx-auto'>
                               <img src='imagenes/pacienteuser.png' height='200' width='200' class='img-fluid mx-auto d-block' alt='Imagen centrada'>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
          </div>
          ";
        }*/?>
       </div>
   </div>
  </div>
  </div>-->

  <div class="row">
  <?php
  if(isset($_SESSION['tipo_usuario'])!=""){
    require_once('sql.php');
    ActualizarEntrada();
    ActualizarCantidad();

  }
?>
<?php if(!isset($_SESSION['tipo_usuario'])){ ?>
  <aside class="d-flex align-items-center justify-content-center text-center bg-gradient-primary-to-secondary" style="min-height: 50vh;">
      <div class="container px-5">
          <div class="row justify-content-center">
              <div class="col-lg-6 col-md-8 col-12">
                  <div class="card" style="background-color:khaki">
                      <div class="card-body" style="background: linear-gradient(to right, yellow, #feb47b);">
                          <h3 style="color:blue;text-shadow: 2px 2px 2px black;">Acceso</h3>
                          <img src="imagenes/acceso.png" class="img-circle" height='100' width='110'/>
                          <br><br>
                          <form method="POST">
                              <div class='input-group mb-3'>
                                  <input class="form-control" style="color:black" type="text" id="usuario" name="usuario" placeholder="Nombre usuario">
                                  <span class='input-group-addon' id='grupo_user'></span>
                              </div>
                              <span id="text_user"></span>
                              <div class='input-group mb-3'>
                                  <input class="form-control" style="color:black" type='password' id="contrasena" name="contrasena" placeholder="Contraseña">
                                  <button class="btn btn-outline-secondary che" type="button" id="che" onclick="mostrar()">
                                      <img src='imagenes/ojo.ico' style='height: 25px;width: 25px;'>
                                  </button>
                              </div>
                              <br>
                              <button type="button" class="btn btn-warning" id="submit" value="Ingresar" onclick="VerificarDatos();">
                                  <img src='imagenes/entrar.ico' height='25' width='25' alt='Imagen centrada'> Ingresar
                              </button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </aside>

<?php } ?>
<aside class="text-center bg-gradient-primary-to-secondary">
  <?php   $fecha_actual = date('Y-m-d');
    echo "<h6>Total de pacientes atendidos por servicios hoy ".$fecha_actual."</h6>"; ?>
            <div class="container px-5">

                      <?php
                      require_once('sql.php');
                    //  if(isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == 'admision'){
                        $servicios = selecionarServicios();
                        $resul =select_registro_diario();
                        $diccionario_servicio = array();
                        while($fi=mysqli_fetch_array($servicios)){
                          $diccionario_servicio[$fi['cod_servicio']] = array("contar" => 0, "nombre" => $fi['nombre_servicio']);
                        }
                        while($fi=mysqli_fetch_array($resul)){
                          $diccionario_servicio[$fi["servicio_rd"]]['contar']+=1;

                        }
                        $servicios = selecionarServicios();

                          echo "<div class='row'>";

                        while($fi=mysqli_fetch_array($servicios)){
                          echo "<div class='col-xl-4 col-md-7 mb-5'>
                              <div class='card border-primary shadow h-100 py-2'>
                                  <div class='card-body'>
                                      <div class='row no-gutters align-items-center'>
                                          <div class='col mr-2'>
                                              <div class='text-xs font-weight-bold text-primary text-uppercase'>
                                                  ".$diccionario_servicio[$fi["cod_servicio"]]['nombre']."</div>
                                              <div class='h5 mb-0 font-weight-bold text-gray-800'>".$diccionario_servicio[$fi["cod_servicio"]]['contar']." Pacientes</div>
                                          </div><div class='col-md-6 mx-auto'>
                                            <img src='imagenes/pacienteuser.png' height='200' width='200' class='img-fluid mx-auto d-block' alt='Imagen centrada'>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>

                       ";
                     }
                     echo "</div>";
                     //}
                     ?>

            </div>
</aside>
        <section id="features">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-8 order-lg-1 mb-5 mb-lg-0">
                        <div class="container-fluid px-5">
                            <div class="row gx-5">
                                <div class="col-md-6 mb-5">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                      La salud es un tesoro invaluable que, muchas veces, no apreciamos plenamente hasta que se ve comprometida. Cuidar de nuestro bienestar físico y mental no es solo una responsabilidad personal, sino también un acto de amor hacia nosotros mismos y quienes nos rodean. La salud abarca mucho más que la ausencia de enfermedad; es un estado de equilibrio en el que el cuerpo, la mente y el espíritu funcionan en armonía.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                    El descanso es otro componente esencial. En una sociedad que a menudo glorifica el ajetreo constante y el sacrificio del sueño en nombre de la productividad, es vital recordar que el cuerpo y la mente necesitan tiempo para recuperarse. Dormir bien es crucial para la memoria, la concentración y el bienestar emocional.
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-5 mb-md-0">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                    La prevención es otra clave para una buena salud. Los chequeos médicos regulares, las vacunas y la adopción de hábitos saludables pueden evitar que pequeños problemas se conviertan en grandes preocupaciones. Recordemos que nuestra salud es nuestro principal recurso para disfrutar de la vida, trabajar, aprender y compartir con los demás.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 order-lg-0">
                        <!-- Features section device mockup-->
                        <div class="features-device-mockup">
                             <div class="device-wrapper">
                                <div class="device" data-device="iPhoneX" data-orientation="portrait" data-color="black">
                                    <div class="screen bg-white">
                                        <!-- PUT CONTENTS HERE:-->
                                        <!-- * * This can be a video, image, or just about anything else.-->
                                        <!-- * * Set the max width of your media to 100% and the height to-->
                                        <!-- * * 100% like the demo example below.-->
                                        <img src="imagenes/medi.jpg" alt="Imagen Salud" class="screen bg-black img-fluid rounded-circle colorsh"  style="height:500px;max-height: 100%;max-width:100%">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
  //alert(456);
  var usuario = document.getElementById("usuario").value;
  var contrasena = document.getElementById("contrasena").value;
  //alert(usuario);
    var datos=new  FormData();
    datos.append("usuario",usuario);
    datos.append("contrasena",contrasena);
    $.ajax({
      type: "POST", //type of submit
      cache: false, //important or else you might get wrong data returned to you
      url: "controlador/logeo.controlador.php?accion=vcu", //destination
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
    location.href="index.php";
   }, 1500);
}
/*function close(){
  setTimeout(() => {
     swal.close();
   }, 1500);
}*/
</script>
<style media="screen">
  .fondo{
    background-color: orange;
   color: #ffffff; /* Color blanco para el texto */
   text-shadow: 2px 2px 4px rgba(250, 0, 0, 0.3); /* Sombra del texto */
   text-align: center;
   padding: 10px; /* Espaciado interno */
   border-radius: 10px; /* Redondear bordes */
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  }
  .colortex{
  background: linear-gradient(to right, orange, yellow);
   color: #ffffff; /* Color blanco para el texto */
   text-shadow: 2px 2px 4px rgba(250, 0, 0, 0.3); /* Sombra del texto */
   text-align: center;
   padding: 20px; /* Espaciado interno */
   border-radius: 5px; /* Redondear bordes */
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  }
  .colorsh{
     box-shadow: 5px 4px 10px rgba(0, 0, 0, 1);
  }

</style>
