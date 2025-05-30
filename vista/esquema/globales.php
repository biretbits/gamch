<?php
function mesEnTexto($d) {
  $d = intval($d);
   // fecha en formato AAAA-MM-DD
  $numMonth =  ($d); // obtener el número de mes (sin ceros iniciales)
  $MonthEsp = array(
      1 => "enero",
      2 => "febrero",
      3 => "marzo",
      4 => "abril",
      5 => "mayo",
      6 => "junio",
      7 => "julio",
      8 => "agosto",
      9 => "septiembre",
      10 => "octubre",
      11 => "noviembre",
      12 => "diciembre"
  );
  return $MonthEsp[$numMonth]; // obtener el nombre del mes en español
}

function convertirMayus($texto){
  $capitalizedText = ucwords($texto);
  return $capitalizedText;
}

function mayuscula($texto){
  $textoMayuscula = strtoupper($texto);
  return $textoMayuscula;
}

function fechaAnoMesDia($fecha){
  $timestamp = strtotime($fecha);

  // Arreglo con los nombres de los meses en español
  $meses = [
      1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril', 5 => 'mayo', 6 => 'junio',
      7 => 'julio', 8 => 'agosto', 9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre'
  ];

  // Obtener día, mes y año
  $dia = date('d', $timestamp);
  $mes = $meses[(int)date('m', $timestamp)];  // Convertir el mes a número
  $anio = date('Y', $timestamp);

  // Crear la fecha en formato textual
  $fechaTexto = "$dia de $mes de $anio";

  // Mostrar el resultado
  return $fechaTexto;
}
?>
