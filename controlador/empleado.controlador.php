<?php
require_once "modelo/empleado.php";
class EmpleadoControlador{
  public static function VistaTablaEmpleado(){
    $us = new Empleado();  // Creando una nueva instancia de la clase Usuario
    $listarDeCuanto = 5;$pagina = 1;
    $resultodoUsuarios = $us->SeleccionarEmpleado("",false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;
    $resul = $us->SeleccionarEmpleado();
    require("vista/empleado/servidor/empleado.php");
  }

  public static function buscandoCargoDeEmpleado($buscar){
    $us = new Empleado();
    $re = $us->buscarcARGOEmpleado($buscar);
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

  public static function RegistrarDatosEmpleadosNuevo($a) {
      $campos = ["id_nivel", "id_cargo", "empleado", "nombre", "apellido_p", "apellido_m", "sexo", "direccion", "telefono", "gmail"];
      foreach ($campos as $campo) {
          if (!isset($a[$campo]) || trim($a[$campo]) === '') {
              echo "campos_vacio";
              return;
          }
      }

      $us = new Empleado();
      $rutaImagen = '';

      // Verificamos si se subió un archivo
      if (isset($_FILES["file"]) && $_FILES["file"]["error"] !== 4) {
          if ($_FILES["file"]["error"] === 0) {
              $nombreArchivo = basename($_FILES["file"]["name"]);
              $directorioDestino = "vista/activos/FotoUsuario/";
              $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
              $nombreUnico = bin2hex(random_bytes(16)) . '.' . $extension;
              $rutaDestino = $directorioDestino . $nombreUnico;

              $ext = strtolower(pathinfo($rutaDestino, PATHINFO_EXTENSION));
              switch ($ext) {
                  case 'jpg':
                  case 'jpeg':
                      $imagen = imagecreatefromjpeg($_FILES["file"]["tmp_name"]);
                      break;
                  case 'png':
                      $imagen = imagecreatefrompng($_FILES["file"]["tmp_name"]);
                      break;
                  case 'gif':
                      $imagen = imagecreatefromgif($_FILES["file"]["tmp_name"]);
                      break;
                  default:
                      echo "Tipo de archivo no permitido.";
                      return;
              }

              list($anchoOriginal, $altoOriginal) = getimagesize($_FILES["file"]["tmp_name"]);
              $anchoNuevo = 800;
              $altoNuevo = 600;

              $imagenRedimensionada = imagecreatetruecolor($anchoNuevo, $altoNuevo);
              imagecopyresampled($imagenRedimensionada, $imagen, 0, 0, 0, 0, $anchoNuevo, $altoNuevo, $anchoOriginal, $altoOriginal);

              switch ($ext) {
                  case 'jpg':
                  case 'jpeg':
                      imagejpeg($imagenRedimensionada, $rutaDestino, 75);
                      break;
                  case 'png':
                      imagepng($imagenRedimensionada, $rutaDestino, 6);
                      break;
                  case 'gif':
                      imagegif($imagenRedimensionada, $rutaDestino);
                      break;
              }

              imagedestroy($imagen);
              imagedestroy($imagenRedimensionada);

              $rutaImagen = $rutaDestino;
          } else {
              echo "Error al subir el archivo.";
              return;
          }
      }

      $re = $us->RegistrarNuevosDatosEmpleado($a, $rutaImagen);
      echo $re ? "correcto" : "error";
  }

  public static function  BuscarEmpleadoTodo($pagina, $listarDeCuanto, $buscar){
    $us = new Empleado();  // Creando una nueva instancia de la clase Usuario
    $resultodoUsuarios = $us->SeleccionarEmpleado($buscar,false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;

    $resul = $us->SeleccionarEmpleado($buscar,$inicioList,$listarDeCuanto);
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
            <th>Tipo Empleado</th>
            <th>Sexo</th>
            <th>Dirección</th>
            <th>Telefono</th>
            <th>Gmail</th>
            <th>Foto</th>
            <th>Nivel</th>
            <th>Cargo</th>
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
                        echo "<td>".$fi['tipo_empleado']."</td>";
                        echo "<td>".$fi['sexo']."</td>";
                        echo "<td>".$fi['direccion']."</td>";
                        echo "<td>".$fi['telefono']."</td>";
                        echo "<td>".$fi['correo_electronico']."</td>";
                        if($fi['foto'] == "default.jpg" || $fi['foto'] == ""){
                          echo "<td class='d-flex justify-content-center align-items-center' style='width: 100px; height: 100px;'>
                            <img src='imagenes/user.png' alt='foto' class='img-fluid rounded-circle' style='object-fit: cover; width: 100%; height: 100%;'>
                          </td>";
                        }else{
                          echo "<td class='d-flex justify-content-center align-items-center' style='width: 100px; height: 100px;'>
                            <img src='".$fi['foto']."' alt='foto' class='img-fluid rounded-circle' style='object-fit: cover; width: 100%; height: 100%;'>
                          </td>";
                        }
                        echo "<td>".$fi['nivel_empleado']."</td>";
                        echo "<td>".$fi['cargo_empleado']."</td>";
                        echo "<td>".$fi['creado_en']."</td>";

                        echo "<td>".$fi['actualizado_en']."</td>";
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
                          \"".$fi["nivel_id"]."\",
                          \"".$fi["cargo_id"]."\",
                          \"".$fi["tipo_empleado"]."\",
                          \"".$fi["nombre"]."\",
                          \"".$fi["apellido_p"]."\",
                          \"".$fi["apellido_m"]."\",
                          \"".$fi["sexo"]."\",
                          \"".$fi["direccion"]."\",
                          \"".$fi["telefono"]."\",
                          \"".$fi["correo_electronico"]."\"
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
}



?>
