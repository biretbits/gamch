<?php
// Incluir el archivo header.php desde la carpeta diseno

require_once('vista/esquema/header.php');
?>
<style>
    .hero-section {
      background-color: #007bff;
      color: white;
      padding: 20px 0;
    }
    .bio-section {
      padding: 40px 0;
    }
    .card {
      border: none;
    }

    /* Estilo para la imagen ovalada con marco antiguo */
    .img-oval {
      width: 300px;
      height: 300px;
      object-fit: cover;
      border-radius: 50%;
      border: 10px solid #d8b1a0; /* Color de borde para el marco antiguo */
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1), 0 0 30px rgba(0, 0, 0, 0.1); /* Sombra para efecto antiguo */
      background-color: #f4e1c1; /* Fondo en tonos cálidos */
    }

    /* Estilo para el marco antiguo */
    .frame {
      padding: 15px;
      border: 5px solid #cfa67d; /* Borde dorado para el marco */
      background-color: #e9dbb2; /* Color de fondo que da el toque antiguo */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
      display: inline-block;
      border-radius: 20px; /* Bordes redondeados para simular el estilo de un cuadro antiguo */
    }
  </style>


  <!-- Biografía Section -->
  <section  class="bio-section text-center">
    <div class="container-fluid">
      <h2 class="mb-4" style="color:red">Biografía del Alcalde</h2>
      <div class="row justify-content-center">
        <div class="col-lg-4">
          <!-- Marco antiguo con la imagen ovalada -->
          <div class="frame">
            <img src="imagenes/gamch/alcalde.png" alt="Foto del Alcalde" class="img-oval">
          </div>
        </div>
        <div class="col-lg-6">
          <p class="lead" style="color:white">Nuestro alcalde, Técnico Superior Marcos Choqueticlla Tito, nació en Challapta. Desde joven ha estado comprometido con el desarrollo de nuestro municipio, impulsando proyectos sociales, educativos y culturales.</p>
          <p style="color:white">Ha ocupado diversos cargos en el ámbito público y, como alcalde, ha logrado [Mencionar logros importantes].</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Logros Section -->
  <section id="logros" class="bg-light py-5">
    <div class="container text-center">
      <h2 class="mb-4">Logros del Alcalde</h2>
      <div class="row">
        <div class="col-md-4">
          <div class="card shadow">
            <div class="card-body">
              <h5 class="card-title">Proyecto de Infraestructura</h5>
              <p class="card-text">Se ha invertido en la mejora de infraestructuras públicas, incluyendo calles, parques y edificios municipales.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow">
            <div class="card-body">
              <h5 class="card-title">Educación</h5>
              <p class="card-text">Se ha implementado un programa para mejorar la calidad educativa en las escuelas públicas del municipio.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow">
            <div class="card-body">
              <h5 class="card-title">Seguridad</h5>
              <p class="card-text">Gracias a políticas de seguridad innovadoras, el municipio ha registrado una disminución significativa en los índices de criminalidad.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php require("vista/esquema/footeruni.php"); ?>
