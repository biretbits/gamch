<?php require_once('vista/esquema/header.php'); ?>
<?php
// Asegúrate de que $resul contiene datos válidos antes de continuar
$fi = mysqli_fetch_array($resul);
?>
<div class="spacer bg-inverse"></div>

<div style="background-color:white;">

    <div class="container-sm">
        <!-- Fila -->
        <div class="row justify-content-center" style="border: 2px solid black">
          <br><br><br>
            <div class="col-md-8">
                <!-- Tarjeta de la noticia -->
                <div class="mini-spacer">
                    <!-- Título de la noticia -->
                    <h2 class="text-center mb-4 text-dark"><?= htmlspecialchars($fi['titulo']) ?></h2>

                    <!-- Imagen de la noticia -->
                    <div class="text-center mb-4">
                        <img src="<?= htmlspecialchars($fi['foto']) ?>" alt="noticia" class="img-fluid" style="max-width: 100%; height: auto; object-fit: cover;">
                    </div>

                    <!-- Información de la noticia -->
                    <ul style="font-size:12px"class="list-inline text-uppercase text-left mb-4 font-11 font-medium text-dark">
                        <b><li class="list-inline-item"><a href="#" class="text-dark">Publicado</a></li></b>
                        <b><li class="list-inline-item"><a href="#" class="text-dark"><?= htmlspecialchars($fi['fecha']) ?></a></li></b>
                    </ul>

                    <!-- Contenedor cuadrado para el contenido -->
                    <div class="border rounded p-4 mb-4 bg-light">
                        <!-- Texto de la noticia -->
                        <p class="text-justify mb-4" style="color:grey;word-wrap: break-word; overflow-wrap: break-word; max-width: 100%;"><?= nl2br(htmlspecialchars($fi['contenido'])) ?></p>
                    </div>

                    <!-- Cita opcional -->
                    <div class="m-t-40 m-b-10 text-center"><i class="display-5 text-muted op-5 fa fa-quote-left"></i></div>
                    <hr class="op-5">

                    <!-- Botones de redes sociales (opcional) -->
                    <!--
                    <div class="m-t-30 text-center">
                        <button type="button" class="btn btn-primary btn-rounded" data-href="#" data-layout="button"><i class="fa fa-facebook"></i> Facebook</button>
                        <button type="button" class="btn btn-info btn-rounded"><i class="fa fa-twitter"></i> Twitter</button>
                    </div>
                    -->
                </div>
                <!-- Fin Tarjeta de la noticia -->
            </div>
        </div>
        <!-- Fin Fila -->
    </div>
</div>

<!-- Scripts si los necesitas -->
<div id="fb-root"></div>



<?php require_once('vista/esquema/footeruni.php'); ?>
