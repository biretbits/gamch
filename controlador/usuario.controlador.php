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

}


?>
