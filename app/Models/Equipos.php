<?php

namespace App\Models;

use CodeIgniter\Model;

class Equipos extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'equipos';
	protected $primaryKey           = 'id_equipo';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['sbn','codigo','nombre_equipo','modelo','manual','imagen','observacion','idmarca','idarea','idsede'];

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


	public function getEquipos($id = null, $idsede = null){
		$db = db_connect();
		$sql = "select equipos.*, marcas.nombre_marca, areas.nombre_area, sedes.nombre_sede, sedes.direccion
			from equipos
			inner join marcas on equipos.idmarca = marcas.id_marca
			inner join areas on equipos.idarea = areas.id_area
			inner join sedes on equipos.idsede = sedes.id_sede ";
		if($idsede != null){
			$sql .= "where sedes.id_sede = ".$idsede;
		}
		else if($id != null){
			$sql .= "where equipos.id_equipo = ".$id;
		}
		$query = $db->query($sql)->getResultArray();
		return $query;
	}

	public function getEquipoFiltro($where = null){
		$db = db_connect();
		$sql = "SELECT mantenimientos.id_mantenimiento, mantenimientos.fecha_operacion, mantenimientos.fecha_mantenimiento,mantenimientos.frecuencia,mantenimientos.periodo_garantia, mantenimientos.estado_alerta, mantenimientos.tipo_mantenimiento, equipos.*, sedes.nombre_sede, marcas.nombre_marca
		FROM equipos INNER JOIN mantenimientos on equipos.id_equipo=mantenimientos.idequipo
		inner join sedes on sedes.id_sede = equipos.idsede
		inner join marcas on marcas.id_marca = equipos.idmarca ";

		//select id_mantenimiento, actividad from equipos inner join mantenimientos on equipos.id_equipo=mantenimientos.idequipo where mantenimientos.tipo_mantenimiento="PREVENTIVO" and equipos.codigo = "001" and idarea = 1
		if($where != null && !is_array($where)){
			$sql .= " WHERE mantenimientos.idusuario = ".$where;
		} else if ( is_array($where) ){

			if(count($where) == 1){
				$sql .= " where ".key($where)." = \"".$where[key($where)]."\" ";
			}
			else if(count($where) > 1){

				$index = 1;
				foreach ($where as $key => $value) {
					if($index == count($where)){
						$sql .= " ".$key." = \"".$value."\" ";
					}else {
						if($index == 1){
							$sql .= " where ".$key." = \"".$value."\" and ";
						} else {
							$sql .= " ".$key." = \"".$value."\" and ";
						}
					}

					$index++;

				}

			}

		}

		$query = $db->query($sql)->getResultArray();
		return $query;
	}

	//funcion para consultar todos los equipos con un left join y validar los que no estan asociados a un equipo.
	public function equiposDetenidos(){
		//contar que registros tiene un equipo
		$db = \Config\Database::connect();
		$query = $db->table('equipos');
		$query->select('equipos.id_equipo, mantenimientos.idequipo');
		$query->join('mantenimientos', 'mantenimientos.idequipo = id_equipo', 'left');
		$respuesta = $query->get()->getResultArray();

		$count = 0;
		if(count($respuesta) != 0){

			foreach($respuesta as $datos){
				if($datos['idequipo'] == null){
					$count++;
				}
			}
		}
		return $count;
	}
}
