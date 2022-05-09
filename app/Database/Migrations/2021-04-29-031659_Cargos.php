<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cargos extends Migration
{
	public function up()
	{
					$this->forge->addField([
									'id_cargo'          => [
													'type'           => 'INT',
													'constraint'     => 5,
													'unsigned'       => true,
													'auto_increment' => true,
									],
									'nombre_cargo'       => [
													'type'       => 'VARCHAR',
													'constraint' => '100',
									]
					]);
					$this->forge->addKey('id_cargo', true);

					$this->forge->createTable('cargos');
	}

	public function down()
	{
					$this->forge->dropTable('cargos');
	}
}
