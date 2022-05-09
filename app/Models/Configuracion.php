<?php

namespace App\Models;

use CodeIgniter\Model;

class Configuracion extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'configuracion';
	protected $primaryKey           = 'id_configuracion';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['ruc', 'razon_social','fecha_creacion','fecha_inicio','condicion','estado','direccion','logo'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [
							'ruc' 		=> 'required|numeric',
							'razon_social'	=>	'required',
							'fecha_creacion'	=>	'required|date',
							'fecha_inicio'	=>	'required|date',
							'condicion'	=>	'required',
							'estado'	=>	'required',
							'direccion'	=>	'required',
							'logo'	=>	'required'
						];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;


}
