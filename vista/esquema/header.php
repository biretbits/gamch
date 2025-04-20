
<!DOCTYPE html>
<html lang="es">
<head>
    <title></title>

    	<meta charset="utf-8">
     		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <script src="/vista/activos/jquery-3.5.1.min.js"></script>
        <!-- Bootstrap CSS (solo una vez) -->
        <script src="/vista/pdfjss/build/pdf.js"></script>
        <script src="/vista/pdfjss/web/pdf_viewer.js"></script>
        <link rel="stylesheet" href="/vista/pdfjss/web/pdf_viewer.css">
        <link rel="stylesheet" type="text/css" href="/vista/activos/bootstrap.css'; ?>">
        <!-- Select2 CSS -->

        <link rel="stylesheet" type="text/css" href="/vista/activos/documentos.css'; ?>">
        <link href="/vista/activos/select2/css/select2.min.css" rel="stylesheet">
        <!-- SweetAlert2 CSS -->
        <link rel="stylesheet" href="/vista/activos/sweetAlert2/sweetalert2.min.css">
        <!-- Tu archivo CSS personalizado -->
        <link href="/vista/activos/styles.css" rel="stylesheet" />
        <!-- Chart.js -->
        <script src="/vista/activos/Chart.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="/vista/activos/bootstrap/bootstrap.min.js"></script>
        <!-- SweetAlert2 JS -->
        <script src="/vista/activos/sweetAlert2/sweetalert2.min.js"></script>
        <!-- Select2 JS -->
        <script src="/vista/activos/select2/js/select2.min.js"></script>
        <link rel="stylesheet" href="/vista/activos/fontawesome/css/all.min.css">
            <link rel="stylesheet" href="/vista/activos/bootstrap/bootstrap.min.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aboreto&amp;display=swap">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aldrich">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alegreya+SC&amp;display=swap">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
      <link rel="stylesheet" href="/vista/activos/fonts/font-awesome.min.css">
      <link rel="stylesheet" href="/vista/activos/css/Background-Image---Parallax---No-Text.css">
      <link rel="stylesheet" href="/vista/activos/css/Comming-Soon-Page.css">
      <link rel="stylesheet" href="/vista/activos/css/Documents-App-Browser.css">
      <link rel="stylesheet" href="/vista/activos/css/Hover-Cards-by-Printaga-Publishing.css">
      <link rel="stylesheet" href="/vista/activos/css/Login-Box-En-login-box-en.css">
      <link rel="stylesheet" href="/vista/activos/css/Login-Form-Basic-icons.css">
      <link rel="stylesheet" href="/vista/activos/css/Pretty-Footer-.css">
      <link rel="stylesheet" href="/vista/activos/css/Simple-Header-y-Navbar-adaptativo-nav.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>
  <header id='header'>
        <img src="/imagenes/gamch/EscudoChallapata2024mediano2.png" style="height: 120px;" />
      <h1>Gobierno Autónomo Municipal de Challapata</h1>
    </header>
    <nav id="navbar">
      <?php
      echo "<ul>
          <li class='nav-item' title='INICIO'>
              <a style='color:white' href='/'>
                  <i class='fas fa-home'></i> INICIO
              </a>
          </li>
          <li class='nav-item' title='GACETA'>
              <a style='color:white' href='/gac'>
                  <i class='fas fa-home'></i> GACETA
              </a>
          </li>";

          if(isset($_SESSION["id"]) && $_SESSION["id"] != "" && isset($_SESSION["especial"]) && $_SESSION["especial"] == "acceso-total"
            && isset($_SESSION["nombre_role"]) && $_SESSION["nombre_role"] == "Admin"){
              echo "<li class='has-submenu' title='Despacho'>
                      <a href='#'style='color:white'>
                        USUARIO
                      </a>
                      <ul class='submenu'>
                          <li title='ROLES'>
                            <a style='color:white' href='/rol'>ROLES</a>
                          </li>
                          <li title='ROLES USUARIO'>
                            <a style='color:white' href='/rolU'>ROLES USUARIO</a>
                          </li>
                          <li title='CRUD DOCUMENTO'>
                            <a style='color:white' href='/Doc'>DOCUMENTOS</a>
                          </li>
                        </ul>
                    </li>
                    ";
                  }

          if(isset($_SESSION["id"]) && $_SESSION["id"] != ""){
            $name = $_SESSION["usuario"];
            //echo $_SESSION["tipo_usuario"];
          }
          if(isset($_SESSION["especial"]) && $_SESSION["especial"] != ""){
            echo "<li title='Nombre Usuario' class='has-submenu'>
              <a href='#'>
                  hola ".$name."
              </a>
              <ul class='submenu'>
                  <li  title='Cerrar sesión'>
                    <a  style='color:white' href='/salir'><i class='fas fa-power-off'></i>
                    </a>
                  </li>
              </ul>
              </li>";
          }else{
            echo"<li class='nav-item'>
              <a style='color:white' href='/iniciar'>Iniciar sesión</a>
            </li>";
          }
            echo "
      </ul>";
      ?>
      <div class="handle">
        Menu
      </div>
    </nav>
    <script>
    // Mostrar u ocultar menú en móviles
    $('.handle').on('click', function () {
      $('nav ul').toggleClass('showing');
    });

    // Manejo de submenús
    $('nav ul li').on('click', function (e) {
      const hasSubmenu = $(this).hasClass('has-submenu');

      if (hasSubmenu) {
        e.preventDefault(); // Evita navegación

        if ($(this).hasClass('active')) {
          $(this).removeClass('active');
        } else {
          $('.has-submenu').removeClass('active');
          $(this).addClass('active');
        }
      } else {
        // Si no tiene submenú, dejamos que funcione el href normalmente
        const link = $(this).find('a').attr('href');
        if (link && link !== '#') {
          window.location.href = link;
        }
      }
    });

    // Previene propagación de clic dentro de <a> con submenu
    $('.has-submenu > a').on('click', function (e) {
      e.preventDefault(); // Previene navegación si haces clic en el texto
    });

  </script>
