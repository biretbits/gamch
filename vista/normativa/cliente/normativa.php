<?php require("vista/esquema/header.php"); ?>
<input type="hidden" name="categoria" id= 'categoria' value="<?php echo $categoria; ?>"><!--campo donde se guarda la categoria de documentos a buscarse con ajax-->
<style media="screen">
.description {
display: -webkit-box; /* Usar un contenedor flexible */
-webkit-box-orient: vertical; /* Establecer la dirección del contenedor */
-webkit-line-clamp: 3; /* Limitar a 3 líneas */
overflow: hidden; /* Ocultar el texto desbordado */
text-overflow: ellipsis; /* Agregar '...' al final si el texto es largo */
}
/* Asegura que los botones mantengan un tamaño fijo */
.btn {
  padding: 0.375rem 0.75rem; /* Tamaño de padding que corresponde al botón pequeño de Bootstrap */
  font-size: 0.875rem; /* Tamaño de fuente para los botones */
  line-height: 1.5; /* Altura de línea normal para los botones */
  display: inline-flex; /* Asegura que los botones no cambien de tamaño y se alineen con los íconos */
  align-items: center; /* Alinea el texto y los íconos verticalmente */
  justify-content: center; /* Alinea el contenido del botón al centro */
}

/* Asegura que los íconos no estiren los botones */
.btn i {
  font-size: 1.25rem; /* Tamaño adecuado para los íconos */
  margin-right: 0.5rem; /* Espacio entre el ícono y el texto */
}

/* Evitar que los botones cambien de tamaño dentro del contenedor */
.d-flex {
  display: flex;
  gap: 0.5rem; /* Ajustar el espacio entre los botones */
  align-items: center; /* Asegura que los botones estén alineados verticalmente */
}

/* Asegura que los botones pequeños no cambien de tamaño inesperadamente */
.btn-sm {
  padding: 0.375rem 0.75rem; /* Establecer el tamaño de los botones pequeños */
}

