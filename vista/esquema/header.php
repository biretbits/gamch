
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
<body style="background: #222222;">
    <header style="background: rgb(34,34,34);"><!DOCTYPE html>
<html>
<head>
    <title>Imagen Protegida</title>
</head>
<body>
    <div class="image-container">
        <img id="escudo"
            src="/imagenes/gamch/Escudo%20Challapata%202025.webp"
            width="105"
            height="140"
            class="protected-image"
            alt="Escudo Challapata 2025"
        />
        <div class="overlay"></div>
    </div>

</body>
</html></header>
    <div>
        <h1 style="font-size: 21px;font-family: Aldrich, sans-serif;text-align: center;line-height: 31.6px;color: rgb(255,255,255);">GOBIERNO AUTÓNOMO MUNICIPAL DE CHALLAPATA</h1>
        <hr class="mt-0">
    </div><!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gobierno Autónomo Municipal de Challapata</title>

</head>
<body>

    <nav id="navbar">
      <div class="handle" aria-expanded="false">☰ MENÚ</div>
      <?php
      echo "<ul>
          <li title='INICIO'>
              <a href='/'>
                  <i class='fas fa-home'></i> INICIO
              </a>
          </li>
          <li><a href='#'><i class='fa fa-users'></i> NOSOTROS</a></li>
          <li><a href='#'><i class='fa fa-newspaper-o'></i> NOTICIAS</a></li>
          <li><a href='#'><i class='fa fa-cogs'></i> SERVICIOS</a></li>
          <li><a href='/gac'>
              <i class='fas fa-file'></i> GACETA
          </a></li>
          <li><a href='#'><i class='fa fa-envelope'></i> CONTACTOS</a></li>
          ";

          if(isset($_SESSION["id"]) && $_SESSION["id"] != "" && isset($_SESSION["especial"]) && $_SESSION["especial"] == "acceso-total"
            && isset($_SESSION["nombre_role"]) && $_SESSION["nombre_role"] == "Admin"){
              echo "<li class='has-submenu' title='Despacho'>
                      <a href='#'>
                        USUARIO
                      </a>
                      <ul class='submenu'>
                          <li title='ROLES'>
                            <a  href='/rol'>ROLES</a>
                          </li>
                          <li title='ROLES USUARIO'>
                            <a  href='/rolU'>ROLES USUARIO</a>
                          </li>
                          <li title='CRUD DOCUMENTO'>
                            <a  href='/Doc'>DOCUMENTOS</a>
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

    </nav>
  </body>
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
// Menú móvil
const handle = document.querySelector('.handle');
const navUl = document.querySelector('nav ul');

handle.addEventListener('click', () => {
  navUl.classList.toggle('showing');
  const isExpanded = handle.getAttribute('aria-expanded') === 'true';
  handle.setAttribute('aria-expanded', !isExpanded);
  handle.textContent = isExpanded ? '☰ MENÚ' : '✕ CERRAR';
});

// Activar estado de botón
document.querySelectorAll('nav ul li a').forEach(link => {
  link.addEventListener('click', e => {
    e.preventDefault();
    document.querySelectorAll('nav ul li a').forEach(a => a.classList.remove('active'));
    e.target.classList.add('active');
  });
});
</script>

    <script>
        // Bloquear menú contextual
        document.getElementById('escudo').addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });

        // Bloquear arrastre de la imagen
        document.getElementById('escudo').addEventListener('dragstart', function(e) {
            e.preventDefault();
        });

        // Bloquear selección de texto/imagen
        document.addEventListener('selectstart', function(e) {
            if (e.target.id === 'escudo') {
                e.preventDefault();
            }
        });
    </script>
