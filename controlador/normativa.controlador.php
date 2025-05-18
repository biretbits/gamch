<?php

require 'modelo/normativa.php';
class NormativaControlador{
  public static function visualizarNormativa($categoria){
    $us = new Normativa();  // Creando una nueva instancia de la clase Usuario
    $listarDeCuanto = 10;$pagina = 1;
    $resultodoUsuarios = $us->SelectPorBusquedaNormativa("",false,false,$categoria);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;

    $resul = $us->SelectPorBusquedaNormativa('',$inicioList,$listarDeCuanto,$categoria);
    $rnoticia = $us->ultimaNoticia();
    require("vista/normativa/cliente/normativa.php");
  }

  public static function buscarNomativaNuevo($pagina,$listarDeCuanto,$buscar,$categoria){
      $us = new Normativa();  // Creando una nueva instancia de la clase Usuario
      $resultodoUsuarios = $us->SelectPorBusquedaNormativa($buscar,false,false,$categoria);
      $num_filas_total = mysqli_num_rows($resultodoUsuarios);
      $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
              //calculamos el registro inicial
      $inicioList = ($pagina - 1) * $listarDeCuanto;

      $resul = $us->SelectPorBusquedaNormativa($buscar,$inicioList,$listarDeCuanto,$categoria);
      if ($resul && mysqli_num_rows($resul) > 0) {
        while($fi = mysqli_fetch_array($resul)):
          echo '<div class="d-flex align-items-center justify-content-between border p-3 rounded shadow-sm">';
            echo '<div class="d-flex align-items-center">';
              echo '<i class="fas fa-file-pdf text-danger fs-3 me-3"></i>';
              echo '<div>';
                echo '<a href="#" target="_blank" class="text-decoration-none fw-bold text-dark">' . $fi["nombre_documento"] . '</a>';
                echo '<div class="text-muted small description">' . $fi["descripcion"] . '</div>';
                echo '<div class="text-muted small">' . $fi["fecha_creacion"] . '</div>';
              echo '</div>';
            echo '</div>';
            echo '<div class="d-flex gap-2">';
              echo '<a href="javascript:void(0)" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#pdfModal" onclick="ejecutar(\'' . $fi["archivo"] . '\')">';
                echo '<i class="fas fa-eye me-1"></i> Ver';
              echo '</a>';
              echo '<a href="' . $fi["archivo"] . '" download class="btn btn-outline-secondary btn-sm" title="Descargar PDF">';
                echo '<i class="fas fa-download me-1"></i> Descargar';
              echo '</a>';
            echo '</div>';
          echo '</div>';
         endwhile;
     }else{
       echo "<tr>";
       echo "<td colspan='15' align='center'>No se encontraron resultados</td>";
       echo "</tr>";
     }
    if ($TotalPaginas != 0):
      $adjacents = 1;
      $anterior = "&lsaquo; Anterior";
      $siguiente = "Siguiente &rsaquo;";

    echo '<div class="row mt-3">';
      echo '<div class="col">';
        echo '<nav aria-label="Paginación de resultados">';
          echo '<ul class="pagination justify-content-center flex-wrap">';

          if ($pagina > 1) {
            echo '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="BuscarUsuarios(1)" aria-label="Primera"><span aria-hidden="true">&laquo;</span></a></li>';
          }

          if ($pagina == 1) {
            echo '<li class="page-item disabled"><span class="page-link">' . $anterior . '</span></li>';
          } else {
            echo '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="BuscarUsuarios(' . ($pagina - 1) . ')">' . $anterior . '</a></li>';
          }

          if ($pagina > ($adjacents + 1)) {
            echo '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="BuscarUsuarios(1)">1</a></li>';
          }

          if ($pagina > ($adjacents + 2)) {
            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
          }

          $pmin = ($pagina > $adjacents) ? ($pagina - $adjacents) : 1;
          $pmax = ($pagina < ($TotalPaginas - $adjacents)) ? ($pagina + $adjacents) : $TotalPaginas;

          for ($i = $pmin; $i <= $pmax; $i++) {
            if ($i == $pagina) {
              echo '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
            } else {
              echo '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="BuscarUsuarios(' . $i . ')">' . $i . '</a></li>';
            }
          }

          if ($pagina < ($TotalPaginas - $adjacents - 1)) {
            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
          }

          if ($pagina < ($TotalPaginas - $adjacents)) {
            echo '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="BuscarUsuarios(' . $TotalPaginas . ')">' . $TotalPaginas . '</a></li>';
          }

          if ($pagina < $TotalPaginas) {
            echo '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="BuscarUsuarios(' . ($pagina + 1) . ')">' . $siguiente . '</a></li>';
          } else {
            echo '<li class="page-item disabled"><span class="page-link">' . $siguiente . '</span></li>';
          }

          if ($pagina != $TotalPaginas) {
            echo '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="BuscarUsuarios(' . $TotalPaginas . ')" aria-label="Última"><span aria-hidden="true">&raquo;</span></a></li>';
          }

          echo '</ul>';
        echo '</nav>';
      echo '</div>';
    echo '</div>';
     endif;

  }

