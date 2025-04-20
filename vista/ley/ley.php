<?php
// Incluir el archivo header.php desde la carpeta diseno

require_once('vista/esquema/header.php');
?>
<br>
<div class="container ">
  <section class="align-items-stretch">
    <div class="d-flex flex-column justify-content-center align-items-center">
      <div class="col-12">
        <a href="#"style="padding: 3px;text-decoration:  none;border-radius: 2px;border-color:5px solid red;background-color:red;color:white;font-size:11px">Ley provincial</a>
          <h1 style="padding:2px;color:black;text-decoration:  none; font-family: 'Times New Roman', Times, serif;text-transform: uppercase;font-weight: bold;">  Ley municipal de la provincia eduardo abaroa del 2025</h1>
          <iframe src="<?php echo $ruta_dominio; ?>vista/pdfjs/web/viewer.html?file=<?php echo $ruta_dominio; ?>vista/DocumentosPDF/RPC2024.pdf" width="100%" height="800px"></iframe>


      </div>
  </div>
  </section>
</div>

<?php
// Incluir el archivo footer.php desde la carpeta diseno
require_once('vista/esquema/footeruni.php');
?>
