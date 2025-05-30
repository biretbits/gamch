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
    <link rel="stylesheet" href="/vista/activos/css/cssNoticia.css">

    <!-- jQuery -->
    <script src="/vista/activos/pdf-js/pdf.min.js"></script>
    <script src="/vista/activos/jquery-3.5.1.min.js">
    </script>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Al final del <body> -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <style>

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

<body >
  <button type="button" class="btn btn-primary" id="openChatbot">💬</button>

<div id="header">

</div>


  <!-- Barra de navegación -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <!-- Logo -->
      <a class="navbar-brand" id="floating-logo" class="logo-fixed" href="/">
        <img src="imagenes/gamch/Logo%20Alcaldía_Mesa%20de%20trabajo%201%20copia.webp" alt="Logo" style="width: 155px;">
      </a>

      <!-- Menú móvil: el icono de hamburguesa estará a la derecha -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" class="ms-auto">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Menú de navegación -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-home"></i> INICIO
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/inicio">HOME</a></li>
              <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario'] != ''): ?>
                <li><a class="dropdown-item" href="/salir"><i class="fas fa-power-off"></i> Cerrar sesión</a></li>
              <?php else: ?>
                <li><a class="dropdown-item" href="/iniciar"><i class="fas fa-sign-in-alt"></i> Iniciar sesión</a></li>
              <?php endif; ?>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-users"></i> NOSOTROS
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/MIVI">MISIÓN Y VISIÓN</a></li>
              <li><a class="dropdown-item" href="/ORGANIGRAMA">ORGANIGRAMA</a></li>
              <li><a class="dropdown-item" href="/SUBALCALDIA">SUB ALCALDIAS</a></li>
              <li><a class="dropdown-item" href="/ALCALDE">ALCALDE MUNICIPAL</a></li>
            </ul>
          </li>

          <li class="nav-item"><a class="nav-link" href="/Noticia"><i class="fa fa-newspaper-o"></i> NOTICIAS</a></li>
          <li class="nav-item"><a class="nav-link" href="/Servicios"><i class="fa fa-cogs"></i> SERVICIOS</a></li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-file-alt"></i> GACETA
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/LEYES-MUNICIPALES">LEYES MUNICIPALES</a></li>
              <li><a class="dropdown-item" href="/RESOLUCIONES-MUNICIPALES">RESOLUCIONES MUNICIPALES</a></li>
              <li><a class="dropdown-item" href="/RESOLUCIONES-MUNICIPALES-ADMINISTRATIVOS">RESOLUCIONES MUNICIPALES ADMINISTRATIVOS</a></li>
              <li><a class="dropdown-item" href="/DECRETOS-EDILES">DECRETOS EDILES</a></li>
              <li><a class="dropdown-item" href="/DECRETOS-MUNICIPALES">DECRETOS MUNICIPALES</a></li>
              <li><a class="dropdown-item" href="/TRANSPARENCIA">TRANSPARENCIA</a></li>
              <li><a class="dropdown-item" href="/AUDITORIA-INTERNA">AUDITORIA INTERNA</a></li>
              <li><a class="dropdown-item" href="/INFORME-DE-GESTION">INFORME DE GESTION</a></li>
              <li><a class="dropdown-item" href="/DOCUMENTOS-IMPORTANTES">DOCUMENTOS IMPORTANTES</a></li>

            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-cogs"></i> NORMATIVA
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/REGLAMENTOS-ESPECIFICOS">REGLAMENTOS</a></li>
              <li><a class="dropdown-item" href="/GESTION-DE-PERSONAL">GESTIÓN DE PERSONAL</a></li>
              <li><a class="dropdown-item" href="/GESTION-TECNICA">GESTIÓN TÉCNICA</a></li>
              <li><a class="dropdown-item" href="/GESTION-NORMATIVA">GESTIÓN NORMATIVA</a></li>
              <li><a class="dropdown-item" href="/GESTION-ADMINISTRATIVA">GESTIÓN ADMINISTRATIVA</a></li>
              <li><a class="dropdown-item" href="/MANUALES-ADMINISTRATIVOS">MANUALES ADMINISTRATIVOS</a></li>
              <li><a class="dropdown-item" href="/MANUAL-DE-ORGANIZACION-FUNCIONES">MANUALES DE ORGANIZACIONES Y FUNCIONES</a></li>

            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-cogs"></i> GESTIÓN TRANSPARENTE
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/INFORMES-DE-GESTION">INFORMES DE GESTIÓN</a></li>
              <li><a class="dropdown-item" href="/REPORTES-DE-EJECUCION">REPORTES DE EJECUCIÓN</a></li>
              <li><a class="dropdown-item" href="/BOLETINES-DE-INFORMACION">BOLETINES DE INFORMACIÓN</a></li>
              <li><a class="dropdown-item" href="/PLANES-ESTRATEGICOS">PLANES ESTRATEGICOS</a></li>
              <li><a class="dropdown-item" href="/PRESUPUESTO-POA">PRESUPUESTO - POA</a></li>
              <li><a class="dropdown-item" href="/UNIDAD-DE-AUDITORIA-INTERNA">UNIDAD DE AUDITORIA INTERNA</a></li>

            </ul>
          </li>

          <li class="nav-item"><a class="nav-link" href="/contacto"><i class="fa fa-envelope"></i> CONTACTOS</a></li>

          <?php if (isset($_SESSION['id']) && $_SESSION['id'] != '' && isset($_SESSION['especial']) && $_SESSION['especial'] == 'acceso-total' && isset($_SESSION['nombre_role']) && $_SESSION['nombre_role'] == 'Admin'): ?>
            <li class="nav-item"><a class="nav-link" href="/panel"><i class="fa fa-cogs"></i> PANEL</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>

  </nav>
  <div id="marquee" style="width: 100%; overflow: hidden; background-color: transparent; position: fixed; top: 67px; left: 0; z-index: 90;">
    <!-- Fila superior con flexbox -->
    <div style="display: flex; align-items: center; background-color: #383838;">
      <!-- Banner Rojo Estático -->
      <div style="background-color: red; color: white; font-size: 15px; font-weight: bold; margin-right: 10px; padding: 3px">
        Noticias:
      </div>

      <style>
        .marquee-content {
          display: inline-block;
          white-space: nowrap;
          animation: scroll-left 30s linear infinite;
        }
        .bullet {
          color: red;
          font-size: 16px;
          margin: 0 10px;
        }
        .message {
          color: white;
          font-size: 13px;
          font-weight: bold;
          margin-right: 110px;
        }

        @keyframes scroll-left {
          0% {
            transform: translateX(0%);
          }
          100% {
            transform: translateX(-50%);
          }
        }
      </style>

      <?php
      $titulos = $_SESSION['TITULOS'];
      ?>

      <!-- Marquesina -->
      <div style="overflow: hidden; white-space: nowrap; background-color: black; position: relative;">
        <div class="marquee-content">
          <?php for ($i = 0; $i < count($titulos); $i++) {
            $titulo = $titulos[$i]; ?>
            <span class="bullet">●</span>
            <span class="message"><?php echo htmlspecialchars($titulo["titulo"]); ?></span>
          <?php } ?>
          <?php for ($i = 0; $i < count($titulos); $i++) {
            $titulo = $titulos[$i]; ?>
            <span class="bullet">●</span>
            <span class="message"><?php echo htmlspecialchars($titulo["titulo"]); ?></span>
          <?php } ?>
        </div>
      </div>

      <!-- Botón de sesión a la derecha -->
      <div style="margin-left: 5px;">
        <?php
          if (isset($_SESSION['usuario']) && $_SESSION['usuario'] != '') {
            $name = $_SESSION['usuario'];
            echo "<span style='font-size:10px; color: white; margin-right: 10px;'>";
            if ($_SESSION['foto'] == "default.jpg" || $_SESSION['foto'] == "") {
              echo "<img src='imagenes/user.png' alt='foto' class='img-fluid rounded-circle' style='object-fit: cover; width: 20px; height: 20px; margin-right:5px;'>";
            } else {
              echo "<img src='" . $_SESSION['foto'] . "' alt='foto' class='img-fluid rounded-circle' style='object-fit: cover; width: 20px; height: 20px; margin-right:5px;'>";
            }
          } else {
            // Si no está logueado, muestra algo aquí
          }
        ?>
      </div>
    </div>
  </div>

    <div style="margin-top: 95px;"> <!-- Ajusta este valor para que esté justo debajo del otro div -->
      <!-- Tu contenido aquí -->
    </div>

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
              //pedirRespuesta(result);
              mostrarResultado(result);
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

          const contenido = (resultado && resultado.choices && resultado.choices[0] && resultado.choices[0].message && resultado.choices[0].message.content)
                  ? resultado.choices[0].message.content.trim()
                  : "No hay respuesta disponible";
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

            function SeguirLeyendo(id){
              var form = document.createElement('form');
               form.method = 'post';
               form.action = '/seguirLey'; // Coloca la URL de destino correcta
               // Agregar campos ocultos para cada dato
               var datos = {
                   id: id
               };
               for (var key in datos) {
                   if (datos.hasOwnProperty(key)) {
                       var input = document.createElement('input');
                       input.type = 'hidden';
                       input.name = key;
                       input.value = datos[key];
                       form.appendChild(input);
                   }
               }
             // Agregar el formulario al cuerpo del documento y enviarlo
             document.body.appendChild(form);
             form.submit();
            }


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

      <div class="content">
        <div class="main-content">
