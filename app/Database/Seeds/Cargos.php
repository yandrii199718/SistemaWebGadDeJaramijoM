<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Cargos extends Seeder
{
	public function run()
	{
		$data = [
				 'nombre_cargo' => 'ADMINISTRADOR'
		 ];


		 // Using Query Builder
		 $this->db->table('cargos')->insert($data);


		 //realizo otro registro
		 $data = [
 				 'nombre_cargo' => 'EMPLEADO'
 		 ];

		 $this->db->table('cargos')->insert($data);
	}
}