</style>
<div class="row justify-content-start" style="background:white;padding:5px">
    <!-- Columna Izquierda: Lista de PDFs -->
    <div class="col-lg-6">
      <div class="bg-success text-white p-3 rounded">
     <div class="d-flex align-items-end gap-3 w-100">

       <!-- Texto o categoría -->
       <div class="flex-grow-1 fw-bold">
         <?php echo str_replace("-", " ", $categoria); ?>
       </div>

       <!-- Select de cantidad -->
       <div style="min-width: 100px;">
         <select class="form-select form-select-sm" id="selectList" name="selectList" onchange="BuscarUsuarios(1)">
           <option selected disabled>--</option>
           <option>5</option>
           <option>10</option>
           <option>25</option>
           <option>50</option>
           <option>100</option>
           <option>250</option>
           <option>500</option>
           <option>1000</option>
         </select>
       </div>

       <!-- Campo de búsqueda -->
       <div class="flex-grow-1">
         <div class="input-group input-group-sm">
           <input type="text" class="form-control" id="buscar" name="buscar" placeholder="Buscar..." onkeyup="BuscarUsuarios(1)">
           <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
         </div>
       </div>

     </div>
   </div>
     <br>
      <div id='viewTabla'>
        <?php   if ($resul && mysqli_num_rows($resul) > 0) { ?>
          <?php while($fi = mysqli_fetch_array($resul)){ ?>
          <div class="d-flex align-items-center justify-content-between border p-3 rounded shadow-sm">
            <div class="d-flex align-items-center">
              <i class="fas fa-file-pdf text-danger fs-3 me-3"></i>
              <div>
                <a href="#" target="_blank" class="text-decoration-none fw-bold text-dark">
                  <?php echo $fi["nombre_documento"]; ?>
                </a>
                <div class="text-muted small description"><?php echo $fi["descripcion"]; ?></div>
                <div class="text-muted small"><?php echo $fi["fecha_creacion"]; ?></div>

              </div>
            </div>
            <div class="d-flex gap-2">
              <!-- Botón para previsualizar -->
              <a href="javascript:void(0)" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#pdfModal"
                onclick="ejecutar('<?php echo $fi["archivo"]; ?>')">
                <i class="fas fa-eye me-1"></i> Ver
              </a>

              <!-- Botón para descargar -->
              <a href="<?php echo $fi["archivo"]; ?>" download class="btn btn-outline-secondary btn-sm" title="Descargar PDF">
                <i class="fas fa-download me-1"></i> Descargar
              </a>
            </div>


          </div>
        <?php } ?>
        <?php }else{
          echo "<tr>";
          echo "<td colspan='15' align='center'>No se encontraron resultados</td>";
          echo "</tr>";
        } ?>
        <?php if ($TotalPaginas != 0):
            $adjacents = 1;
            $anterior = "&lsaquo; Anterior";
            $siguiente = "Siguiente &rsaquo;";
        ?>

        <div class="row mt-3">
          <div class="col">
            <nav aria-label="Paginación de resultados">
              <ul class="pagination justify-content-center flex-wrap" style="background:white">

                <!-- Primera página -->
                <?php if ($pagina > 1): ?>
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0);" onclick="BuscarUsuarios(1)" aria-label="Primera">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                <?php endif; ?>

                <!-- Anterior -->
                <?php if ($pagina == 1): ?>
                  <li class="page-item disabled">
                    <span class="page-link"><?= $anterior ?></span>
                  </li>
                <?php else: ?>
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0);" onclick="BuscarUsuarios(<?= $pagina - 1 ?>)"><?= $anterior ?></a>
                  </li>
                <?php endif; ?>

                <!-- Páginas -->
                <?php
                  if ($pagina > ($adjacents + 1)) {
                    echo '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="BuscarUsuarios(1)">1</a></li>';
                  }

                  if ($pagina > ($adjacents + 2)) {
                    echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                  }

                  $pmin = ($pagina > $adjacents) ? ($pagina - $adjacents) : 1;
                  $pmax = ($pagina < ($TotalPaginas - $adjacents)) ? ($pagina + $adjacents) : $TotalPaginas;

                  for ($i = $pmin; $i <= $pmax; $i++) {
                    if ($i == $pagina) {
                      echo '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
                    } else {
                      echo '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="BuscarUsuarios(' . $i . ')">' . $i . '</a></li>';
                    }
                  }

                  if ($pagina < ($TotalPaginas - $adjacents - 1)) {
                    echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                  }

                  if ($pagina < ($TotalPaginas - $adjacents)) {
                    echo '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="BuscarUsuarios(' . $TotalPaginas . ')">' . $TotalPaginas . '</a></li>';
                  }
                ?>

                <!-- Siguiente -->
                <?php if ($pagina < $TotalPaginas): ?>
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0);" onclick="BuscarUsuarios(<?= $pagina + 1 ?>)"><?= $siguiente ?></a>
                  </li>
                <?php else: ?>
                  <li class="page-item disabled">
                    <span class="page-link"><?= $siguiente ?></span>
                  </li>
                <?php endif; ?>

                <!-- Última página -->
                <?php if ($pagina != $TotalPaginas): ?>
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0);" onclick="BuscarUsuarios(<?= $TotalPaginas ?>)" aria-label="Última">
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


        <!-- Columna Derecha: Última Noticia -->
        <div class="col-lg-6">
          <div class="container-md">

            <div class="card shadow-sm">
              <div class="card-header bg-success text-white">
                <h5 class="mb-0">📰 NOTAS RECIENTES</h5>
              </div>
              <div class="card-body">
              <?php while($fila = mysqli_fetch_array($rnoticia)){ ?>
              <?php if (!empty($fila["foto"])): ?>
                <img src="<?php echo $fila["foto"]; ?>" class="img-fluid mb-3 rounded" alt="Imagen de la noticia">
              <?php endif; ?>

              <h4 class="card-title">
                <?php echo !empty($fila["titulo"]) ? strtoupper($fila["titulo"]) : "Sin título"; ?>
              </h4>

              <p class="card-text text-muted">
                Publicado: <?php echo !empty($fila["fecha"]) ? $fila["fecha"] : "Sin fecha"; ?>
              </p>

              <p class="description">
                <?php echo !empty($fila["contenido"]) ? $fila["contenido"] : "Sin contenido disponible."; ?>
              </p>

              <a href="#" onclick="SeguirLeyendo(<?php echo $fila["id"]; ?>)" class="btn btn-sm btn-outline-success">Leer más</a><p></p>
            <?php } ?>
            </div>


            </div>
          </div>
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

    </script>
<!--modal de visualizar pdf-->

<!-- Modal -->
<div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pdfModalLabel">Visor de PDF</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <div class="modal-body">
        <div id="loading-message" style="display: none;">Cargando PDF...</div>

        <div class="container-fluid bg-light py-1 px-2 shadow-sm mb-2" id="top-bar" style="display: none;">
    <div class="row align-items-center">
      <!-- Botones -->
      <div class="col-md-8 d-flex flex-wrap align-items-center gap-1 mb-2 mb-md-0">
        <button class="btn btn-sm btn-outline-primary p-1" id="prev" title="Anterior">
          <i class="fas fa-arrow-left"></i>
        </button>

        <button class="btn btn-sm btn-outline-primary p-1" id="next" title="Siguiente">
          <i class="fas fa-arrow-right"></i>
        </button>

        <button class="btn btn-sm btn-outline-success p-1" id="download" title="Descargar" data-pdfd="vista/DocumentosPDF/RPC2024.pdf">
          <i class="fas fa-download"></i>
        </button>

        <button class="btn btn-sm btn-outline-info p-1 text-white" id="print" title="Imprimir" data-pdf="vista/DocumentosPDF/RPC2024.pdf">
          <i class="fas fa-print"></i>
        </button>
      </div>

      <!-- Paginación -->
      <div class="col-md-4 d-flex justify-content-end align-items-center">
        <span class="me-2 small">Página</span>
        <input type="number" id="page_num_input" class="form-control form-control-sm w-auto" style="max-width: 60px;" value="1" min="1" />
        <span class="ms-2 small">de <span id="page_count"></span></span>
      </div>
    </div>
  </div>

        <div class="container-md" id="canvas-container">
          <canvas id="pdf_canvas" class="w-100 border shadow-sm rounded"></canvas>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
