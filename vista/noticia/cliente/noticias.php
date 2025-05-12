<?php require_once('vista/esquema/header.php'); ?>

<!-- Banner superior -->
<div class="static-slider10" style="background-image:url(imagenes/gamch/challapata-población.jpg); background-size: cover;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center" data-aos="fade-down" data-aos-duration="1200">
                <h1 class="title"></h1><br><br>
                <h1 class="title"></h1><br><br><br><br><br>
            </div>
        </div>
    </div>
</div>

<!-- Contenido -->
<div class="" style="background-color:white">
    <div class="container-sm">
      <br>
        <?php if ($resul && $resul->num_rows > 0): ?>
            <?php while ($newpage = $resul->fetch_object()): ?>
                <div class="row justify-content-center mb-5">
                    <!-- Imagen -->
                    <div class="col-md-5" >
                        <div class="mb-4">
                            <a href="#">
                                <!-- Contenedor para imagen -->
                                <div style="width: 100%; height: 250px; overflow: hidden;">
                                    <img src="<?= htmlspecialchars($newpage->foto) ?>" alt="noticia" class="img-fluid" style="width: 100%; height: 100%; object-fit: contain;">
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Texto -->
                    <div class="col-md-5">
                        <ul class="list-inline text-uppercase text-muted small mb-2">
                            <li class="list-inline-item"><a href="#">Publicado</a></li>
                            <li class="list-inline-item"><a href="#"><?= htmlspecialchars($newpage->fecha) ?></a></li>
                        </ul>

                        <h3 class="fw-light">
                          <a href="#" onclick="SeguirLeyendo(<?= $newpage->id ?>)" class="text-decoration-none">
                              <?= htmlspecialchars($newpage->titulo) ?>
                          </a>

                        </h3>

                        <p class="my-3">
                            <?= substr(strip_tags($newpage->contenido), 0, 200) . '...' ?>
                        </p>

                        <a href="#" onclick="SeguirLeyendo(<?= $newpage->id ?>)"  class="text-primary small text-decoration-none">Seguir Leyendo Más</a>
                    </div>
                </div>
                <hr>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="text-center">
                <p class="text-white">No se encontraron noticias.</p>
            </div>
        <?php endif; ?>

        <!-- Aquí podrías colocar paginación si la agregas luego -->
    </div>
</div>
<script type="text/javascript">
function SeguirLeyendo(id){
  var form = document.createElement('form');
   form.method = 'post';
   form.action = '/seguirLey'; // Coloca la URL de destino correcta
   // Agregar campos ocultos para cada dato
   var datos = {
       id: id
   };
   for (var key in datos) {
       if (datos.hasOwnProperty(key)) {
           var input = document.createElement('input');
           input.type = 'hidden';
           input.name = key;
           input.value = datos[key];
           form.appendChild(input);
       }
   }
 // Agregar el formulario al cuerpo del documento y enviarlo
 document.body.appendChild(form);
 form.submit();
}

</script>

<?php require_once('vista/esquema/footeruni.php'); ?>
