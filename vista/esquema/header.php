<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Gobierno Autónomo Municipal de Challapata</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/vista/activos/bootstrap/bootstrap.min.css">

    <!-- Librerías CSS -->
    <link rel="stylesheet" href="/vista/activos/select2/css/select2.min.css">
    <link rel="stylesheet" href="/vista/activos/sweetAlert2/sweetalert2.min.css">
    <link rel="stylesheet" href="/vista/activos/pdfjs-5.2.133/build/pdf_viewer.css">
    <link rel="stylesheet" href="/vista/activos/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/vista/activos/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="/vista/activos/fonts/line-awesome.min.css">

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="/vista/activos/css/styles.css">
    <link rel="stylesheet" href="/vista/activos/documentos.css">
    <link rel="stylesheet" href="/vista/activos/css/Background-Image---Parallax---No-Text.css">
    <link rel="stylesheet" href="/vista/activos/css/Comming-Soon-Page.css">
    <link rel="stylesheet" href="/vista/activos/css/Documents-App-Browser.css">
    <link rel="stylesheet" href="/vista/activos/css/Hover-Cards-by-Printaga-Publishing.css">
    <link rel="stylesheet" href="/vista/activos/css/Login-Box-En-login-box-en.css">
    <link rel="stylesheet" href="/vista/activos/css/Login-Form-Basic-icons.css">
    <link rel="stylesheet" href="/vista/activos/css/Pretty-Footer-.css">
    <link rel="stylesheet" href="/vista/activos/css/Simple-Header-y-Navbar-adaptativo-nav.css">

    <!-- jQuery -->
    <script src="/vista/activos/pdf-js/pdf.min.js"></script>
    <script src="/vista/activos/jquery-3.5.1.min.js">
    </script>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Al final del <body> -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <style>
        body {
            background: #222222;
        }

        .mayu {
            text-transform: uppercase;
        }

        /* Estilos para eliminar flechas en inputs numéricos */
        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }


    </style>
</head>

<body>
  <div class="col-12 bg-white text-end py-2 px-3">
  <?php
  if (isset($_SESSION['usuario']) && $_SESSION['usuario'] != '') {
      $name = $_SESSION['usuario'];
      echo "
        <span class='me-3'>👤 Hola <strong>$name</strong></span>
        <a href='/salir' class='btn btn-sm btn-outline-danger'>
          <i class='fas fa-power-off'></i> Cerrar sesión
        </a>";
  } else {
      echo "
        <a href='/iniciar' class='btn btn-sm btn-primary'>
          <i class='fas fa-sign-in-alt'></i> Iniciar sesión
        </a>";
  }
  ?>
</div>

<header id="header" class="position-relative">
  <div class="container-fluid p-0">

    <!-- Contenedor del carrusel con fondo -->
    <div class="position-relative">

      <!-- Carrusel Bootstrap -->
      <div id="carouselHeader" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2500">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="/imagenes/img-challapata/frontisALEJADO.jpg"
                 class="d-block w-100"
                 style="height: 40vh; object-fit: cover; filter: brightness(0.85);"
                 alt="Imagen 1">
          </div>
          <div class="carousel-item">
            <img src="/imagenes/img-challapata/monumento3.jpg"
                 class="d-block w-100"
                 style="height: 40vh; object-fit: cover; filter: brightness(0.85);"
                 alt="Imagen 2">
          </div>
          <div class="carousel-item">
            <img src="/imagenes/img-challapata/PLAZA.jpg"
                 class="d-block w-100"
                 style="height: 40vh; object-fit: cover; filter: brightness(0.85);"
                 alt="Imagen 3">
          </div>
        </div>

        <!-- Controles -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselHeader" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
          <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselHeader" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
          <span class="visually-hidden">Siguiente</span>
        </button>
      </div>

      <!-- Escudo y texto sobre el carrusel -->
      <div class="position-absolute top-50 start-50 translate-middle text-center z-3">
        <img id="escudo" src="/imagenes/gamch/Escudo%20Challapata%202025.webp"
             width="100" height="135" class="protected-image mb-2" alt="Escudo Challapata 2025">
             <h1 class="text-white"
         style="font-size: 20px; font-family: Aldrich, sans-serif; text-shadow: 2px 2px 5px rgba(0, 0, 0, 1);">
       GOBIERNO AUTÓNOMO MUNICIPAL DE CHALLAPATA
     </h1>

      </div>

    </div>
  </div>
