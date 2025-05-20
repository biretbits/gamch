<?php
require_once('vista/esquema/header.php');
?>
<style>
  /* Color anaranjado para los botones */
  .btn-orange {
    background-color: #f57c00;
    color: white;
    border: none;
  }

  .btn-orange:hover {
    background-color: #e65100;
    color: white;
  }

  /* Hacer que todas las tarjetas tengan la misma altura */
  .service-card {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: stretch;
  }

  .service-card .card-body {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  /* Opcional: dar sombra y bordes suaves */
  .card {
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }
</style>
<br>

<div class="container-md" >
  <!-- Fila superior -->
  <div class="row">
    <!--<div class="col-md-4 mb-4">
      <div class="card service-card" data-category="recaudaciones">
        <div class="card-body text-center">
          <h3>Pago de Impuestos</h3>
          <p>Realiza el pago de impuestos municipales.</p>
          <button class="btn btn-orange" data-bs-toggle="modal" data-bs-target="#infoModal"
          onclick="mostrar({
            descripcion: 'es el registro de vehiculos',
          titulo: 'PAGO DE IMPUESTOS',
          requisitos: 'cedula de identidad.solicitud dirigida al alcalde.',

          contacto:'67788967-73458798',
          correo:'ruat@gmail.com',
          horario:'Lunes a Viernes, Mañana de 8:00 a 12:00 AM - Tarde 2:00 a 6:00 PM',
          imagen : 'imagenes/img-challapata/monumento.jpg',
          })">Más Información</button>
        </div>
      </div>
    </div>-->

    <div class="col-md-4 mb-4">
      <div class="card service-card" data-category="cementerio">
        <div class="card-body text-center">
          <h3>Espacio en Cementerio</h3>
          <p>Espacio en el cementerio municipal.</p>
          <button class="btn btn-orange" data-bs-toggle="modal" data-bs-target="#infoModal"
          onclick="mostrar({
            descripcion: 'El cementerio Municipal es un espacio físico designado y habilitado oficialmente para la inhumación (entierro), resguardo y recordación de los restos mortales de las personas fallecidas. Su propósito fundamental es ofrecer un lugar digno, ordenado y respetuoso para el descanso eterno de los difuntos, enmarcado en principios de humanidad, cultura, espiritualidad y respeto a la memoria.',
          titulo: 'ESPACIO EN EL CEMENTERIO MUNICIPAL',
          requisitos: 'Compra de espacio en el cementerio. nichos. otros.',

          contacto:'',
          correo:'',
          horario:'Lunes a Viernes, Mañana de 8:00 a 12:00 AM - Tarde 2:00 a 6:00 PM',
          imagen : 'imagenes/img-challapata/cementerio.jpeg',
          })">Más Información</button>
        </div>
      </div>
    </div>

    <!--<div class="col-md-4 mb-4">
      <div class="card service-card" data-category="aseo">
        <div class="card-body text-center">
          <h3>Recolección de Basura</h3>
          <p>Programa el servicio de recolección de basura.</p>
          <button class="btn btn-orange" data-bs-toggle="modal" data-bs-target="#infoModal"
          onclick="mostrar({
            descripcion: 'es el registro de vehiculos',
          titulo: 'RECOLECCIÓN DE BASURA',
          requisitos: 'cedula de identidad.solicitud dirigida al alcalde.',

          contacto:'67788967-73458798',
          correo:'ruat@gmail.com',
          horario:'Lunes a Viernes, Mañana de 8:00 a 12:00 AM - Tarde 2:00 a 6:00 PM',
          imagen : 'imagenes/img-challapata/monumento.jpg',
          })">Más Información</button>
        </div>
      </div>
    </div>-->

    <div class="col-md-4 mb-4">
      <div class="card service-card" data-category="ruat">
        <div class="card-body text-center">
          <h3>Registro de Vehículos</h3>
          <p>Realiza trámites relacionados con el RUAT.</p>
          <button class="btn btn-orange" data-bs-toggle="modal" data-bs-target="#infoModal"
          onclick="mostrar({
          descripcion: 'El RUAT es una Institución Pública Descentralizada, no lucrativa con personería jurídica, patrimonio propio y autonomía de gestión administrativa, financiera, legal y técnica, bajo tuición del Ministerio de Economía y Finanzas, la misma que será ejercida por el Viceministerio de Política Tributaria.',
          titulo: 'REGISTRO DE VEHÍCULOS',
          requisitos: 'INSCRIPCIÓN VEHÍCULOS AUTOMOTORES.INSCRIPCIÓN VEHÍCULOS ELÉCTRICOS NACIONALES.INSCRIPCIÓN MOTOCICLETAS.INSCRIPCIÓN MAQUINARIA PESADA.CAMBIO DE SERVICIO.TRANSFERENCIA VEHÍCULOS AUTOMOTORES.TRANSFERENCIA MOTOCICLETAS.DUPLICADO CERTIFICADO PROPIETARIO.ACTUALIZACIÓN CRPVA.MODIFICACIÓN DE DATOS TÉCNICOS.MODIFICACIÓN DATOS TÉCNICOS POR CAMBIO DE ESTRUCTURA.DUPLICADO PLAQUETA.DUPLICADO PLACA Y PLAQUETA VEHÍCULO.DUPLICADO PLACA Y PLAQUETA MOTOCICLETA.DUPLICADO PLACA Y PLAQUETA MAQUINARIA PESADA.REGULARIZACIÓN DE INSCRIPCIÓN PLACA ANT (ASIGNACIÓN DE PLACA PTA).CAMBIO DE RADICATORIA.REEMPLAQUE.BAJA.',
          contacto:'',
          correo:'ruat@gmail.com',
          horario:'Lunes a Viernes, Mañana de 8:00 a 12:00 AM - Tarde 2:00 a 6:00 PM',
          imagen : 'imagenes/img-challapata/RUAT.jpg',
          })">Más Información</button>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="card service-card" data-category="eventos">
        <div class="card-body text-center">
          <h3>Unidad de Tributaciones</h3>
          <p>Pago de impuestos.</p>
          <button class="btn btn-orange" data-bs-toggle="modal" data-bs-target="#infoModal"
          onclick="mostrar({
            descripcion: 'Encargada de gestionar, controlar y recaudar los tributos municipales.',
          titulo: 'UNIDAD DE TRIBUTACIONES',
          requisitos: 'Impuesto a la Propiedad de Bienes Inmuebles.',

          contacto:'',
          correo:'',
          horario:'Lunes a Viernes, Mañana de 8:00 a 12:00 AM - Tarde 2:00 a 6:00 PM',
          imagen : 'imagenes/img-challapata/RUAT.jpg',
          })">Más Información</button>
        </div>
      </div>
    </div>

    <!-- Espacio vacío para completar la fila -->
    <div class="col-md-4 mb-4 d-none d-md-block"></div>
  </div>
