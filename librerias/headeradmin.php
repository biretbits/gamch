
<!DOCTYPE html>
<html lang="es">
<head>
    <title></title>

    	<meta charset="utf-8">

     		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <script src="activos/jquery-3.5.1.min.js"></script>
        <!-- Bootstrap CSS (solo una vez) -->
        <link rel="stylesheet" type="text/css" href="activos/bootstrap/bootstrap.min.css">
        <!-- Select2 CSS -->
        <link href="activos/select2/css/select2.min.css" rel="stylesheet">
        <!-- SweetAlert2 CSS -->
        <link rel="stylesheet" href="activos/sweetAlert2/sweetalert2.min.css">
        <!-- Tu archivo CSS personalizado -->
        <link href="activos/styles.css" rel="stylesheet" />
        <!-- Chart.js -->
        <script src="activos/Chart.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="activos/bootstrap/bootstrap.min.js"></script>
        <!-- SweetAlert2 JS -->
        <script src="activos/sweetAlert2/sweetalert2.min.js"></script>
        <!-- Select2 JS -->
        <script src="activos/select2/js/select2.min.js"></script>

</head>
<style type="text/css">
html, body {
      height: 100%;
      margin: 0;
      padding: 0;
  }

  body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
  }
  .content {
    flex: 1 0 auto;
  }
  .main-content {
      padding-top: 80px; /* Ajusta este valor según la altura de tu navbar */
  }
  #co{
    color:gray;
    font-size: 17px
  }
  /* Estilo del cuerpo del modal */
  .modal-body {
      height: 100%; /* Ocupa el 100% de la altura del modal */
      overflow: hidden; /* Evita que el contenido haga scroll */
      padding: 0; /* Ajusta el relleno si es necesario */
  }

  /* Contenedor de contenido dentro del modal */
  .wrapper {
      width: 100%;
      background: white;
      border-radius: 5px;
      border: 1px solid lightgrey;
      border-top: 0px;
      height: 100%; /* Ocupa el 100% de la altura del modal */
      box-sizing: border-box; /* Incluye el padding y el borde en el ancho y alto */
  }

  /* Estilo del formulario dentro del contenedor */
  .wrapper .form {
      padding: 30px 15px;
      min-height: 300px;
      max-height: 300px;
      overflow-y: auto; /* Permite el scroll solo si el contenido excede el tamaño */
  }

  /* Estilos para el inbox y otros elementos dentro del formulario */
  .wrapper .form .inbox {
      width: auto;
      display: flex;
      align-items: baseline;
  }

  .wrapper .form .user-inbox {
      justify-content: flex-end;
      margin: 13px 0;
  }

  .wrapper .form .inbox .icon {
      height: 33px;
      width: 33px;
      color: #fff;
      text-align: center;
      line-height: 40px;
      border-radius: 50%;
      font-size: 18px;
      background: lime
  }

  .wrapper .form .inbox .msg-header {
      max-width: 60%;
      margin-left: 10px;
  }

  .wrapper .form .inbox .msg-header p {
      color: #fff;
      background: Teal;
      border-radius: 10px;
      padding: 8px 10px;
      font-size: 14px;
      word-break: break-all;
  }

  .wrapper .form .user-inbox .msg-header p {
      color: #333;
      background: #efefef;
  }


  .titleNew {
      background: Teal;
      color: #fff;
      font-size: 20px;
      font-weight: 500;
      line-height: 60px;
      text-align: center;
      border-bottom: 1px solid lime;
      border-radius: 5px 5px 0 0;
  }

  /* Estilo del botón para abrir el chatbot */
  #openChatbot {
      position: fixed;
      bottom: 5px;
      right: 10px;
      border-radius: 50%;
      background-color: #007bff;
      color: white;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      cursor: pointer;
      z-index: 1051; /* Asegúrate de que esté sobre otros elementos */
  }

  /* Contenedor del chatbot */
  .chatbot-container {
      position: fixed;
      width: 370px;
      height: 450px;
      border: 1px solid lightgrey;
      border-radius: 5px;
      background: white;
      z-index: 1050;
      display: none; /* Oculto por defecto */
      transition: transform 0.3s ease-in-out;
  }

  /* Estilos para pantallas grandes (computadoras de escritorio) */
  @media (min-width: 768px) {
      .chatbot-container {
          bottom: 80px; /* Ajusta la distancia desde la parte inferior para que aparezca más arriba del botón */
          right: 20px; /* Coloca el chatbot en la parte derecha de la pantalla */
          transform: translateY(0); /* Desactiva el translate Y en pantallas grandes */
      }
  }

  /* Estilos para pantallas pequeñas (móviles y tablets) */
  @media (max-width: 767px) {
      .chatbot-container {
          top: 50%; /* Centrado verticalmente */
          left: 50%; /* Centrado horizontalmente */
          transform: translate(-50%, -50%); /* Centra el chatbot en la pantalla */
      }
  }

  /* Clase para mostrar el chatbot en el centro */
  .chatbot-container.d-block {
      display: block; /* Muestra el chatbot */
  }

  /* Estilo del encabezado del chatbot */
  .chatbot-header {
      background: teal;
      color: white;
      padding: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
  }

  /* Estilo del cuerpo del chatbot */
  .chatbot-body {
      padding: 15px;
      height: calc(100% - 100px); /* Ajusta la altura restante después del header y footer */
  }

  /* Estilo del pie del chatbot */
  .chatbot-footer {
      display: flex;
      align-items: center; /* Alinea verticalmente */
      gap: 1px; /* Espacio entre el input y el botón */
  }

  .chatbot-footer input {
      flex: 1; /* Ocupa el espacio disponible */
  }

  .chatbot-footer button {
      flex-shrink: 0; /* Evita que el botón se reduzca */
      width: auto; /* Ajusta el tamaño del botón automáticamente */
      height: auto; /* Ajusta la altura del botón automáticamente */
      padding: 5px 10px; /* Ajusta el padding del botón para hacerlo más pequeño */
  }
