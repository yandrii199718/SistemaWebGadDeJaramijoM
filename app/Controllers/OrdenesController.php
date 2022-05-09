<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Ordenes;
use App\Models\Cronogramamantenimiento;
use App\Models\Configuracion;

class OrdenesController extends BaseController
{
	public function index()
	{
		return view('admin/orden.php');
	}

	public function tableOrdenes(){
		$model = model('Ordenes');
		$config = model('Configuracion');

		if(session('rol') == ROL_ADMIN){
			$data['data'] = $model->getOrden();
		} else {
			$data['data'] = $model->getOrden(['id_usuario' => session('id')]);
		}

		return json_encode($data);
	}

	public function report(){
		$model = model('Ordenes');
		if(session('rol') == ROL_ADMIN){
			$ordenes = $model->getOrden();
		} else {
			$ordenes = $model->getOrden(['id_usuario' => session('id')]);
		}

		require ROOTPATH. 'vendor/autoload.php';
		include __DIR__.'/reports/reports_orders.php';
	}

//mostramos el detalle de una orden
	public function reporteOrden($id){
		$model = model('Ordenes');
		$config = model('Configuracion');
		$configuracion = $config->find(1);

		$tabla = "ordenes";

		if(session('rol') == ROL_ADMIN){

			$ordenes = $model->getOrdenArray(['id_orden' => $id], $tabla);

		} else {
			$ordenes = $model->getOrdenArray(['id_usuario' => session('id'), 'id_orden' => $id], $tabla);
		}

		require ROOTPATH. 'vendor/autoload.php';
		include __DIR__.'/reports/reports_orden.php';
	}

	public function store(){
		$fechaActual = date('Y-m-d');
		$arrayOrden = $this->request->getPost();
		$idcronograma = $this->request->getPost('idcronograma');
		$newHour = 0;

		$horaInicio = $this->request->getPost('hora_inicio');
		$horaFin = $this->request->getPost('hora_final');
		if($horaInicio != '' || $horaFin != '')
			$newHour = calcularHoras($horaInicio, $horaFin);

			//agrego al final del array para guardar a base de datos
			$arrayOrden['fecha_registro'] = $fechaActual;
			$arrayOrden['horas_total'] = $newHour;
			$arrayOrden['estado']	= 1;

			$model = model('Ordenes');
			//echo $idcronograma; exit;
			$orden = $model->where('idcronograma', $idcronograma)->first();


			if(!is_array($orden) || $orden == null){
					if($respuesta = $model->insert($arrayOrden)){
						//editar el estado del cronograma
						$cronograma = model('Cronogramamantenimiento');
						$cronograma->update($idcronograma, ['estadomantenimiento' => 0]);

						//consultar si la actividad del cronograma tiene mas ordenes para cambiar el estado del mantenimiento.
						$cronogramap = model('Cronogramamantenimiento');
						$resCronograma = $cronogramap->find($idcronograma);
						if($resCronograma != null){
							$idmantenimiento = $resCronograma['idmantenimiento'];
							$respuestaC = $cronogramap->where('idmantenimiento', $idmantenimiento)
							->where('estadomantenimiento', 1)->findAll();


							if($respuestaC == null){

								$mantenimiento = model('Mantenimientos');
								$mantenimiento->update($idmantenimiento, ['estado_alerta' => 0]);
							}
						}
						
						$data = [
							'status' => 'success',
							'code' => 200,
							'id' => $respuesta
						];
						return json_encode($data);
					} else {
						$data = [
							'status' => 'error',
							'code' => 400,
							'errores' => $model->errors()
						];
						return json_encode($data);
						//return redirect()->back()->withInput()->with('errors', $model->errors());
					}
				}

				$data = [
					'status' => 'error',
					'code' => 400,
					'message' => 'cronograma no puede repetirse'
				];
				return json_encode($data);
		}

	public function show($id){
		$model = model('Ordenes');
		$respuesta = $model->where('id_orden', $id)->first();

		return json_encode($respuesta);
	}


	public function edit($id){
		$model = model('Ordenes');
		$respuesta = $model->find($id);

		return json_encode($respuesta);
	}

	public function update(){
		$arrayOrden = $this->request->getPost();
		//$idcronograma = $this->request->getPost('idcronograma');
		$newHour = 0;

		$horaInicio = $this->request->getPost('hora_inicio');
		$horaFin = $this->request->getPost('hora_final');
		if($horaInicio != '' || $horaFin != '')
			$newHour = calcularHoras($horaInicio, $horaFin);

			//agrego al final del array para guardar a base de datos
			$arrayOrden['horas_total'] = $newHour;

			//elimino un dato del array
			unset($arrayOrden['idcronograma']);

			$model = model('Ordenes');
			//echo $idcronograma; exit;

					if($respuesta = $model->save($arrayOrden)){
						//editar el estado del cronograma

						$data = [
							'status' => 'success',
							'code' => 200,
							'id' => $respuesta
						];
						return json_encode($data);
					} else {
						$data = [
							'status' => 'error',
							'code' => 400,
							'errores' => $model->errors()
						];
						return json_encode($data);
						//return redirect()->back()->withInput()->with('errors', $model->errors());
					}
	}

}
