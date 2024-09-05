<?php require("../librerias/headeradmin1.php"); ?>

<div class="container main-content">
<div class="container">
  <?php
  /*echo "<div id='color1'><a href='$diario'id='co'>Registro Diario</a>><a href='#'
   onclick='accionHitorialVer($paciente_rd,$cod_rd)'
   id='co'>Historial</a>></div>"; */

   ?>

<h4>Configurar el control de acceso</h4>
<div class="row" >
     <div class="col-12">
       <hr>
     </div>
   </div>
<p>Nota:</p>
<p>Si la configuración esta en "si" todos los usuarios tendran que esperar que inicie el sistema el administrador, para poder ingresar al sistema.</p>
<p>Si la configuración esta en "no" todos los usuarios pueden ingresar al sistema si necesidad de espera de inicio el administrador</p>
<p>Tenga en cuenta que si el control de acceso lo configura a "si" todos los usuarios seran afectados, por eso esta accion debe de realizarse fuera de horarios de trabajo, tenga en cuenta.</p>
    <div class="row">
      <div class="col-lg-12">
        <label for="">Control de acceso</label>
        <select class="form-control" name="cacceso" id='cacceso' onchange="configurar()">
          <option value="">seleccione</option>
          <?php
            if($resul!='' and mysqli_num_rows($resul)>0){
                $ar = ["si",'no'];
                $fila = mysqli_fetch_array($resul);
                for($i = 0;$i<count($ar);$i++){
                  if($fila["configControlAcceso"] == $ar[$i]){
                    echo "<option value='".$ar[$i]."' selected>".$ar[$i]."</option>";
                  }else{
                    echo "<option value='".$ar[$i]."'>".$ar[$i]."</option>";
                  }
                }
              }else{
                echo "  <option value='si'>si</option>
                  <option value='no'>no</option>
                ";
            }
           ?>
        </select>
      </div>
    </div>
  </div>
</div>
 <!-- modal de seleccion de fechas-->
<script type="text/javascript">
  function configurar(){
    var control = document.getElementById("cacceso").value;
    var formData = new FormData();
    formData.append('control', control);
    $.ajax({
      url: '../controlador/usuario.controlador.php?accion=cambiarCOnfig', // Archivo PHP que procesa la subida
      type: 'POST',
      data: formData,
      contentType: false, // No establecer el tipo de contenido
      processData: false, // No procesar los datos
      success: function (r) {
        if(r=='correcto'){
          Error1();
        }else{
          Correcto();
        }
        setTimeout(() => {
          location.href="../controlador/usuario.controlador.php?accion=cca";
        }, 1500);
      }
    })
  }
  function Correcto(){
    Swal.fire({
     icon: 'success',
     title: '¡Correcto!',
     text: '¡Se cambio la correctamente!',
     showConfirmButton: false,
     timer: 2000
   });
  }
  function Error1(){
    Swal.fire({
     icon: 'error',
     title: '¡Error!',
     text: '¡Ocurrio algun error!',
     showConfirmButton: false,
     timer: 1500
   });
  }
</script>
<?php require("../librerias/footeruni.php"); ?>
