<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Configuracion extends Migration
{
	public function up()
	{
		$this->forge->addField([
						'id_configuracion'       => [
										'type'           => 'INT',
										'constraint'     => 5,
										'auto_increment' => true,
						],
						'ruc'       => [
										'type'       => 'VARCHAR',
										'constraint' => '15',
						],
						'razon_social'       => [
										'type'       => 'VARCHAR',
										'constraint' => '200',
						],
						'fecha_creacion'       => [
										'type'       => 'DATE',
						],
						'fecha_inicio'       => [
										'type'       => 'DATE',
						],
						'condicion'       => [
										'type'       => 'VARCHAR',
										'constraint' => '30',
						],
						'estado'       => [
										'type'       => 'VARCHAR',
										'constraint' => '30',
						],
						'direccion'       => [
										'type'       => 'VARCHAR',
										'constraint' => '100',
						],
						'logo'       => [
										'type'       => 'VARCHAR',
										'constraint' => '200',
						]
		]);
		$this->forge->addKey('id_configuracion', true);

		$this->forge->createTable('configuracion');
	}

	public function down()
	{
			$this->forge->dropTable('configuracion');
	}
}
