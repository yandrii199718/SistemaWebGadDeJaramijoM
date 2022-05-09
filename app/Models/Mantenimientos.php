<?php

namespace App\Models;

use CodeIgniter\Model;

class Mantenimientos extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'mantenimientos';
	protected $primaryKey           = 'id_mantenimiento';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['idequipo','fecha_operacion',
																		'fecha_mantenimiento', 'frecuencia','cantidad_mantenimiento',
																		'tipo_mantenimiento','horas_uso','periodo_garantia','estado_alerta'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [
		'idequipo'   => 'required|numeric|max_length[10]',
		'actividad'   => 'required',
		'fecha_operacion'   => 'required|valid_date',
		'fecha_mantenimiento'   => 'required|valid_date',
		'frecuencia'   => 'required|numeric',
		'cantidad_mantenimiento' 	=> 'required|numeric',
		'tipo_mantenimiento'   => 'required',
		'horas_uso'   => 'required|numeric'
	];
	protected $validationMessages   = [
		'idequipo' => [
			'required' => 'Campo equipo es requerido',
			'numeric' => 'Campo equipo solo puede contener numeros',
			'max_length' => 'Campo equipo solo puede contener un maximo de 10 caracteres'
		]
	];
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


	public function getMantenimiento($where = null, $idsede = null){
		$db = db_connect();
    $sql = "select mantenimientos.*, equipos.nombre_equipo, equipos.codigo as codigo_equipo, usuarios.nombres, equipos.sbn, sedes.nombre_sede
			from mantenimientos
			inner join equipos on mantenimientos.idequipo = equipos.id_equipo
			inner join sedes on sedes.id_sede=equipos.idsede
			inner join usuarios on usuarios.idsede = sedes.id_sede ";
			if($idsede != null){
				$sql .= "where equipos.idsede = ".$idsede." ORDER BY mantenimientos.id_mantenimiento DESC ";
			}
		else if($where != null && !is_array($where)){
			$sql .= " where mantenimientos.id_mantenimiento = ".$where." ORDER BY mantenimientos.id_mantenimiento DESC ";
		} else if ( is_array($where) ){
			$sql .= " where mantenimientos.".key($where)." = \"".$where[key($where)]."\"  ORDER BY mantenimientos.id_mantenimiento DESC ";
		} else {
			$sql .= " ORDER BY mantenimientos.id_mantenimiento DESC ";
		}

    $query = $db->query($sql)->getResultArray();
    return $query;
	}

	//funcion para consultar la cantidad de mantenimientos preventivos y correctivos
	public function amountMantenimiento($tipo){
		$db = \Config\Database::connect();
		$query = $db->table('mantenimientos');
		$query->select('count(id_mantenimiento) as amount');
		$query->where('tipo_mantenimiento', $tipo);
		$respuesta = $query->get()->getResultArray();
		if(count($respuesta) != 0){
			if($respuesta[0]['amount'] != 0){
				return (int)$respuesta[0]['amount'];
			}
		}

		return 0;
	}

}
