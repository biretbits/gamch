<?php
ob_end_clean();
// Iniciar el almacenamiento en búfer de salida
ob_start();

// Verificar que no haya salida antes de las cabeceras
// Generar el contenido del PDF aquí

// Ajustar las cabeceras
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="reporte.pdf"');

  include("../librerias/globales.php");
 //echo $fechai."fi   ".$fechaf."ff   ".$buscar."b   ".$pagina."p   ".$listarDeCuanto."ldc" ; ?>
<style media="screen">
.image {
    width: 105%;
    height: 95%;
  }
  .image-container {
    text-align: center;
  }
</style>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Report Box</title>
    <style media="screen">

    </style>
  </head>
  <body>
    <?php
    $fechai = date('Y-m-d');

     ?>

        <div style="clear:both;"></div>
        <?php
          if ($resul && count($resul) > 0)
          {
            $i = 0;
          $descripcion = "";
          $ruta = "";
          $nombre_imagen = "";
          foreach ($resul as $fi){
            $descripcion = $fi["descripcion"];
            $ruta = $fi["ruta_imagen"];
            $nombre_imagen = $fi["nombre_imagen"];
          }?>
          <div class="row">
            <div class="col-12">
              <h5 align='center'><?php echo $descripcion; ?></h5>
            </div>
            <div class="image-container">
              <?php
              $cdir = $ruta.$nombre_imagen;

              $c = "data:image/jpg;base64," . base64_encode(file_get_contents($cdir));
              ?>
              <img src="<?php echo $c; ?>" alt="No se encontro Imagen"  class="image">
            </div>
          </div>

    <?php } ?>
  </body>
</html>

<?php
//https://parzibyte.me/blog/2019/12/25/generar-pdf-php-dompdf/ 9:00pm a 11:30pm
//https://programmerclick.com/article/89841075890/
$html=ob_get_clean();
//$html = '<img src="data:image/svg+xml;base64,' . base64_encode($svg) . '" ...>';
//$html = file_get_contents(__DIR__ . '/hoja.php');
//echo $html;
//sudo apt-get install php7.0-mbstring
//apt-get install php7.2-xml

//require '../vendor/autoload.php';
require_once '../librerias/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

//use Dompdf\Options;//nueva
//$options=new Options();
//$options->setchroot(__DIR__);
//$options->set('isRemoteEnebled',TRUE);

$dompdf=new Dompdf();

//https://noviello.it/es/como-instalar-composer-en-ubuntu-20-04-lts/
$options=$dompdf->getOptions();
$options->set(array('isRemoteEnebled'=>true));
$dompdf->setOptions($options);
$options->setIsHtml5ParserEnabled(true);
//$dompdf->loadHtml($html);

$dompdf->loadHtml($html);
$dompdf->setPaper('letter');

$dompdf->render();
$type=false;
if(!isset($_GET["id"]))
  $type=false;
$dompdf->stream("archivo_.pdf",array("Attachment"=>$type));


?>
