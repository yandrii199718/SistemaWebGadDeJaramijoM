<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Herramientas extends Migration
{
	public function up()
	{
					$this->forge->addField([
									'id_herramienta'          => [
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
									'nombre_herramienta'       => [
													'type'       => 'VARCHAR',
													'constraint' => '100',
									],
									'imagen'       => [
													'type'       => 'VARCHAR',
													'constraint' => '100',
													'null' 			=> true,
									],
									'observacion'       => [
													'type'       => 'TEXT',
													'constraint' => '255',
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
					$this->forge->addKey('id_herramienta', true);

					$this->forge->addForeignKey('idmarca', 'marcas', 'id_marca');
						$this->forge->addForeignKey('idarea', 'areas', 'id_area');
							$this->forge->addForeignKey('idsede', 'sedes', 'id_sede');

					$this->forge->createTable('herramientas');
	}

	public function down()
	{
					$this->forge->dropTable('herramientas');
	}
}