</div>

<!-- Estilo para cabecera anaranjada -->
<style>
  .modal-header-orange {
    background-color: #f57c00;
    color: white;
  }

  .modal-header-orange .btn-close {
    filter: invert(1);
  }
</style>

<!-- Modal común -->

<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header modal-header-orange">
        <h5 class="modal-title" id="infoModalLabel">Título del Servicio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
    <!-- Imagen centrada y destacada -->
    <div class="text-center mb-4">
      <img id="img" src="" alt="Imagen del evento" class="img-fluid rounded shadow-sm" style="max-height: 300px; object-fit: cover;" />
    </div>

    <h6><strong>Descripción:</strong></h6>
    <p id="modalDescription">Aquí se mostrará una breve descripción del servicio.</p>

    <h6><strong>Sub Servicios:</strong></h6>
    <ul id="modalRequisitos">
      <li>Requisito 1</li>
      <li>Requisito 2</li>
      <li>Requisito 3</li>
    </ul>

    <!--<h6><strong>Documentación necesaria:</strong></h6>
    <ul id="modalDocumentacion">
      <li>Documento 1</li>
      <li>Documento 2</li>
    </ul>-->

    <h6><strong>Contacto:</strong></h6>
    <p id="modalContacto">Celular: </p>
    <p id="modalCorreo">Correo electrónico: </p>

    <h6><strong>Horario de atención:</strong></h6>
    <p id="modalHorario"></p>
  </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-orange" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  function mostrar(data) {
    // Actualiza el título del modal
    document.getElementById('modalDescription').textContent = data.descripcion;
    document.getElementById('infoModalLabel').textContent = data.titulo;

    // Actualiza los requisitos
    let requisitosList = document.getElementById('modalRequisitos');
    requisitosList.innerHTML = ''; // Limpia la lista antes de agregar nuevos ítems
    data.requisitos.split('.').forEach(requisito => {
      if (requisito.trim()) {
        let li = document.createElement('li');
        li.textContent = requisito.trim();
        requisitosList.appendChild(li);
      }
    });

    // Actualiza el contacto
    document.getElementById('modalContacto').textContent = `Celular: ${data.contacto}`;

    // Actualiza el correo
    document.getElementById('modalCorreo').textContent = `Correo electrónico: ${data.correo}`;
    // Actualiza el horario
    document.getElementById('modalHorario').textContent = data.horario;
    document.getElementById('img').src = data.imagen;

  }
</script>

<?php
require_once('vista/esquema/footeruni.php');
?>
