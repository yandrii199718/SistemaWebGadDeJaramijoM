<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Cronogramamantenimiento;
use App\Models\Ordenes;
use Exception;

class CronogramamantenimientoController extends BaseController
{
	public function index()
	{

	}

	public function show($id){

	}

	// consulto un cronograma de acuerdo al usuario
	public function showCronograma(){

		$model = model('Cronogramamantenimiento');
		$idusuario = session('id');
		$filtro = [
			'usuarios.id_usuario' => $idusuario,
			'month' => $this->request->getPost('month'),
			'year' => $this->request->getPost('year'),
		];

		if(session('rol') == ROL_ADMIN)
			unset($filtro['usuarios.id_usuario']);

		$respuesta = $model->getCronograma($filtro);
		return json_encode($respuesta);
	}

	public function getCronograma(){
		$model = model('Cronogramamantenimiento');
		$idusuario = session('id');
		$filtro = [
			'usuarios.id_usuario' => $idusuario,
			'month' => $this->request->getPost('month'),
			'year' => $this->request->getPost('year'),
			'day'	=> $this->request->getPost('day'),
		];
		if(session('rol') == ROL_ADMIN)
			unset($filtro['usuarios.id_usuario']);
		$respuesta = [];
		$respuesta = $model->getCronograma($filtro);
		if(count($respuesta) != 0){
			$modelOrden = model('Ordenes');
			$i = 0;
			foreach($respuesta as $cro){
				try{
					$orden = $modelOrden->where('idcronograma', $cro['id_cronograma'])->first();
					if(count($orden) != 0){
						$respuesta[$i]['idorden'] = $orden["id_orden"];
					}
				}
				catch(Exception $e){
					$respuesta[$i]['idorden'] = null;
					//return json_encode($respuesta);
				}
				$i++;
			}
		}
		return json_encode($respuesta);
	}
}
