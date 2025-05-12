<?php
require_once('vista/esquema/header.php');
?>
<!-- Botón para mostrar el offcanvas -->

    <div class="navbar navbar-expand-lg navbar-dark" style="background-color:orange">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
              <button class="btn btn-primary d-flex align-items-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop">
                MENU PANEL
              </button>
            </div>
            <div class="d-flex align-items-center">

              <h1 class="navbar-brand mb-0 h4">Alcaldía Municipal de Challapata</h1>
            </div>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle me-2"></i><span id="username">Administrador</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" id="logout"><i class="fas fa-sign-out-alt me-2"></i>Cerrar sesión</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid content" id="dashboardContent">
        <div class="jumbotron bg-transparent">
            <h1 class="display-4" style="color:white" align='center'>¡Bienvenido al Panel de Control!</h1>
            <p class="lead">Seleccione una opción del menú para comenzar</p>
        </div>
    </div>

  <?php
// Incluir el archivo footer.php desde la carpeta diseno
require_once('vista/esquema/footeruni.php');
?>
