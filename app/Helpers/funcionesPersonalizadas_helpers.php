<?php
function eliminarDirectorioArchivos($url){
  if(file_exists($url)){
    $files = glob($url.'/*'); //obtenemos todos los nombres de los ficheros
    foreach($files as $file){
        if(is_file($file))
        unlink($file); //elimino el fichero
    }
    rmdir($url);
    return 'Directorio eliminado';

  } else {
    return 'error al eliminar el directorio';
  }

}

//funcion para subir un archivo o Imagen
function uploadFiles($imagefile, $url){
  if ($imagefile->isValid() && ! $imagefile->hasMoved()) {

      $imagen = $imagefile->getName(); // getRandomName() nombre aleatorio de imagen

      eliminarDirectorioArchivos($url);

      $imagefile->move($url.'/', $imagen);

      return $imagen;
  } else {
    return null;
  }
}

//funcion para obtener la cantidad de horas transcurridas
function calcularHoras($horaInicio, $horaFin){
  $newHour = 0;
  $horaInicio = explode(':',$horaInicio);
  $horaFin = explode(':',$horaFin);

  if(is_array($horaInicio) && is_array($horaFin)){
    $hour = $horaFin[0] - $horaInicio[0];
    $minute	= $horaFin[1] - $horaInicio[1];

    if($hour < 0)
      $hour = $hour * -1;

    if($minute < 0)
      $minute = $minute * -1;

    $newHour = $hour.':'.$minute;
  }

  return $newHour;
}

// calcular cual fecha es mayor
function fechaVencida($fechaVence){
  $fechaActual = strtotime(date('Y-m-d'));
  $fechaVence = strtotime(date($fechaVence));
  if($fechaVence < $fechaActual){
    return "Vencido";
  } else {
    return "Activo";
  }
}
/*  $fechaActual = strtotime(date('Y-m-d'));
  if($fechaActual == "")
    $fechavencimiento = $fechaActual;
  $fechaVence = strtotime(date($fechaVence));
  if($fechaVence < $fechavencimiento){
    return "Vencido";
  } else {
    return "Activo";
  }*/

// funcion para mostrar el nombre del mes
function nombreMes($fecha){
  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
  $fecha = date('n', strtotime($fecha));
  return $meses[$fecha - 1];
}

// funcion para mostrar la fecha con el nombre del mes
function nuevaFecha($fecha){
  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
  $mes = date('n', strtotime($fecha));
  $day = date('d', strtotime($fecha));
  $year = date('Y', strtotime($fecha));
  return $day.'-'.$meses[$mes - 1].'-'.$year;
}


 ?>
