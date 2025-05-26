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
  <div class="col-auto mb-2" style="color:gray">
    <h5>ROLES DE USUARIOS</h5>
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

        <button type="button" class="form-control btn btn-primary" onclick="accionBtnEditar('','','',''
        ,'')" class="d-sm-inline-block btn btn-sm btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#ModalRegistro">
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
          <h6 class="modal-title" id="miModalRegistro"style="color:dimgray">ROLES DE USUARIOS</h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Contenido del modal -->
        <div class="modal-body">
          <div class="card shadow-lg">
           <div class="card-body">
             <form>

               <input type="hidden" name="id" id='id' value="">
               <input type="hidden" name="usuario_id" id='usuario_id' value="">
                <input type="hidden" name="id_rol" id='id_rol' value="">
               <div class="input-group input-group-sm mb-3">
                 <select id="nombreUsuario" class="form-select select2" required>
                   <option value=""></option>
                 </select>
               </div>
               <div class="input-group input-group-sm mb-3">
                 <select id="rolTipo" class="form-select select2" required>
                   <option value=""></option>
                 </select>
               </div>
               <div class="input-group input-group-sm mb-3">
                 <h6 id='edi'></h6>
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
          <tbody>
      <?php
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
                 \"".$fi["usuario_id"]."\",\"\",   \"\"
                )'>
         <i class='fas fa-edit'></i></button>";
         echo "<button type='button'
              class='btn btn-danger btn-sm shadow-sm'
              title='Eliminar'
              onclick='accionBtnActivar(
                    \"".$fi["id"]."\"
                  )'>
          <i class='fas fa-trash-alt'></i> Eliminar</button>";
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
        url: "/buscandoRolesUsuario",
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
   function accionBtnActivar(id){
     var datos = new FormData(); // Crear un objeto FormData vacío
     datos.append('id', id);
     $.ajax({
       url: "/eliminarRolUsuario",
       type: "POST",
       data: datos,
       contentType: false, // Deshabilitar la codificación de tipo MIME
       processData: false, // Deshabilitar la codificación de datos
       success: function(data) {
     //  alert(data+"dasdas");
     	   data=$.trim(data);
        // alert(data);
         if(data == "correcto"){
           alertaValidacion("success","Acción realizada con éxito","Correcto")
           IRalLink(id);
        }else{
          alertaValidacion("error","¡No se pudo realizar la acción!","¡Error!")
        }
       }
     });
   }
 //funcion para verificar si el usuario existe o no y despues poder editar sus datos
 function accionBtnEditar(id, idRol,usuarioId, nombreUsuario, rolTipo) {
   // Asignar valores simples
   document.getElementById("id").value = id;
   document.getElementById("usuario_id").value = usuarioId;
   document.getElementById("id_rol").value = idRol;

   // Asignar texto al Select2 de nombreUsuario
   $('#nombreUsuario').val(nombreUsuario).trigger('change');

   // Asignar texto al Select2 de rolTipo
   $('#rolTipo').val(rolTipo).trigger('change');
   if(id!=''){
       document.getElementById("edi").innerText = "NOTA: Esta en acción Editar, busque de nuevo un usuario y rol de usuario, si desea actualizar.";
   }else{
     document.getElementById("edi").innerText = "";
    }
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
     var usuario_id = document.getElementById("usuario_id").value;
     var id_rol = document.getElementById("id_rol").value;
      registrarDatos(id,usuario_id,id_rol);
   }

   function registrarDatos(id,usuario_id,id_rol){
     var datos = new FormData(); // Crear un objeto FormData vacío
      datos.append("id",id);
      datos.append("usuario_id",usuario_id);
      datos.append("id_rol",id_rol);
     $.ajax({
       url: "/RolUsuarioReg",
       type: "POST",
       data: datos,
       contentType: false, // Deshabilitar la codificación de tipo MIME
       processData: false, // Deshabilitar la codificación de datos
       success: function(data) {
         data = $.trim(data);
         //alert(data);
         console.log(data);
         if(data == "correcto"){
           alertaValidacion("success","Acción realizada con éxito","Correcto")
           IRalLink(id);
        }else if(data == "vacio"){
          alertaValidacion("warning","Algun campo vacio","Complete los campos")
        }else{
          alertaValidacion("error","¡No se pudo realizar la acción!","¡Error!")
        }
       }
     });

   }
   function alertaValidacion(icono,texto,titulo){
    Swal.fire({
     icon: icono,
     title: titulo,
     text: texto,
     showConfirmButton: false,
     timer: 2000
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
         location.href="/rolU";
           $('#ModalRegistro').modal('hide');
       }, 1500);
     }
   }


      $(document).ready(function() {
        $('#nombreUsuario').select2({
          theme: "bootstrap-5",
          dropdownParent: $('#ModalRegistro'),
          placeholder: "Buscar usuario",
          width: '100%',

          ajax: {
            url: "/buscandoNombre",
            type: 'POST',
            dataType: 'json',
            delay: 250,
            data: function(params) {
              return {
                buscar: params.term
              };
            },
            processResults: function(data) {
              return {
                results: $.map(data, function(item) {
                  return {
                    id: item.usuario_id,
                    text: item.usuario_nombre_completo + " - " + item.usuario,
                    id_empleado: item.empleado_id
                  };
                })
              };
            },
            cache: true
          },
          minimumInputLength: 1
        }).on('select2:select', function(e) {
          var selectedData = e.params.data;
          console.log("Seleccionado:", selectedData);
          $("#usuario_id").val(selectedData.id);
        });

        $('.select2-container .select2-selection--single').css({
          'border': '1px solid #ced4da',
          'border-radius': '.375rem',
        });
      });

      $(document).ready(function() {
        $('#rolTipo').select2({
          theme: "bootstrap-5",
          dropdownParent: $('#ModalRegistro'),
          placeholder: "Buscar rol usuario",
          width: '100%',

          ajax: {
            url: "/buscandoRolUsuario",
            type: 'POST',
            dataType: 'json',
            delay: 250,
            data: function(params) {
              return {
                buscar: params.term
              };
            },
            processResults: function(data) {
              return {
                results: $.map(data, function(item) {
                  return {
                    id: item.id,
                    text: item.nombre + " - " + item.slug
                  };
                })
              };
            },
            cache: true
          },
          minimumInputLength: 1
        }).on('select2:select', function(e) {
          var selectedData = e.params.data;
          console.log("Seleccionado:", selectedData);
          $("#id_rol").val(selectedData.id);
        });

        $('.select2-container .select2-selection--single').css({
          'border': '1px solid #ced4da',
          'border-radius': '.375rem',
        });
      });

function vaciarRemision(){
}

</script>
