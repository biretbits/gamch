<?php

require 'modelo/index.php';
class IndexControlador{
  public static function visualizarPrincipal(){
    $u = new Index();
    $resul = $u->SeleccionarNoticiasNuevas(0,5);
    $resulAlert = $u->SeleccionarNoticiasNuevas(0,2);
    $res = $u->SeleccionarNoticiasNuevas(0,3);
    if ($res->num_rows > 0) {
        // Guardar los resultados en un array
        $resu = array();
        while ($fila = $res->fetch_assoc()) {
            $resu[] = $fila;  // Agregar cada fila al array
        }
        // Guardar el array en la sesión
        $_SESSION['TITULOS'] = $resu;
    } else {
      $resu[] = array(
        'id' => 1,          // Insertar ID manualmente
        'titulo' => 'Challapata, por un municipio saludable, fuerte y con mente productiva', // Insertar nombre manualmente
        'descripcion' => 'Ninguna' // Insertar descripción manualmente
      );
      // Puedes agregar más entradas manuales aquí si lo deseas
      $resu[] = array(
          'id' => 2,
          'titulo' => 'Todo por Challapata',
          'descripcion' => 'Ninguna'
      );$resu[] = array(
          'id' => 3,
          'titulo' => 'Con mas Obras para un municipio más Fuerte.',
          'descripcion' => 'Ninguna'
      );
      $_SESSION["TITULOS"] = $resu;
    }
    $resulNo = $u->SeleccionarNoticiasDeDosDias(5);//seleccionar noticias pasadas
    require("vista/principal/principal.php");
  }
}


?>
