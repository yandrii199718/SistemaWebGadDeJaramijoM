<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Areas extends Seeder
{
	public function run()
	{

		$data = [
				 'nombre_area' => 'Informatica'
		 ];


		 // Using Query Builder
		 $this->db->table('areas')->insert($data);
	}
}
