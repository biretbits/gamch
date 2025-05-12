<?php
require_once('vista/esquema/header.php');
?>
<style>
        /* Estilos adicionales para hacer que la imagen ocupe casi todo el modal */
        .swal2-image {
          width: 100%;
          height: auto;
          max-height: 500px; /* Limita el alto de la imagen */
          object-fit: cover; /* Asegura que la imagen se ajuste bien al contenedor */
        }
      </style>
    <!-- Script para mostrar la alerta al cargar la página -->

    <script>
window.onload = function() {
  // Crear el texto con fecha y hora
  const dateTimeText = `Fecha y Hora: 12/03/2025 12:02 `;
  Swal.fire({
    html: `
       <div class="swal2-date-time" style="text-align: left;font-size:12px">${dateTimeText}</div>
       <div style='text-align:center'>LUCHA DE MUJERES</div>
    `,
    imageUrl: 'https://i0.wp.com/cebem.org/wp-content/uploads/2020/03/renamat-en-challapata.png?resize=600%2C336&ssl=1', // Imagen en la alerta
    imageWidth: '100%', // Ancho de la imagen en porcentaje para que ocupe todo el ancho
    imageHeight: 'auto', // Mantener la proporción de la imagen
    imageAlt: 'Imagen de alerta',
    confirmButtonText: 'Cerrar',
    showConfirmButton: true, // Botón de confirmar
    heightAuto: false, // Evita que SweetAlert2 ajuste el tamaño automático de la ventana
    customClass: {
      htmlContainer: 'swal2-html-container' // Aplicar el estilo personalizado
    },
    timer: 5000, // La alerta se cerrará después de 5 segundos
    timerProgressBar: true, // Muestra la barra de progreso del temporizador
  });
};
</script>
<section class="bg-white">
    <div class="container-fluid" data-aos="fade-right" data-aos-duration="1200">
        <div class="row" >
            <div class="col-md-12 col-lg-6" style="padding: 0px;background: url(imagenes/gamch/challapata-población.jpg) center / cover no-repeat;">
                <p><br><br><br><br><br><br><br><br><br><br><br><br><br></p>
            </div>
            <div class="col-md-12 col-lg-6">
              <h1 class="typewriter">Challapata</h1>

              <style>
              .typewriter {
              overflow: hidden;
              white-space: nowrap;
              margin: 0 auto;
              letter-spacing: 2px;
              animation: typing 24s steps(7, end) infinite;
              animation-delay: 2s;
              animation-iteration-count: infinite;
              animation-direction: normal;
              animation-timing-function: steps(10, end);
              font-size: 2rem;
              color: #212529;
              padding: 20px 15px 0;
              width: fit-content;
              }

              /* Reinicia el ancho a 0 y lo anima de nuevo */
              @keyframes typing {
              0%   { width: 0; }
              40%  { width: 100%; }
              60%  { width: 100%; }
              100% { width: 0; }
              }
              </style>

                <hr>
                <p class="text-black-50" style="padding-left: 15px;padding-right: 15px;text-align: justify;">Challapata, capital de la provincia Eduardo Abaroa en el Departamento de Oruro, Bolivia, es un municipio que encapsula la esencia de la cultura andina, la historia heroica y la autenticidad de un destino aún por descubrir. Fundado en 1896, este enclave de aproximadamente 29,000 habitantes, se erige como un símbolo de resistencia y legado, honrando la memoria de Eduardo Abaroa, prócer boliviano cuyo nombre identifica a la provincia.<br><br><br></p>
                <div style="text-align:center"><button class="btn btn-light btn-lg" type="button" style="margin-bottom: 21px;">Ver más</button></div>
            </div>
        </div>
    </div>
</section>
<style>
  .counter {
    font-size: 3rem;
    font-weight: bold;
    color: #007bff;
  }
  .counter-box {
    padding: 2rem;
    background: #f8f9fa;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
  }
  .unit {
    font-size: 1.5rem;
    margin-left: 5px;
    color: #555;
  }
</style>
<section class="container-md py-5">
  <div class="row text-center">
    <div class="col-md-4">
      <div class="counter-box">
        <div>
          <span class="counter" data-target="35339">0</span>
        </div>
        <p>POBLACIÓN</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="counter-box">
        <div>
          <span class="counter" data-target="3738">0</span><span class="unit"> Msnm</span>
        </div>
        <p>ALTITUD</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="counter-box">
        <div>
          <span class="counter" data-target="2815">0</span><span class="unit"> km²</span>
        </div>
        <p>SUPERFICIE</p>
      </div>
    </div>
  </div>
