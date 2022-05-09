<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Marcas extends Migration
{
	public function up()
	{
					$this->forge->addField([
									'id_marca'          => [
													'type'           => 'INT',
													'constraint'     => 5,
													'unsigned'       => true,
													'auto_increment' => true,
									],
									'nombre_marca'       => [
													'type'       => 'VARCHAR',
													'constraint' => '100',
									]
					]);
					$this->forge->addKey('id_marca', true);

					$this->forge->createTable('marcas');
	}

	public function down()
	{
					$this->forge->dropTable('marcas');
	}
}
