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
        $archivo = $_FILES['archivo'];

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
            <th>Usuario</th>
            <th>Fecha creación</th>
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

}


?>
