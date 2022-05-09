<?php

namespace App\Models;

use CodeIgniter\Model;

class Provedores extends Model
{
	protected $table                = 'provedores';
	protected $primaryKey           = 'id_provedor';
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;

	protected $allowedFields = ['ruc','razon_social','rubro','direccion','telefono','contacto','celular','email','tipo'];

	// Dates
	protected $useTimestamps        = false;

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;


}
