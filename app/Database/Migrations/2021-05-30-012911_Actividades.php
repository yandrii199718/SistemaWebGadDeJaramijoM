<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Actividades extends Migration
{
	public function up()
	{
		$this->forge->addField([
						'idmantenimiento'       => [
										'type'           => 'INT',
										'constraint'     => 5,
										'unsigned'       => true,
						],
						'actividad'       => [
										'type'       => 'TEXT',
						]
		]);

		$this->forge->addForeignKey('idmantenimiento', 'mantenimientos', 'id_mantenimiento','','CASCADE');

		$this->forge->createTable('actividades');
	}

	public function down()
	{
			$this->forge->dropTable('actividades');
	}
}
