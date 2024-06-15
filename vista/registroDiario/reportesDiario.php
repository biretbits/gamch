<?php require("../librerias/headeradmin1.php"); ?>
<?php $RegistroDiario=$_SERVER["REQUEST_URI"];
$_SESSION["diario"] = $RegistroDiario;?>
<style media="screen">
  #co{
    color:gray;
    font-size: 17px
  }
</style>
<div class="container mt-5">
  <?php
  echo "<div id='color1'><a href='$RegistroDiario'id='co'>Reporte</a>></div>"; ?>
  <div class="row" >
     <div class="col-12">
       <hr>
     </div>
   </div>
   <div class="row">
     <div class="col-auto mb-2" style="color:gray">
         <h5>Reporte de Servicios</h5>
     </div>
     <div class="col-4 mb-1">
       <!-- espacio vacío para mantener el diseño intacto -->
     </div>
     <div class="col-auto mb-2">
       <label for="">Fecha inicio</label>
       <input type="date" name="fecha" id="fecha" value="" onchange="BuscarRegistrosDiarios(1)" class="form-control">
     </div>

     <div class="col-auto mb-2">
        <label for="">Fecha final</label>
       <input type="date" name="fecha" id="fecha" value="" onchange="BuscarRegistrosDiarios(1)" class="form-control">
     </div>
  </div>
  <div class="row">
    <?php
      while($fi=mysqli_fetch_array($resultado)){
        echo "  <div class='col-xl-4 col-md-7 mb-5'>
              <div class='card border-primary shadow h-100 py-2'>
                  <div class='card-body'>
                      <div class='row no-gutters align-items-center'>
                          <div class='col mr-2'>
                              <div class='text-xs font-weight-bold text-primary text-uppercase'>
                                  Pediatria</div>
                              <div class='h5 mb-0 font-weight-bold text-gray-800'>50</div>
                          </div><div class='col-md-6 mx-auto'>
                            <img src='../imagenes/pacienteuser.png' height='200' width='200' class='img-fluid mx-auto d-block' alt='Imagen centrada'>
                          </div>
                      </div>
                  </div>
              </div>
          </div>" ;
       }

     ?>

  </div>
<div class='row'>
  <!-- Earnings (Monthly) Card Example -->

</div>


<?php require("../librerias/footeruni.php"); ?>
