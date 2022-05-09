<?php

function getCargo(){
  $db = \Config\Database::connect();
  $builder = $db->table('cargos');
  $builder->select('*');
  $cargo = $builder->get()->getResultArray();
  return $cargo;
}

function getArea(){
  $db = \Config\Database::connect();
  $builder = $db->table('areas');
  $builder->select('*');
  $respuesta = $builder->get()->getResultArray();
  return $respuesta;
}

function getSedess(){
  $db = \Config\Database::connect();
  $builder = $db->table('sedes');
  $builder->select('*');
  $respuesta = $builder->get()->getResultArray();
  return $respuesta;
}

function getSedes(){
  $db = \Config\Database::connect();
  $sql = "select sedes.*, usuarios.id_usuario from sedes left join usuarios on sedes.id_sede = usuarios.idsede ORDER BY usuarios.id_usuario ASC ";
  $respuesta = $db->query($sql)->getResultArray();
  return $respuesta;
}

function getMarcas(){
  $db = \Config\Database::connect();
  $builder = $db->table('marcas');
  $builder->select('*');
  $respuesta = $builder->get()->getResultArray();
  return $respuesta;
}

function getEquipos(){
  $db = \Config\Database::connect();
  $builder = $db->table('equipos');
  $builder->select('id_equipo, nombre_equipo');
  $respuesta = $builder->get()->getResultArray();
  return $respuesta;
}

function getUsuarios(){
  $db = \Config\Database::connect();
  $builder = $db->table('usuarios');
  $builder->select('id_usuario, nombres');
  $respuesta = $builder->get()->getResultArray();
  return $respuesta;
}

function getConfiguracion(){
  $db = \Config\Database::connect();
  $builder = $db->table('configuracion');
  $respuesta = $builder->get()->getResultArray();
  return $respuesta;
}

function cambiarEstadoVencido(){
  $db = \Config\Database::connect();
  //select id_cronograma from cronograma_mantenimientos where fecha_cronograma < now() and estadomantenimiento = 1
  $builder = $db->table('cronograma_mantenimientos');
  $builder->select('id_cronograma');
  $builder->where('fecha_cronograma < now() and estadomantenimiento = 1');
  $respuesta = $builder->get()->getResultArray();

  //realizar el cambio de estado
  if($respuesta){
    foreach($respuesta as $key => $value){
      $id = $value['id_cronograma'];
      $db = db_connect();
        //$sql = "select id, titulo, autor, costo, pub_descargas from publicaciones";
        $sql = "update cronograma_mantenimientos set estadomantenimiento = 2 where id_cronograma = ".$id;
        $query = $db->query($sql);
    }
  }

}





 ?>
