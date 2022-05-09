<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CronogramaNamtenimiento extends Migration
{
	public function up()
	{
		$this->forge->addField([
						'id_cronograma'          => [
										'type'           => 'INT',
										'constraint'     => 5,
										'unsigned'       => true,
										'auto_increment' => true,
						],
						'idmantenimiento'       => [
										'type'       => 'INT',
										'constraint' => 5,
										'unsigned' => true,
						],
						'fecha_cronograma'       => [
										'type'       => 'DATETIME',
						],
						'year' 	=> 		[
								'type'	=>	'VARCHAR',
								'constraint' 	=> '4'
						],
						'month' 	=> 		[
								'type'	=>	'INT',
								'constraint' 	=> 2
						],
						'day' 	=> 		[
								'type'	=>	'INT',
								'constraint' 	=> '2'
						],
						'estadomantenimiento'       => [
										'type'       => 'INT',
										'constraint' => 1,
						]
		]);
		$this->forge->addKey('id_cronograma', true);

		$this->forge->addForeignKey('idmantenimiento', 'mantenimientos', 'id_mantenimiento', '', 'CASCADE');

		$this->forge->createTable('cronograma_mantenimientos');
	}

	public function down()
	{
		$this->forge->dropTable('cronograma_mantenimientos');
	}
}