/*quitar los botones de incremento y decremento de un campo de typo numbert html*/
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Quitar spinners en Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
  </style>
<body  id="page-top">
  <button type="button" class="btn btn-primary" id="openChatbot">💬</button>

  <div class="content">
  <?php
  $name = "";
  if(isset($_SESSION["tipo_usuario"]) && $_SESSION["tipo_usuario"] != ""){
    $name = $_SESSION["usuario"];
  }

  echo "<nav style=' border-bottom: 1px solid silver;' class='navbar navbar-expand-lg navbar-light fixed-top shadow-sm' id='mainNav'>
    <div class='container px-5'>
        <a href='#' class='navbar-brand fw-bold'><img src='imagenes/cds.ico' height='30' width='30' class='rounded-circle'> Centro De Salud</a>

        <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarResponsive' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
        </button>
          <div class='collapse navbar-collapse' id='navbarResponsive'>
            <ul class='navbar-nav ms-auto me-4 my-3 my-lg-0'>
                <li class='nav-item' title='Inicio'>
                  <a class='nav-link btn btn-outline-warning' href='controlador/logeo.controlador.php?accion=ix'><img src='imagenes/house.ico'style='height: 25px;width: 25px;'></a>
                </li>";
              if(isset($_SESSION["tipo_usuario"]) && $_SESSION["tipo_usuario"] == "admin"){
              echo "
                <li class='nav-item' title='Usuarios'>
                    <a class='nav-link btn btn-outline-warning' href='controlador/usuario.controlador.php?accion=vut'><img src='imagenes/admin.ico'style='height: 25px;width: 25px;'></a>
                </li>";
                echo "
                  <li class='nav-item' title='Servicios'>
                      <a class='nav-link btn btn-outline-warning' href='controlador/servicio.controlador.php?accion=rsr'><img src='imagenes/servicio.ico'style='height: 25px;width: 25px;'></a>
                  </li>";
                echo "
                  <li class='nav-item' title='Patologías'>
                      <a class='nav-link btn btn-outline-warning' href='controlador/patologias.controlador.php?accion=vtp'><img src='imagenes/patologia.png'style='height: 25px;width: 25px;'></a>
                  </li>";
                echo "
                  <li class='nav-item' title='ChatBot'>
                      <a class='nav-link btn btn-outline-warning' href='controlador/chat.controlador.php?accion=tcb'><img src='imagenes/robot.png'style='height: 25px;width: 25px;'></a>
                  </li>";

                echo "
                  <li class='nav-item' title='Configuracion del control de acceso'>
                      <a class='nav-link btn btn-outline-warning' href='controlador/usuario.controlador.php?accion=cca'><img src='imagenes/control.png'style='height: 25px;width: 25px;'></a>
                  </li>";
                  echo "<li class='nav-item dropdown' title='Base de datos'>
                    <a class='nav-link dropdown-toggle btn btn-outline-success' href='#' id='navbarDropdown2' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                        <img src='imagenes/bd.png'style='height: 25px;width: 25px;'>
                    </a>
                    <ul class='dropdown-menu' aria-labelledby='navbarDropdown2'>
                        <li class='nav-item ' title='Exportar base de datos' style='color:green'>
                          <a class='nav-link text-info btn btn-outline-warning' href='controlador/usuario.controlador.php?accion=exp'>Exportar</a>
                        </li>
                        <li><hr class='dropdown-divider'></li>
                        <li class='nav-item ' title='Importar base de datos' style='color:green'>
                          <a class='nav-link text-primary btn btn-outline-warning' href='#' data-bs-toggle='modal' data-bs-target='#exampleModal'>Importar</a>
                        </li>
                    </ul>
                    </li>";

              }else if(isset($_SESSION["tipo_usuario"]) && $_SESSION["tipo_usuario"] == "admision"){
                echo "
                  <li class='nav-item' title='Registro diario'>
                      <a class='nav-link btn btn-outline-warning' href='controlador/registroDiario.controlador.php?accion=vtd'><img src='imagenes/archivo.ico'style='height: 25px;width: 25px;'></a>
                  </li>";
                echo "<li class='nav-item dropdown' title='Reportes'>
                    <a class='nav-link dropdown-toggle btn btn-outline-warning' href='#' id='navbarDropdown2' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                      <img src='imagenes/reporte.ico'style='height: 25px;width: 25px;'> Reportes
                    </a>
                    <ul class='dropdown-menu' aria-labelledby='navbarDropdown2'>";
                echo "<li class='nav-item' title='Pacientes atendidos por servicio'>
                        <a class='nav-link btn btn-outline-warning' href='controlador/servicio.controlador.php?accion=vTs'><img src='imagenes/servicio.ico'style='height: 25px;width: 25px;'> Pacientes atendidos</a>
                      </li>
                      ";
                echo "<li class='nav-item' title='Pacientes atendidos por servicio por sexo'>
                        <a class='nav-link btn btn-outline-warning' href='controlador/servicio.controlador.php?accion=rtsx'><img src='imagenes/servicio.ico'style='height: 25px;width: 25px;'> Pacientes atendidos por sexo</a>
                      </li>
                      ";

                echo "<li class='nav-item' title='Pacientes atendidos por servicio por edad'>
                        <a class='nav-link btn btn-outline-warning' href='controlador/servicio.controlador.php?accion=rGE'><img src='imagenes/servicio.ico'style='height: 25px;width: 25px;'> Pacientes atendidos por edad</a>
                      </li>
                      ";
              echo "</ul>
              </li>";
              }

            if(isset($_SESSION["tipo_usuario"]) && $_SESSION["tipo_usuario"] == "farmacia"){

            echo "<li class='nav-item dropdown' title='Cliente Proveedor'>
              <a class='nav-link dropdown-toggle btn btn-outline-warning' href='#' id='navbarDropdown2' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                <img src='imagenes/clienteProveedor.png'style='height: 25px;width: 25px;'> Cliente Proveedor
              </a>
              <ul class='dropdown-menu' aria-labelledby='navbarDropdown2'>";

              echo "<li class='nav-item' title='Proveedor'>
                    <a class='nav-link btn btn-outline-warning' href='controlador/farmacia.controlador.php?accion=fpro'>
                    <img src='imagenes/proveedor.png'style='height: 25px;width: 25px;'> Proveedor</a>
                  </li>";
               echo "<li class='nav-item' title='Representante'>
                     <a class='nav-link btn btn-outline-warning' href='controlador/farmacia.controlador.php?accion=Frep'>
                     <img src='imagenes/representante.png'style='height: 25px;width: 25px;'> Representante</a>
                   </li>";
              echo "</ul>";
              echo "<li class='nav-item dropdown' title='Farmacia'>
                <a class='nav-link dropdown-toggle btn btn-outline-warning' href='#' id='navbarDropdown2' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                  <img src='imagenes/farmacia.ico'style='height: 25px;width: 25px;'> Farmacia
                </a>
                <ul class='dropdown-menu' aria-labelledby='navbarDropdown2'>";
              echo "
                <li class='nav-item' title='Productos Farmacéuticos'>
                    <a class='nav-link btn btn-outline-warning' href='controlador/farmacia.controlador.php?accion=ngf'>Productos Farmacéuticos</a>
                </li>";
                echo "
                  <li class='nav-item' title='Concentración Unidad de medida'>
                      <a class='nav-link btn btn-outline-warning' href='controlador/farmacia.controlador.php?accion=vtf'>Concentración</a>
                  </li>";
                  echo "
                    <li class='nav-item' title='Forma de presentación'>
                        <a class='nav-link btn btn-outline-warning' href='controlador/farmacia.controlador.php?accion=vfp'>Presentación</a>
                    </li>";
                  echo "
                    <li class='nav-item' title='Entrada'>
                        <a class='nav-link btn btn-outline-warning' href='controlador/farmacia.controlador.php?accion=vpf'>Entrada</a>
                    </li>";
                  echo "
                    <li class='nav-item' title='Salida'>
                        <a class='nav-link btn btn-outline-warning' href='controlador/farmacia.controlador.php?accion=vsf'>Salida</a>
                    </li>";
                echo "</ul>
                </li>";
            }
             if(isset($_SESSION["tipo_usuario"]) && $_SESSION["tipo_usuario"] != ""){
              echo "<li class='nav-item dropdown' title='Nombre Usuario'>
                <a class='nav-link dropdown-toggle btn btn-outline-success' href='#' id='navbarDropdown2' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                    hola ".$name."
                </a>
                <ul class='dropdown-menu' aria-labelledby='navbarDropdown2'>
                    <li><hr class='dropdown-divider'></li>
                    <li class='nav-item ' title='Cerrar sesión' style='color:green'>
                      <a class='nav-link text-primary btn btn-outline-danger' href='controlador/logeo.controlador.php?accion=salir'><img src='imagenes/apagar.ico'style='height: 25px;width: 25px;'></a>
                    </li>
                </ul>
                </li>";
            }else{
              echo "
                  <li class='nav-item'>
                      <a class='nav-link btn btn-outline-secondary' href='controlador/logeo.controlador.php?accion=is'>Iniciar sesión</a>
                  </li>";
            }
      echo "</ul>
        </div>
    </div>