</section>
<div class="features-boxed container-fluid" style="background: rgb(44,49,52);">
    <div class="">
        <div></div>
        <hr class="mt-0">
        <h3 style="border-bottom-style: none;margin: -35px;margin-top: 45px;height: 35.0938px;color: rgb(255,255,255);font-family: Aldrich, sans-serif;text-align: center;">Destacados</h3>
        <br><br>
    </div>

    <div style="color: rgb(255,255,255);font-family: Aldrich, sans-serif;">
  <div class="row justify-content-center features">
    <div class="col-sm-6 col-md-5 col-lg-4 item mb-4">
      <div class="box text-center">
        <i class="fas fa-users icon" style="color: var(--bs-orange); font-size: 50px;"></i>
        <h3 class="name">Desarrollo Humano y Social</h3>
        <p class="description"></p>
        <a class="learn-more" href="#" style="color: var(--bs-orange);">Ver más »</a>
      </div>
    </div>
    <div class="col-sm-6 col-md-5 col-lg-4 item mb-4">
      <div class="box text-center">
        <i class="la la-money icon" style="color: var(--bs-orange); font-size: 50px;"></i>
        <h3 class="name">Pago de Impuestos</h3>
        <p class="description"></p>
        <a class="learn-more" href="#" style="color: var(--bs-orange);">Ver más »</a>
      </div>
    </div>
    <div class="col-sm-6 col-md-5 col-lg-4 item mb-4">
      <div class="box text-center">
        <i class="la la-cloud-upload icon" style="color: var(--bs-orange); font-size: 50px;"></i>
        <h3 class="name">Desarrollo Productivo</h3>
        <p class="description"></p>
        <a class="learn-more" href="#" style="color: var(--bs-orange);">Ver más »</a>
      </div>
    </div>
    <div class="col-sm-6 col-md-5 col-lg-4 item mb-4">
      <div class="box text-center">
        <i class="fa fa-leaf icon" style="color: var(--bs-orange); font-size: 50px;"></i>
        <h3 class="name">Obras Públicas</h3>
        <p class="description"></p>
        <a class="learn-more" href="#" style="color: var(--bs-orange);">Ver más »</a>
      </div>
    </div>
    <div class="col-sm-6 col-md-5 col-lg-4 item mb-4">
      <div class="box text-center">
        <i class="fa fa-plane icon" style="color: var(--bs-orange); font-size: 50px;"></i>
        <h3 class="name">Turismo</h3>
        <p class="description"></p>
        <a class="learn-more" href="/turismo" style="color: var(--bs-orange);">Ver más »</a>
      </div>
    </div>
    <div class="col-sm-6 col-md-5 col-lg-4 item mb-4">
      <div class="box text-center">
        <i class="fa fa-theater-masks icon" style="color: var(--bs-orange); font-size: 50px;"></i>
        <h3 class="name">Cultura</h3>
        <p class="description"></p>
        <a class="learn-more" href="/cultura" style="color: var(--bs-orange);">Ver más »</a>
      </div>
    </div>
    <div class="col-sm-6 col-md-5 col-lg-4 item mb-4">
      <div class="box text-center">
        <i class="fa fa-plane icon" style="color: var(--bs-orange); font-size: 50px;"></i>
        <h3 class="name">Eventos</h3>
        <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu.</p>
        <a class="learn-more" href="#" style="color: var(--bs-orange);">Ver más »</a>
      </div>
    </div>
  </div>
</div>
  </div>




    <script>
      function isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return rect.top <= (window.innerHeight || document.documentElement.clientHeight);
      }

      function formatNumber(num) {
        return num.toLocaleString('es-ES'); // Usa punto como separador de miles
      }

      function animateCounter(counter) {
        const target = parseInt(counter.getAttribute('data-target'));
        const speed = 200;
        const increment = Math.ceil(target / speed);
        let current = 0;

        const updateCounter = () => {
          if (current < target) {
            current += increment;
            if (current > target) current = target;
            counter.innerText = formatNumber(current);
            setTimeout(updateCounter, 10);
          } else {
            counter.innerText = formatNumber(target);
          }
        };

        updateCounter();
      }

      let countersStarted = false;
      window.addEventListener('scroll', () => {
        const counters = document.querySelectorAll('.counter');
        if (!countersStarted && Array.from(counters).some(isInViewport)) {
          counters.forEach(animateCounter);
          countersStarted = true;
        }
      });
    </script>

<?php
// Incluir el archivo footer.php desde la carpeta diseno
require_once('vista/esquema/footeruni.php');
?>
