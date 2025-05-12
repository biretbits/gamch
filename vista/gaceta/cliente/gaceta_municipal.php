
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
<div style='background-color:white'>
  <div class="container-sm">
      <!-- Título -->
      <div class="row justify-content-center">
          <div class="col-md-7 text-center">
              <h2 class="title">Elija un Tipo de Documento</h2>
          </div>
      </div>
  </div>
      <!-- Cartas -->
      <div class="container-sm">
        <div class="row m-t-40">
            <?php
            // Arreglo de documentos
            $documentos = [
                ['titulo' => 'LEYES MUNICIPALES', 'descripcion' => 'Documento Referente a Leyes Municipales.', 'ruta' => 'LEYES-MUNICIPALES'],
                ['titulo' => 'RESOLUCIONES MUNICIPALES', 'descripcion' => 'Documento Referente a Resoluciones Municipales.', 'ruta' => 'RESOLUCIONES-MUNICIPALES'],
                ['titulo' => 'RESOLUCIONES MUNICIPALES ADMINISTRATIVOS', 'descripcion' => 'Documento Referente a R.A.M.', 'ruta' =>  'RESOLUCIONES-MUNICIPALES-ADMINISTRATIVOS'],
                ['titulo' => 'DECRETOS EDILES', 'descripcion' => 'Documento Referente a Decretos Ediles.', 'ruta' => 'DECRETOS-EDILES'],
                ['titulo' => 'DECRETOS MUNICIPALES', 'descripcion' => 'Documento Referente a Decretos Municipales.', 'ruta' => 'DECRETOS-MUNICIPALES'],
                ['titulo' => 'TRANSPARENCIA', 'descripcion' => 'Documento Referente a Transparencia.', 'ruta' =>  'TRANSPARENCIA'],
                ['titulo' => 'AUDITORIA INTERNA', 'descripcion' => 'Documento Referente a Auditoria Interna.', 'ruta' => 'AUDITORIA-INTERNA'],
                ['titulo' => 'INFORME DE GESTION', 'descripcion' => 'Documento Referente a Informes de Gestion.', 'ruta' =>  'INFORME-DE-GESTION'],
                ['titulo' => 'DOCUMENTOS IMPORTANTES', 'descripcion' => 'Documentos importantes del municipio.', 'ruta' => 'DOCUMENTOS-IMPORTANTES'],
            ];

            // Animaciones alternadas para efecto visual
            $animaciones = ['fade-right', 'fade-down', 'fade-left', 'fade-up'];
            $i = 0;

            foreach ($documentos as $doc) {
                $anim = $animaciones[$i % count($animaciones)];
                echo '
                  <div class="col-md-4 wrap-feature5-box" data-aos="fade-right" data-aos-duration="1200">
                      <div class="card card-shadow">
                          <div class="card-body d-flex">
                              <div class="icon-space me-3">
                                  <i class="fa-solid fa-file-lines text-success fa-4x"></i>
                              </div> <!-- Espacio entre el icono y el texto -->
                              <div>
                                  <h6 class="font-medium">
                                      <a href="/' . $doc["ruta"] . '" class="linking text-success">' . $doc["titulo"] . '</a>
                                  </h6>
                                  <p class="m-t-20" style="color:grey">' . $doc["descripcion"] . '</p>
                              </div>
                          </div>
                      </div>
                  </div>';

                $i++;
            }
            ?>
        </div>
      </div>

</div>

<?php require("vista/esquema/footeruni.php"); ?>
