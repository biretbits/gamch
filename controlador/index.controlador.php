<?php

require 'modelo/index.php';
class IndexControlador{
  public static function visualizarPrincipal(){
    $u = new Index();
    $resul = $u->SeleccionarNoticiasNuevas(0,5);
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
      $resul[] = array(
        'id' => 1,          // Insertar ID manualmente
        'titulo' => 'Challapata, por un municipio saludable, fuerte y con mente productiva', // Insertar nombre manualmente
        'descripcion' => 'Ninguna' // Insertar descripción manualmente
      );
      // Puedes agregar más entradas manuales aquí si lo deseas
      $resul[] = array(
          'id' => 2,
          'nombre' => 'Todo por Challapata',
          'descripcion' => 'Ninguna'
      );$resul[] = array(
          'id' => 3,
          'nombre' => 'Con mas Obras para un municipio más Fuerte.',
          'descripcion' => 'Ninguna'
      );
      $_SESSION["TITULOS"] = $resu;
    }
    require("vista/principal/principal.php");
  }
}


?>
