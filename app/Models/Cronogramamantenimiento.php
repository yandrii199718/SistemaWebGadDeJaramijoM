<?php

namespace App\Models;

use CodeIgniter\Model;

class Cronogramamantenimiento extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'cronograma_mantenimientos';
	protected $primaryKey           = 'id_cronograma';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['idmantenimiento','fecha_cronograma','year','month','day','estadomantenimiento'];

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


	//obtenemos todos los cronogramas por filtros
	public function getCronograma($where = null){
		$db = db_connect();

		$sql = "select cronograma_mantenimientos.*, mantenimientos.*, usuarios.nombres, cargos.nombre_cargo
			from cronograma_mantenimientos inner join
			mantenimientos on mantenimientos.id_mantenimiento = cronograma_mantenimientos.idmantenimiento
			inner join equipos on equipos.id_equipo = mantenimientos.idequipo
			inner join sedes on sedes.id_sede = equipos.idsede
			inner join usuarios on usuarios.idsede = sedes.id_sede
			inner join cargos on usuarios.idcargo = cargos.id_cargo ";
		if($where != null && !is_array($where)){
			$sql .= " where usuarios.id_usuario = ".$where;
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

	//obtener el cronograma con la orde
	public function getCronogramaOrden($where = null){
		$db = db_connect();
		$sql = "SELECT c.id_cronograma, c.idmantenimiento, c.fecha_cronograma, c.estadomantenimiento, o.nro_orden FROM cronograma_mantenimientos as c LEFT JOIN ordenes as o ON c.id_cronograma=o.idcronograma ";
		if($where != null && !is_array($where)){
			$sql .= " where c.id_cronograma = $id";
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

	// funcion para contar las actividades de calendario que existen segun condicion
	public function amountCronograma(){
		$db = \Config\Database::connect();
		$query = $db->table('cronograma_mantenimientos');
		$query->select('cronograma_mantenimientos.id_cronograma, ordenes.idcronograma');
		$query->join('ordenes', 'ordenes.idcronograma = id_cronograma', 'left');
		$respuesta = $query->get()->getResultArray();

		$total = 0;
		$pendientes = 0;
		$finalizados = 0;
		if(count($respuesta) != 0){
			foreach($respuesta as $datos){
				if($datos['idcronograma'] == null){
					$pendientes++;
				} else {
					$finalizados++;
				}
				$total++;
			}
		}

		$data = array(
			'total' => $total,
			'pendientes' => $pendientes,
			'finalizados' => $finalizados
		);

		return $data;
	}
}
