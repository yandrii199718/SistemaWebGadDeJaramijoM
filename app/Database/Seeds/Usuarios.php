<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Usuarios extends Seeder
{
	public function run()
	{
		$usuario = "admin";
		$password = password_hash('admin', PASSWORD_DEFAULT);

		$data = [
				 'usuario' => $usuario,
				 'password' => $password,
				 'nombres' => 'Admin',
				 'dni' => '12345678',
				 'telefono' => '3211232123',
				 'email' => 'admin@mantenimiento.com',
				 'estado' => 0,
				 'idcargo' => 1,
				 'idarea' => 1,
				 'idsede' => 1,
				 'imagen' => 'no_image.jpg'
		 ];


		 // Using Query Builder
		 $this->db->table('usuarios')->insert($data);

		 $data = [
 				 'usuario' => 'fredy',
 				 'password' => $password,
 				 'nombres' => 'Fredy yela',
 				 'dni' => '12323332',
 				 'telefono' => '44343434',
 				 'email' => 'admin@mantenimiento.com',
 				 'estado' => 0,
 				 'idcargo' => 2,
 				 'idarea' => 1,
 				 'idsede' => 2,
 				 'imagen' => 'no_image.jpg'
 		 ];


 		 // Using Query Builder
 		 $this->db->table('usuarios')->insert($data);
	}
}
