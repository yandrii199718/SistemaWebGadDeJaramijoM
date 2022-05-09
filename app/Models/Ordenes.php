<?php

namespace App\Models;

use CodeIgniter\Model;

class Ordenes extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'ordenes';
	protected $primaryKey           = 'id_orden';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['idcronograma','fecha_registro','fecha_orden','nro_orden','costo','descripcion_servicio','repuestos_utilizados','hora_inicio','hora_final','horas_total','estado'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = 	[
		'idcronograma' 	=> 'required|numeric',
		'fecha_registro'		=> 'required|date',
		'fecha_orden' 		=> 'required|date',
		'nro_orden' 		=> 'required',
		'costo' 		=> 'required',
		'descripcion_servicio' 		=> 'required',
		'repuestos_utilizados' 		=> 'required',
		'hora_inicio'			=> 'required',
		'hora_final' 		=> 'required',
		'horas_total' 		=> 'required',
		'estado' 		=> 'required'
	];
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

	public function getOrden($where = null, $entidad = null){
		if($entidad == null){
			$entidad = "usuarios";
		}

		$db = db_connect();
		$sql = "select ordenes.*, areas.nombre_area, usuarios.nombres, mantenimientos.idequipo, marcas.nombre_marca
			from ordenes
			inner join cronograma_mantenimientos as cro on ordenes.idcronograma = cro.id_cronograma
			inner join mantenimientos on cro.idmantenimiento = mantenimientos.id_mantenimiento
			inner join equipos on equipos.id_equipo = mantenimientos.idequipo
			inner join sedes on sedes.id_sede = equipos.idsede
			inner join usuarios on usuarios.idsede = sedes.id_sede
			inner join areas on usuarios.idarea = areas.id_area
			inner join marcas on equipos.idmarca = marcas.id_marca ";
		if($where != null && !is_array($where)){
			$sql .= " where usuarios.id_usuario = ".$where;
		} else if ( is_array($where) ){
			$sql .= " where ".$entidad.".".key($where)." = \"".$where[key($where)]."\" ";
		}
//var_dump($sql);exit;
		$query = $db->query($sql)->getResultArray();
		return $query;
	}


	// consulta para el reposte
	public function getOrdenArray($where = null, $entidad = null){
		if($entidad == null){
			$entidad = "usuarios";
		}

		$db = db_connect();
		$sql = "select ordenes.*, areas.nombre_area, usuarios.nombres, mantenimientos.*, equipos.*,  marcas.nombre_marca, sedes.direccion as direccion_sede, sedes.imagen_sede
			from ordenes
			inner join cronograma_mantenimientos as cro on ordenes.idcronograma = cro.id_cronograma
			inner join mantenimientos on cro.idmantenimiento = mantenimientos.id_mantenimiento
			inner join equipos on equipos.id_equipo = mantenimientos.idequipo
			inner join sedes on sedes.id_sede = equipos.idsede
			inner join usuarios on usuarios.idsede = sedes.id_sede
			inner join areas on usuarios.idarea = areas.id_area
			inner join marcas on equipos.idmarca = marcas.id_marca ";
		if($where != null && !is_array($where)){
			$sql .= " where usuarios.id_usuario = ".$where;
		} else if ( is_array($where) ){

				if(count($where) == 1){
						$sql .= " where ordenes.id_orden  = \"".$where['id_orden']."\" ";
				}
				else if(count($where) == 2){

							$sql .= " where ordenes.id_orden = \"".$where['id_orden']."\" ";
							$sql .= " and usuarios.id_usuario = \"".$where['id_usuario']."\" ";

				}

			}

//var_dump($sql);exit;
		$query = $db->query($sql)->getResultArray();
		return $query;
	}


}
