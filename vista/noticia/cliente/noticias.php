<?php require_once('vista/esquema/header.php'); ?>
<input type="hidden" name="paginas"id='paginas' value="">
<!-- Banner superior -->
<div class="static-slider10"> <!-- Ajusta la altura a algo menor -->
    <div class="container-md">
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


<div class="container-fluid">
  <div class="row g-4" style="padding:10px">
    <!-- Columna izquierda -->
    <div class="col-lg-9">
      <!-- Contenedor con borde y padding -->
      <div class="p-3" style=" border-radius:8px;">
        <?php
        // Función para imprimir una tarjeta de noticia
        function mostrarNoticia($fil, $tamanoClase = 'medium-news') {
            ?>
            <div class="col-md-6 p-3" style="border:1px solid red;">
                <div class="news-card <?php echo $tamanoClase; ?>">
                  <div class="w-100" style="height: 100%;right: 100%;overflow: hidden;">
                    <img
                      src="<?php echo ($fil['foto'] != '') ? $fil['foto'] : 'imagenes/img-challapata/banner2.jpg'; ?>"
                      class="img-fluid h-100 w-100"
                      style="object-fit: contain;"
                      alt="Imagen dinámica">
                  </div>
                  <div class="news-overlay">
                    <a href="#" class="news-title"><?php echo $fil['titulo']; ?></a>
                  </div>
                </div>
                <div class="news-desc3"><?php echo $fil['contenido']; ?></div>
                <div class="news-date">Fecha:
                  <?php echo fechaAnoMesDia($fil["fecha"]); ?></div>
                <div class="text-end">
                  <a href="#" onclick="SeguirLeyendo(<?php echo $fil["id"]; ?>)"class="text-decoration-none p-0 m-0" style="color:green">
                    Ver más
                  </a>
                </div>
            </div>
            <?php
        }

        $j = 0;
        $abiertaFila = false;
        while ($fil = mysqli_fetch_assoc($resul)) {
            if ($j == 0) {
                // Noticia principal
                ?>
                <div class="news-card big-news mb-4 p-3">
                  <div style="height: 300px; overflow: hidden;">
                  <img
                    src="<?php echo ($fil['foto'] != '') ? $fil['foto'] : 'imagenes/img-challapata/banner2.jpg'; ?>"
                    class="img-fluid"
                    style="
                      width: 100%;
                      height: 100%;
                      object-fit: fill;
                      image-rendering: auto; /* Opciones: auto | crisp-edges | pixelated */
                    "
                    alt="Imagen dinámica">
                </div>


                  <div class="news-overlay">
                       <a href="#" class="news-title"><?php echo $fil['titulo']; ?></a>
                  </div>
                </div>
                <div class="news-desc3"><?php echo $fil['contenido']; ?> </div><div class="news-date"><?php echo fechaAnoMesDia($fil["fecha"]);?></div>
                <div class="text-end">
                  <a href="#"  onclick="SeguirLeyendo(<?php echo $fil["id"]; ?>)" class="text-decoration-none p-0 m-0" style="color:green">
                    Ver más
                  </a>
                </div>
                <?php
            } else {
                // Noticias secundarias en filas de 2
                if ($j % 2 == 1) {
                    echo '<div class="row">'; // Abrir fila
                    $abiertaFila = true;
                }

                mostrarNoticia($fil); // Mostrar noticia

                if ($j % 2 == 0 && $abiertaFila) {
                    echo '</div>'; // Cerrar fila
                    $abiertaFila = false;
                }
            }
            $j++;
        }

        // Si quedó una fila abierta al final
        if ($abiertaFila) {
            echo '</div>';
        }
        ?>
      </div> <!-- Fin del div con borde -->
    </div> <!-- Fin de col-lg-9 -->

       <!-- Columna derecha -->
  <div class="col-lg-3">
    <h6 style="color:green">Noticias Pasadas</h6>
      <div class="row">
        <?php if(mysqli_num_rows($resulNo) > 0){?>
          <?php while($fi = mysqli_fetch_assoc($resulNo)){?>
            <div class="col-12">
              <div class="news-card small-news">
                <img src="<?php echo $fi["foto"]; ?>" alt="Pequeña">
              </div>
              <div class="news-desc1">
                <a href="#" onclick="SeguirLeyendo(<?php echo $fi["id"]; ?>)" class="news-desc1"><?php echo $fi["titulo"]; ?></a></div>
              <div class="news-date">Fecha: <?php
              echo fechaAnoMesDia($fi["fecha"]); ?></div>
            </div>
          <?php } ?>
        <?php } ?>
         </div>
       </div>
     </div>
  </div>

