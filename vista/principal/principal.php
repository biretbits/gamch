<br><br><br><br>
<div class="container">
            <div class="row">
				<!--disabled-- nos sib=rbe para bloquear y solo mostrar no enviar por post-->
				<div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3
                    col-12">
				    <div class="modal-content" style='padding:20px 15px;'>
					<center>
					<h5 Style='color:gold;text-shadow: 2px 2px 2px black;'>Acceso</h5></center>
                    <center>
                    <img src="imagenes/logeo/loginnn.png"class="img-circle"  height='100' width='110'/>
					</center>
						<form method="POST">

							<div class='input-group'>
								<input class="form-control" style="color:black" type="text"  id="usuario" name ="usuario" placeholder=" Nombre usuario">
									<span class='input-group-addon' id='grupo_user'></span>
							</div>
							<span id="text_user"></span>
		           <br>

							<div class='input-group'>
								<input class="form-control" style="color:black" type='password' id="contrasena" name ="contrasena" placeholder="Contraseña"><br>

		         			<span class='input-group-addon' id='grupo_contrasena'></span>
							</div>
							<br>
							<span id="text_contrasena" style='width:auto;background-color:black'></span>

							<br>
							<input class="btn btn-primary"  type="button" style='padding:3px 3px'id="submit" value="Ingresar" onclick="VerificarDatos();">
							<br>
							<!--<a href="../index.php">Cancelar</a>
							<div id='ErrorUsuario'><strong>Error!</strong>Usuario No Encontrado</div>
							-->
							<center>
							<!--<a target="_blank" href="usuario.controler.php?accion=registrar"> <h6>Registrarse</h6></a>-->
							</center>
						</form>
						<br>
				</div>
					</div>
					</div>

<br>
<script type="text/javascript">
  function VerificarDatos(){
    var usuario = document.getElementById("usuario").value;
    var contrasena = document.getElementById("contrasena").value;

      var datos=new  FormData();
      datos.append("usuario",usuario);
      datos.append("contrasena",contrasena);
      $.ajax({
        type: "POST", //type of submit
        cache: false, //important or else you might get wrong data returned to you
        url: "../controlador/logeo.controlador.php?accion=very", //destination
        datatype: "html", //expected data format from process.php
        data: datos, //target your form's data and serialize for a POST
        contentType:false,
        processData:false,
        success: function(r){
          r=$.trim(r);
          alert(r);
          if(r == "admin"){
              location.href="../controlador/principal.controlador.php?accion=pp";
          }else if(r == "Medico"){
              location.href="../controlador/principal.controlador.php?accion=pp";
          }else{
            alert ("error");
          }


          //$("#respuesta").html(r);
        }
      });

  }
</script>

</div>






</body>
</html>




<style>
	body{
    background: url(imagenes/fondo/bosque.jpg) no-repeat center center fixed;
    background-size: cover;
}


.modal-content{
    background-color: rgba(255,255,225,0.6);
    opacity: .85;
    padding: 0 20px;
    box-shadow: 0px 0px 3px #848484;
}

.input-group input{
    height: 42px;
    font-size: 18px;
    border:0;
    border-radius: 5px;
}




</style>


<?php
//require_once "../view/footer.php";
?>
