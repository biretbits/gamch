

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
         if(isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == 'admision'){
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
        }?>
       </div>
   </div>
  </div>
  </div>
  <div class="row">
  <?php if(!isset($_SESSION['tipo_usuario'])){
        ?><div class="alert alert-success border border-success border-3" style=" box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.5);">
            <div class="justify-content-center d-flex " style="height: 100vh;">
              <div class="col-lg-5 col-md-6 col-12">
                <div class="card" style="background-color:khaki">
                  <div class="card-body">
                    <center>
                      <h3 Style='color:blue;text-shadow: 2px 2px 2px black;'>Acceso</h3></center>
                    <center>
                      <img src="imagenes/acceso.png"class="img-circle"  height='100' width='110'/>
                    </center>
                    <br>
                      <form method="POST">
                        <div class='input-group'>
                          <input class="form-control" style="color:black" type="text"  id="usuario" name ="usuario" placeholder=" Nombre usuario">
                            <span class='input-group-addon' id='grupo_user'></span>
                        </div>
                        <span id="text_user"></span>
                         <br>
                        <div class='input-group'>
                          <input class="form-control" style="color:black" type='password' id="contrasena" name ="contrasena" placeholder="Contraseña"><br>
                          <button class="btn btn-outline-secondary che" type="button" id="che" onclick="mostrar()">
                            <img src='imagenes/ojo.ico'style='height: 25px;width: 25px;'>
                          </button>
                        </div>
                        <br>
                        <button type="button" class="btn btn-warning"   style='padding:3px 3px'id="submit" value="Ingresar" onclick="VerificarDatos();"><i class="fas fa-sign-in-alt login-icon"></i> Ingresar</button>
                        <br>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

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
    background-color: rgba(0, 255, 0, 0.3);
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
