<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Equipos extends Migration
{
	public function up()
	{
					$this->forge->addField([
									'id_equipo'          => [
													'type'           => 'INT',
													'constraint'     => 5,
													'unsigned'       => true,
													'auto_increment' => true,
									],
									'codigo'          => [
													'type'           => 'VARCHAR',
													'constraint'     => '20',
									],
									'sbn'       => [
													'type'       => 'VARCHAR',
													'constraint' => '20',
									],
									'nombre_equipo'       => [
													'type'       => 'VARCHAR',
													'constraint' => '100',
									],
									'modelo'       => [
													'type'       => 'VARCHAR',
													'constraint' => '100',
									],
									'manual'       => [
													'type'       => 'VARCHAR',
													'constraint' => '100',
													'null' 			=> true,
									],
									'imagen'       => [
													'type'       => 'VARCHAR',
													'constraint' => '100',
													'null' 			=> true,
									],
									'observacion'       => [
													'type'       => 'TEXT',
													'null' 			=> true,
									],
									'idmarca'       => [
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
													'unsigned' => true
									]
					]);
					$this->forge->addKey('id_equipo', true);

					$this->forge->addForeignKey('idmarca', 'marcas', 'id_marca');
						$this->forge->addForeignKey('idarea', 'areas', 'id_area');
							$this->forge->addForeignKey('idsede', 'sedes', 'id_sede');

					$this->forge->createTable('equipos');
	}

	public function down()
	{
					$this->forge->dropTable('equipos');
	}
}
