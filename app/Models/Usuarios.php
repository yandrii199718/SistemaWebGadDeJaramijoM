<?php

namespace App\Models;

use CodeIgniter\Model;

class Usuarios extends Model
{
	protected $table                = 'usuarios';
	protected $primaryKey           = 'id_usuario';
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;

	protected $allowedFields = ['usuario','password','dni','nombres','telefono','email','estado','idcargo','idarea','idsede', 'imagen'];

	// Dates
	protected $useTimestamps        = false;

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;

	public function getUsuario($where = null){
		$db = db_connect();
    $sql = "select usuarios.*, cargos.nombre_cargo, areas.nombre_area, sedes.nombre_sede, sedes.direccion
			from usuarios
			inner join cargos on usuarios.idcargo = cargos.id_cargo
			inner join areas on usuarios.idarea = areas.id_area
			inner join sedes on usuarios.idsede = sedes.id_sede ";
		if($where != null && !is_array($where)){
			$sql .= " where usuarios.id_usuario = ".$where;
		} else if ( is_array($where) ){
			$sql .= " where usuarios.".key($where)." = \"".$where[key($where)]."\" ";
		}

    $query = $db->query($sql)->getResultArray();
    return $query;
	}

	/*
	public function getUsuario($id = null, $usuario = null){
		$db = db_connect();
    $sql = "select usuarios.*, cargos.nombre_cargo, areas.nombre_area, sedes.nombre_sede, sedes.direccion
			from usuarios
			inner join cargos on usuarios.idcargo = cargos.id_cargo
			inner join areas on usuarios.idarea = areas.id_area
			inner join sedes on usuarios.idsede = sedes.id_sede ";
		if($id != null){
			$sql .= " where usuarios.id_usuario = ".$id;
		} else if ( $usuario != null ){
			$sql .= " where usuarios.usuario = \"".$usuario."\" ";
		}

    $query = $db->query($sql)->getResultArray();
    return $query;
	}
	 */

}
