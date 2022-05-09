<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Configuracion extends Seeder
{
	public function run()
	{

		$data = [
				 'ruc' => '12332233',
				 'razon_social' => 'INVERSIONES PEREZ SAC.',
				 'fecha_creacion' => '2021-05-17',
				 'fecha_inicio' => '2021-05-17',
				 'condicion' => 'ACTIVO',
				 'estado' => 'ACTIVO',
				 'direccion' => 'Jarin',
				 'logo' => 'no_image.jpg'
		 ];


		 // Using Query Builder
		 $this->db->table('configuracion')->insert($data);
	}
}