</div>



<script>

function verificarList(valor){
  if(valor != "" && valor != "--"){
    return valor;
  }else{
    return 9;
  }
}
function BuscarUsuarios(page){
  var obt_lis = document.getElementById("selectList").value;
    var listarDeCuanto = verificarList(obt_lis);
    var buscar = document.getElementById("buscar").value;
    document.getElementById("paginas").value=page;
    var categoria = document.getElementById("categoria").value;

    //alert(buscar);
    //ponerFechactualAlModalDeReporte(listarDeCuanto,buscar,page,fecha);
    var datos = new FormData(); // Crear un objeto FormData vacío
    datos.append('pagina', page);
    datos.append('listarDeCuanto',listarDeCuanto);
    datos.append("buscar",buscar);
    datos.append("categoria",categoria);
      $.ajax({
        url: "/buscarViewNormas",
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

pdfjsLib.GlobalWorkerOptions.workerSrc = 'vista/activos/pdf-js/pdf.worker.min.js';


  let archivoPDF = "";

  function ejecutar(ruta) {
    let archivoPDF = ruta;
      loadPDF(archivoPDF);
  }

  let pdfDoc = null,
      pageNum = 1,
      pageRendering = false,
      pageNumPending = null,
      scale = 1.5;

  const canvas = document.getElementById("pdf_canvas");
  const ctx = canvas.getContext('2d');

  function renderPage(num) {
    pageRendering = true;

    pdfDoc.getPage(num).then((page) => {
      const viewport = page.getViewport({ scale: scale });
      const outputScale = window.devicePixelRatio || 1;

      canvas.width = Math.floor(viewport.width * outputScale);
      canvas.height = Math.floor(viewport.height * outputScale);
      canvas.style.width = `${viewport.width}px`;
      canvas.style.height = `${viewport.height}px`;

      const transform = outputScale !== 1 ? [outputScale, 0, 0, outputScale, 0, 0] : null;

      const renderContext = {
        canvasContext: ctx,
        transform: transform,
        viewport: viewport
      };

      const renderTask = page.render(renderContext);
      renderTask.promise.then(() => {
        pageRendering = false;
        if (pageNumPending !== null) {
          renderPage(pageNumPending);
          pageNumPending = null;
        }
      });
    });

    document.getElementById('page_num_input').value = num;
  }


  function queueRenderPage(num) {
    if (pageRendering) {
      pageNumPending = num;
    } else {
      renderPage(num);
    }
  }

  function onPrevPage() {
    if (pageNum <= 1) return;
    pageNum--;
    queueRenderPage(pageNum);
  }

  function onNextPage() {
    if (pageNum >= pdfDoc.numPages) return;
    pageNum++;
    queueRenderPage(pageNum);
  }

  function loadPDF(archivoPDF) {
    document.getElementById('loading-message').style.display = 'block';
    pdfjsLib.getDocument(archivoPDF).promise.then((pdfDoc_) => {
      pdfDoc = pdfDoc_;
      document.getElementById('loading-message').style.display = 'none';
      document.getElementById('top-bar').style.display = 'block';
      document.getElementById('page_count').textContent = pdfDoc.numPages;
      renderPage(pageNum);
    }).catch((error) => {
      document.getElementById('loading-message').style.display = 'none';
      document.getElementById('canvas-container').innerHTML = '<div class="text-danger">No se pudo cargar el PDF.</div>';
    });
  }


  document.getElementById('prev').addEventListener('click', onPrevPage);
  document.getElementById('next').addEventListener('click', onNextPage);

  document.getElementById('page_num_input').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
      const inputPageNum = parseInt(this.value, 10);
      if (inputPageNum >= 1 && inputPageNum <= pdfDoc.numPages) {
        pageNum = inputPageNum;
        queueRenderPage(pageNum);
      } else {
        alert(`Por favor, ingrese un número válido (1 - ${pdfDoc.numPages}).`);
      }
    }
  });

  // Descargar PDF
  document.getElementById('download').addEventListener('click', () => {
    const datapdf = document.getElementById("download").getAttribute('data-pdfd');
    const link = document.createElement('a');
    link.href = datapdf;
    link.download = archivoPDF.split('/').pop();
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  });

  // Evento de clic para imprimir
  document.getElementById('print').addEventListener('click', () => {
    // Obtener la ruta del archivo PDF desde el atributo data-pdf
    const archivoPDF = document.getElementById('print').getAttribute('data-pdf');

    // Abre el PDF en una nueva pestaña
    const printWindow = window.open(archivoPDF, '_blank');
    printWindow.focus();

    // Espera a que la ventana cargue y luego imprime
    printWindow.onload = function() {
      printWindow.print();
    };
  });


  // Bloqueo clic derecho (opcional)
  document.addEventListener('contextmenu', function(event) {
    event.preventDefault();
  });


</script>


<?php require("vista/esquema/footeruni.php"); ?>
