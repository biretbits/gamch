<?php
// Incluir el archivo header.php desde la carpeta diseno

require_once('vista/esquema/header.php');
?>
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

<div class="content">
  <div class="container1">
    <div class="col-auto" style="color:white">
      <h5>NOTICIAS</h5>
    </div>
    <div class="border rounded shadow-sm p-3 bg-white">
    <input type="hidden" name="paginas" id='paginas' value="">
    <div class="row">
        <label for="selectPage" class="form-label">Página</label>
        <div class="col-2">
          <select class="form-select" id="selectList" onchange="BuscarUsuarios(1)" name="selectList">
            <option>--</option>
            <option>5</option>
            <option>10</option>
            <option>25</option>
            <option>50</option>
            <option>100</option>
            <option>250</option>
            <option>500</option>
            <option>1000</option>
          </select>
        </div>
        <div class="col-2" title="Registro de nuevo Rol">
          <button type="button" class="form-control btn btn-primary"onclick="accionBtnEditar({
            'id': '',
            'titulo': '',
            'contenido': '',
            'foto': '',
            'fechas': ''
          })"
          class="btn btn-primary"
          data-bs-toggle="modal"
          data-bs-target="#ModalRegistro">
            <i class="fas fa-plus-circle"></i>
          </button>
        </div>
        <div class="col-3">

        </div>
        <div class="col-5">
          <input type="text" class="form-control mb-3" placeholder="Buscar..." id='buscar' onkeyup="BuscarUsuarios(1)">
        </div>
      </div>
    <div class="modal fade" id="ModalRegistro" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title" id="miModalRegistro"style="color:dimgray">NOTICIA</h6>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- Contenido del modal -->
          <div class="modal-body">
            <div class="card shadow-lg">
             <div class="card-body">
               <form>

                 <input type="hidden" name="id" id='id' value="">
                 <div class="mb-3">
                   <input type="hidden" class="form-control" id="ruta" name='ruta' placeholder="">
                 </div>
                 <div class="mb-3">
                   <input type="text" class="form-control" id="titulo" name='titulo' placeholder="Ponga Titulo">
                 </div>
                 <div class="mb-3">
                   <textarea name="contenido" id='contenido' rows="8" cols="80" class='form-control' placeholder="Ponga Contenido"required></textarea>
                </div>
                <div class="mb-3">
                  <input type="file" accept=".jpg, .jpeg, .png" class="form-control" id="foto" name="foto" placeholder="Ponga archivo">
                </div>

                 <div class="mb-3">
                   <label for="">Fecha de creación</label>
                    <input type="date" class="form-control" id="fecha" name='fecha' placeholder="Ponga fecha de creación" required>
                 </div>

               </form>
             </div>
           </div>
          <!-- Pie de página del modal -->
        </div>
          <div class="modal-footer">
            <button title='Guardar'type="button" class="btn btn-primary" onclick="registrar()"><i class="fas fa-save"></i></button>
           <button title='cerrar'type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
          </div>
        </div>
      </div>
    </div>


    <div class="verDatos" id="verDatos">
      <div class="row">
        <div class="col">
          <div class="table-responsive">
          <table class="table" style='font-size:12px'>
            <thead>

              <tr>
                <th>N°</th>
                <th>Titulo</th>
                <th>Contenido</th>
                <th>Foto</th>
                <th>Usuario</th>
                <th>Fecha Creación</th>
                <th>Fecha Registro</th>
                <th>Fecha Actualización</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody>
        <?php
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

           ?>
          </tbody>
        </table>
        </div>
      </div>
    </div>
    <?php
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
     ?>
   </div>
  </div>
   </div>


</div>

 <?php
 // Incluir el archivo footer.php desde la carpeta diseno
 require_once('vista/esquema/footeruni.php');
 ?>