</header>





    <nav id="navbar">

      <div id="floating-logo" class="logo-fixed">
        <img src="imagenes/gamch/Logo%20Alcaldía_Mesa%20de%20trabajo%201%20copia.webp" alt="Logo Pequeño" style="width: 115px;">
      </div>

        <div class="handle" aria-expanded="false">☰ MENÚ</div>
        <?php
        echo "<ul>
            <li title='INICIO'>
                <a href='/'><i class='fas fa-home'></i> INICIO</a>
            </li>
            <li title='NOSOTROS' class='has-submenu'>
                <a href='#'><i class='fa fa-users'></i> NOSOTROS &#9661;</a>
                <ul class='submenu'>
                    <li title='MISIÓN VISIÓN'><a  href='/MIVI'>MISIÓN Y VISIÓN</a></li>
                    <li title='ORGANIGRAMA'><a  href='/ORGANIGRAMA'>ORGANIGRAMA</a></li>
                    <li title='SUB ALCALDIAS'><a  href='/SUBALCALDIA'>SUB ALCALDIAS</a></li>
                </ul>
            </li>
            <li><a href='/Noticia'><i class='fa fa-newspaper-o'></i> NOTICIAS</a></li>
            <li><a href='/Servicios'><i class='fa fa-cogs'></i> SERVICIOS</a></li>

            <li title='NORMATIVA' class='has-submenu'>
                <a href='/gac'><i class='fa fa-users'></i> GACETA &#9661;</a>
                <ul class='submenu'>
                  <li title='Documento Referente a Leyes Municipales.'><a href='/LEYES-MUNICIPALES'>LEYES MUNICIPALES</a></li>
                  <li title='Documento Referente a Resoluciones Municipales.'><a href='/RESOLUCIONES-MUNICIPALES'>RESOLUCIONES MUNICIPALES</a></li>
                  <li title='Documento Referente a R.A.M.'><a href='/RESOLUCIONES-MUNICIPALES-ADMINISTRATIVOS'>RESOLUCIONES MUNICIPALES ADMINISTRATIVOS</a></li>
                  <li title='Documento Referente a Decretos Ediles.'><a href='/DECRETOS-EDILES'>DECRETOS EDILES</a></li>
                  <li title='Documento Referente a Decretos Municipales.'><a href='/DECRETOS-MUNICIPALES'>DECRETOS MUNICIPALES</a></li>
                  <li title='Documento Referente a Transparencia.'><a href='/TRANSPARENCIA'>TRANSPARENCIA</a></li>
                  <li title='Documento Referente a Auditoria Interna.'><a href='/AUDITORIA-INTERNA'>AUDITORIA INTERNA</a></li>
                  <li title='Documento Referente a Informes de Gestion.'><a href='/INFORME-DE-GESTION'>INFORME DE GESTION</a></li>
                  <li title='Documentos importantes del municipio.'><a href='/DOCUMENTOS-IMPORTANTES'>DOCUMENTOS IMPORTANTES</a></li>
              </ul>
            </li>

            <li title='NORMATIVA' class='has-submenu'>
                <a href='#'><i class='fa fa-users'></i> NORMATIVA &#9661;</a>
                <ul class='submenu'>
                    <li title='REGLAMENTOS ESPECIFICOS'><a  href='/REGLAMENTOS-ESPECIFICOS'>REGLAMENTOS ESPECIFICOS</a></li>
                    <li title='GESTION DE PERSONAL'><a  href='/GESTION-DE-PERSONAL'>GESTÓN DE PERSONAL</a></li>
                    <li title='GESTION TECNICA'><a  href='/GESTION-TECNICA'>GESTIÓN TÉCNICA</a></li>
                    <li title='GESTION NORMATIVA'><a  href='/GESTION-NORMATIVA'>GESTIÓN NORMATIVA</a></li>
                    <li title='GESTION ADMINISTRATIVA'><a  href='/GESTION-ADMINISTRATIVA'>GESTIÓN ADMINISTRATIVA</a></li>
                    <li title='MANUALES ADMINISTRATIVOS'><a  href='/MANUALES-ADMINISTRATIVOS'>MANUALES ADMINISTRATIVOS</a></li>
                    <li title='MANNUALES DE ORGANIZACION Y FUNCIONES'><a  href='/MANUAL-DE-ORGANIZACION-FUNCIONES'>MANUALES DE ORGANIZACIONES Y FUNCIONES</a></li>
                </ul>
            </li>
            <li title='GESTIÓN TRANSPARENTE' class='has-submenu'>
                <a href='#'><i class='fa fa-users'></i> GESTIÓN TRANSPARENTE &#9661;</a>
                <ul class='submenu'>
                    <li title='INFORMES DE GESTIÓN'><a  href='/INFORMES-DE-GESTION'>INFORMES DE GESTIÓN</a></li>
                    <li title='REPORTES DE EJECUCIÓN'><a  href='/REPORTES-DE-EJECUCION'>REPORTES DE EJECUCIÓN</a></li>
                    <li title='BOLETINES DE INFORMACION'><a  href='/BOLETINES-DE-INFORMACION'>BOLETINES DE INFORMACIÓN</a></li>
                    <li title='PLANES ESTRATEGICOS'><a  href='/PLANES-ESTRATEGICOS'>PLANES ESTRATEGICOS</a></li>
                    <li title='PRESUPUESTO - POA'><a  href='/PRESUPUESTO-POA'>PRESUPUESTO - POA</a></li>
                    <li title='UNIDAD DE AUDITORIA INTERNA'><a  href='/UNIDAD-DE-AUDITORIA-INTERNA'>UNIDAD DE AUDITORIA INTERNA</a></li>
                </ul>
            </li>

            <li><a href='/contacto'><i class='fa fa-envelope'></i> CONTACTOS</a></li>";

        if (isset($_SESSION['id']) && $_SESSION['id'] != '' &&
            isset($_SESSION['especial']) && $_SESSION['especial'] == 'acceso-total' &&
            isset($_SESSION['nombre_role']) && $_SESSION['nombre_role'] == 'Admin') {
            echo "<li><a href='/panel'><i class='fa fa-envelope'></i> PANEL</a></li>";
        }

        if (isset($_SESSION['id']) && $_SESSION['id'] != '') {
            $name = $_SESSION['usuario'];
        }
        echo "</ul>";
        ?>

    </nav>

    <!-- Menú lateral de administración -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasWithBackdrop" aria-labelledby="offcanvasWithBackdropLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBackdropLabel">MENÚ PANEL DE CONTROL</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex flex-column">
                          <?php if(isset($_SESSION['nombre_role']) && $_SESSION['nombre_role'] == 'Admin'){ ?>
                            <div class="p-2" data-role="admin,developer">
                                <a class="nav-link" href="/empleado"><i class="fas fa-users-cog me-3"></i> Gestión de empleados</a>
                            </div>
                            <div class="p-2" data-role="admin,developer">
                                <a class="nav-link" href="/usuarios"><i class="fas fa-users-cog me-3"></i> Gestión de Usuarios</a>
                            </div>
                            <div class="p-2" data-role="admin,developer">
                                <a class="nav-link" href="/rolU"><i class="fas fa-users-cog me-3"></i> Gestión de Role Usuarios</a>
                            </div>
                            <div class="p-2" data-role="admin,developer">
                                <a class="nav-link" href="/rol"><i class="fas fa-file-alt me-3"></i> Gestión de Roles</a>
                            </div>
                            <div class="p-2" data-role="employee,admin,developer">
                                <a class="nav-link" href="/Doc"><i class="fas fa-plus-circle me-3"></i> Gestión Documentos</a>
                            </div>
                            <div class="p-2" data-role="employee,admin,developer">
                                <a class="nav-link" href="/Normas"><i class="fas fa-plus-circle me-3"></i> Gestión de Normativas</a>
                            </div>

                            <div class="p-2" data-role="employee,admin,developer">
                                <a class="nav-link" href="/Transparente"><i class="fas fa-plus-circle me-3"></i> Gestión de Transaparencia</a>
                            </div>
                            <div class="p-2" data-role="employee,admin,developer">
                                <a class="nav-link" href="/RegNot"><i class="fas fa-plus-circle me-3"></i> Gestión Noticias</a>
                            </div>
                            <div class="p-2" data-role="admin,developer">
                                <a class="nav-link" href="/gTurismo"><i class="fas fa-plane me-3"></i> Gestión de Turismo</a>
                            </div>

                            <div class="p-2" data-role="admin,developer">
                                <a class="nav-link" href="/gCultura"><i class="fas fa-theater-masks me-3"></i> Gestión de Cultura</a>
                            </div>
                            <div class="p-2" data-role="developer">
                                <a class="nav-link" href="#reportes"><i class="fas fa-chart-pie me-3"></i> Reportes</a>
                            </div>
                          <?php }else if(isset($_SESSION['nombre_role']) && $_SESSION['nombre_role'] == 'patrimonio'){ ?>
                            <div class="p-2" data-role="admin,developer">
                                <a class="nav-link" href="/gTurismo"><i class="fas fa-plane me-3"></i> Gestión de Turismo</a>
                            </div>

                            <div class="p-2" data-role="admin,developer">
                                <a class="nav-link" href="/gCultura"><i class="fas fa-theater-masks me-3"></i> Gestión de Cultura</a>
                            </div>

                          <?php }  ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts para menú -->
    <script>
    // Mostrar u ocultar el menú principal (modo móvil)
