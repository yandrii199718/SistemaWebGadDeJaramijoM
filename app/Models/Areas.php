<?php

namespace App\Models;

use CodeIgniter\Model;

class Areas extends Model
{
	protected $table                = 'areas';
	protected $primaryKey           = 'id_area';
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $allowedFields        = ['nombre_area'];

	// Dates
	protected $useTimestamps        = false;

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
}
