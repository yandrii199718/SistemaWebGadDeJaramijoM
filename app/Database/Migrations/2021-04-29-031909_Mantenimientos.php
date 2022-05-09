<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mantenimientos extends Migration
{
	public function up()
	{
					$this->forge->addField([
									'id_mantenimiento'       => [
													'type'           => 'INT',
													'constraint'     => 5,
													'unsigned'       => true,
													'auto_increment' => true,
									],
									'idequipo'       => [
													'type'       => 'INT',
													'constraint' => 5,
													'unsigned' => true,
									],
									'fecha_operacion'       => [
													'type'       => 'DATE',
									],
									'fecha_mantenimiento'       => [
													'type'       => 'DATE',
									],
									'frecuencia'       => [
													'type'       => 'INT',
													'constraint' => 9,
									],
									'cantidad_mantenimiento'       => [
													'type'       => 'INT',
													'constraint' => 9,
									],
									'tipo_mantenimiento'       => [
													'type'       => 'ENUM("PREVENTIVO", "CORRECTIVO", "TOTAL")',
									],
									'horas_uso'       => [
													'type'       => 'FLOAT',
													'constraint' => 9,
									],
									'periodo_garantia'       => [
													'type'       => 'DATE',
									],
									'estado_alerta'       => [
													'type'       => 'INT',
													'constraint' => 1,
									]
					]);
					$this->forge->addKey('id_mantenimiento', true);

					$this->forge->addForeignKey('idequipo', 'equipos', 'id_equipo');

					$this->forge->createTable('mantenimientos');
	}

	public function down()
	{
					$this->forge->dropTable('mantenimientos');
	}
}