$('.handle').on('click', function () {
$('nav ul').toggleClass('showing');
});

// Manejar clics en los elementos del menú
$('nav ul li').on('click', function (e) {
const hasSubmenu = $(this).hasClass('has-submenu');

if (hasSubmenu) {
    e.preventDefault(); // Evita que se siga el enlace

    // Mostrar u ocultar el submenú solo para el elemento actual
    if ($(this).hasClass('active')) {
        $(this).removeClass('active');
        $(this).children('ul').slideUp(); // Oculta submenú
    } else {
        // Oculta otros submenús
        $('.has-submenu').removeClass('active').children('ul').slideUp();

        // Muestra el submenú actual
        $(this).addClass('active');
        $(this).children('ul').slideDown();
    }
} else {
    const link = $(this).find('a').attr('href');
    if (link && link !== '#') {
        window.location.href = link;
    }
}
});


window.addEventListener('scroll', function () {
    const navbar = document.getElementById('header');
    const floatingLogo = document.getElementById('floating-logo');

    if (!navbar || !floatingLogo) return;

    const rect = navbar.getBoundingClientRect();

    if (rect.bottom < 0) {
      floatingLogo.classList.add('show');
    } else {
      floatingLogo.classList.remove('show');
    }
  });

    </script>

    <script>
      AOS.init();
    </script>
    <!--
    <div id="loader">
    <div class="spinner">
      <i class="fas fa-spinner fa-spin"></i>
    </div>
    <div style="
  font-size: 10px;
  background: linear-gradient(to right, red 50%, blue 50%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  font-weight: bold;
">
  CHALLAPATA
</div>

  </div>
  <style>
  #loader {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(255, 255, 255, 0.9);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
  font-size: 24px;
  display: none; /* Oculto inicialmente */
}

#loader .spinner {
  font-size: 40px;
  animation: spin 3s linear infinite, colorChange 3s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

@keyframes colorChange {
  0% { color: red; }
  50% { color: blue; }
  100% { color: red; }
}


  </style>
  <script>
      window.onload = function() {
        // Mostrar el loader al inicio
        const loader = document.getElementById('loader');
        loader.style.display = 'flex'; // Mostrar el loader

        // Ocultar el loader después de 2 segundos (para simular carga)
        setTimeout(function() {
          loader.style.display = 'none';
        }, 500); // Puedes cambiar el tiempo según el tiempo que desees mostrar el "Cargando"
      };
    </script>-->
