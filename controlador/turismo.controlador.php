
<?php
require_once "modelo/turismo.php";
class TurismoControlador{
  public static function ViewTurismo(){
    $us = new Turismo();
    $resul = $us->SeleccionarTurismo();
    require("vista/turismo/cliente/turismo.php");
  }

  public static function VisualizarTurismo(){
    $us = new Turismo();  // Creando una nueva instancia de la clase Usuario
    $listarDeCuanto = 5;$pagina = 1;
    $resultodoUsuarios = $us->SeleccionarTurismo("",false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;
    $resul = $us->SeleccionarTurismo();
    require("vista/turismo/servidor/turismoTabla.php");
  }
  //funcion para insertar en la tabla turismo los datos
  public static function RegistrarDatosTurismo($a) {
    $us = new Turismo();  // Creando una nueva instancia de la clase Usuario

    $campos = ["nombre_destino", "descripcion", "tipo_destino", "ubicacion", "contacto"];
    $datos = [];
    $vacio = false;

    // Validar que todos los campos estén presentes y no vacíos
    foreach ($campos as $campo) {
        if (!isset($a[$campo]) || trim($a[$campo]) === "") {
            $vacio = true;
            break;
        }
    }
    if ($vacio) {
        echo "vacio";
    } else {
        $archivoRuta = '';

        // Validar que el archivo imagen_url exista y sea válido
        if (isset($_FILES['imagen_url']) && $_FILES['imagen_url']['error'] == 0) {
            // Validar el tipo de archivo, por ejemplo, imágenes .jpg, .png, o .gif
            $tipoArchivo = $_FILES['imagen_url']['type'];
            $permitidos = ['image/jpeg', 'image/png', 'image/gif']; // Tipos permitidos

            // Comprobar que el tipo de archivo es válido
            if (in_array($tipoArchivo, $permitidos)) {
                // Validar el tamaño del archivo (opcional, ejemplo: máximo 30 MB)
                $maxSize = 30 * 1024 * 1024; // 30MB (Revisar si esto es lo que quieres)
                if ($_FILES['imagen_url']['size'] > $maxSize) {
                    echo "El archivo es demasiado grande. El tamaño máximo permitido es 30 MB.";
                    return;
                }

                // Definir el directorio de destino y sanitizar el nombre del archivo
                $directorioDestino = "vista/activos/turismoImagen/";
                $extension = pathinfo($_FILES["imagen_url"]["name"], PATHINFO_EXTENSION);
                // Generar un nombre único para evitar colisiones y asegurar seguridad
                $nombreUnico = bin2hex(random_bytes(16)) . '.' . $extension;
                $archivoDestino = $directorioDestino . $nombreUnico;

                // Intentar mover el archivo al directorio de destino
                if (move_uploaded_file($_FILES['imagen_url']['tmp_name'], $archivoDestino)) {
                    // Archivo movido correctamente, guardar la ruta en la variable
                    $archivoRuta = $archivoDestino;
                } else {
                    echo "Error al mover el archivo.";
                    return;
                }
            } else {
                echo "El tipo de archivo no está permitido. Solo se permiten imágenes JPG, PNG o GIF.";
                return;
            }
        }
        // Llamar a la función de inserción pasando la ruta del archivo
        $re = $us->insertarDatosTurismo($a, $archivoRuta);
        if($re){
          echo "correcto";
        }else{
          echo "error";
        }
    }


  }

  public static function BuscarTurismo($pagina, $listarDeCuanto, $buscar){
    $us = new Turismo();  // Creando una nueva instancia de la clase Usuario
    $resultodoUsuarios = $us->SeleccionarTurismo($buscar,false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;

    $resul = $us->SeleccionarTurismo($buscar,$inicioList,$listarDeCuanto);
    echo "
    <div class='row'>
      <div class='col'>
        <div class='table-responsive'>
        <table class='table' style='font-size:12px'>
          <thead>
            <tr>
            <th>N°</th>
            <th>Nombre destino</th>
            <th>Tipo de Destino</th>
            <th>Descripción</th>
            <th>Ubicación</th>
            <th>Contacto</th>
            <th>Imagen</th>
            <th>Creado en</th>
            <th>Actualizado en</th>
            <th>Acción</th>
            </tr>
          </thead>
          <tbody>";

          if ($resul && mysqli_num_rows($resul) > 0) {
            $i = $inicioList;
             while($fi = mysqli_fetch_array($resul)){
                echo "<tr>";
                  echo "<td>".($i+1)."</td>";
                  echo "<td>" . htmlspecialchars($fi['nombre_destino']) . "</td>";
                  echo "<td>" . htmlspecialchars($fi['tipo_destino']) . "</td>";
                  echo "<td>" . htmlspecialchars($fi['descripcion']) . "</td>";
                  echo "<td>" . htmlspecialchars($fi['ubicacion']) . "</td>";
                  echo "<td>" . htmlspecialchars($fi['contacto']) . "</td>";

                  // Mostrar imagen si existe
                  if (!empty($fi['imagen_url'])) {
                      echo "<td><img src='" . htmlspecialchars($fi['imagen_url']) . "' alt='Imagen' style='max-width:100px;'></td>";
                  } else {
                      echo "<td>Sin imagen</td>";
                  }

                  echo "<td>" . htmlspecialchars($fi['enlace_web']) . "</td>";
                  echo "<td>" . $fi['creado_en'] . "</td>";
                  echo "<td>" . $fi['actualizado_en'] . "</td>";
                  echo "<td>";
                  $id_u = '';
                  $datos = [
                    "id" => $fi["id"],
                    "nombre_destino" => addslashes($fi["nombre_destino"]),
                    "tipo_destino" => addslashes($fi["tipo_destino"]),
                    "descripcion" => addslashes($fi["descripcion"]),
                    "actividades_disponibles" => addslashes($fi["actividades_disponibles"]),
                    "ubicacion" => addslashes($fi["ubicacion"]),
                    "contacto" => addslashes($fi["contacto"]),
                    "enlace_web" => addslashes($fi["enlace_web"]),
                    "imagen_url" => addslashes($fi["imagen_url"])
                ];

                              echo "<td>";
                echo '<div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <button type="button" class="btn btn-info btn-sm shadow-sm" title="Editar"
                            data-bs-toggle="modal" data-bs-target="#ModalRegistro"
                            onclick=\'accionBtnEditar(' . json_encode($datos) . ')\' >
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>';
                echo "</td>";



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
