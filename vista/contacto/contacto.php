<?php
require_once('vista/esquema/header.php');
?>
<div class="spacer bg-dark contact4">
    <!-- Row  -->
    <div class="row justify-content-center">
        <div class="col-md-6 contact-box text-center">
            <h1 class="title font-light text-white m-t-10">Contactanos</h1>
            <form  action="/contacts" method="POST">
                @csrf
              <div class="form-group">
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-mail" required="">
              </div>
              <div class="form-group">
                <input type="text" name="name" class="form-control" id="exampleInputPassword1" placeholder="Nombre" required="">
              </div>
              <div class="form-group">
                <input type="text" name="asunto" class="form-control" id="exampleInputPassword1" placeholder="Asunto" required="">
              </div>
              <div class="form-group">
                <textarea class="form-control" rows="4" name="mensaje" placeholder="Mensaje" required=""></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<?php
// Incluir el archivo footer.php desde la carpeta diseno
require_once('vista/esquema/footeruni.php');
?>