</nav>
";


?>

<!-- Modal del Chatbot -->

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
                          <img src='imagenes/robot.png'style='height: 25px;width: 25px;'>
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

  <!-- Modal de Bootstrap -->
  <div class="modal fade" id="chatbotModal" tabindex="-1" aria-labelledby="chatbotModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Encabezado del modal -->
      <div class="modal-header">
        <h5 class="modal-title" id="chatbotModalLabel">Chatbot</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Cuerpo del modal con el contenido del chatbot -->
      <div class="modal-body">
        <div id="chatbotContainer" class="chatbot-container">
          <div class="chatbot-body">
            <div class="wrapper">
              <div class="form">
                <div class="bot-inbox inbox">
                  <div class="icon">
                    <img src='../imagenes/robot.png' style='height: 25px; width: 25px; transform: translateY(-5px);'>
                  </div>
                  <div class="msg-header">
                    <p>Hola, Bienvenido</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Pie de página del modal -->
      <div class="modal-footer">
        <input id="data" class="form-control me-2" type="text" onkeydown="checkEnter(event)" placeholder="Escriba su consulta">
        <button id="send-btn" class="btn btn-primary" onclick="enviar()" style="background: Teal;">Enviar</button>
      </div>

    </div>
  </div>
  </div>
<script type="text/javascript">
function checkEnter(event) {
    if (event.key === 'Enter') {
            enviar();
    }
}
function alertInfo(){
  Swal.fire({
   icon: 'info',
   title: '¡Información!',
   text: '¡Ponga algo para realizar su consulta!',
   showConfirmButton: false,
   timer: 1500
 });
}
function enviar(){
    var va=document.getElementById("data").value;
    if(va == ''){
      alertInfo();
      return;
    }
    var msg = '<div class="user-inbox inbox"><div class="msg-header"><p>' + va + '</p></div></div>';
    $(".form").append(msg);
    $("#data").val('');
    var datos=new  FormData();
    datos.append("mensaje",va);
    //alert(va);
    $.ajax({
      cache: false, //important or else you might get wrong data returned to you
      url: 'controlador/todo.controlador.php?accion=msu',
      datatype: "html",
      type: 'POST',
      data: datos,
      contentType:false,
      processData:false,
      success: function(result) {
      //  alert(result);
          var replay = '<div class="bot-inbox inbox"><div class="icon"><img src="imagenes/robot.png"style="height: 25px;width: 25px;"></div><div class="msg-header"><p>' + result + '</p></div></div>';
          $(".form").append(replay);
              // cuando el chat baja, la barra de desplazamiento llega automáticamente al final
              $(".form").scrollTop($(".form")[0].scrollHeight);
          }
      });
  }

  // script.js
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

  function validarArchivo() {
    const filePath = document.getElementById('formFile').value;
    // Obtener la extensión del archivo
    if (filePath.split('.').pop().toLowerCase() != 'sql') {
        return false;
    }
   return true;
}
function error(valor){
  //Solo se permite archivos de tipo .sql
  Swal.fire({
   icon: 'error',
   title: '¡Error!',
   text: valor,
   showConfirmButton: false,
   timer: 2000
 });
}