<script type="text/javascript">
function BuscarUsuarios(page){
  var obt_lis = document.getElementById("selectList").value;
    var listarDeCuanto = verificarList(obt_lis);
    var buscar = document.getElementById("buscar").value;
    document.getElementById("paginas").value=page;
    //alert(buscar);
    //ponerFechactualAlModalDeReporte(listarDeCuanto,buscar,page,fecha);
    var datos = new FormData(); // Crear un objeto FormData vacío
    datos.append('pagina', page);
    datos.append('listarDeCuanto',listarDeCuanto);
    datos.append("buscar",buscar);
      $.ajax({
        url: "/buscarNoticias",
        type: "POST",
        data: datos,
        contentType: false, // Deshabilitar la codificación de tipo MIME
        processData: false, // Deshabilitar la codificación de datos
        success: function(data) {
        //alert(data+"dasdas");
          $("#verDatos").html(data);
        }
      });
  }

  function verificarList(valor){
    if(valor != "" && valor != "--"){
      return valor;
    }else{
      return 5;
    }
  }

  function enviar(id_usuario,id_ruta,folios,procedencia,referencia,fecha,hora){
    document.getElementById("foliosNumero").value=folios;
    document.getElementById("id_ruta2").value= id_ruta;

    cargarRemisiones(id_usuario,folios,id_ruta);
  }

  function visforUsuario(){
     location.href="../controlador/usuario.controlador.php?accion=vfu" ;
   }

  function visforUsuario(){
     location.href="../controlador/usuario.controlador.php?accion=vfu" ;
   }
   //$pagina,$listarDeCuanto
   //funcion para activar o desactivar el usuario o dar de baja
   function accionBtnActivar(accion,pagina,listarDeCuanto,cod_usuario){
     var buscar = document.getElementById("buscar").value;
     var datos = new FormData(); // Crear un objeto FormData vacío
     datos.append('accion', accion);
     datos.append("pagina",pagina);
     datos.append("listarDeCuanto",listarDeCuanto);
     datos.append("buscar",buscar);
     datos.append("cod_usuario",cod_usuario);
     $.ajax({
       url: "index.php?accion=del",
       type: "POST",
       data: datos,
       contentType: false, // Deshabilitar la codificación de tipo MIME
       processData: false, // Deshabilitar la codificación de datos
       success: function(data) {
     //  alert(data+"dasdas");
     	   data=$.trim(data);
         if(data == "error"){
           error();
         }else{
           $("#verDatos").html(data);
         }
       }
     });
   }

 //funcion para verificar si el usuario existe o no y despues poder editar sus datos

 function accionBtnEditar(data) {
     // Asignar los valores a los camposs}
     document.getElementById('id').value = data.id;
     document.getElementById('titulo').value = data.titulo;
     document.getElementById('contenido').value = data.contenido;
     document.getElementById('ruta').value = data.foto;
      document.getElementById('fecha').value = data.fechas;
 }



   function error(){
  	 Swal.fire({
  		icon: 'error',
  		title: '¡Error!',
  		text: '¡No se pudo realizar la acción !',
  		showConfirmButton: false,
  		timer: 1500
  	});
   }

   function registrar(){
     var id = document.getElementById("id").value;
     var titulo = document.getElementById("titulo").value;
     var contenido = document.getElementById("contenido").value;
     var foto = document.getElementById("foto");
     var fecha = document.getElementById("fecha").value;
     var ruta = document.getElementById("ruta").value;
      registrarDatos(id,titulo,contenido,foto,fecha,ruta);
   }

   function registrarDatos(id,titulo,contenido,foto,fecha,ruta){
     var datos = new FormData(); // Crear un objeto FormData vacío
     var archivo = foto.files[0];
     datos.append("id",id);
      datos.append("titulo",titulo);
      datos.append("contenido",contenido);
      datos.append("fecha",fecha);
      datos.append("archivo",archivo);
      datos.append("ruta",ruta);

     $.ajax({
       url: "/regNoticia",
       type: "POST",
       data: datos,
       contentType: false, // Deshabilitar la codificación de tipo MIME
       processData: false, // Deshabilitar la codificación de datos
       success: function(data) {
         data = $.trim(data);
         //alert(data);
         if(data == "correcto"){
           alert("accion realizada con exito");
        }else if(data == "error"){
           alert("ocurio un error al insertar datos");
        }else{
          alert(data);
        }
        IRalLink(id);
       }
     });

   }

   function IRalLink(id_usuario){
     if(id_usuario!=''){
       setTimeout(() => {
         var pagina = document.getElementById("paginas").value;
         if(pagina==''){pagina=1;}
         BuscarUsuarios(pagina);
           $('#ModalRegistro').modal('hide');
       }, 1500);
     }else{
       setTimeout(() => {
         location.href="/RegNot";
           $('#ModalRegistro').modal('hide');
       }, 1500);
     }
   }

   $(document).ready(function() {
       $('#para').select2({
         theme: "bootstrap-5", // Aplicar el tema de Bootstrap 5 a Select2
        dropdownParent: $('#miModalRemision3'), // Mantiene el dropdown dentro del modal
        placeholder: "Buscar para .......",
        width: '100%',
        ajax: {
               url: "index.php?accion=buhr", // Archivo PHP que procesará la búsqueda
               type: 'POST',
               dataType: 'json',
               delay: 250, // Tiempo de espera en ms para la solicitud AJAX
               data: function(params) {
                   return {
                       buscar: params.term // Término de búsqueda ingresado por el usuario
                   };
               },
               processResults: function(data) {
                   return {
                       results: $.map(data, function(item) {
                           return {
                               id: item.id_usuario, // ID correcto
                               text: item.nombres+" "+item.ap_usuario+" "+item.am_usuario+" - "+item.tipo_cargo, // Nombre visible en el select
                               id_cargo:item.id_cargo
                           };
                       })
                   };
               },

               cache: true,
               success: function(response) {
               console.log("Respuesta recibida desde el servidor:", response);
             },
             error: function(xhr, status, error) {
               console.error("Error en la solicitud:", error);
               console.log("Detalles del error:", xhr.responseText);
                           //alert("Ocurrió un error al obtener los datos. Revisa la consola para más detalles.");
           }
           },
           minimumInputLength: 1 // Mínimo de caracteres antes de hacer la búsqueda
       }).on('select2:select', function(e) {
           var selectedData = e.params.data;
          console.log("Seleccionado:", selectedData);
          $("#id_usuario").val(selectedData.id);
          $("#id_cargo2").val(selectedData.id_cargo);
       });
       // Agregar el borde de select2 si es necesario
    $('.select2-container .select2-selection--single').css({
        'border': '1px solid #ced4da',
        'border-radius': '.375rem',
    });
   });


function vaciarRemision(){
}

</script>