<script>
  // Obtenemos el elemento con id="navbar" (el menú)
const navbar = document.getElementById("navbar");
const header = document.getElementById("header");

// Variable de control para saber si el menú ya está fijado o no
let navbarFixed = false;

// Esta función se ejecuta cada vez que el usuario hace scroll
window.onscroll = function () {
// Obtenemos el número de píxeles que se ha desplazado la ventana hacia abajo
const scrollTop = window.scrollY;
// Si el menú aún no está fijado y el scroll ha superado la altura del header
if (!navbarFixed && scrollTop >= header.offsetHeight+5) {
  // Agrega la clase "pre-fixed" para que el menú esté oculto inicialmente
  navbar.classList.add("pre-fixed");
  // Luego agrega la clase "fixed" para posicionarlo fijo en la parte superior
  navbar.classList.add("fixed");
  console.log(header.offsetHeight);
  // Esperamos 10 milisegundos para que el navegador aplique la clase anterior,
  // y luego quitamos "pre-fixed" para activar la transición visual (suavidad)
  setTimeout(() => {
    navbar.classList.remove("pre-fixed");
  }, 10);
  // Marcamos que el menú ya está fijado para evitar repetir este bloque
  navbarFixed = true;
}

// Si el menú está fijado y el usuario hace scroll hacia arriba por encima del header
if (navbarFixed && scrollTop < header.offsetHeight) {
  // Quitamos la clase "fixed" para que el menú vuelva a su posición normal
  navbar.classList.remove("fixed");
  // Por si acaso, también quitamos "pre-fixed" si aún estuviera presente
  navbar.classList.remove("pre-fixed");
  // Indicamos que el menú ya no está fijado
  navbarFixed = false;
}
};
</script>