<!-- Contenido -->

<div class="" style="background-color:white">
  <div> <!-- Ajusta la altura a algo menor -->
    <div class="container-fluid">
      <div class="row justify-content-start"> <!-- Cambié 'justify-content-center' a 'justify-content-start' -->
        <div class="col-auto aos-init aos-animate" data-aos="fade-down" data-aos-duration="1200">
          <div class="encabezado-municipal">
            <h4 class="fw-bold text-uppercase text-dark text-start">MAS NOTICIAS</h4> <!-- Añadí 'text-start' -->
            <h6 class="fs-5 text-muted fst-italic text-start">Gobierno Autónomo Municipal de Challapata</h6> <!-- Añadí 'text-start' -->
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id='viewTabla'>
    <div class="container-fluid">
    <br>
    <style media="screen">

    .card1:hover {
      border-color: #0097a7; /* Cambia el color del borde al pasar el ratón */
      box-shadow: 0 8px 16px rgba(0, 158, 171, 0.4); /* Sombra más fuerte al hacer hover */
    }
    </style>
    <div class="row row-cols-1 row-cols-md-4 g-4"> <!-- Aquí usamos row-cols-1 para dispositivos pequeños y row-cols-md-3 para dispositivos medianos en adelante -->
        <?php if ($resul2 && $resul2->num_rows > 0): ?>
            <?php while ($newpage = $resul2->fetch_object()): ?>
                <div class="col mb-4">
                    <div class="card card1" style=" border: 2px solid #00bcd4; /* Celeste claro */
                      border-radius: 8px; /* Esquinas redondeadas */
                      box-shadow: 0 4px 8px rgba(0, 188, 212, 0.3); /* Sombra suave de color celeste */
                      transition: all 0.3s ease; /* Efecto de transición */">
                                        <!-- Imagen -->
                        <div class="card-body">
                            <div style="width: 100%; height: 200px; overflow: hidden;">
                                <img src="<?= htmlspecialchars($newpage->foto) ?>" alt="noticia" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </div>

                        <!-- Texto -->
                        <div class="card-body" style="font-size:11px">
                            <ul class="list-inline text-uppercase text-muted small mb-2">
                                <li class="list-inline-item"><a href="#" style="color:black">Publicado</a></li>
                                <li class="list-inline-item"><a href="#" style="color:black"><?= htmlspecialchars(fechaAnoMesDia($newpage->fecha)) ?></a></li>
                            </ul>

                            <h5 class="card-title" style="font-size:14px">
                                <a href="#" onclick="SeguirLeyendo(<?= htmlspecialchars($newpage->id) ?>)"style="color:black"onclick="SeguirLeyendo(<?= $newpage->id ?>)" class="text-decoration-none">
                                    <?= htmlspecialchars($newpage->titulo) ?>
                                </a>
                            </h5>

                            <p class="card-text" style="color:grey">
                                <?= substr(strip_tags($newpage->contenido), 0, 200) . '...' ?>
                            </p>

                            <a href="#" onclick="SeguirLeyendo(<?= $newpage->id ?>)" class="text-primary small text-decoration-none">Seguir Leyendo Más</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="text-center">
                <p class="text-white">No se encontraron noticias.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Paginación -->
    <?php if ($TotalPaginas != 0):
        $adjacents = 1;
        $anterior = "&lsaquo; Anterior";
        $siguiente = "Siguiente &rsaquo;";
    ?>

    <div class="row">
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
  </div>

</div>
<script type="text/javascript">

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
