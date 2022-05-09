<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Sedes extends Seeder
{
	public function run()
	{
		$data = [
				 'nombre_sede' => 'Cite lima',
				 'direccion' => 'JR. LIMA 254'
		 ];


		 // Using Query Builder
		 $this->db->table('sedes')->insert($data);

		 $data = [
					'nombre_sede' => 'Cite Orito',
					'direccion' => 'JR. Bariio alameda'
			];


			// Using Query Builder
			$this->db->table('sedes')->insert($data);
	}
}
