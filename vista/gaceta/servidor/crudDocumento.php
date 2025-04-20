<?php
// Incluir el archivo header.php desde la carpeta diseno

require_once('vista/esquema/header.php');
?>

<div class="container-md"><br>
  <div class="col-auto mb-2" style="color:gray">
    <h5>DOCUMENTOS</h5>
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

        <button type="button" class="form-control btn btn-primary" onclick="onclick='accionBtnEditar("","","","","","","","","","","")'
        " class="d-sm-inline-block btn btn-sm btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#ModalRegistro">
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
          <h6 class="modal-title" id="miModalRegistro"style="color:dimgray">DOCUMENTO</h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Contenido del modal -->
        <div class="modal-body">
          <div class="card shadow-lg">
           <div class="card-body">
             <form>

               <input type="hidden" name="id" id='id' value="">

               <div class="mb-3">
                  <select class="form-control" name="categoria" id='categoria' required>
                    <option value="">Seleccione categoria</option>
                    <option value="RESOLUCIONES-MUNICIPALES">RESOLUCIONES MUNICIPALES</option>
                     <option value="AUDITORIA-INTERNA">AUDITORIA INTERNA</option>
                     <option value="DOCUMENTOS-IMPORTANTES">DOCUMENTOS IMPORTANTES</option>
                     <option value="LEYES-MUNICIPALES">LEYES MUNICIPALES</option>
                     <option value="DECRETOS-EDILES">DECRETOS EDILES</option>
                     <option value="DECRETOS-MUNICIPALES">DECRETOS MUNICIPALES</option>
                     <option value="INFORME-DE-GESTION">INFORME DE GESTION</option>
                     <option value="TRANSPARENCIA">TRANSPARENCIA</option>
                     <option value="RESOLUCIONES-MUNICIPALES-ADMINISTRATIVOS">RESOLUCIONES MUNICIPALES ADMINISTRATIVOS</option>
                  </select>
               </div>
               <div class="mb-3">
                 <input type="text" class="form-control" id="ruta" name='ruta' placeholder="">
               </div>
               <div class="mb-3">
                 <input type="text" class="form-control" id="cod" name='cod' placeholder="Ponga codigo documento" required>
               </div>
               <div class="mb-3">
                 <input type="text" class="form-control" id="entidad" name='entidad' placeholder="Ponga entidad Opcional">
               </div>
               <div class="mb-3">
                  <input type="text" class="form-control" id="descripcion" name='descripcion' placeholder="Ponga descripción" required>
               </div>
               <div class="mb-3">
                  <input type="file"  accept="application/pdf"class="form-control" id="archivo" name='archivo' placeholder="Ponga archivo">
               </div>

               <div class="mb-3">
                 <label for="">Fecha de creación</label>
                  <input type="date" class="form-control" id="fecha_creacion" name='fecha_creacion' placeholder="Ponga fecha de creación" required>
               </div>
               <div class="mb-3">
                  <input type="text" class="form-control" id="nombre_documento" name='nombre_documento' placeholder="Ponga nombre del Documento" required>
               </div>
               <div class="mb-3">
                  <input type="text" class="form-control" id="dato_documento" name='dato_documento' placeholder="Ponga datos del documento" required>
               </div>
               <div class="mb-3">
                 <select class="form-control" name="estado" id='estado' required>
                   <option value="">Seleccione estado</option>
                   <option value="vigente">vigente</option>
                   <option value="no vigente">no vigente</option>

                 </select>
               </div>
               <div class="mb-3">
                 <select class="form-control" name="publicar" id='publicar' required>
                   <option value="">Seleccione publicar</option>
                   <option value="1">Si</option>
                   <option value="0">No</option>

                 </select>
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
              <th>Categoria</th>
              <th>Nombre Documento</th>
              <th>Datos Documento</th>
              <th>descripción</th>
              <th>Usuario</th>
              <th>Fecha creación</th>
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
        url: "/buscarDoc",
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

 function accionBtnEditar(id,categoria,cod,entidad,descripcion,fecha_creacion,nombre_documento,datos_documento,estado,publicar,archivo
 ) {
     document.getElementById('id').value = id;
     document.getElementById('categoria').value = categoria;
     document.getElementById('cod').value = cod;
     document.getElementById('entidad').value = entidad;
     document.getElementById('descripcion').value = descripcion;
     document.getElementById('fecha_creacion').value = fecha_creacion;
     document.getElementById('nombre_documento').value = nombre_documento;
     document.getElementById('dato_documento').value = datos_documento;
     document.getElementById('estado').value = estado;
     document.getElementById('publicar').value = publicar;
     document.getElementById("ruta").value=archivo;
 }

   function formularioSubmit(pagina,listarDeCuanto,cod_usuario,buscar){
     var form = document.createElement('form');
      form.method = 'post';
      form.action = '../controlador/usuario.controlador.php?accion=fm'; // Coloca la URL de destino correcta
      // Agregar campos ocultos para cada dato
      var datos = {
          pagina: pagina,
          listarDeCuanto: listarDeCuanto,
          cod_usuario: cod_usuario,
          buscar: buscar
      };
      for (var key in datos) {
          if (datos.hasOwnProperty(key)) {
              var input = document.createElement('input');
              input.type = 'hidden';
              input.name = key;
              input.value = datos[key];
              form.appendChild(input);
          }
      }
    // Agregar el formulario al cuerpo del documento y enviarlo
    document.body.appendChild(form);
    form.submit();
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
     var categoria = document.getElementById("categoria").value;
     var cod = document.getElementById("cod").value;
     var entidad = document.getElementById("entidad").value;
     var descripcion = document.getElementById("descripcion").value;
     var archivo = document.getElementById("archivo");
     var fecha_creacion = document.getElementById("fecha_creacion").value;
     var nombre_documento = document.getElementById("nombre_documento").value;
     var dato_documento = document.getElementById("dato_documento").value;
     var publicar = document.getElementById("publicar").value;
     var estado = document.getElementById("estado").value;
     var ruta = document.getElementById("ruta").value;
      registrarDatos(id,categoria,cod,entidad,descripcion,archivo,fecha_creacion,nombre_documento,dato_documento,publicar,estado,ruta);
   }

   function registrarDatos(id,categoria,cod,entidad,descripcion,input,fecha_creacion,nombre_documento,dato_documento,publicar,estado,ruta){
     var datos = new FormData(); // Crear un objeto FormData vacío
     var archivo = input.files[0];
     datos.append("id",id);
      datos.append("categoria",categoria);
      datos.append("cod",cod);
      datos.append("entidad",entidad);
      datos.append("descripcion",descripcion);
      datos.append("archivo",archivo);
      datos.append("fecha_creacion",fecha_creacion);
      datos.append("nombre_documento",nombre_documento);
      datos.append("dato_documento",dato_documento);
      datos.append("publicar",publicar);
      datos.append("estado",estado);
      datos.append("ruta",ruta);
     $.ajax({
       url: "/regDoc",
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
         location.href="/Doc";
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
