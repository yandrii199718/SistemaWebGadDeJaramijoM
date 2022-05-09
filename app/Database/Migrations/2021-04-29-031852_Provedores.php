<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Provedores extends Migration
{
	public function up()
	{
					$this->forge->addField([
									'id_provedor'          => [
													'type'           => 'INT',
													'constraint'     => 5,
													'unsigned'       => true,
													'auto_increment' => true,
									],
									'ruc'       => [
													'type'       => 'VARCHAR',
													'constraint' => '10',
									],
									'razon_social'       => [
													'type'       => 'VARCHAR',
													'constraint' => '100',
									],
									'rubro'       => [
													'type'       => 'VARCHAR',
													'constraint' => '100',
									],
									'direccion'       => [
													'type'       => 'VARCHAR',
													'constraint' => '100',
									],
									'telefono'       => [
													'type'       => 'VARCHAR',
													'constraint' => '10',
									],
									'contacto'       => [
													'type'       => 'VARCHAR',
													'constraint' => '100',
									],
									'celular'       => [
													'type'       => 'VARCHAR',
													'constraint' => '10',
									],
									'email'       => [
													'type'       => 'VARCHAR',
													'constraint' => '100',
									],
									'tipo'       => [
													'type'       => 'ENUM("PRODUCTO","SERVICIO","AMBOS")',
									]
					]);
					$this->forge->addKey('id_provedor', true);

					$this->forge->createTable('provedores');
	}

	public function down()
	{
					$this->forge->dropTable('provedores');
	}
}
