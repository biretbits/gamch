<?php
require '../modelo/usuario.php';
require '../modelo/chat.php';
require "sesion.controlador.php";
$ins=new sesionControlador();
$ins->StarSession();
//si esto esta vacio no puede ingresar nadies directamente no s llevara index
/*if(isset($_SESSION["tipo_usuario"])==""){
    $ins->Redireccionar_inicio();
}*/
class TodoControlador{
  public function actualizarAno(){
    $u = new Usuario();
    $re = $u->cambiaraNoLaNotificacion("no");
  }
  public function ValidarAdminSiEstaActivo(){
    $u = new Usuario();
    $resul = $u->seleccionarAdminInicioSesion();
    if($resul!=''){
      if(mysqli_num_rows($resul)>0){
        $f = mysqli_fetch_array($resul);
        if($f["configControlAcceso"]=='si'){//si es igual a si entonces verifiamos el contro de acceso
          if($f["control_acceso"]=='desactivo'){
            if($f["notificacionEjecutar"]=='si')
            {
              //$re = $u->cambiaraNoLaNotificacion("no");//esta funcion permite ejecutar si o no la notificacion en este caso se actualizara por el no
              echo "desactivo";

            } else{
              echo "activo";
            }
          }else {
            echo "activo";
          }
        }else{
          echo "activo";
        }
      }else{
        echo "error";
      }
    }else{
      echo "error";
    }
  }
  public function MensajeUsuario($mensaje){
    $ch = new Chat();
    $resul = $ch->BuscarRespuesta();
		if($resul!=''){
      if(mysqli_num_rows($resul)>0){
				$vv = $this->GuardarEnArray($resul);
				$vecConsulta = $vv["consultas"];
				$vecRespuesta = $vv["respuestas"];
				//aplicando el coseno de similitud
				$totalConsulta = count($vecConsulta);
				$terminos = $this->SepararEnTerminos($vecConsulta);
				$terminoUsuario = $this->preprocess($mensaje);
				$df = $this->calcularELdf($terminos,$terminoUsuario);
				$tfidConsulta = $this->calcualarTFI($terminos,$df,$totalConsulta);
				$tfidUsuario = $this->calcularTFIusuario($terminoUsuario,$df,$totalConsulta);
				$resultadoCos = $this->CalcularCoseno($tfidConsulta,$tfidUsuario);
				$maxSimilar = max($resultadoCos);
				$posicion = array_search($maxSimilar, $resultadoCos);
				/*echo "La pregunta del usuario es más similar al documento: \n";
				echo $vecConsulta[$posicion] . "\n";
				echo "Con una similitud de coseno de: " . $vecRespuesta[$posicion] . "\n";
				*/
				echo $vecRespuesta[$posicion];
      }else{
        echo "Lo siento no tengo una respuesta para su consulta";
      }
    }else{
      echo "Lo siento no tengo una respuesta para su consulta";
    }
  }

	function GuardarEnArray($resul){
		$vec = array();
		$vecId = array();
		while($fi = mysqli_fetch_array($resul)){
			$vec[]=$fi["consulta"];
			$vecRes[]=$fi["respuesta_consulta"];
		}
		return array('consultas' => $vec, 'respuestas' => $vecRes);
	}

// Preprocesar los documentos y la pregunta (convertir a minúsculas y dividir en palabras) y se hace un conteo de cada palabra cuantas veces aparece
function preprocess($text) {
    return array_count_values(explode(" ", strtolower($this->removeAccents($text))));
}

function SepararEnTerminos($documents){
	$terms = [];
	foreach ($documents as $doc) {
	    $terms[] = $this->preprocess($doc);
	}
	return $terms;
}

// Calcular el DF (Document Frequency)
function calcularELdf($terms,$userTerms){
	$df = [];
	foreach ($terms as $termCount) {
	    foreach ($termCount as $term => $count) {
	        if (isset($df[$term])) {
	            $df[$term] += 1;
	        } else {
	            $df[$term] = 1;
	        }
	    }
	}
	foreach ($userTerms as $term => $count) {
	    if (!isset($df[$term])) {
	        $df[$term] = 1;
	    }
	}
	return $df;
}

// Calcular TF-IDF para cada documento y para la pregunta del usuario
function calculateTfidf($termCount, $df, $totalDocuments) {
    $tfidf = [];
    foreach ($termCount as $term => $tf) {
        $idf = log($totalDocuments / $df[$term]);
        $tfidf[$term] = $tf * $idf;
    }
    return $tfidf;
}

function calcualarTFI($terms,$df,$totalDocuments){
	$tfidfDocuments = [];
	foreach ($terms as $termCount) {
	    $tfidfDocuments[] = $this->calculateTfidf($termCount, $df, $totalDocuments);
	}
	return $tfidfDocuments;
}
function calcularTFIusuario($userTerms,$df,$totalDocuments){
	$tfidfUser = $this->calculateTfidf($userTerms, $df, $totalDocuments);
	return $tfidfUser;
}
function CalcularCoseno($tfidfDocuments,$tfidfUser){
	$similarities = [];
	foreach ($tfidfDocuments as $index => $tfidfDoc) {
	    $similarities[$index] = $this->cosineSimilarity($tfidfUser, $tfidfDoc);
	}
	return $similarities;
}
// Función para calcular la similitud de coseno entre dos vectores
function cosineSimilarity($vectorA, $vectorB) {
    $dotProduct = 0;
    $magnitudeA = 0;
    $magnitudeB = 0;

    foreach ($vectorA as $term => $weightA) {
        $weightB = isset($vectorB[$term]) ? $vectorB[$term] : 0;
        $dotProduct += $weightA * $weightB;
        $magnitudeA += $weightA * $weightA;
    }

    foreach ($vectorB as $weightB) {
        $magnitudeB += $weightB * $weightB;
    }

    if ($magnitudeA == 0 || $magnitudeB == 0) {
        return 0;
    }

    return $dotProduct / (sqrt($magnitudeA) * sqrt($magnitudeB));
}


function removeAccents($text) {
  $acentos = [
      'á' => 'a', 'Á' => 'A',
      'é' => 'e', 'É' => 'E',
      'í' => 'i', 'Í' => 'I',
      'ó' => 'o', 'Ó' => 'O',
      'ú' => 'u', 'Ú' => 'U',
      'ü' => 'u', 'Ü' => 'U',
      'ñ' => 'ñ', 'Ñ' => 'ñ'
  ];
  // Reemplaza cada carácter acentuado con su versión sin tilde
  $text = strtr($text, $acentos);
  return $text;
}
}
$uc=new TodoControlador();
if(isset($_GET["accion"]) && $_GET["accion"]=="validarAdmin"){
  $uc->ValidarAdminSiEstaActivo();
}

if(isset($_GET["accion"]) && $_GET["accion"]=="msu"){
  $uc->MensajeUsuario($_POST["mensaje"]);
}

if(isset($_GET["accion"]) && $_GET["accion"]=="acno"){
  $uc->actualizarAno($_POST["si"]);
}


 ?>
