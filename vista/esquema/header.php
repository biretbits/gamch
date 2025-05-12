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
    <link rel="stylesheet" href="/vista/pdfjss/web/pdf_viewer.css">
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
    <script src="/vista/activos/jquery-3.5.1.min.js"></script>
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
  <header id="header" class="position-relative">
  <div class="container-fluid">
    <div class="d-flex justify-content-end">
      <?php
        if (isset($_SESSION['usuario']) && $_SESSION['usuario'] != '') {
            $name = $_SESSION['usuario']; // Asegúrate de definir $name
            echo "
                      <a  href='#'>
                        Hola $name
                      </a>
                    <a  href='/salir'><i class='fas fa-power-off'></i> Cerrar sesión</a></li>";
        } else {
            echo "<a class='nav-link text-white' href='/iniciar'>Iniciar sesión</a>";
        }
      ?>
    </div>

    <div class="text-center my-2">
      <img id="escudo" src="/imagenes/gamch/Escudo%20Challapata%202025.webp"
           width="105" height="140" class="protected-image" alt="Escudo Challapata 2025">
      <h1 class="mt-2" style="font-size: 21px; font-family: Aldrich, sans-serif; line-height: 31.6px;">
        GOBIERNO AUTÓNOMO MUNICIPAL DE CHALLAPATA
      </h1>
    </div>

    <hr class="mt-0 border-white">
  </div>
</header>



    <nav id="navbar">
        <div class="handle" aria-expanded="false">☰ MENÚ</div>
        <?php
        echo "<ul>
            <li title='INICIO'>
                <a href='/'><i class='fas fa-home'></i> INICIO</a>
            </li>
            <li title='NOSOTROS' class='has-submenu'>
                <a href='#'><i class='fa fa-users'></i> NOSOTROS▼</a>
                <ul class='submenu'>
                    <li title='MISIÓN VISIÓN'><a  href='/MIVI'>MISIÓN Y VISIÓN</a></li>
                    <li title='ORGANIGRAMA'><a  href='/ORGANIGRAMA'>ORGANIGRAMA</a></li>
                    <li title='SUB ALCALDIAS'><a  href='/SUBALCALDIA'>SUB ALCALDIAS</a></li>
                </ul>
            </li>
            <li><a href='/Noticia'><i class='fa fa-newspaper-o'></i> NOTICIAS</a></li>
            <li><a href='#'><i class='fa fa-cogs'></i> SERVICIOS</a></li>
            <li><a href='/gac'><i class='fas fa-file'></i> GACETA</a></li>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts para menú -->
    <script>
        $('.handle').on('click', function () {
            $('nav ul').toggleClass('showing');
        });

        $('nav ul li').on('click', function (e) {
            const hasSubmenu = $(this).hasClass('has-submenu');
            if (hasSubmenu) {
                e.preventDefault();
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active');
                } else {
                    $('.has-submenu').removeClass('active');
                    $(this).addClass('active');
                }
            } else {
                const link = $(this).find('a').attr('href');
                if (link && link !== '#') {
                    window.location.href = link;
                }
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
