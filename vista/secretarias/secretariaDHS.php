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
          <img src="imagenes/secretarias/sdhs.png" alt="Icono Secretaría" width="100" height="100" class="me-3">
        </div>
        <div class="col-auto text-start">
          <h1 class="display-6 fw-bold text-white">Secretaría Municipal de Desarrollo Humano Y Social</h1>
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
          <h5 class="card-title">AREA SALUD</h5>
        </div>
      </div>

      <!-- 2 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">AREA EDUCACIÓN</h5>
        </div>
      </div>

      <!-- 3 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">ALIMENTACIÓN COMPLEMENTARIA</h5>
        </div>
      </div>

      <!-- 4 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">APOYO AL DESARROLLO DEPORTIVO C.</h5>
        </div>
      </div>

      <!-- 5 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">APOYO A LA CULTURA</h5>
        </div>
      </div>

      <!-- 6 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">APOYO AL TURISMO</h5>
        </div>
      </div>

      <!-- 7 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">UNIDAD DE SERVICIO LEGAL INTEGRAL MUNICIPAL</h5>
        </div>
      </div>

      <!-- 8 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="700">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">EQUIDAD DE GENERO LEY 348</h5>
        </div>
      </div>

      <!-- 9 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="800">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">UNIDAD MUNICIPAL DE ATENCIÓN A LAS PERSONAS CON DISCAPACIDAD</h5>
        </div>
      </div>

      <!-- 10 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="900">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">FUNCIONAMIENTO CASA INTEGRAL DE ACOGIDA</h5>
        </div>
      </div>

      <!-- 11 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="1000">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">RECURSO PARA ADULTOS MAYORES (LEY 548)</h5>
        </div>
      </div>

      <!-- 12 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="1100">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">DEFENSORIA DE LA NIÑEZ Y LA ADOLESCENCIA (LEY 548)</h5>
        </div>
      </div>

      <!-- 13 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="1200">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">SEGURIDAD CIUDADANA (LEY 264)</h5>
        </div>
      </div>

      <!-- 14 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="1300">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">LIMITES TERRITORIALES</h5>
        </div>
      </div>

      <!-- 15 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="1400">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">FUNCIONAMIENTO CANAL MUNICIPAL</h5>
        </div>
      </div>

      <!-- 16 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="1500">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">APOYO AL FUNCIONAMIENTO Y REGULACIÓN DE MERCADOS</h5>
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
          <img src="imagenes/secretarias/humano/1.jpeg" class="w-100 galeria-img" alt="Agricultura">
        </div>
        <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="100">
          <img src="imagenes/secretarias/humano/2.jpeg" class="w-100 galeria-img" alt="Tecnología">
        </div>
        <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="200">
          <img src="imagenes/secretarias/humano/4.jpeg" class="w-100 galeria-img" alt="Trabajo en equipo">
        </div>
        <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
          <img src="imagenes/secretarias/humano/6.jpeg" class="w-100 galeria-img" alt="Industria">
        </div>

        <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
          <img src="imagenes/secretarias/humano/3.jpeg" class="w-100 galeria-img" alt="Industria">
        </div>

        <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
          <img src="imagenes/secretarias/humano/5.jpeg" class="w-100 galeria-img" alt="Industria">
        </div>

        <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
          <img src="imagenes/secretarias/humano/8.jpeg" class="w-100 galeria-img" alt="Industria">
        </div>

        <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
          <img src="imagenes/secretarias/humano/7.jpeg" class="w-100 galeria-img" alt="Industria">
        </div>
      </div>
    </div>
  </section>

<?php
// Incluir el archivo footer.php desde la carpeta diseno
require_once('vista/esquema/footeruni.php');
?>
