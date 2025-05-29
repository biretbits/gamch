<?php
require_once('vista/esquema/header.php');
?>
<style>
  .carousel-container {
    width: 100%;
    height: 90vh;
    overflow: hidden;
  }

  .carousel-item img {
    object-fit: cover;
    width: 100%;
    height: 100%;
  }

  /* En celulares (pantallas de hasta 768px) */
  @media (max-width: 768px) {
    .carousel-container {
      height: 35vh; /* Más bajo en móvil */
    }
  }
</style>

<div class="carousel-container">
  <div id="carruselBootstrap" class="carousel slide h-100" data-bs-ride="carousel">
    <div class="carousel-inner h-100">
      <div class="carousel-item active h-100">
        <img src="imagenes/img-challapata/banner1.webp" class="d-block" alt="Imagen 1">
      </div>
      <div class="carousel-item h-100">
        <img src="imagenes/img-challapata/banner2.jpg" class="d-block" alt="Imagen 2">
      </div>
      <div class="carousel-item h-100">
        <img src="imagenes/img-challapata/Banner.webp" class="d-block" alt="Imagen 3">
      </div>
    </div>

    <!-- Controles -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carruselBootstrap" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carruselBootstrap" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Siguiente</span>
    </button>
  </div>
</div>

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


    <style>
       .news-card {
         position: relative;
         overflow: hidden;
         border-radius: 0px;
         margin-bottom: 25px;
         height: 100%;
       }

       .news-card img {
         width: 100%;
         height: 100%;
         object-fit: cover;
         filter: brightness(100%);
         transition: transform 0.3s ease;
       }

       .news-card:hover img {
         transform: scale(1.05);
       }

       .news-overlay {/*codigo del texto de la imagenes el titulo*/
         position: absolute;
         bottom: 0;
         left: 0;
         color: white;
         padding: 15px;
         background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
         width: 100%;
       }

       .news-title {
         font-size: 1.25rem;
         font-weight: bold;
         margin-bottom: 5px;
         color:#CAD5E2
       }

       .news-desc {
         font-size: 0.9rem;
         color:#CAD5E2;
         display: -webkit-box;
         -webkit-line-clamp: 2;           /* Cambiado a 3 líneas */
         -webkit-box-orient: vertical;
         line-clamp: 2;
         overflow: hidden;
         text-overflow: ellipsis;
         word-break: break-word;
         line-height: 1.3em;

       }
       .news-desc3 {
         display: -webkit-box;
         -webkit-line-clamp: 2;           /* Cambiado a 3 líneas */
         -webkit-box-orient: vertical;
         line-clamp: 2;
         overflow: hidden;
         text-overflow: ellipsis;
         word-break: break-word;
         line-height: 1.3em;
         font-size: 0.9rem;
         color: #CAD5E2;
       }

       .news-desc1{
          display: -webkit-box;
         -webkit-line-clamp: 1;       /* Número de líneas que quieres mostrar */
         -webkit-box-orient: vertical;
         overflow: hidden;
         text-overflow: ellipsis;
         font-size: 0.9rem;
         color:#CAD5E2
       }
       .news-date {
         font-size: 0.75rem;
         color:#CAD5E2
       }

       .big-news {
         height: 420px;
       }

       .medium-news {
         height: 200px;
       }

       .small-news {
         height: 150px;
       }

     </style>

<div class="container-fluid"><br>
    <h3 style="color:#CAD5E2" align='left'>Noticias.</h3>
    <hr style="color:blue">
