
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
<nav class="nav f45-tab" id="myTab4">
          <!-- Tabs -->
    <a class="nav-item nav-link show active" id="wp-tab" data-toggle="tab" href="#wp-hos"  aria-expanded="true">
        <i class="hidden-sm-up icon-Monitor-4"></i> <span class="hidden-sm-down">RESOLUCIONES MUNICIPALES ADMINISTRATIVAS</span>
    </a>
</nav>
<div class="my-4">
    <div class="d-flex justify-content-center">
        <input type="text" name="buscar" placeholder="Buscar..." class="form-control w-50">
    </div>
</div>

<div class="tabla-view">
  <div class="container-fluid">
      <div class="row mt-4 mb-4">
          <?php
          if ($resul && mysqli_num_rows($resul) > 0) {
              while($doc = mysqli_fetch_array($resul)) {
                  echo '
                  <div class="col-md-6 mb-4">
                      <div class="card card-shadow h-100" data-aos="fade-right" data-aos-duration="1200">
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


<?php require("vista/esquema/footeruni.php"); ?>
