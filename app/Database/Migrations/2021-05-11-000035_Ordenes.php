<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ordenes extends Migration
{
	public function up()
	{
		$this->forge->addField([
						'id_orden'       => [
										'type'           => 'INT',
										'constraint'     => 5,
										'unsigned'       => true,
										'auto_increment' => true,
						],
						'idcronograma'       => [
										'type'       => 'INT',
										'constraint' => 5,
										'unsigned' => true,
						],
						'fecha_registro'       => [
										'type'       => 'DATE',
						],
						'fecha_orden'       => [
										'type'       => 'DATE',
						],
						'nro_orden'       => [
										'type'       => 'VARCHAR',
										'constraint' => '10',
						],
						'costo'       => [
										'type'       => 'FLOAT',
						],
						'descripcion_servicio'       => [
										'type'       => 'TEXT',
						],
						'repuestos_utilizados'       => [
										'type'       => 'TEXT',
						],
						'hora_inicio'       => [
										'type'       => 'TIME',
						],
						'hora_final'       => [
										'type'       => 'TIME',
						],
						'horas_total'       => [
										'type'       => 'TIME',
						],
						'estado'       => [
										'type'       => 'INT',
										'constraint' => 1,
						]
		]);
		$this->forge->addKey('id_orden', true);

		$this->forge->addForeignKey('idcronograma', 'cronograma_mantenimientos', 'id_cronograma','','CASCADE');

		$this->forge->createTable('ordenes');
	}

	public function down()
	{
		$this->forge->dropTable('ordenes');
	}
}