</div>
<div class="container-fluid">
  <div class="row g-4" style="padding:10px">
    <!-- Columna izquierda -->
    <div class="col-lg-9">
      <!-- Contenedor con borde y padding -->
      <div class="p-3" style=" border-radius:8px;">
        <?php
        // Función para imprimir una tarjeta de noticia
        function mostrarNoticia($fil, $tamanoClase = 'medium-news') {
            ?>
            <div class="col-md-6 p-3" style="border:1px solid red;">
                <div class="news-card <?php echo $tamanoClase; ?>">
                  <div class="w-100" style="height: 100%;right: 100%;overflow: hidden;">
                    <img
                      src="<?php echo ($fil['foto'] != '') ? $fil['foto'] : 'imagenes/img-challapata/banner2.jpg'; ?>"
                      class="img-fluid h-100 w-100"
                      style="object-fit: contain;"
                      alt="Imagen dinámica">
                  </div>
                  <div class="news-overlay">
                    <a href="#" class="news-title"><?php echo $fil['titulo']; ?></a>
                  </div>
                </div>
                <div class="news-desc3"><?php echo $fil['contenido']; ?> no se puede seguir con este doloe de los estudiante pero se debe seguir en grande para toda lasemana de los dias por los dias de los meses siempre se tiene que tener mucho orgullo
                de los estudiante pero se debe seguir en grande para toda lasemana de los dias por los dias de los meses siempre se tiene que tener mucho orgullo
                de los estudiante pero se debe seguir en grande para toda lasemana de los dias por los dias de los meses siempre se tiene que tener mucho orgullo</div>
                <div class="news-date">Fecha: <?php echo $fil['fecha']; ?></div>
                <div class="text-end">
                  <a href="noticia.php?id=123" class="text-decoration-none p-0 m-0" style="color:green">
                    Ver más
                  </a>
                </div>
            </div>
            <?php
        }

        $j = 0;
        $abiertaFila = false;
        while ($fil = mysqli_fetch_assoc($resul)) {
            if ($j == 0) {
                // Noticia principal
                ?>
                <div class="news-card big-news mb-4 p-3">
                  <div style="height: 300px; overflow: hidden;">
                  <img
                    src="<?php echo ($fil['foto'] != '') ? $fil['foto'] : 'imagenes/img-challapata/banner2.jpg'; ?>"
                    class="img-fluid"
                    style="
                      width: 100%;
                      height: 100%;
                      object-fit: fill;
                      image-rendering: auto; /* Opciones: auto | crisp-edges | pixelated */
                    "
                    alt="Imagen dinámica">
                </div>


                  <div class="news-overlay">
                       <a href="#" class="news-title"><?php echo $fil['titulo']; ?></a>
                  </div>
                </div>
                <div class="news-desc3"><?php echo $fil['contenido']; ?> no se puede seguir con este doloe de los estudiante pero se debe seguir en grande para toda lasemana de los dias por los dias de los meses siempre se tiene que tener mucho orgullo
                de los estudiante pero se debe seguir en grande para toda lasemana de los dias por los dias de los meses siempre se tiene que tener mucho orgullo
                de los estudiante pero se debe seguir en grande para toda lasemana de los dias por los dias de los meses siempre se tiene que tener mucho orgullo</div>
                <div class="news-date"><?php echo $fil['fecha']; ?></div>
                <div class="text-end">
                  <a href="noticia.php?id=123" class="text-decoration-none p-0 m-0" style="color:green">
                    Ver más
                  </a>
                </div>
                <?php
            } else {
                // Noticias secundarias en filas de 2
                if ($j % 2 == 1) {
                    echo '<div class="row">'; // Abrir fila
                    $abiertaFila = true;
                }

                mostrarNoticia($fil); // Mostrar noticia

                if ($j % 2 == 0 && $abiertaFila) {
                    echo '</div>'; // Cerrar fila
                    $abiertaFila = false;
                }
            }
            $j++;
        }

        // Si quedó una fila abierta al final
        if ($abiertaFila) {
            echo '</div>';
        }
        ?>
      </div> <!-- Fin del div con borde -->
    </div> <!-- Fin de col-lg-9 -->

       <!-- Columna derecha -->
  <div class="col-lg-3">
    <h6 style="color:green">Noticias Pasadas</h6>
      <div class="row">
        <?php for($i = 0; $i < 5; $i++) { ?>
           <div class="col-12">
             <div class="news-card small-news">
               <img src="imagenes/img-challapata/banner2.jpg" alt="Pequeña">
             </div>
             <div class="news-desc1">
               <a href="#" class="news-desc1">Resumen corto de las luchas del psssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssroletariado por un dias mas de vida como es de saber ahora se quiero la renovacion de los candidatos de la madere</a></div>
             <div class="news-date">Fecha: 26 Mayo 2025</div>

           </div>
         <?php } ?>

         </div>
       </div>
     </div>
  </div>
  <div class="container-fluid text-center my-4">
    <button class="btn btn-primary px-4 py-8 shadow rounded-pill">
      Ver más Noticias
    </button>
  </div>