  public static function DatosDeTablaNormativa(){
    $us = new Normativa();  // Creando una nueva instancia de la clase Usuario
    $listarDeCuanto = 5;$pagina = 1;
    $resultodoUsuarios = $us->SelectPorBusquedaNormativa("",false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;

    $resul = $us->SelectPorBusquedaNormativa('',$inicioList,$listarDeCuanto);
    require("vista/normativa/servidor/normativaTabla.php");
  }

  public static function registrarNormativas($a){
    $us = new Normativa();
    $r = "";
    $usuario_id = $_SESSION["usuario_id"];
    if (isset($_FILES['archivo'])) {//si existe el archivo
      $archivo = $_FILES["archivo"];
      $r="vista/activos/documento/normativas/";//ruta donde se guardara el archivo
        if ($archivo['type'] === 'application/pdf') {//verificamos si es un pdf
          $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
          $nombreUnico = bin2hex(random_bytes(16)) . '.' . $extension;
            $r = $r.$nombreUnico;
            move_uploaded_file($archivo['tmp_name'], $r);//movemos el archivo a la ruta $r
        } else {
            echo "Solo se permite PDF.";
        }
    } else {
      if($a["id"] == ""){//si es vacio se quiere registrar
        echo "No se recibió ningún archivo.";
      }
    }
    $resul = $us->registrar($a,$usuario_id,$r);
    if($resul){
      echo "correcto";
    }else{
      echo "error";
    }
  }

  public static function BuscarNormativas($pagina,$listarDeCuanto,$buscar){
      $us = new Normativa();  // Creando una nueva instancia de la clase Usuario
      $resultodoUsuarios = $us->SelectPorBusquedaNormativa($buscar,false,false);
      $num_filas_total = mysqli_num_rows($resultodoUsuarios);
      $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
              //calculamos el registro inicial
      $inicioList = ($pagina - 1) * $listarDeCuanto;

      $resul = $us->SelectPorBusquedaNormativa($buscar,$inicioList,$listarDeCuanto);
      echo "
      <div class='row'>
        <div class='col'>
          <div class='table-responsive'>
          <table class='table' style='font-size:12px'>
            <thead>
              <tr>
              <th>N°</th>
              <th>Categoria</th>
              <th>Nombre Documento</th>
              <th>descripción</th>
              <th>Usuario</th>
              <th>Publicar</th>
              <th>Fecha creación</th>
              <th>Acción</th>
              </tr>
            </thead>
            <tbody>";
            if ($resul && mysqli_num_rows($resul) > 0) {
              $i = $inicioList;
               while($fi = mysqli_fetch_array($resul)){
                  echo "<tr>";
                    echo "<td>".($i+1)."</td>";
                    echo "<td>".$fi['categoria']."</td>";
                    echo "<td>".$fi['nombre_documento']."</td>";
                    echo "<td>".$fi['descripcion']."</td>";
                    echo "<td>".$fi['usuario_id']."</td>";
                    $publica = $fi["publicar"];
                    if($publica == 1){
                      echo "<td>Si</td>";
                    }else{
                      echo "<td>No</td>";
                    }
                    echo "<td>".$fi['fecha_creacion']."</td>";
                    echo "<td>";
                    $id_u = '';
                    $datos = [
                      "id" => $fi["id"],
                      "categoria" => addslashes($fi["categoria"]),
                      "cod" => addslashes($fi["cod"]),
                      "descripcion" => addslashes($fi["descripcion"]),
                      "fecha_creacion" => $fi["fecha_creacion"],
                      "nombre_documento" => addslashes($fi["nombre_documento"]),
                      "estado" => addslashes($fi["estado"]),
                      "publicar" => addslashes($fi["publicar"]),
                  ];

                  echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>
                      <button type='button'
                          class='btn btn-info btn-sm shadow-sm'
                          title='Editar'
                          data-bs-toggle='modal'
                          data-bs-target='#ModalRegistro'
                          onclick='accionBtnEditar(" . json_encode($datos) . ")'>
                          <i class='fas fa-edit'></i>
                      </button>
                  </div>";


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
