<?php

namespace App\Controllers;
use App\Models\Usuarios;
use App\Models\Provedores;
use App\Models\Mantenimientos;
use App\Models\Ordenes;
use App\Models\Cronogramamantenimiento;
use App\Models\Equipos;

class InicioController extends BaseController
{
	public function index()
	{
		$equipo = model('Equipos');
		$mantenimiento = model('Mantenimientos');
		//contar que registros tiene un equipo
		$equiposD = $equipo->equiposDetenidos();

		//contar cantidad de mantenimientos segun el tipo(preventivos o correctivo)
		$amounPreventivo = $mantenimiento->amountMantenimiento('PREVENTIVO');
		$amounCorrectivo = $mantenimiento->amountMantenimiento('CORRECTIVO');

		$numberProvedores = model('Provedores')->select('count(id_provedor) as amount')->first();


		//consultar cronograma
		$cronograma = model('Cronogramamantenimiento');
		$amountCronograma = $cronograma->amountCronograma();


		$equipos = $equipo->select('count(id_equipo) as amount')->first();

		$data['provedores'] = $numberProvedores['amount'];
		$data['equipos'] = $equipos['amount'];
		$data['equiposD'] = $equiposD;
		$data['amounPreventivo'] = $amounPreventivo;
		$data['amounCorrectivo'] = $amounCorrectivo;
		$data['amountCronograma'] = $amountCronograma;

		return view('admin/inicio2', $data);
	}

	public function index1()
	{
		return view('admin/inicio1');
	}

	public function tecnico(){
		return view('admin/dashboard');
	}
}