<div class="container-md" style="padding:10px">
  <div style="border: 1px solid #E7000B;"class="container-fluid" data-aos="fade-right" data-aos-duration="1200">
      <div class="row" >
          <div class="col-md-12 col-lg-6" style="padding: 0px;background: url(imagenes/gamch/challapata-población.jpg) center / cover no-repeat;">
              <p><br><br><br><br><br><br><br><br><br></p>
          </div>
          <div class="col-md-12 col-lg-6">
            <h1 class="typewriter" style="color:white">Challapata</h1>
              <hr>
              <p  style="padding-left: 15px;padding-right: 15px;text-align: justify;color:#CAD5E2">Challapata, capital de la provincia Eduardo Abaroa en el Departamento de Oruro, Bolivia, es un municipio que encapsula la esencia de la cultura andina, la historia heroica y la autenticidad de un destino aún por descubrir. Fundado en 1896, este enclave de aproximadamente 29,000 habitantes, se erige como un símbolo de resistencia y legado, honrando la memoria de Eduardo Abaroa, prócer boliviano cuyo nombre identifica a la provincia.<br><br><br></p>
              <div style="text-align:center"><button class="btn btn-light btn-lg" type="button" style="margin-bottom: 21px;">Ver más</button></div>
          </div>
      </div>
  </div>

</div>

<section class="container-md">
  <div class="row text-center">
    <div class="col-md-4  card-hover" style="border: 1px solid #E7000B;">
      <div class="counter-box"style="background-color: transparent;">
        <div>
          <span class="counter"  style="color:red;font-size:40px"data-target="35339">0</span>
        </div>
        <p style="color:#CAD5E2">POBLACIÓN</p>
      </div>
    </div>
    <div class="col-md-4  card-hover" style="border: 1px solid #E7000B;">
      <div class="counter-box"style="background-color: transparent;">
        <div>
          <span class="counter" data-target="3738" style="color:orange;font-size:40px">0</span><span class="unit"> Msnm</span>
        </div>
        <p style="color:#CAD5E2">ALTITUD</p>
      </div>
    </div>
    <div class="col-md-4  card-hover" style="border: 1px solid #E7000B;">
      <div class="counter-box"style="background-color: transparent;">
        <div>
          <span class="counter" data-target="2815" style="color:green;font-size:40px">0</span><span class="unit"> km²</span>
        </div>
        <p style="color:#CAD5E2">SUPERFICIE</p>
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
<div class="container-md" style="background-size: cover; background-position: center; background-repeat: no-repeat;border: 1px solid #E7000B;">
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
      <div class="features-boxed">
        <div class="container-md">
          <h3 class="mb-4 text-white text-center" style="border-radius: 10px;">
            Himno A Challapata
          </h3>
          <div class="d-flex flex-wrap justify-content-center gap-4">
            <!-- Tarjeta 3 -->
            <div class="card shadow-sm card-hover" style="width: 18rem;" data-aos="fade-up"  style="border: 1px solid green">
              <div class="card-body">
                <h5 class="card-title" style="color:#6A7282">Himno a Challapata</h5>
                <p class="card-text" style="color:#6A7282">Himno a Challapata - BANDA F.F.E.E. 24 RANGER de Challapata</p>
              </div>
              <div class="card-footer bg-white border-top-0">
                <audio controls class="w-100" style="background-color: transparent;">
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

<div class="container-fluid" style="  background: url('/imagenes/img-challapata/challapata-portadaweb.jpg');
   background-size: cover;
   background-position: center;
   background-repeat: no-repeat;
   margin: 0;
   ">
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
