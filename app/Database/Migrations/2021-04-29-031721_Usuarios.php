<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Usuarios extends Migration
{
	public function up()
	{
					$this->forge->addField([
									'id_usuario'          => [
													'type'           => 'INT',
													'constraint'     => 5,
													'unsigned'       => true,
													'auto_increment' => true,
									],
									'usuario'       => [
													'type'       => 'VARCHAR',
													'constraint' => '30',
									],
									'password'       => [
													'type'       => 'VARCHAR',
													'constraint' => '200',
									],
									'nombres'       => [
													'type'       => 'VARCHAR',
													'constraint' => '200',
									],
									'dni'       => [
													'type'       => 'VARCHAR',
													'constraint' => '12',
									],
									'telefono'       => [
													'type'       => 'VARCHAR',
													'constraint' => '12',
									],
									'email'       => [
													'type'       => 'VARCHAR',
													'constraint' => '50',
									],
									'estado'       => [
													'type'       => 'INT',
													'constraint' => 1,
									],
									'idcargo'       => [
													'type'       => 'INT',
													'constraint' => 5,
													'unsigned' => true
									],
									'idarea'       => [
													'type'       => 'INT',
													'constraint' => 5,
													'unsigned' => true
									],
									'idsede'       => [
													'type'       => 'INT',
													'constraint' => 5,
													'unsigned' => true,
													'unique' => true
									],
									'imagen'       => [
													'type'       => 'VARCHAR',
													'constraint' => '100',
													'default' => 'no_image.jpg'
									]
					]);

					$this->forge->addKey('id_usuario', true);

					  $this->forge->addForeignKey('idcargo', 'cargos', 'id_cargo');
						  $this->forge->addForeignKey('idarea', 'areas', 'id_area');
							  $this->forge->addForeignKey('idsede', 'sedes', 'id_sede');

					$this->forge->createTable('usuarios');
	}

	public function down()
	{
					$this->forge->dropTable('usuarios');
	}

}
