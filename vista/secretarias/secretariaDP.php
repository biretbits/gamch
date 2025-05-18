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
          <img src="imagenes/secretarias/sfp.png" alt="Icono Secretaría" width="100" height="100" class="me-3">
        </div>
        <div class="col-auto text-start">
          <h1 class="display-6 fw-bold text-white">Secretaría Municipal de Desarrollo Productivo</h1>
          <p class="lead text-white">Fomentando el desarrollo económico sostenible e inclusivo.</p>
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
          <h5 class="card-title">Fortalecimiento al desarrollo productivo agropecuario</h5>
        </div>
      </div>

      <!-- 2 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">Inseminación artificial</h5>
        </div>
      </div>

      <!-- 3 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">Apoyo funcionamiento zoonosis</h5>
        </div>
      </div>

      <!-- 4 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">
            Previsiones para contrapartes de Proy.&nbsp;Productivos con Inst.&nbsp;Públicas y Privadas
          </h5>
        </div>
      </div>

      <!-- 5 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">
            Const. Sistema de Micro Riego a Canal Abierto – Challapata
          </h5>
        </div>
      </div>

      <!-- 6 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">Equipamiento de Maquinaria Pesada G.A.M. Challapata</h5>
        </div>
      </div>

      <!-- 7 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">Implementación y mantenimiento de áreas verdes</h5>
        </div>
      </div>

      <!-- 8 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="700">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">Apoyo al medio ambiente – Municipio de Challapata</h5>
        </div>
      </div>

      <!-- 9 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="800">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">Proyecto forestación en micro-cuenca – Challapata</h5>
        </div>
      </div>

      <!-- 10 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="900">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">Forestación en áreas estratégicas – Challapata</h5>
        </div>
      </div>

      <!-- 11 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="1000">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">Funcionamiento de aseo urbano</h5>
        </div>
      </div>

      <!-- 12 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="1100">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">Apoyo al funcionamiento y regulación de mercados</h5>
        </div>
      </div>

      <!-- 13 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="1200">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">Servicio de inhumación – Cementerio</h5>
        </div>
      </div>

      <!-- 14 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="1300">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">Fortalecimiento a la Unidad de UGR</h5>
        </div>
      </div>

      <!-- 15 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="1400">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">
            Previsión de recursos para Gestión de Riesgo – Ley 602
          </h5>
        </div>
      </div>

      <!-- 16 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="1500">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">
            Centro Municipal de Servicio de Maquinaria Agrícola – DS 2785
          </h5>
        </div>
      </div>

      <!-- 17 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="1600">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">
            Producción de camélidos en 5 distritos indígenas – FDI
          </h5>
        </div>
      </div>


      <!-- 19 -->
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="1800">
        <div class="card unidad-card h-100 p-3">
          <h5 class="card-title">Mejoramiento de la producción de ganado bovino</h5>
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
          <img src="imagenes/secretarias/productivo/1.jpg" class="w-100 galeria-img" alt="Agricultura">
        </div>
        <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="100">
          <img src="imagenes/secretarias/productivo/2.jpg" class="w-100 galeria-img" alt="Tecnología">
        </div>
        <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="200">
          <img src="imagenes/secretarias/productivo/4.jpeg" class="w-100 galeria-img" alt="Trabajo en equipo">
        </div>
        <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
          <img src="imagenes/secretarias/productivo/6.jpg" class="w-100 galeria-img" alt="Industria">
        </div>

        <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
          <img src="imagenes/secretarias/productivo/3.jpg" class="w-100 galeria-img" alt="Industria">
        </div>

        <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
          <img src="imagenes/secretarias/productivo/5.jpg" class="w-100 galeria-img" alt="Industria">
        </div>

        <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
          <img src="imagenes/secretarias/productivo/8.jpeg" class="w-100 galeria-img" alt="Industria">
        </div>

        <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
          <img src="imagenes/secretarias/productivo/7.jpeg" class="w-100 galeria-img" alt="Industria">
        </div>
      </div>
    </div>
  </section>


<?php
// Incluir el archivo footer.php desde la carpeta diseno
require_once('vista/esquema/footeruni.php');
?>
