
<?php require("vista/esquema/header.php"); ?>
<div class="banner-innerpage" style="background-image:url(/imagenes/gamch/fondo.jpg)">
    <div class="container">
    <!-- Row  -->
    <div class="row justify-content-center ">
    <!-- Column -->
    <div class="col-md-6 align-self-center text-center aos-init aos-animate" data-aos="fade-down" data-aos-duration="1200">
    <h1 class="title">GACETA MUNICIPAL</h1>
    <h6 class="subtitle op-8">Gobierno Autonomo Municipal de Challapata</h6>
    </div>
    <!-- Column -->
    </div>
    </div>
</div>

<div class="bg-light spacer feature5">
<div class="nav f45-tab" id="myTab4">
          <!-- Tabs -->
    <a class="nav-item nav-link show active" id="wp-tab" data-toggle="tab" href="#wp-hos"  aria-expanded="true">
        <i class="hidden-sm-up icon-Monitor-4"></i> <span class="hidden-sm-down"><?php echo $ruta; ?></span>
    </a>
</div>

<div class="container-sm">
    <input type="text" id='buscar'name="buscar" placeholder="Buscar..." class="form-control" onkeyup="buscando()">
</div>
<div id="verDatos">
  <div class="container-sm">
      <div class="row mt-4 mb-4">
          <?php
          if ($resul && mysqli_num_rows($resul) > 0) {
              while($doc = mysqli_fetch_array($resul)) {
                if($doc["publicar"] == 1){
                  echo '
                  <div class="col-md-6 mb-4" data-aos="fade-right" data-aos-duration="1200">
                      <div class="card card-shadow h-100">
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-8">
                                      <h6 class="font-medium">'. $doc['nombre_documento'] .'</h6>
                                      <hr>
                                      <p class="text-muted mt-3">'. $doc['descripcion'] .'</p>
                                  </div>
                                  <div class="col-4 text-center">
                                      <a href="'. $doc['archivo'] .'" target="_blank">
                                          <img src="/imagenes/pdf.png" alt="PDF" style="max-width: 50px;">
                                      </a>
                                      <h6 class="font-medium mt-2" style="font-size: 11px;">'. $doc['fecha_creacion'] .'</h6>
                                      <a href="'. $doc['archivo'] .'" download="'. $doc['nombre_documento'] .'.pdf">
                                          <i class="fa fa-download fa-2x text-danger mt-2"></i>
                                      </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>';

                }
              }
          } else {
              echo '
              <div class="col-md-6 mb-4">
                  <div class="card card-shadow h-100" data-aos="fade-right" data-aos-duration="1200">
                      <div class="card-body text-center">
                          <p class="text-muted mb-0">NO SE ENCONTRARON DOCUMENTOS</p>
                      </div>
                  </div>
              </div>';
          }
          ?>
      </div>
  </div>

  </div>
</div>


</div>

<script type="text/javascript">
  function buscando(){
    var buscar = document.getElementById("buscar").value;
    var datos = new FormData(); // Crear un objeto FormData vacío
    datos.append("buscar",buscar);

    $.ajax({
      url: "/buscando",
      type: "POST",
      data: datos,
      contentType: false, // Deshabilitar la codificación de tipo MIME
      processData: false, // Deshabilitar la codificación de datos
      success: function(data) {
        //alert(data+"dasdas");
        data=$.trim(data);
        if(data == "error"){
          error();
        }else{
          $("#verDatos").html(data);
        }
      }
    });
  }
</script>
<?php require("vista/esquema/footeruni.php"); ?>
