<?php
require_once('vista/esquema/header.php');
?>


  <style>
    .hero {
      background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                  url('https://source.unsplash.com/1600x500/?development,industry') no-repeat center center;
      background-size: cover;
      color: white;
      padding: 100px 20px;
      text-align: center;
    }

    .galeria-img {
      height: 250px;
      object-fit: cover;
      border-radius: 10px;
      transition: transform 0.3s ease;
    }

    .galeria-img:hover {
      transform: scale(1.05);
    }

    .unidad-card {
  background-color: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: 10px;
  padding: 0.75rem !important; /* menos padding */
  font-size: 0.85rem; /* texto más pequeño */
  color: #fff;
  transition: transform 0.3s ease;
}
.unidad-card:hover {
  transform: scale(1.03);
}
.unidad-card .card-title {
  font-size: 0.9rem; /* texto del título más pequeño */
  margin: 0;
}

  </style>

  <!-- Sección principal con icono a la izquierda -->
  <header class="hero d-flex align-items-center justify-content-center text-center">
    <div class="container-md">
      <div class="row justify-content-center align-items-center">
        <div class="col-auto">
          <!-- Icono de la secretaría -->
          <img src="imagenes/secretarias/obras/1.jpeg" alt="Icono Secretaría" width="100" height="100" class="me-3">
        </div>
        <div class="col-auto text-start">
          <h1 class="display-6 fw-bold text-white">Secretaría Municipal de Obras Publicas</h1>
          <p class="lead text-white"></p>
        </div>
      </div>
    </div>
  </header>


  <!-- Sección de Unidades -->
  <!-- ======= UNIDADES DE LA SECRETARÍA ======= -->
  <section class="container-md">
    <h2 class="text-center mb-4" style="color:white">Unidades de la Secretaría</h2>

    <div class="row g-4">

      <!-- 1 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">Sub Alcaldia de Challapata</h5>
        </div>
      </div>

      <!-- 2 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">Sub Alcaldia de Qaqachaca</h5>
        </div>
      </div>

      <!-- 3 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">Sub Alcaldia de Norte Condo Abajo</h5>
        </div>
      </div>

      <!-- 4 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">
          Sub Alcaldia de Norte condo Nro. 3</h5>
        </div>
      </div>

      <!-- 5 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">
          Sub Alcaldia de Culta</h5>
        </div>
      </div>

      <!-- 6 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">Sub Alcaldia de Huancane</h5>
        </div>
      </div>

      <!-- 7 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">Sub Alcaldia de Aguas Calientes</h5>
        </div>
      </div>

      <!-- 8 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="700">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">Sub Alcaldia de Ancacato</h5>
        </div>
      </div>

      <!-- 9 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="800">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">Sub Alcaldia de Tolapalca</h5>
        </div>
      </div>

      <!-- 10 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="900">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">Dirección de Catastro</h5>
        </div>
      </div>


    </div>
  </section>


  <!-- Galería de Imágenes -->
  <section class="bg-light py-5">
    <div class="container-md">
      <h2 class="text-center mb-4">Galería</h2>
      <div class="row g-4">
        <div class="col-md-6 col-lg-3" data-aos="zoom-in">
          <img src="imagenes/secretarias/obras/9.jpeg" class="w-100 galeria-img" alt="Agricultura">
        </div>
        <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="100">
          <img src="imagenes/secretarias/obras/2.jpeg" class="w-100 galeria-img" alt="Tecnología">
        </div>
        <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="200">
          <img src="imagenes/secretarias/obras/4.jpeg" class="w-100 galeria-img" alt="Trabajo en equipo">
        </div>
        <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
          <img src="imagenes/secretarias/obras/6.jpeg" class="w-100 galeria-img" alt="Industria">
        </div>

        <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
          <img src="imagenes/secretarias/obras/3.jpeg" class="w-100 galeria-img" alt="Industria">
        </div>

        <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
          <img src="imagenes/secretarias/obras/5.jpeg" class="w-100 galeria-img" alt="Industria">
        </div>

        <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
          <img src="imagenes/secretarias/obras/8.jpeg" class="w-100 galeria-img" alt="Industria">
        </div>

        <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
          <img src="imagenes/secretarias/obras/7.jpeg" class="w-100 galeria-img" alt="Industria">
        </div>
      </div>
    </div>
  </section>


<?php
// Incluir el archivo footer.php desde la carpeta diseno
require_once('vista/esquema/footeruni.php');
?>
