<?php
require_once('vista/esquema/header.php');
?>
<style>
     .card-img-top {
         height: 200px;
         object-fit: cover;
     }
     .card {
         border: none;
         border-radius: 10px;
         box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
         transition: transform 0.3s ease-in-out;
     }
     .card:hover {
         transform: translateY(-10px);
         box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
     }
     .card-body {
         padding: 20px;
     }
     .btn-primary {
         background-color: #007bff;
         border-color: #007bff;
     }
     #modalDescripcion {
   text-align: justify;
 }
 </style>
 <style>
 .text-truncate-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

 </style>

 <!-- Barra de navegación -->
  <h5>CULTURA</h5>

 <style>
   .bg-dark-elegante {
     background-color: white; /* Gris oscuro elegante */
     color: black; /* Texto claro */
   }
 </style>

 <!-- Sección de Lugares Turísticos -->
 <div class="container-md bg-dark-elegante rounded-4 shadow-lg p-4 my-5">
   <h4 class="text-center mb-4" data-aos="fade-up">CULTURA</h4>

     <!-- Lugar 3 -->
     <?php
     $index = 0;
     if ($resul && mysqli_num_rows($resul) > 0) {
         echo '<div class="container-md">';
         while ($fi = mysqli_fetch_array($resul)) {
             $reverseClass = ($index % 2 !== 0) ? 'flex-md-row-reverse' : '';

             // Animaciones alternas
             $imgAnimation = ($index % 2 === 0) ? 'fade-right' : 'fade-left';
             $textAnimation = ($index % 2 === 0) ? 'fade-left' : 'fade-right';

             echo '<div class="row mb-5 align-items-center ' . $reverseClass . '">';

             // Columna de imagen
             echo '<div class="col-md-6 d-flex justify-content-center mb-3 mb-md-0" data-aos="' . $imgAnimation . '">';
             if (!empty($fi['imagen_url'])) {
                 echo '<img src="' . htmlspecialchars($fi['imagen_url']) . '"
                             alt="Imagen actividad"
                             class="img-fluid rounded shadow-lg"
                             style="max-height: 400px; object-fit: cover;">';
             } else {
                 echo '<div class="bg-secondary text-white p-5 text-center rounded shadow-sm">Sin imagen</div>';
             }
             echo '</div>';

             // Columna de contenido
             echo '<div class="col-md-6"  data-aos="' . $textAnimation . '">';
             echo '<div class="p-3 p-md-4 bg-light rounded shadow-sm">';
             echo '<h3 class="mb-3" style="font-size:19px">' . htmlspecialchars(strtoupper($fi['nombre_actividad'])) . '</h3>';
             echo '<p><strong>Tipo:</strong> ' . htmlspecialchars($fi['tipo_actividad']) . '</p>';
             echo '<p class="text-truncate-3"><strong>Descripción:</strong> ' . nl2br(htmlspecialchars($fi['descripcion'])) . '</p>';

             echo '<p><strong>Ubicación:</strong> ' . htmlspecialchars($fi['ubicacion']) . '</p>';
             echo '<p><strong>Fecha Actividad:</strong> ' . htmlspecialchars($fi['fecha_inicio']) .
                  ($fi['fecha_fin'] ? ' - ' . htmlspecialchars($fi['fecha_fin']) : '') . '</p>';
             if (!empty($fi['contacto'])) {
                 echo '<p><strong>Contacto:</strong> ' . htmlspecialchars($fi['contacto']) . '</p>';
             }
        echo "<button class='btn btn-primary mt-2'
        data-bs-toggle='modal'
        data-bs-target='#infoModal'
        data-nombre='" . htmlspecialchars($fi["nombre_actividad"], ENT_QUOTES) . "'
        data-descripcion='" . htmlspecialchars($fi["descripcion"], ENT_QUOTES) . "'
        data-imagen='" . htmlspecialchars($fi["imagen_url"], ENT_QUOTES) . "'
        onclick='loadModalDataFromButton(this)'>
        Más información</button>";





             if (!empty($fi['enlace_web'])) {

              }
             echo '</div>';
             echo '</div>';

             echo '</div>'; // Cierra .row
             $index++;
         }
         echo '</div>'; // Cierra container
     } else {
         echo '<p class="text-center mt-5">No se encontraron actividades.</p>';
     }


      ?>
</div>

<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header bg-primary text-white rounded-top-4">
        <h5 class="modal-title" id="modalLugar1Label">
          <i class="fas fa-plane-departure me-2"></i> <span id="modalLugar1Title">Playa Bonita</span>
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body p-4 bg-dark text-light rounded-bottom-4">
        <div class="row g-4 align-items-center">

          <div class="col-md-12">
            <p id="modalDescripcion" class="mb-3 text-justify"></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

 <script>
  function loadModalDataFromButton(button) {
  const nombre = button.getAttribute('data-nombre');
  const descripcion = button.getAttribute('data-descripcion');
  const imagenUrl = button.getAttribute('data-imagen');

  document.getElementById("modalLugar1Title").textContent = nombre;
  document.getElementById("modalDescripcion").textContent = descripcion;
  document.getElementById("modalImagen").src = imagenUrl;

}

</script>

<?php
// Incluir el archivo footer.php desde la carpeta diseno
require_once('vista/esquema/footeruni.php');
?>
