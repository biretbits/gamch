<?php
require_once "modelo/usuario.php";
class UsuarioControlador{
  public static function visualizarRol(){
    $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
    $listarDeCuanto = 5;$pagina = 1;
    $resultodoUsuarios = $us->SelectPorBusqueda("",false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;

    $resul = $us->SelectPorBusqueda('',$inicioList,$listarDeCuanto);

    require("vista/usuario/rol.php");
  }

  public static function RegistrarRol($a){
    $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
    $resul = $us->registrarRole($a);
    if ($resul) {
              echo "correcto";
          } else {
              echo "error";
          }
  }

  public static function BuscarUsuarioTabla($pagina,$listarDeCuanto,$buscar){
    $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
    $resultodoUsuarios = $us->SelectPorBusqueda($buscar,false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;

    $resul = $us->SelectPorBusqueda($buscar,$inicioList,$listarDeCuanto);
    echo "
    <div class='row'>
      <div class='col'>
        <div class='table-responsive'>
        <table class='table' style='font-size:12px'>
          <thead>
          <tr>
              <th>N°</th>
              <th>Nombre</th>
              <th>Slug</th>
              <th>Descripcion</th>
              <th>Fecha creado</th>
              <th>Fecha actualizado</th>
              <th>Especial</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>";
                if ($resul && mysqli_num_rows($resul) > 0) {
                  $i = $inicioList;
                   while($fi = mysqli_fetch_array($resul)){
                      echo "<tr>";
                        echo "<td>".($i+1)."</td>";
                        echo "<td>".$fi['nombre']."</td>";
                        echo "<td>".$fi['slug']."</td>";
                        echo "<td>".$fi['descripcion']."</td>";
                        echo "<td>".$fi['creado_en']."</td>";
                        echo "<td>".$fi['actualizado_en']."</td>";

                        echo "<td>".$fi['especial']."</td>";
                        echo "<td>";
                        $id_u = '';
                          echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>
                          <button type='button'
                       class='btn btn-info btn-sm shadow-sm'
                       title='Editar'
                       data-bs-toggle='modal'
                       data-bs-target='#ModalRegistro'
                       onclick='accionBtnEditar(

                             \"".$fi["id"]."\",
                           \"".$fi["nombre"]."\",
                           \"".$fi["slug"]."\",
                           \"".$fi["descripcion"]."\",
                           \"".$fi["especial"]."\")'>
                   <i class='fas fa-edit'></i></button>";

                          echo "</div>";
                        echo "</td>";
                      echo "</tr>";
                      $i++;
                    }
                  }else{
                    echo "<tr>";
                    echo "<td colspan='15' align='center'>No se encontraron resultados</td>";
                    echo "</tr>";
                  }

        echo "
        </tbody>
      </table>
      </div>
    </div>
  </div>";
  if($TotalPaginas!=0){
    $adjacents=1;
    $anterior = "&lsaquo; Anterior";
    $siguiente = "Siguiente &rsaquo;";
echo "<div class='row'>
      <div class='col'>";

    echo "<div class='d-flex flex-wrap flex-sm-row justify-content-between'>";
      echo '<ul class="pagination">';
        echo "pagina &nbsp;".$pagina."&nbsp;con&nbsp;";
          $total=$inicioList+$pagina;
          if($TotalPaginas > $num_filas_total){
            $TotalPaginas = $num_filas_total;
          }
        echo '<li class="page-item active"><a class=" href="#"> '.($TotalPaginas).' </a></li> ';
        echo " &nbsp;de&nbsp;".$num_filas_total." registros";
      echo '</ul>';

      echo '<ul class="pagination d-flex flex-wrap">';

      // previous label
      if ($pagina != 1) {
        echo "<li class='page-item'><a class='page-link'  onclick=\"BuscarUsuarios(1)\"><span aria-hidden='true'>&laquo;</span></a></li>";
      }
      if($pagina==1) {
        echo "<li class='page-item'><a class='page-link text-muted'>$anterior</a></li>";
      } else if($pagina==2) {
        echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"BuscarUsuarios(1)\" class='page-link'>$anterior</a></li>";
      }else {
        echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"BuscarUsuarios($pagina-1)\">$anterior</a></li>";

      }
      // first label
      if($pagina>($adjacents+1)) {
        echo "<li class='page-item'><a href='javascript:void(0);' class='page-link' onclick=\"BuscarUsuarios(1)\">1</a></li>";
      }
      // interval
      if($pagina>($adjacents+2)) {
        echo"<li class='page-item'><a class='page-link'>...</a></li>";
      }

      // pages

      $pmin = ($pagina>$adjacents) ? ($pagina-$adjacents) : 1;
      $pmax = ($pagina<($TotalPaginas-$adjacents)) ? ($pagina+$adjacents) : $TotalPaginas;
      for($i=$pmin; $i<=$pmax; $i++) {
        if($i==$pagina) {
          echo "<li class='page-item active'><a class='page-link'>$i</a></li>";
        }else if($i==1) {
          echo"<li class='page-item'><a href='javascript:void(0);' class='page-link'onclick=\"BuscarUsuarios(1)\">$i</a></li>";
        }else {
          echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"BuscarUsuarios(".$i.")\" class='page-link'>$i</a></li>";
        }
      }

      // interval

      if($pagina<($TotalPaginas-$adjacents-1)) {
        echo "<li class='page-item'><a class='page-link'>...</a></li>";
      }
      // last

      if($pagina<($TotalPaginas-$adjacents)) {
        echo "<li class='page-item'><a href='javascript:void(0);'class='page-link ' onclick=\"BuscarUsuarios($TotalPaginas)\">$TotalPaginas</a></li>";
      }
      // next

      if($pagina<$TotalPaginas) {
        echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"BuscarUsuarios($pagina+1)\">$siguiente</a></li>";
      }else {
        echo "<li class='page-item'><a class='page-link text-muted'>$siguiente</a></li>";
      }
      if ($pagina != $TotalPaginas) {
        echo "<li class='page-item'><a class='page-link' onclick=\"BuscarUsuarios($TotalPaginas)\"><span aria-hidden='true'>&raquo;</span></a></li>";
      }

      echo "</ul>";
      echo "</div>";

echo "</div>
    </div>";


    }
  }

  public static function visualizarRolUsuario(){
    $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
    $listarDeCuanto = 5;$pagina = 1;
    $resultodoUsuarios = $us->SelectPorBusquedaU("",false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;

    $resul = $us->SelectPorBusquedaU('',$inicioList,$listarDeCuanto);

    require("vista/usuario/rol_usuario.php");
  }

  public static function CrearTablaUsuarioGamch(){
    require("vista/esquema/bd/crear/tablas.php");
  }

  public static function panelUsuario(){
    require("vista/panelControl/panelUsuario.php");
  }
  public static function panelPermisos(){
    $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
    $listarDeCuanto = 5;$pagina = 1;
    $resultodoUsuarios = $us->SelectPorBusquedaPer("",false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;

    $resul = $us->SelectPorBusquedaPer('',$inicioList,$listarDeCuanto);
    require("vista/permisos/permisos.php");
  }

  public static function RegistrarPermiso($a){
    $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
    $resul = $us->registrarPermisos($a);
    if ($resul) {
              echo "correcto";
          } else {
              echo "error";
          }
  }

  public static function BuscarPermisos($pagina,$listarDeCuanto,$buscar){
    $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
    $resultodoUsuarios = $us->SelectPorBusquedaPer($buscar,false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;

    $resul = $us->SelectPorBusquedaPer($buscar,$inicioList,$listarDeCuanto);
    echo "
    <div class='row'>
      <div class='col'>
        <div class='table-responsive'>
        <table class='table' style='font-size:12px'>
          <thead>
          <tr>
            <th>N°</th>
            <th>Nombre</th>
            <th>Slug</th>
            <th>Descripción</th>
            <th>Fecha de Creación</th>
            <th>Acción</th>
            </tr>
          </thead>
          <tbody>";
          if ($resul && mysqli_num_rows($resul) > 0) {
            $i = $inicioList;
             while($fi = mysqli_fetch_array($resul)){
                echo "<tr>";
                  echo "<td>".($i+1)."</td>";
                  echo "<td>".$fi['nombre']."</td>";
                  echo "<td>".$fi['slug']."</td>";
                  echo "<td>".$fi['descripcion']."</td>";
                  echo "<td>".$fi['creado_en']."</td>";
                  echo "<td>";
                  $id_u = '';
                    echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>
                    <button type='button'
                 class='btn btn-info btn-sm shadow-sm'
                 title='Editar'
                 data-bs-toggle='modal'
                 data-bs-target='#ModalRegistro'
                 onclick='accionBtnEditar(
                 \"".$fi["id"]."\",
                 \"".$fi["nombre"]."\",
                 \"".$fi["slug"]."\",
                 \"".$fi["descripcion"]."\"
                 )'>

             <i class='fas fa-edit'></i></button>";

                    echo "</div>";
                  echo "</td>";
                echo "</tr>";
                $i++;
              }
            }else{
              echo "<tr>";
              echo "<td colspan='15' align='center'>No se encontraron resultados</td>";
              echo "</tr>";
            }

        echo "
        </tbody>
      </table>
      </div>
    </div>
  </div>";
  if($TotalPaginas!=0){
    $adjacents=1;
    $anterior = "&lsaquo; Anterior";
    $siguiente = "Siguiente &rsaquo;";
echo "<div class='row'>
      <div class='col'>";

    echo "<div class='d-flex flex-wrap flex-sm-row justify-content-between'>";
      echo '<ul class="pagination">';
        echo "pagina &nbsp;".$pagina."&nbsp;con&nbsp;";
          $total=$inicioList+$pagina;
          if($TotalPaginas > $num_filas_total){
            $TotalPaginas = $num_filas_total;
          }
        echo '<li class="page-item active"><a class=" href="#"> '.($TotalPaginas).' </a></li> ';
        echo " &nbsp;de&nbsp;".$num_filas_total." registros";
      echo '</ul>';

      echo '<ul class="pagination d-flex flex-wrap">';

      // previous label
      if ($pagina != 1) {
        echo "<li class='page-item'><a class='page-link'  onclick=\"BuscarUsuarios(1)\"><span aria-hidden='true'>&laquo;</span></a></li>";
      }
      if($pagina==1) {
        echo "<li class='page-item'><a class='page-link text-muted'>$anterior</a></li>";
      } else if($pagina==2) {
        echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"BuscarUsuarios(1)\" class='page-link'>$anterior</a></li>";
      }else {
        echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"BuscarUsuarios($pagina-1)\">$anterior</a></li>";

      }
      // first label
      if($pagina>($adjacents+1)) {
        echo "<li class='page-item'><a href='javascript:void(0);' class='page-link' onclick=\"BuscarUsuarios(1)\">1</a></li>";
      }
      // interval
      if($pagina>($adjacents+2)) {
        echo"<li class='page-item'><a class='page-link'>...</a></li>";
      }

      // pages

      $pmin = ($pagina>$adjacents) ? ($pagina-$adjacents) : 1;
      $pmax = ($pagina<($TotalPaginas-$adjacents)) ? ($pagina+$adjacents) : $TotalPaginas;
      for($i=$pmin; $i<=$pmax; $i++) {
        if($i==$pagina) {
          echo "<li class='page-item active'><a class='page-link'>$i</a></li>";
        }else if($i==1) {
          echo"<li class='page-item'><a href='javascript:void(0);' class='page-link'onclick=\"BuscarUsuarios(1)\">$i</a></li>";
        }else {
          echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"BuscarUsuarios(".$i.")\" class='page-link'>$i</a></li>";
        }
      }

      // interval

      if($pagina<($TotalPaginas-$adjacents-1)) {
        echo "<li class='page-item'><a class='page-link'>...</a></li>";
      }
      // last

      if($pagina<($TotalPaginas-$adjacents)) {
        echo "<li class='page-item'><a href='javascript:void(0);'class='page-link ' onclick=\"BuscarUsuarios($TotalPaginas)\">$TotalPaginas</a></li>";
      }
      // next

      if($pagina<$TotalPaginas) {
        echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"BuscarUsuarios($pagina+1)\">$siguiente</a></li>";
      }else {
        echo "<li class='page-item'><a class='page-link text-muted'>$siguiente</a></li>";
      }
      if ($pagina != $TotalPaginas) {
        echo "<li class='page-item'><a class='page-link' onclick=\"BuscarUsuarios($TotalPaginas)\"><span aria-hidden='true'>&raquo;</span></a></li>";
      }

      echo "</ul>";
      echo "</div>";

echo "</div>
    </div>";


    }
  }

  public static function panelPermisosUsuario(){
    $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
    $listarDeCuanto = 5;$pagina = 1;
    $resultodoUsuarios = $us->SelectPorBusquedaPerUser("",false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;

    $resul = $us->SelectPorBusquedaPerUser('',$inicioList,$listarDeCuanto);
    require("vista/permisos/permisosUsuario.php");
  }

  public static function BuscarInformacionUsuario($buscar){
      $us = new Usuario();
    $re = $us->buscarInformacion($buscar);
    $datos = array();
    if ($re->num_rows > 0) {
   // Recoger los resultados en un array
     while($row = $re->fetch_assoc()) {
      $datos[] = $row;
    }
        echo json_encode($datos);
    } else {
        echo json_encode([]);
    }
  }


    public static function buscandoPermisos($buscar){
        $us = new Usuario();
      $re = $us->buscarInformacionPermisos($buscar);
      $datos = array();
      if ($re->num_rows > 0) {
     // Recoger los resultados en un array
       while($row = $re->fetch_assoc()) {
        $datos[] = $row;
      }
          echo json_encode($datos);
      } else {
          echo json_encode([]);
      }
    }

    public static function RegistrarPermisosUsuario($a){
      $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
      $resul = $us->registrarPermisosUsuarios($a);
      if ($resul) {
                echo "correcto";
            } else {
                echo "error";
            }
    }

    public static function BuscarPermisoUsuario($pagina,$listarDeCuanto,$buscar){
      $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
      $resultodoUsuarios = $us->SelectPorBusquedaPerUser($buscar,false,false);
      $num_filas_total = mysqli_num_rows($resultodoUsuarios);
      $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
              //calculamos el registro inicial
      $inicioList = ($pagina - 1) * $listarDeCuanto;

      $resul = $us->SelectPorBusquedaPerUser($buscar,$inicioList,$listarDeCuanto);
      echo "
      <div class='row'>
        <div class='col'>
          <div class='table-responsive'>
          <table class='table' style='font-size:12px'>
            <thead>
              <tr>
              <th>N°</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Slug</th>
              <th>Descripción</th>
              <th>Fecha de Creación</th>
              <th>Acción</th>
              </tr>
            </thead>
            <tbody>";
            if ($resul && mysqli_num_rows($resul) > 0) {
              $i = $inicioList;
               while($fi = mysqli_fetch_array($resul)){
                  echo "<tr>";
                    echo "<td>".($i+1)."</td>";
                    echo "<td>".$fi['usuario_nombre']." ".$fi['apellido_p']." ".$fi['apellido_m']."</td>";
                    echo "<td>".$fi['usuario']."</td>";
                    echo "<td>".$fi['slug']."</td>";
                    echo "<td>".$fi['descripcion']."</td>";
                    echo "<td>".$fi['creado_en']."</td>";
                    echo "<td>";
                    $id_u = '';
                      echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>
                      <button type='button'
                   class='btn btn-info btn-sm shadow-sm'
                   title='Editar'
                   data-bs-toggle='modal'
                   data-bs-target='#ModalRegistro'
                   onclick='accionBtnEditar(
                   \"".$fi["id"]."\",
                   \"".$fi["permiso_id"]."\",
                   \"".$fi["usuario_id"]."\",
                   )'>

               <i class='fas fa-edit'></i></button>";

                      echo "</div>";
                    echo "</td>";
                  echo "</tr>";
                  $i++;
                }
              }else{
                echo "<tr>";
                echo "<td colspan='15' align='center'>No se encontraron resultados</td>";
                echo "</tr>";
              }
            echo "
          </tbody>
        </table>
        </div>
      </div>
    </div>";
    if($TotalPaginas!=0){
      $adjacents=1;
      $anterior = "&lsaquo; Anterior";
      $siguiente = "Siguiente &rsaquo;";
  echo "<div class='row'>
        <div class='col'>";

      echo "<div class='d-flex flex-wrap flex-sm-row justify-content-between'>";
        echo '<ul class="pagination">';
          echo "pagina &nbsp;".$pagina."&nbsp;con&nbsp;";
            $total=$inicioList+$pagina;
            if($TotalPaginas > $num_filas_total){
              $TotalPaginas = $num_filas_total;
            }
          echo '<li class="page-item active"><a class=" href="#"> '.($TotalPaginas).' </a></li> ';
          echo " &nbsp;de&nbsp;".$num_filas_total." registros";
        echo '</ul>';

        echo '<ul class="pagination d-flex flex-wrap">';

        // previous label
        if ($pagina != 1) {
          echo "<li class='page-item'><a class='page-link'  onclick=\"BuscarUsuarios(1)\"><span aria-hidden='true'>&laquo;</span></a></li>";
        }
        if($pagina==1) {
          echo "<li class='page-item'><a class='page-link text-muted'>$anterior</a></li>";
        } else if($pagina==2) {
          echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"BuscarUsuarios(1)\" class='page-link'>$anterior</a></li>";
        }else {
          echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"BuscarUsuarios($pagina-1)\">$anterior</a></li>";

        }
        // first label
        if($pagina>($adjacents+1)) {
          echo "<li class='page-item'><a href='javascript:void(0);' class='page-link' onclick=\"BuscarUsuarios(1)\">1</a></li>";
        }
        // interval
        if($pagina>($adjacents+2)) {
          echo"<li class='page-item'><a class='page-link'>...</a></li>";
        }

        // pages

        $pmin = ($pagina>$adjacents) ? ($pagina-$adjacents) : 1;
        $pmax = ($pagina<($TotalPaginas-$adjacents)) ? ($pagina+$adjacents) : $TotalPaginas;
        for($i=$pmin; $i<=$pmax; $i++) {
          if($i==$pagina) {
            echo "<li class='page-item active'><a class='page-link'>$i</a></li>";
          }else if($i==1) {
            echo"<li class='page-item'><a href='javascript:void(0);' class='page-link'onclick=\"BuscarUsuarios(1)\">$i</a></li>";
          }else {
            echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"BuscarUsuarios(".$i.")\" class='page-link'>$i</a></li>";
          }
        }

        // interval

        if($pagina<($TotalPaginas-$adjacents-1)) {
          echo "<li class='page-item'><a class='page-link'>...</a></li>";
        }
        // last

        if($pagina<($TotalPaginas-$adjacents)) {
          echo "<li class='page-item'><a href='javascript:void(0);'class='page-link ' onclick=\"BuscarUsuarios($TotalPaginas)\">$TotalPaginas</a></li>";
        }
        // next

        if($pagina<$TotalPaginas) {
          echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"BuscarUsuarios($pagina+1)\">$siguiente</a></li>";
        }else {
          echo "<li class='page-item'><a class='page-link text-muted'>$siguiente</a></li>";
        }
        if ($pagina != $TotalPaginas) {
          echo "<li class='page-item'><a class='page-link' onclick=\"BuscarUsuarios($TotalPaginas)\"><span aria-hidden='true'>&raquo;</span></a></li>";
        }

        echo "</ul>";
        echo "</div>";

  echo "</div>
      </div>";


      }
    }

    public static function listraUsuarios(){
      $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
      $listarDeCuanto = 5;$pagina = 1;
      $resultodoUsuarios = $us->SelectPorBusquedaListarUsuario("",false,false);
      $num_filas_total = mysqli_num_rows($resultodoUsuarios);
      $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
              //calculamos el registro inicial
      $inicioList = ($pagina - 1) * $listarDeCuanto;

      $resul = $us->SelectPorBusquedaListarUsuario('',$inicioList,$listarDeCuanto);
      require("vista/usuario/gestion_usuario.php");
    }

    public static function buscandoEmpleadoAhora($buscar){
      $us = new Usuario();
      $re = $us->buscarEmpleadoNuevo($buscar);
      $datos = array();
      if ($re->num_rows > 0) {
     // Recoger los resultados en un array
       while($row = $re->fetch_assoc()) {
        $datos[] = $row;
      }
          echo json_encode($datos);
      } else {
          echo json_encode([]);
      }
    }

    public static function RegistrarNuevoUsuario($a){
      $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
      $resul = $us->registrarUsuario($a);
      if ($resul) {
          echo "correcto";
      } else {
          echo "error";
      }
    }


        public static function BuscarUsuarioUno($pagina,$listarDeCuanto,$buscar){
          $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
          $resultodoUsuarios = $us->SelectPorBusquedaListarUsuario($buscar,false,false);
          $num_filas_total = mysqli_num_rows($resultodoUsuarios);
          $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
                  //calculamos el registro inicial
          $inicioList = ($pagina - 1) * $listarDeCuanto;

          $resul = $us->SelectPorBusquedaListarUsuario($buscar,$inicioList,$listarDeCuanto);
          echo "
          <div class='row'>
            <div class='col'>
              <div class='table-responsive'>
              <table class='table' style='font-size:12px'>
                <thead>
                  <tr>
                  <th>N°</th>
                  <th>Nombre</th>
                  <th>Apellido P.</th>
                  <th>Apellido M.</th>
                  <th>Usuario</th>
                  <th>estado</th>
                  <th>Fecha Reg.</th>
                  <th>Ultima Actualización</th>
                  <th>Acción</th>
                  </tr>
                </thead>
                <tbody>";
                      if ($resul && mysqli_num_rows($resul) > 0) {
                        $i = $inicioList;
                         while($fi = mysqli_fetch_array($resul)){
                            echo "<tr>";
                              echo "<td>".($i+1)."</td>";
                              echo "<td>".$fi['nombre']."</td>";
                              echo "<td>".$fi['apellido_p']."</td>";
                              echo "<td>".$fi['apellido_m']."</td>";
                              echo "<td>".$fi['usuario']."</td>";
                              echo "<td>".$fi['usuario_estado']."</td>";
                              echo "<td>".$fi['usuario_creado']."</td>";
                              echo "<td>".$fi['usuario_actualizado']."</td>";
                              echo "<td>";
                              $id_u = '';
                                echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>
                                <button type='button'
                             class='btn btn-info btn-sm shadow-sm'
                             title='Editar'
                             data-bs-toggle='modal'
                             data-bs-target='#ModalRegistro'
                             onclick='accionBtnEditar(
                                   \"".$fi["usuario_id"]."\",
                                 \"".$fi["usuario"]."\",
                                 \"".$fi["empleado_id"]."\"
                                 )'>
                         <i class='fas fa-edit'></i></button>";

                                echo "</div>";
                              echo "</td>";
                            echo "</tr>";
                            $i++;
                          }
                        }else{
                          echo "<tr>";
                          echo "<td colspan='15' align='center'>No se encontraron resultados</td>";
                          echo "</tr>";
                        }

                echo "
              </tbody>
            </table>
            </div>
          </div>
        </div>";
        if($TotalPaginas!=0){
          $adjacents=1;
          $anterior = "&lsaquo; Anterior";
          $siguiente = "Siguiente &rsaquo;";
      echo "<div class='row'>
            <div class='col'>";

          echo "<div class='d-flex flex-wrap flex-sm-row justify-content-between'>";
            echo '<ul class="pagination">';
              echo "pagina &nbsp;".$pagina."&nbsp;con&nbsp;";
                $total=$inicioList+$pagina;
                if($TotalPaginas > $num_filas_total){
                  $TotalPaginas = $num_filas_total;
                }
              echo '<li class="page-item active"><a class=" href="#"> '.($TotalPaginas).' </a></li> ';
              echo " &nbsp;de&nbsp;".$num_filas_total." registros";
            echo '</ul>';

            echo '<ul class="pagination d-flex flex-wrap">';

            // previous label
            if ($pagina != 1) {
              echo "<li class='page-item'><a class='page-link'  onclick=\"BuscarUsuarios(1)\"><span aria-hidden='true'>&laquo;</span></a></li>";
            }
            if($pagina==1) {
              echo "<li class='page-item'><a class='page-link text-muted'>$anterior</a></li>";
            } else if($pagina==2) {
              echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"BuscarUsuarios(1)\" class='page-link'>$anterior</a></li>";
            }else {
              echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"BuscarUsuarios($pagina-1)\">$anterior</a></li>";

            }
            // first label
            if($pagina>($adjacents+1)) {
              echo "<li class='page-item'><a href='javascript:void(0);' class='page-link' onclick=\"BuscarUsuarios(1)\">1</a></li>";
            }
            // interval
            if($pagina>($adjacents+2)) {
              echo"<li class='page-item'><a class='page-link'>...</a></li>";
            }

            // pages

            $pmin = ($pagina>$adjacents) ? ($pagina-$adjacents) : 1;
            $pmax = ($pagina<($TotalPaginas-$adjacents)) ? ($pagina+$adjacents) : $TotalPaginas;
            for($i=$pmin; $i<=$pmax; $i++) {
              if($i==$pagina) {
                echo "<li class='page-item active'><a class='page-link'>$i</a></li>";
              }else if($i==1) {
                echo"<li class='page-item'><a href='javascript:void(0);' class='page-link'onclick=\"BuscarUsuarios(1)\">$i</a></li>";
              }else {
                echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"BuscarUsuarios(".$i.")\" class='page-link'>$i</a></li>";
              }
            }

            // interval

            if($pagina<($TotalPaginas-$adjacents-1)) {
              echo "<li class='page-item'><a class='page-link'>...</a></li>";
            }
            // last

            if($pagina<($TotalPaginas-$adjacents)) {
              echo "<li class='page-item'><a href='javascript:void(0);'class='page-link ' onclick=\"BuscarUsuarios($TotalPaginas)\">$TotalPaginas</a></li>";
            }
            // next

            if($pagina<$TotalPaginas) {
              echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"BuscarUsuarios($pagina+1)\">$siguiente</a></li>";
            }else {
              echo "<li class='page-item'><a class='page-link text-muted'>$siguiente</a></li>";
            }
            if ($pagina != $TotalPaginas) {
              echo "<li class='page-item'><a class='page-link' onclick=\"BuscarUsuarios($TotalPaginas)\"><span aria-hidden='true'>&raquo;</span></a></li>";
            }

            echo "</ul>";
            echo "</div>";

      echo "</div>
          </div>";


          }
        }

        public static function buscandoRolUsuarios($buscar){
            $us = new Usuario();
          $re = $us->buscarInformacionRolUsuario($buscar);
          $datos = array();
          if ($re->num_rows > 0) {
         // Recoger los resultados en un array
           while($row = $re->fetch_assoc()) {
            $datos[] = $row;
          }
              echo json_encode($datos);
          } else {
              echo json_encode([]);
          }
        }

    public static function RegistrarRolUsuario($a){
      $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
      $resul = $us->registrarRolesUsuarios($a);
      if ($resul) {
                echo "correcto";
            } else {
                echo "error";
            }
    }

    public static function BuscarRolesUsuarios($pagina,$listarDeCuanto,$buscar){
      $us = new Usuario();  // Creando una nueva instancia de la clase Usuario
      $resultodoUsuarios = $us->SelectPorBusquedaU($buscar,false,false);
      $num_filas_total = mysqli_num_rows($resultodoUsuarios);
      $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
              //calculamos el registro inicial
      $inicioList = ($pagina - 1) * $listarDeCuanto;

      $resul = $us->SelectPorBusquedaU($buscar,$inicioList,$listarDeCuanto);
      echo "
      <div class='row'>
        <div class='col'>
          <div class='table-responsive'>
          <table class='table' style='font-size:12px'>
            <thead>
            <tr>
            <th>N°</th>
            <th>Nombre</th>
            <th>Apellido P.</th>
            <th>Apellido M.</th>
            <th>Usuario</th>
            <th>Rol usuario</th>
            <th>descripción</th>
            <th>Especial</th>
            <th>Fecha Reg.</th>
            <th>Ultima Actualización</th>
            <th>Acción</th>
              </tr>
            </thead>
            <tbody>";
            if ($resul && mysqli_num_rows($resul) > 0) {
              $i = $inicioList;
               while($fi = mysqli_fetch_array($resul)){
                  echo "<tr>";
                    echo "<td>".($i+1)."</td>";
                    echo "<td>".$fi['nombre']."</td>";
                    echo "<td>".$fi['apellido_p']."</td>";
                    echo "<td>".$fi['apellido_m']."</td>";
                    echo "<td>".$fi['usuario']."</td>";
                    echo "<td>".$fi['rol_nombre']."</td>";
                    echo "<td>".$fi['rol_descripcion']."</td>";
                    echo "<td>".$fi['especial']."</td>";
                    echo "<td>".$fi['rol_asignado_en']."</td>";
                    echo "<td>".$fi['rol_actualizado_en']."</td>";
                    echo "<td>";
                    $id_u = '';
                      echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>
                      <button type='button'
                   class='btn btn-info btn-sm shadow-sm'
                   title='Editar'
                   data-bs-toggle='modal'
                   data-bs-target='#ModalRegistro'
                   onclick='accionBtnEditar(

                         \"".$fi["id"]."\",
                       \"".$fi["rol_id"]."\",
                       \"".$fi["usuario_id"]."\",
                       \"".$fi["rol_descripcion"]."\")'>
               <i class='fas fa-edit'></i></button>";

                      echo "</div>";
                    echo "</td>";
                  echo "</tr>";
                  $i++;
                }
              }else{
                echo "<tr>";
                echo "<td colspan='15' align='center'>No se encontraron resultados</td>";
                echo "</tr>";
              }


          echo "
          </tbody>
        </table>
        </div>
      </div>
    </div>";
    if($TotalPaginas!=0){
      $adjacents=1;
      $anterior = "&lsaquo; Anterior";
      $siguiente = "Siguiente &rsaquo;";
  echo "<div class='row'>
        <div class='col'>";

      echo "<div class='d-flex flex-wrap flex-sm-row justify-content-between'>";
        echo '<ul class="pagination">';
          echo "pagina &nbsp;".$pagina."&nbsp;con&nbsp;";
            $total=$inicioList+$pagina;
            if($TotalPaginas > $num_filas_total){
              $TotalPaginas = $num_filas_total;
            }
          echo '<li class="page-item active"><a class=" href="#"> '.($TotalPaginas).' </a></li> ';
          echo " &nbsp;de&nbsp;".$num_filas_total." registros";
        echo '</ul>';

        echo '<ul class="pagination d-flex flex-wrap">';

        // previous label
        if ($pagina != 1) {
          echo "<li class='page-item'><a class='page-link'  onclick=\"BuscarUsuarios(1)\"><span aria-hidden='true'>&laquo;</span></a></li>";
        }
        if($pagina==1) {
          echo "<li class='page-item'><a class='page-link text-muted'>$anterior</a></li>";
        } else if($pagina==2) {
          echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"BuscarUsuarios(1)\" class='page-link'>$anterior</a></li>";
        }else {
          echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"BuscarUsuarios($pagina-1)\">$anterior</a></li>";

        }
        // first label
        if($pagina>($adjacents+1)) {
          echo "<li class='page-item'><a href='javascript:void(0);' class='page-link' onclick=\"BuscarUsuarios(1)\">1</a></li>";
        }
        // interval
        if($pagina>($adjacents+2)) {
          echo"<li class='page-item'><a class='page-link'>...</a></li>";
        }

        // pages

        $pmin = ($pagina>$adjacents) ? ($pagina-$adjacents) : 1;
        $pmax = ($pagina<($TotalPaginas-$adjacents)) ? ($pagina+$adjacents) : $TotalPaginas;
        for($i=$pmin; $i<=$pmax; $i++) {
          if($i==$pagina) {
            echo "<li class='page-item active'><a class='page-link'>$i</a></li>";
          }else if($i==1) {
            echo"<li class='page-item'><a href='javascript:void(0);' class='page-link'onclick=\"BuscarUsuarios(1)\">$i</a></li>";
          }else {
            echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"BuscarUsuarios(".$i.")\" class='page-link'>$i</a></li>";
          }
        }

        // interval

        if($pagina<($TotalPaginas-$adjacents-1)) {
          echo "<li class='page-item'><a class='page-link'>...</a></li>";
        }
        // last

        if($pagina<($TotalPaginas-$adjacents)) {
          echo "<li class='page-item'><a href='javascript:void(0);'class='page-link ' onclick=\"BuscarUsuarios($TotalPaginas)\">$TotalPaginas</a></li>";
        }
        // next

        if($pagina<$TotalPaginas) {
          echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"BuscarUsuarios($pagina+1)\">$siguiente</a></li>";
        }else {
          echo "<li class='page-item'><a class='page-link text-muted'>$siguiente</a></li>";
        }
        if ($pagina != $TotalPaginas) {
          echo "<li class='page-item'><a class='page-link' onclick=\"BuscarUsuarios($TotalPaginas)\"><span aria-hidden='true'>&raquo;</span></a></li>";
        }

        echo "</ul>";
        echo "</div>";

  echo "</div>
      </div>";


      }
    }
}


?>
