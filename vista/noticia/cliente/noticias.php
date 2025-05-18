<?php require_once('vista/esquema/header.php'); ?>
<input type="hidden" name="paginas"id='paginas' value="">
<!-- Banner superior -->
<div class="static-slider10" style="background-image:url(imagenes/gamch/challapata-población.jpg); background-size: cover;">
    <div class="container">
        <div class="row justify-content-center">
          <div class="col-auto align-self-center text-center aos-init aos-animate" data-aos="fade-down" data-aos-duration="1200">
            <div class="encabezado-municipal">
              <h1 class="display-5 fw-bold text-uppercase text-dark">NOTICIAS</h1>
              <h6 class="fs-5 text-muted fst-italic">Gobierno Autónomo Municipal de Challapata</h6>
            </div>
          </div>
        </div>
    </div>
</div>

<!-- Contenido -->

<div class="" style="background-color:white">
  <div id='viewTabla'>
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
            <?php if ($TotalPaginas != 0):
                $adjacents = 1;
                $anterior = "&lsaquo; Anterior";
                $siguiente = "Siguiente &rsaquo;";
            ?>

            <div class="row mt-3">
              <div class="col">
                <nav>
                  <ul class="pagination justify-content-center flex-wrap" style="background:white">

                    <!-- Primera página -->
                    <?php if ($pagina > 1): ?>
                      <li class="page-item">
                        <a class="page-link rounded-0" href="javascript:void(0);" onclick="BuscarUsuarios(1)" aria-label="Primera">
                          <span aria-hidden="true">&laquo;</span>
                        </a>
                      </li>
                    <?php endif; ?>

                    <!-- Anterior -->
                    <?php if ($pagina == 1): ?>
                      <li class="page-item disabled">
                        <span class="page-link rounded-0"><?= $anterior ?></span>
                      </li>
                    <?php else: ?>
                      <li class="page-item">
                        <a class="page-link rounded-0" href="javascript:void(0);" onclick="BuscarUsuarios(<?= $pagina - 1 ?>)"><?= $anterior ?></a>
                      </li>
                    <?php endif; ?>

                    <!-- Páginas -->
                    <?php
                      if ($pagina > ($adjacents + 1)) {
                        echo '<li class="page-item"><a class="page-link rounded-0" href="javascript:void(0);" onclick="BuscarUsuarios(1)">1</a></li>';
                      }

                      if ($pagina > ($adjacents + 2)) {
                        echo '<li class="page-item disabled"><span class="page-link rounded-0">...</span></li>';
                      }

                      $pmin = ($pagina > $adjacents) ? ($pagina - $adjacents) : 1;
                      $pmax = ($pagina < ($TotalPaginas - $adjacents)) ? ($pagina + $adjacents) : $TotalPaginas;

                      for ($i = $pmin; $i <= $pmax; $i++) {
                        if ($i == $pagina) {
                          echo '<li class="page-item active"><span class="page-link rounded-0 bg-success border-success">' . $i . '</span></li>';
                        } else {
                          echo '<li class="page-item"><a class="page-link rounded-0" href="javascript:void(0);" onclick="BuscarUsuarios(' . $i . ')">' . $i . '</a></li>';
                        }
                      }

                      if ($pagina < ($TotalPaginas - $adjacents - 1)) {
                        echo '<li class="page-item disabled"><span class="page-link rounded-0">...</span></li>';
                      }

                      if ($pagina < ($TotalPaginas - $adjacents)) {
                        echo '<li class="page-item"><a class="page-link rounded-0" href="javascript:void(0);" onclick="BuscarUsuarios(' . $TotalPaginas . ')">' . $TotalPaginas . '</a></li>';
                      }
                    ?>

                    <!-- Siguiente -->
                    <?php if ($pagina < $TotalPaginas): ?>
                      <li class="page-item">
                        <a class="page-link rounded-0" href="javascript:void(0);" onclick="BuscarUsuarios(<?= $pagina + 1 ?>)"><?= $siguiente ?></a>
                      </li>
                    <?php else: ?>
                      <li class="page-item disabled">
                        <span class="page-link rounded-0"><?= $siguiente ?></span>
                      </li>
                    <?php endif; ?>

                    <!-- Última página -->
                    <?php if ($pagina != $TotalPaginas): ?>
                      <li class="page-item">
                        <a class="page-link rounded-0" href="javascript:void(0);" onclick="BuscarUsuarios(<?= $TotalPaginas ?>)" aria-label="Última">
                          <span aria-hidden="true">&raquo;</span>
                        </a>
                      </li>
                    <?php endif; ?>

                  </ul>
                </nav>
              </div>
            </div>

            <?php endif; ?>

            <!-- Aquí podrías colocar paginación si la agregas luego -->
        </div>
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


function verificarList(valor){
  if(valor != "" && valor != "--"){
    return valor;
  }else{
    return 5;
  }
}
function BuscarUsuarios(page){
  var obt_lis = 5;
    var listarDeCuanto = verificarList(obt_lis);
    document.getElementById("paginas").value=page;
    //alert(buscar);
    //ponerFechactualAlModalDeReporte(listarDeCuanto,buscar,page,fecha);
    var datos = new FormData(); // Crear un objeto FormData vacío
    datos.append('pagina', page);
    datos.append('listarDeCuanto',listarDeCuanto);
      $.ajax({
        url: "/listarNoticias",
        type: "POST",
        data: datos,
        contentType: false, // Deshabilitar la codificación de tipo MIME
        processData: false, // Deshabilitar la codificación de datos
        success: function(data) {
        ///alert(data+"dasdas");
          $("#viewTabla").html(data);
        }
      });
  }

</script>

<?php require_once('vista/esquema/footeruni.php'); ?>
