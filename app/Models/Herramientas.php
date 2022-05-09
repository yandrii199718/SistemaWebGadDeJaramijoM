<?php

namespace App\Models;

use CodeIgniter\Model;

class Herramientas extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'herramientas';
	protected $primaryKey           = 'id_herramienta';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['sbn','codigo','nombre_herramienta','imagen','observacion','idmarca','idarea','idsede'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	public function getHerramientas($id = null, $idsede = null){
		$db = db_connect();
		$sql = "select herramientas.*, marcas.nombre_marca, areas.nombre_area, sedes.nombre_sede, sedes.direccion
			from herramientas
			inner join marcas on herramientas.idmarca = marcas.id_marca
			inner join areas on herramientas.idarea = areas.id_area
			inner join sedes on herramientas.idsede = sedes.id_sede ";
			if($idsede != null){
				$sql .= "where sedes.id_sede = ".$idsede;
			}
			else if($id != null){
			$sql .= "where herramientas.id_herramienta = ".$id;
		}
		$query = $db->query($sql)->getResultArray();
		return $query;
	}
}
