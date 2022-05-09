<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Areas extends Migration
{
	public function up()
	{
					$this->forge->addField([
									'id_area'          => [
													'type'           => 'INT',
													'constraint'     => 5,
													'unsigned'       => true,
													'auto_increment' => true,
									],
									'nombre_area'       => [
													'type'       => 'VARCHAR',
													'constraint' => '100',
									]
					]);
					$this->forge->addKey('id_area', true);

					$this->forge->createTable('areas');
	}

	public function down()
	{
					$this->forge->dropTable('areas');
	}
}