function correcto(valor){
  //Solo se permite archivos de tipo .sql
  Swal.fire({
   icon: 'success',
   title: '¡Correcto!',
   text: valor,
   showConfirmButton: false,
   timer: 2000
 });
}
function Importar(e){
  e.preventDefault(); // Evitar la recarga de la página
  var fileInput = document.getElementById('formFile');
  var file = fileInput.files[0]; // Obtener el primer archivo seleccionado

  if (!file) {
      error('Por favor, selecciona un archivo.');
      return;
  }
  var re = validarArchivo();
  if(re == false){
    error('Solo se permite archivos de tipo .sql');
    return;
  }
  var formData = new FormData();
  formData.append('file', file);
      $.ajax({
          url: 'controlador/usuario.controlador.php?accion=imp', // Archivo PHP que procesa la subida
          type: 'POST',
          data: formData,
          contentType: false, // No establecer el tipo de contenido
          processData: false, // No procesar los datos
          success: function (response) {
            //alert(response);
            if(response == 'correcto'){
              correcto("Se importo correctamente");
            }else{
              error(response);
            }
            setTimeout(function() {
              $('#exampleModal').modal('hide');
            }, 2000);
              //alert('Archivo subido con éxito: ' + response);
          },
          error: function () {
              error('Error al subir el archivo.');
          }
      });
}

