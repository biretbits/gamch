<?php
require "modelo/documento.php";
class DocumentoControlador{
  public static function registroDocumento(){
    $us = new Documento();  // Creando una nueva instancia de la clase Usuario
    $listarDeCuanto = 5;$pagina = 1;
    $resultodoUsuarios = $us->SelectPorBusqueda("",false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;

    $resul = $us->SelectPorBusqueda('',$inicioList,$listarDeCuanto);
    require("vista/gaceta/servidor/crudDocumento.php");
  }

  public static function documentos_visualizar($ruta){
    $us = new Documento();  // Creando una nueva instancia de la clase Usuario
    $resul = $us->SeleccionarDocumentos($ruta);

    require('vista/gaceta/cliente/gaceta_documentos.php');

  }

  public static function registrarDocumentos($a){
    $us = new Documento();
    $r = "vista/activos/Documentos/";
    $usuario_id = $_SESSION["usuario_id"];
    if (isset($_FILES['archivo'])) {
      $archivo = $_FILES["archivo"];

        if ($archivo['type'] === 'application/pdf') {
          $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
          $nombreUnico = bin2hex(random_bytes(16)) . '.' . $extension;
            $r = $r.$nombreUnico;
            move_uploaded_file($archivo['tmp_name'], $r);
            $resul = $us->registrar($a,$r,$usuario_id,$nombreUnico);
            if($resul){
              echo "correcto";
            }else{
              echo "error";
            }
        } else {
            echo "Solo se permite PDF.";
        }
    } else {
      if($a["id"] == ""){
        echo "No se recibió ningún archivo.";
      }else{//si no se tiene el id esta actualizando y al actualizar es valido que no haya archivo
        //no mandamos la ruta nu el nombre_del archivo
        $resul = $us->registrar($a,'',$usuario_id,"");
        if($resul){
          echo "correcto";
        }else{
          echo "error";
        }
      }
    }

  }

  public static function BuscarDoc($pagina,$listarDeCuanto,$buscar){
    $us = new Documento();  // Creando una nueva instancia de la clase Usuario
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
            <th>Categoria</th>
            <th>Nombre Documento</th>
            <th>Datos Documento</th>
            <th>descripción</th>
            <th>Fecha Creación</th>
            <th>Fecha Registro</th>
            <th>Acción</th>
            </tr>
          </thead>
          <tbody>";if ($resul && mysqli_num_rows($resul) > 0) {
            $i = $inicioList;
             while($fi = mysqli_fetch_array($resul)){
                echo "<tr>";
                  echo "<td>".($i+1)."</td>";
                  echo "<td>".$fi['categoria']."</td>";
                  echo "<td>".$fi['nombre_documento']."</td>";
                  echo "<td>".$fi['datos_documento']."</td>";
                  echo "<td>".$fi['descripcion']."</td>";
                  echo "<td>".$fi['usuario_id']."</td>";
                  echo "<td>".$fi['fecha_creacion']."</td>";
                  echo "<td>";
                  $id_u = '';
                  echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>
                  <button type='button'
                      class='btn btn-info btn-sm shadow-sm'
                      title='Editar'
                      data-bs-toggle='modal'
                      data-bs-target='#ModalRegistro'
                      onclick='accionBtnEditar(
                          \"" . $fi["id"] . "\",
                          \"" . addslashes($fi["categoria"]) . "\",
                          \"" . addslashes($fi["cod"]) . "\",
                          \"" . addslashes($fi["entidad"]) . "\",
                          `" . addslashes($fi["descripcion"]) . "`,
                          \"" . $fi["fecha_creacion"] . "\",
                          \"" . addslashes($fi["nombre_documento"]) . "\",
                          \"" . addslashes($fi["datos_documento"]) . "\",
                          \"" . addslashes($fi["estado"]) . "\",
                          \"" . addslashes($fi["publicar"],) . "\",
                          \"" . addslashes($fi["archivo"]) . "\",
                      )'>
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

  public static function BuscarDocumento($buscar){
    $us = new Documento();  // Creando una nueva instancia de la clase Usuario
    $resul = $us->BuscarDocumentoFiltrar($buscar);
    echo "<div class='container-sm'>
    <div class='row mt-4 mb-4'>";

        if ($resul && mysqli_num_rows($resul) > 0) {
            while($doc = mysqli_fetch_array($resul)) {
                if($doc['publicar'] == 1){
                  echo "
                  <div class='col-md-6 mb-4'>
                      <div class='card card-shadow h-100' data-aos='fade-right' data-aos-duration='1200'>
                          <div class='card-body'>
                              <div class='row'>
                                  <div class='col-8'>
                                      <h6 class='font-medium'>". $doc['nombre_documento'] ."</h6>
                                      <hr>
                                      <p class='text-muted mt-3'>". $doc['descripcion'] ."</p>
                                  </div>
                                  <div class='col-4 text-center'>
                                      <a href='". $doc['archivo'] ."' target='_blank'>
                                          <img src='/imagenes/pdf.png' alt='PDF' style='max-width: 50px;'>
                                      </a>
                                      <h6 class='font-medium mt-2' style='font-size: 11px;'>". $doc['fecha_creacion'] ."</h6>
                                      <a href='". $doc['archivo'] ."' download='". $doc['nombre_documento'] .".pdf'>
                                          <i class='fa fa-download fa-2x text-danger mt-2'></i>
                                      </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>";

                }
            }
        } else {
            echo "
            <div class='col-md-6 mb-4'>
                <div class='card card-shadow h-100' data-aos='fade-right' data-aos-duration='1200'>
                    <div class='card-body text-center'>
                        <p class='text-muted mb-0'>NO SE ENCONTRARON DOCUMENTOS</p>
                    </div>
                </div>
            </div>";
        }
    echo "</div>
</div>
";

  }

  public static function FormularioNoticia(){
    $us = new Documento();  // Creando una nueva instancia de la clase Usuario
    $listarDeCuanto = 5;$pagina = 1;
    $resultodoUsuarios = $us->SeleccionarNoticias("",false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;

    $resul = $us->SeleccionarNoticias('',$inicioList,$listarDeCuanto);
    require('vista/noticia/servidor/crudNoticias.php');
  }

  public static function registrarNoticia($a) {
    $us = new Documento();
    $r = "vista/activos/NoticiasImagen/";
    $usuario_id = $_SESSION["usuario_id"];

    if (isset($_FILES['archivo'])) {
        $archivo = $_FILES['archivo'];
        $mime = $archivo['type'];
        $ext = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));

        // Validar que sea imagen aceptada
        $tiposValidos = ['image/jpeg', 'image/png', 'image/jpg'];
        $extensionesValidas = ['jpg', 'jpeg', 'png'];

        if (in_array($mime, $tiposValidos) && in_array($ext, $extensionesValidas)) {
            $nombreUnico = bin2hex(random_bytes(16)) . '.' . $ext;
            $rutaFinal = $r . $nombreUnico;

            if (move_uploaded_file($archivo['tmp_name'], $rutaFinal)) {
                $resul = $us->registrarNoticia($a, $rutaFinal, $usuario_id, $nombreUnico);
                echo $resul ? "correcto" : "error";
            } else {
                echo "Error al mover el archivo.";
            }
        } else {
            echo "Solo se permiten imágenes JPG o PNG.";
        }
    } else {
        if ($a["id"] == "") {
            echo "No se recibió ningún archivo.";
        } else {
            $resul = $us->registrarNoticia($a, '', $usuario_id, "");
            echo $resul ? "correcto" : "error";
        }
    }
  }

  public static function BuscarNoticiaSeXISTEN($pagina,$listarDeCuanto,$buscar){
    $us = new Documento();  // Creando una nueva instancia de la clase Usuario
    $resultodoUsuarios = $us->SeleccionarNoticias($buscar,false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;

    $resul = $us->SeleccionarNoticias($buscar,$inicioList,$listarDeCuanto);
    echo "
    <div class='row'>
      <div class='col'>
        <div class='table-responsive'>
        <table class='table' style='font-size:12px'>
          <thead>
            <tr>
            <th>N°</th>
            <th>Titulo</th>
            <th>Contenido</th>
            <th>Foto</th>
            <th>Usuario</th>
            <th>Fecha</th>
            <th>Fecha creación</th>
            <th>Fecha Actualización</th>
            <th>Acción</th>
            </tr>
          </thead>
          <tbody>";
          if ($resul && mysqli_num_rows($resul) > 0) {
            $i = $inicioList;
             while($fi = mysqli_fetch_array($resul)){
                echo "<tr>";
                  echo "<td>".($i+1)."</td>";
                  echo "<td>".$fi['titulo']."</td>";
                  echo "<td>".$fi['contenido']."</td>";
                  echo "<td><img src='" . $fi['foto'] . "' alt='Foto' style='width: 80px; height: auto;'></td>";

                  echo "<td>".$fi['usuario_usuario']."</td>";
                  echo "<td>".$fi['fecha']."</td>";
                  echo "<td>".$fi['creado_en']."</td>";
                  echo "<td>".$fi['actualizado_en']."</td>";
                  echo "<td>";
                  $id_u = '';
                  $datos = [
                      "id" => $fi["id"],
                      "titulo" => addslashes($fi["titulo"]),
                      "contenido" => addslashes($fi["contenido"]),
                      "foto" => addslashes($fi["foto"]),
                      "fechas" => ($fi["fecha"])
                  ];

                  echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>
                      <button type='button' class='btn btn-info btn-sm shadow-sm' title='Editar'
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

  public static function ViewNoticias(){
    $us = new Documento();
    $listarDeCuanto = 5;$pagina = 1;
    $resultodoUsuarios = $us->SeleccionarNoticiasNuevas(false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;
    $resul = $us->SeleccionarNoticiasNuevas($inicioList,$listarDeCuanto);
    require("vista/noticia/cliente/noticias.php");
  }

  public static function SeguirLeyendodOCUMENTO($id){
    $us = new Documento();
    $resul = $us->SeleccionarNoticiasNuevasID($id);
    require("vista/noticia/cliente/seguirLeyendo.php");

  }

  public static function ListarNoticasNuevas($pagina,$listarDeCuanto){
    $us = new Documento();
    $resultodoUsuarios = $us->SeleccionarNoticiasNuevas(false,false);
    $num_filas_total = mysqli_num_rows($resultodoUsuarios);
    $TotalPaginas = ceil($num_filas_total / $listarDeCuanto);//obtenenemos el total de paginas a mostrar
            //calculamos el registro inicial
    $inicioList = ($pagina - 1) * $listarDeCuanto;
    $resul = $us->SeleccionarNoticiasNuevas($inicioList,$listarDeCuanto);
    echo '<div class="container-sm">';
    echo '<br>';

    if ($resul && $resul->num_rows > 0) {
        while ($newpage = $resul->fetch_object()) {
            echo '<div class="row justify-content-center mb-5">';

            // Imagen
            echo '<div class="col-md-5">';
            echo '<div class="mb-4">';
            echo '<a href="#">';
            echo '<div style="width: 100%; height: 250px; overflow: hidden;">';
            echo '<img src="' . htmlspecialchars($newpage->foto) . '" alt="noticia" class="img-fluid" style="width: 100%; height: 100%; object-fit: contain;">';
            echo '</div>';
            echo '</a>';
            echo '</div>';
            echo '</div>';

            // Texto
            echo '<div class="col-md-5">';
            echo '<ul class="list-inline text-uppercase text-muted small mb-2">';
            echo '<li class="list-inline-item"><a href="#">Publicado</a></li>';
            echo '<li class="list-inline-item"><a href="#">' . htmlspecialchars($newpage->fecha) . '</a></li>';
            echo '</ul>';

            echo '<h3 class="fw-light">';
            echo '<a href="#" onclick="SeguirLeyendo(' . $newpage->id . ')" class="text-decoration-none">';
            echo htmlspecialchars($newpage->titulo);
            echo '</a>';
            echo '</h3>';

            echo '<p class="my-3">';
            echo substr(strip_tags($newpage->contenido), 0, 200) . '...';
            echo '</p>';

            echo '<a href="#" onclick="SeguirLeyendo(' . $newpage->id . ')" class="text-primary small text-decoration-none">Seguir Leyendo Más</a>';
            echo '</div>';

            echo '</div>'; // row
            echo '<hr>';
        }
    } else {
        echo '<div class="text-center">';
        echo '<p class="text-white">No se encontraron noticias.</p>';
        echo '</div>';
    }

    if ($TotalPaginas != 0) {
        $adjacents = 1;
        $anterior = "&lsaquo; Anterior";
        $siguiente = "Siguiente &rsaquo;";

        echo '<div class="row mt-3">';
        echo '<div class="col">';
        echo '<nav>';
        echo '<ul class="pagination justify-content-center flex-wrap" style="background:white">';

        // Primera página
        if ($pagina > 1) {
            echo '<li class="page-item">';
            echo '<a class="page-link rounded-0" href="javascript:void(0);" onclick="BuscarUsuarios(1)" aria-label="Primera">';
            echo '<span aria-hidden="true">&laquo;</span>';
            echo '</a>';
            echo '</li>';
        }

        // Anterior
        if ($pagina == 1) {
            echo '<li class="page-item disabled">';
            echo '<span class="page-link rounded-0">' . $anterior . '</span>';
            echo '</li>';
        } else {
            echo '<li class="page-item">';
            echo '<a class="page-link rounded-0" href="javascript:void(0);" onclick="BuscarUsuarios(' . ($pagina - 1) . ')">' . $anterior . '</a>';
            echo '</li>';
        }

        // Páginas
        if ($pagina > ($adjacents + 1)) {
            echo '<li class="page-item"><a class="page-link rounded-0" href="javascript:void(0);" onclick="BuscarUsuarios(1)">1</a></li>';
        }

        if ($pagina > ($adjacents + 2)) {
            echo '<li class="page-item disabled"><span class="page-link rounded-0">...</span></li>';
        }

        $pmin = ($pagina > $adjacents) ? ($pagina - $adjacents) : 1;
        $pmax = ($pagina < ($TotalPaginas - $adjacents)) ? ($pagina + $adjacents) : $TotalPaginas;

        for ($i = $pmin; $i <= $pmax; $i++) {
            if ($i == $pagina) {
                echo '<li class="page-item active"><span class="page-link rounded-0 bg-success border-success">' . $i . '</span></li>';
            } else {
                echo '<li class="page-item"><a class="page-link rounded-0" href="javascript:void(0);" onclick="BuscarUsuarios(' . $i . ')">' . $i . '</a></li>';
            }
        }

        if ($pagina < ($TotalPaginas - $adjacents - 1)) {
            echo '<li class="page-item disabled"><span class="page-link rounded-0">...</span></li>';
        }

        if ($pagina < ($TotalPaginas - $adjacents)) {
            echo '<li class="page-item"><a class="page-link rounded-0" href="javascript:void(0);" onclick="BuscarUsuarios(' . $TotalPaginas . ')">' . $TotalPaginas . '</a></li>';
        }

        // Siguiente
        if ($pagina < $TotalPaginas) {
            echo '<li class="page-item">';
            echo '<a class="page-link rounded-0" href="javascript:void(0);" onclick="BuscarUsuarios(' . ($pagina + 1) . ')">' . $siguiente . '</a>';
            echo '</li>';
        } else {
            echo '<li class="page-item disabled">';
            echo '<span class="page-link rounded-0">' . $siguiente . '</span>';
            echo '</li>';
        }

        // Última página
        if ($pagina != $TotalPaginas) {
            echo '<li class="page-item">';
            echo '<a class="page-link rounded-0" href="javascript:void(0);" onclick="BuscarUsuarios(' . $TotalPaginas . ')" aria-label="Última">';
            echo '<span aria-hidden="true">&raquo;</span>';
            echo '</a>';
            echo '</li>';
        }

        echo '</ul>';
        echo '</nav>';
        echo '</div>';
        echo '</div>';
    }

    echo '</div>';

  }
}


?>
