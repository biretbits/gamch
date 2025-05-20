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
    <?php
    // Simulación de variable que indica si el usuario es admin
    $esAdmin = true; // o false

    // Generar el HTML/JS
    ?>
    <script>
    window.onload = function() {
      const dateTimeText = `Fecha y Hora: 12/01/2025 00:00 `;

      // Botones que solo se muestran si es admin
      let botonesHtml = '';
      <?php if (isset($_SESSION['nombre_role']) && $_SESSION['nombre_role'] == 'Admin'): ?>
        botonesHtml = `<button type="button" class="btn btn-primary btn-sm me-2" title="Editar">
          <i class="fas fa-edit"></i>
        </button>
        <button type="button" class="btn btn-secondary btn-sm" title="Eliminar">
          <i class="fas fa-trash-alt"></i>
        </button>
        `;
      <?php endif; ?>

      Swal.fire({
        html: `
          <div class="swal2-date-time" style="text-align: left;font-size:12px">${dateTimeText}</div>
          <div style='text-align:center'>El pasado año, el Comité Interinstitucional de Defensa del Medio Ambiente de Challapata celebró un importante triunfo: entregaron la Ley Municipal 403/2024, que declara al distrito de Challapata como una zona libre de actividad y contaminación minera.

La visita a las oficinas de la Autoridad Jurisdiccional Administrativa Minera (AJAM) casi coincidió con el 63 aniversario de la Represa de Tacagua, pilar de la actividad agroganadera del municipio de Challapata, la Capital Agrícola, Ganadera e Industrial Lechera del Occidente Boliviano.</div>
          <div style="margin-top: 15px; text-align:center;">${botonesHtml}</div>
        `,
        imageUrl: 'https://www.opinion.com.bo/asset/thumbnail,992,558,center,center/media/opinion/images/2025/01/09/2025010922313656652.jpg',
        imageWidth: '100%',
        imageHeight: 'auto',
        imageAlt: 'Imagen de alerta',
        confirmButtonText: 'Cerrar',
        showConfirmButton: true,
        heightAuto: false,
        customClass: {
          htmlContainer: 'swal2-html-container'
        },
        timer: 9000,
        timerProgressBar: true,
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

<section class="container-md">
  <div class="row text-center">
    <div class="col-md-4  card-hover">
      <div class="counter-box">
        <div>
          <span class="counter" data-target="35339">0</span>
        </div>
        <p>POBLACIÓN</p>
      </div>
    </div>
    <div class="col-md-4  card-hover">
      <div class="counter-box">
        <div>
          <span class="counter" data-target="3738">0</span><span class="unit"> Msnm</span>
        </div>
        <p>ALTITUD</p>
      </div>
    </div>
    <div class="col-md-4  card-hover">
      <div class="counter-box">
        <div>
          <span class="counter" data-target="2815">0</span><span class="unit"> km²</span>
        </div>
        <p>SUPERFICIE</p>
      </div>
    </div>
  </div>
</section>

<style media="screen">
.estrofa {
text-align: justify;
font-size: 1rem;
}

@media (max-width: 576px) {
.estrofa {
  font-size: 0.65rem;
}
}

</style>
<div class="container-fluid" style="background-image: url('imagenes/gamch/frontisALEJADO.webp'); background-size: cover; background-position: center; background-repeat: no-repeat;">
  <div class="row">
    <!-- Columna del pergamino -->
    <div class="col-12 col-lg-6">
      <div class="features-boxed container-fluid">
        <div class="container" data-aos="fade-up">
          <div class="pergamino">
            <div class="scroll-contenido">
              <h2>Himno a Challapata</h2>
              <div class="autor">Letra: Saturnino Barre &nbsp;&nbsp;&nbsp; Música: Enrique Pérez</div>

              <div class="estrofa izquierda" class="estrofa">
                Somos hijos de Eduardo Abaroa
                que desde el Topater nos llegó
                bello ejemplo de hombría y coraje
                al morir sin rendirse jamás.
              </div>

              <div class="estrofa derecha" class="estrofa">
                En la inmensidad del altiplano
                muy celoso guardamos su mensaje
                trabajando ahínco por su gloria
                por la patria, la pobreza y la unión.
              </div>

              <div class="estrofa izquierda" class='estrofa'>
                Con cerebro y corazón
                centinelas son tus hijos
                con el cóndor de nuestro escudo
                vigilando el Mapocho y al ladrón.
              </div>

              <div class="estrofa derecha" class='estrofa'>
                Noble pueblo de Challapata
                la vanguardia vengadora
                de su sangre aún caliente
                llama al mar a nuestro bello litoral.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Columna de audios -->
    <div class="col-12 col-lg-6">
      <div class="features-boxed container-fluid" style="background: rgba(45,45,89,0.5);">
        <div class="container-md">
          <h3 class="mb-4 text-white text-center" style="border-radius: 10px;">
            Himno A Challapata
          </h3>

          <div class="d-flex flex-wrap justify-content-center gap-4">
            <!-- Tarjeta 3 -->
            <div class="card shadow-sm card-hover" style="width: 18rem;" data-aos="fade-up">
              <div class="card-body">
                <h5 class="card-title">Himno a Challapata</h5>
                <p class="card-text">Himno a Challapata - BANDA F.F.E.E. 24 RANGER de Challapata</p>
              </div>
              <div class="card-footer bg-white border-top-0">
                <audio controls class="w-100">
                  <source src="imagenes/audios/himno%20a%20challapata.mp3" type="audio/mpeg">
                  Tu navegador no soporta el elemento de audio.
                </audio>
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container-md">

    <h3 class="mb-4 text-white text-center" style="border-radius: 10px;">
      Melodías de Nuestra Tierra
    </h3>
  <div class="row">
    <!-- Tarjeta de audio 1 -->
    <div class="col-md-6 mb-4">
      <div class="card shadow-sm card-hover" style="width: 100%;" data-aos="fade-up">
        <div class="card-body">
          <h5 class="card-title">Mi Challapata Querida</h5>
          <p class="card-text">Kalchas - Mi Challapata Querida</p>
        </div>
        <div class="card-footer">
          <audio controls class="w-100">
            <source src="imagenes/audios/Kalchas%20-%20Mi%20Challapata%20querida.mp3" type="audio/mpeg">
            Tu navegador no soporta el elemento de audio.
          </audio>
        </div>
      </div>
    </div>

    <!-- Tarjeta de audio 2 -->
    <div class="col-md-6 mb-4">
      <div class="card shadow-sm card-hover" style="width: 100%;" data-aos="fade-up">
        <div class="card-body">
          <h5 class="card-title">Mi Challapata Querida</h5>
          <p class="card-text">Kilapaya - Mi Challapata Querida</p>
        </div>
        <div class="card-footer bg-white border-top-0">
          <audio controls class="w-100">
            <source src="imagenes/audios/Kilapaya%20-%20Mi%20Challapata%20querida.mp3" type="audio/mpeg">
            Tu navegador no soporta el elemento de audio.
          </audio>
        </div>
      </div>
    </div>
  </div>
</div>

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
        <a class="learn-more" href="/SDHS" style="color: var(--bs-orange);">Ver más »</a>
      </div>
    </div>
    <div class="col-sm-6 col-md-5 col-lg-4 item mb-4">
      <div class="box text-center">
        <i class="la la-cloud-upload icon" style="color: var(--bs-orange); font-size: 50px;"></i>
        <h3 class="name">Desarrollo Productivo</h3>
        <p class="description"></p>
        <a class="learn-more" href="/SDP" style="color: var(--bs-orange);">Ver más »</a>
      </div>
    </div>
    <div class="col-sm-6 col-md-5 col-lg-4 item mb-4">
      <div class="box text-center">
        <i class="fa fa-leaf icon" style="color: var(--bs-orange); font-size: 50px;"></i>
        <h3 class="name">Obras Públicas</h3>
        <p class="description"></p>
        <a class="learn-more" href="SOP" style="color: var(--bs-orange);">Ver más »</a>
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