function showNotification() {
  var formData = new FormData();
  formData.append('file', 'hola');
      $.ajax({
          url: 'controlador/todo.controlador.php?accion=validarAdmin', // Archivo PHP que procesa la subida
          type: 'POST',
          data: formData,
          contentType: false, // No establecer el tipo de contenido
          processData: false, // No procesar los datos
          success: function (response) {
            if(response=='error'){
              error("Revise hay un problema con el control de acceso");
            }else if(response=='desactivo'){
              Swal.fire({
                  title: '¡Notificación!',
                  text: 'El Administrador cerro el sistema, o cambio el control de acceso.',
                  icon: 'success', // Puedes usar 'info', 'warning', 'error', o 'question'
                  position: 'bottom-start', // Posiciona la alerta en la parte inferior izquierda
                  toast: true, // Hace que la alerta se vea como un toast
                  timer: 40000, // Duración en milisegundos
                  showConfirmButton: false, // Oculta el botón de confirmación
                  timerProgressBar: true, // Muestra una barra de progreso
              });
              setTimeout(function() {
                actualizarDato();
              }, 4000);
              clearInterval(intervalId);
            }
          }
        });

}

// Usa setInterval para ejecutar la función cada 4000 milisegundos (4 segundos)
intervalId = setInterval(showNotification, 3000);
function actualizarDato(){
  var formData = new FormData();
  formData.append('si', 'no');
  $.ajax({
  url: 'controlador/todo.controlador.php?accion=acno',
  type: 'POST',
  data: formData,
  contentType: false,
  processData: false,
  success: function (response) {
      // No hacer nada con la respuesta
  }
  });
}
</script>
