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

  <button type="button" class="btn btn-primary" id="openChatbot">💬</button>

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

<header id="header">
  <div class="container-fluid p-0">
    <div class="banner d-flex align-items-center position-relative">
      <img id="escudo" src="/imagenes/gamch/Escudo%20Challapata%202025.webp"
           width="100" height="135" class="protected-image mb-2" alt="Escudo Challapata 2025">

      <div class="banner-text ms-3">
        <h1 class="banner-title text-white mb-2">Gobierno Autónomo Municipal de Challapata</h1>
        <!--<button class="banner-button btn btn-primary">Iniciar sesión</button>-->
      </div>

      <div class="wisp-effect"></div>
      <div class="gradient-overlay"></div>
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
            </li>";

            //<li><a href='/contacto'><i class='fa fa-envelope'></i> CONTACTOS</a></li>";

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

        document.addEventListener('DOMContentLoaded', function () {
            const openButton = document.getElementById('openChatbot');
            const closeButton = document.getElementById('closeChatbot');
            const chatbotContainer = document.getElementById('chatbotContainer');

            // Función para abrir el chatbot
            openButton.addEventListener('click', function () {
                chatbotContainer.classList.remove('d-none');
                chatbotContainer.classList.add('d-block');
            });

            // Función para cerrar el chatbot
            closeButton.addEventListener('click', function () {
                chatbotContainer.classList.remove('d-block');
                chatbotContainer.classList.add('d-none');
            });

            // También puedes hacer que el chatbot se cierre si se hace clic fuera de él, si así lo deseas
            document.addEventListener('click', function (event) {
                if (!chatbotContainer.contains(event.target) && !openButton.contains(event.target)) {
                    chatbotContainer.classList.remove('d-block');
                    chatbotContainer.classList.add('d-none');
                }
            });
        });

</script>
<script>

        function enviar() {
          var va = document.getElementById("data").value;
          if (va == '') {
            alertInfo();
            return;
          }

          var msg = '<div class="user-inbox inbox"><div class="msg-header"><p>' + va + '</p></div></div>';
          $(".form").append(msg);
          $("#data").val('');

          var datos = new FormData();
          datos.append("mensaje", va);

          $.ajax({
            cache: false,
            url: '/msu',
            datatype: "html",
            type: 'POST',
            data: datos,
            contentType: false,
            processData: false,
            success: function(result) {
              result=$.trim(result);
              pedirRespuesta(result);
            }
          });
        }

        const apiKey = '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';
      const apiUrl = "https://openrouter.ai/api/v1/chat/completions";

      async function pedirRespuesta(respuesta) {
        const textoBase = respuesta;

        const prompt = `
      Eres un asistente oficial del Gobierno Autónomo Municipal de Challapata.
      Por favor, responde de forma clara, formal y profesional a la siguiente información.

      Información: "${textoBase}"
      Devuelve únicamente la información reformulada, sin saludos ni despedidas.
      `;

        const data = {
          model: "google/gemma-2-9b-it:free",
          messages: [
            { role: "user", content: prompt.trim() }
          ]
        };

        try {
          const respuesta = await fetch(apiUrl, {
            method: "POST",
            headers: {
              "Authorization": `Bearer ${apiKey}`,
              "Content-Type": "application/json",
              "HTTP-Referer": "https://tusitio.com",
              "X-Title": "MiAppOpenRouter"
            },
            body: JSON.stringify(data)
          });

          if (!respuesta.ok) {
            console.warn("Fallo la petición a la IA. Mostrando texto original.");
            mostrarResultado(textoBase);
            mostrarResultado("Error: " + data.error);
            return;
          }

          const resultado = await respuesta.json();
          console.log("Respuesta completa de la API:", resultado);

          const contenido = resultado?.choices?.[0]?.message?.content?.trim() || "No hay respuesta disponible";
          if(contenido == "No hay respuesta disponible"){
            mostrarResultado(textoBase);
          }else{
            mostrarResultado(contenido);
          }
        } catch (error) {
          console.error("Error al consultar la IA:", error);
          mostrarResultado(`Error: ${error.message}`);
        }
      }

            function mostrarResultado(texto) {

                  $(".form").append('<span class="mensaje-espere">....</span>');
                  $(".form").scrollTop($(".form")[0].scrollHeight);
                  setTimeout(function() {
                    $(".mensaje-espere").remove();
                    var replay = '<div class="bot-inbox inbox"><div class="icon"><img src="imagenes/gamch/chat.png"style="height: 25px;width: 25px; transform: translateY(3px);"></div><div class="msg-header"><p>' + texto + '</p></div></div>';
                    $(".form").append(replay);
                    $(".form").scrollTop($(".form")[0].scrollHeight);
                  }, 1500);
            }
      /*
            document.addEventListener("DOMContentLoaded", () => {
              pedirRespuesta();
            });*/
    </script>

    <script>
      AOS.init();
    </script>

    <div id="chatbotContainer" class="chatbot-container d-none">
          <div class="chatbot-header">
              <h5>Chatbot</h5>
              <button type="button" class="btn-close" id="closeChatbot"></button>
          </div>
          <div class="chatbot-body">
              <div class="wrapper">
                  <div class="form">
                      <div class="bot-inbox inbox">
                          <div class="icon">
                              <img src='imagenes/gamch/chat.png'style='height: 25px;width: 25px;'>
                          </div>
                          <div class="msg-header">
                              <p>Hola, Bienvenido</p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="chatbot-footer">
              <input id="data" class='form-control' type="text" onkeydown="checkEnter(event)" placeholder="Escriba su consulta">
              <button id="send-btn" width='20px' height='20px'class='btn btn-primary' onclick="enviar()" style='background:Teal'>Enviar</button>
          </div>
      </div>

  <style media="screen">
  .mensaje-espere {
    display: inline-block;
    font-size: 16px;
    font-weight: bold;
    color: #3498db; /* Puedes cambiar el color si lo prefieres */
    animation: moverTexto 2s linear infinite;
  }

  @keyframes moverTexto {
    0% {
        transform: translateX(0); /* Empieza en la posición original */
    }
    50% {
        transform: translateX(20px); /* Se mueve 20px a la derecha */
    }
    100% {
        transform: translateX(0); /* Regresa a la posición original */
    }
  }
  </style>
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
