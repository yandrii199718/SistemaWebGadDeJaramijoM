<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sedes extends Migration
{
	public function up()
	{
		$this->forge->addField([
						'id_sede'          => [
										'type'           => 'INT',
										'constraint'     => 5,
										'unsigned'       => true,
										'auto_increment' => true,
						],
						'nombre_sede'       => [
										'type'       => 'VARCHAR',
										'constraint' => '100',
						],
						'direccion'       => [
										'type'       => 'VARCHAR',
										'constraint' => '100'
						],
						'imagen_sede'       => [
										'type'       => 'VARCHAR',
										'constraint' => '255',
										'default' => 'no_image.jpg'
						]
		]);
		$this->forge->addKey('id_sede', true);

		$this->forge->createTable('sedes');
	}

	public function down()
	{
		$this->forge->dropTable('sedes');
	}
}
