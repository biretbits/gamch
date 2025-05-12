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
 .text-truncate-2 {
   display: -webkit-box;
   -webkit-line-clamp: 2;      /* Número de líneas a mostrar */
   -webkit-box-orient: vertical;
   overflow: hidden;
 }
 </style>
<a class="navbar-brand" href="#">Turismo</a>

 <style>
   .bg-dark-elegante {
     background-color: white; /* Gris oscuro elegante */
     color: black; /* Texto claro */
   }
 </style>

 <!-- Sección de Lugares Turísticos -->
 <div class="container-md bg-dark-elegante rounded-4 shadow-lg p-4 my-5">
   <h2 class="text-center mb-4" data-aos="fade-up">Lugares Turísticos</h2>
   <div class="row row-cols-1 row-cols-md-3 g-4">

     <!-- Lugar 3 -->
     <?php
     if ($resul && mysqli_num_rows($resul) > 0) {
        while($fi = mysqli_fetch_array($resul)){
          echo "<div class='col' data-aos='zoom-in' data-aos-delay='300'>
            <div class='card h-100 shadow-sm bg-secondary text-light'>
              <img src='".$fi["imagen_url"]."' class='img-fluid w-100 object-fit-cover' style='height: 200px;' alt='Lugar 3'>";

              echo "<div class='card-body'>
          <h5 class='card-title'>".strtoupper($fi["nombre_destino"])."</h5>
          <p class='card-text text-truncate-2'>".$fi["descripcion"]."</p>
          <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalLugar1' onclick='loadModalData(".json_encode([
                "id" => $fi["id"],
                "nombre_destino" => strtoupper($fi["nombre_destino"]),
                "descripcion" => $fi["descripcion"],
                "tipo_destino" => $fi["tipo_destino"],
                "actividades_disponibles" => $fi["actividades_disponibles"],
                "ubicacion" => $fi["ubicacion"],
                "contacto" => $fi["contacto"],
                "enlace_web" => $fi["enlace_web"],
                "imagen_url" => $fi["imagen_url"]
            ]).")'>
            Más Información
          </button>
        </div>
      </div>
    </div>";

        }
      }


      ?>
   </div>
 </div>
 <div class="modal fade" id="modalLugar1" tabindex="-1" aria-labelledby="modalLugar1Label" aria-hidden="true">
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
           <div class="col-md-6">
             <img id="modalImagen" src="https://via.placeholder.com/500x300" class="img-fluid rounded-3 shadow" alt="Imagen del destino">
           </div>
           <div class="col-md-6">
             <p id="modalDescripcion" class="mb-3" class="mb-3 text-justify"></p>
             <ul class="list-unstyled">
               <li><i class="fas fa-map-marker-alt me-2 text-info"></i><strong>Ubicación:</strong> <span id="modalUbicacion"></span></li>
               <li><i class="fas fa-water me-2 text-info"></i><strong>Actividades:</strong> <span id="modalActividades"></span></li>
               <li><i class="fas fa-map-pin  text-info"></i><strong>Tipo Destino: </strong> <span id="tipo_destino"></span></li>
               <li><i class="fas fa-phone me-2 text-info"></i><strong>Contacto:</strong> <span id="modalContacto"></span></li>
               <li><i class="fas fa-link me-2 text-info"></i><strong>Enlace web:</strong> <a href="" id="modalEnlaceWeb" target="_blank">Visitar</a></li>
             </ul>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
 <script>

 function loadModalData(data) {
     // Usar los valores del objeto 'data' para actualizar los campos del modal
     document.getElementById('modalImagen').src = data.imagen_url;
     document.getElementById('modalLugar1Title').innerText = data.nombre_destino;
     document.getElementById('modalDescripcion').innerText = data.descripcion;
     document.getElementById('tipo_destino').innerText = data.tipo_destino;
     document.getElementById('modalActividades').innerText = data.actividades_disponibles;
     document.getElementById('modalUbicacion').innerText = data.ubicacion;
     document.getElementById('modalContacto').innerText = data.contacto;
     var enlace = document.getElementById("modalEnlaceWeb");

     // Asignar el enlace al atributo href
     enlace.href = data.enlace_web;
 }

</script>

<?php
// Incluir el archivo footer.php desde la carpeta diseno
require_once('vista/esquema/footeruni.php');
?>
