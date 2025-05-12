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
    <h5>GESTIÓN DE EMPLEADOS</h5>
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
          <h6 class="modal-title" id="miModalRegistro"style="color:dimgray">DATOS DEL EMPLEADO</h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Contenido del modal -->
        <div class="modal-body">
          <div class="card shadow-lg">
           <div class="card-body">
             <form>

               <input type="text" name="id" id='id' value="">
               <input type="text" name="id_nivel" id='id_nivel' value="">
               <input type="text" name="id_cargo" id='id_cargo' value="">

               <div class="input-group input-group-sm mb-3">
                 <select id="cargo" class="form-select select2" required>
                   <option value="">Seleccione cargo</option>
                </select>
               </div>

              <div class="input-group input-group-sm mb-3">
                <select id="empleado" class="form-control" required>
                  <option value="">Seleccione tipo de empleado</option>
                  <option value="Autoridad">Autoridad</option>
                  <option value="Normal">Normal</option>
                </select>
              </div>
               <div class="mb-3">
                 <input type="text"class="form-control mayu" id="nombre" name='nombre' placeholder="Ponga nombre">
               </div>
               <div class="mb-3">
                 <input type="text"class="form-control mayu" id="apellido_p" name='apellido_p' placeholder="Ponga apellido paterno">
               </div>
               <div class="mb-3">
                 <input type="text"class="form-control mayu" id="apellido_m" name='apellido_m' placeholder="Ponga apellido materno">
               </div>
               <div class="input-group input-group-sm mb-3">
                 <select id="sexo" class="form-select select2" required>
                   <option value="">Seleccione sexo</option>
                   <option value="Masculino">Masculino</option>
                   <option value="Femenino">Femenino</option>
                 </select>
               </div>

               <div class="mb-3">
                 <input type="text"class="form-control" id="direccion" name='direccion' placeholder="Ponga la Direccióno">
               </div>

               <div class="mb-3">
                 <input type="number" class="form-control mayu" id="telefono" name='telefono' placeholder="Ponga el Telefono">
               </div>
               <div class="mb-3">
                 <input type="email" class="form-control" name="gmail" id="gmail"
                        required

                        placeholder="ejemplo@gmail.com">
              </div>
               <div class="mb-3">
                 <h6>Selecciona tu foto (JPG o PNG, optimizada)</h6>
                 <input type="file"accept="image/jpeg, image/png"  class="form-control" name="upload" id='upload' required>
                  <div id="preview-container">
                    <img id="avatar" class="avatar-preview" style="display:none;">
                  </div>
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



 <script>
   const upload = document.getElementById('upload');
   const avatar = document.getElementById('avatar');

   upload.addEventListener('change', function () {
     const file = this.files[0];
     if (!file) return;

     // Verificar que el archivo sea JPG o PNG
     const validTypes = ['image/jpeg', 'image/png'];
     if (!validTypes.includes(file.type)) {
       alert('Por favor, selecciona una imagen JPG o PNG.');
       return;
     }

     const reader = new FileReader();
     reader.onload = function (e) {
       const img = new Image();
       img.onload = function () {
         const canvas = document.createElement('canvas');
         const maxSize = 150;
         canvas.width = maxSize;
         canvas.height = maxSize;
         const ctx = canvas.getContext('2d');

         // Redibujar imagen reducida
         ctx.drawImage(img, 0, 0, maxSize, maxSize);

         // Convertir a base64 JPEG (más liviano que PNG)
         const compressed = canvas.toDataURL('image/jpeg', 0.7); // calidad 70%
         avatar.src = compressed;
         avatar.style.display = 'block';
       };
       img.src = e.target.result;
     };
     reader.readAsDataURL(file);
   });
 </script>
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
        url: "/BuscarEmpleadoB",
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

   function accionBtnEditar(id,nivel_id,cargo_id,tipo_empleado,nombre,apellido_p,apellido_m,sexo,direccion,telefono,correo_electronico){
     document.getElementById('id').value = id;
     document.getElementById('id_nivel').value = nivel_id;
     document.getElementById('id_cargo').value = cargo_id;
     document.getElementById('empleado').value = tipo_empleado;
     document.getElementById('nombre').value = nombre;
     document.getElementById('apellido_p').value = apellido_p;
     document.getElementById('apellido_m').value = apellido_m;
     document.getElementById('sexo').value = sexo;
     document.getElementById('direccion').value = direccion;
     document.getElementById('telefono').value = telefono;
     document.getElementById('gmail').value = correo_electronico;

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
     var id_nivel = document.getElementById("id_nivel").value;
     var id_cargo = document.getElementById("id_cargo").value;
     var empleado = document.getElementById("empleado").value;
     var nombre = document.getElementById("nombre").value;
     var apellido_p = document.getElementById("apellido_p").value;
     var apellido_m = document.getElementById("apellido_m").value;
     var sexo = document.getElementById("sexo").value;
     var direccion = document.getElementById("direccion").value;
     var telefono = document.getElementById("telefono").value;
     var gmail = document.getElementById("gmail").value;
     var file = document.getElementById("upload");
     registrarDatos(id,id_nivel,id_cargo,empleado,nombre,apellido_p,apellido_m,sexo,direccion,telefono,gmail,file);

   }

   function registrarDatos(id,id_nivel,id_cargo,empleado,nombre,apellido_p,apellido_m,sexo,direccion,telefono,gmail,file){
     var datos = new FormData(); // Crear un objeto FormData vacío
      datos.append("id",id);
      datos.append("id_nivel",id_nivel);
       datos.append("id_cargo",id_cargo);
       datos.append("empleado",empleado);
       datos.append("nombre",nombre);
       datos.append("apellido_p",apellido_p);
       datos.append("apellido_m",apellido_m);
       datos.append("sexo",sexo);
       datos.append("direccion",direccion);
       datos.append("telefono",telefono);
       datos.append("gmail",gmail);
       if (file.files.length > 0) {
         datos.append("file", file.files[0]); // Validación opcional de archivo
       }
      $.ajax({
       url: "/registrarDatosEmpleado",
       type: "POST",
       data: datos,
       contentType: false, // Deshabilitar la codificación de tipo MIME
       processData: false, // Deshabilitar la codificación de datos
       success: function(data) {
         data = $.trim(data);
         console.log(data);
         if(data == "correcto"){
           alert("accion realizada con exito");
        }else{
          console.log(data);
           alert("ocurio un error al insertar datos");
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
         location.href="/empleado";
           $('#ModalRegistro').modal('hide');
       }, 1500);
     }
   }



      $(document).ready(function() {
        $('#cargo').select2({
          theme: "bootstrap-5",
          dropdownParent: $('#ModalRegistro'),
          placeholder: "Seleccione cargo",
          width: '100%',

          ajax: {
            url: "/buscandoCargoNuevo",
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
                    id: item.id_cargo,
                    text: item.cargo_empleado+" - "+item.nivel_empleado,
                    id_nivel: item.nivel_id
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
          $("#id_nivel").val(selectedData.id_nivel);
          $("#id_cargo").val(selectedData.id);
        });
        $('.select2-container .select2-selection--single').css({
          'border': '1px solid #ced4da',
          'border-radius': '.375rem',
        });
      });
</script>
