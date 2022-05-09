<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Mantenimientos;
use App\Models\Cronogramamantenimiento;
use App\Models\Actividad;
use App\Models\Equipos;

class MantenimientoController extends BaseController
{
	public function index()
	{
		return view('admin/mantenimiento');
	}

	public function tableMantenimiento()
	{
		$data = [];
		$model = model('Mantenimientos');
		$actividad = model('Actividad');
		$respuesta = $model->getMantenimiento();
		if(session('rol') == ROL_ADMIN){
			$respuesta = $model->getMantenimiento();
		} else {
			//$data['data'] = 	$Equipos->getEquipos(null, session('idsede'));
			$respuesta = $model->getMantenimiento(null, session('idsede'));
		}
		unset($respuesta['actividad']);
		foreach($respuesta as $datos){
			//consultar cantidad de actividades existentes
			$datos['actividad'] = $actividad->where('idmantenimiento',$datos['id_mantenimiento'])->countAllResults();

			$data['data'][] = $datos;

		}

		//$data['data'] = $respuesta;

		return json_encode($data);
	}

	public function report(){
		$model = model('Mantenimientos');
		$mantenimientos = $model->getMantenimiento();

		//var_dump($mantenimientos); exit;
		require ROOTPATH. 'vendor/autoload.php';
		include __DIR__.'/reports/reports_maintenances.php';
	}

	public function getMantenimientoEquipo(){
			$data['data'] = null;
			$model = model('Equipos');
			if(session('rol') == ROL_ADMIN){
				$equipos = $model->getEquipos();
			} else {
				$equipos = $model->getEquipos(null, session('idsede'));
			}

			$data['data'] = $equipos;

			return json_encode($data);
	}


	public function create(){
		$data['tipoMantenimiento'] = ['PREVENTIVO','CORRECTIVO','TOTAL'];
		$data['estadoAlerta'] = ['1' => 'PENDIENTE', '2' => 'FINALIZADO'];
		return view('admin/mantenimiento-crear', $data);
	}

	public function store(){

		$datos = $this->request->getPost();

		unset($datos['id_herramienta']);
		$mantenimiento = model('Mantenimientos');

	//	dd($mantenimiento);

		//obtener los errores con validaciones en modelo Mantenimientos
		$datos['estado_alerta'] = 1;
		if($idManteniimiento = $mantenimiento->insert($datos)){
			//var_dump($mantenimiento->errors());
			$modelCronograma = model('Cronogramamantenimiento');

			//realizar despues del registro a base de datos

			//guardar las actividades.
			$actividad = model('Actividad');
			foreach($datos['actividad'] as $act){
				if(!empty($act)){
						$datosActividad = [
							"idmantenimiento" => $idManteniimiento,
							'actividad' => $act
						];
						$actividad->save($datosActividad);
				}

			}

			//para guardar el cronograma
			$fechaMantenimiento = $this->request->getPost('fecha_mantenimiento');
			$frecuencia = $this->request->getPost('frecuencia');
			$cantidadMantenimientos = $this->request->getPost('cantidad_mantenimiento');
			$estadoMantenimiento = 1;
			$usuarioMantenimiento = $this->request->getPost('idusuario');

			$array = [];
			$amount = 0;
			$index = 0;
			for ($i=0; $i < $cantidadMantenimientos; $i++) {
				$index = $i * $frecuencia;
				echo date("Y-m-d",strtotime($fechaMantenimiento."+ $index days"));

				$cronograma = [
					'idmantenimiento' => $idManteniimiento,
					'fecha_cronograma' => date("Y-m-d",strtotime($fechaMantenimiento."+ $index days")),
					'year'	=> date("Y",strtotime($fechaMantenimiento."+ $index days")),
					'month'	=> date("m",strtotime($fechaMantenimiento."+ $index days")),
					'day'	=> date("d",strtotime($fechaMantenimiento."+ $index days")),
					'estadomantenimiento' => $estadoMantenimiento,
				];
				if($modelCronograma->save($cronograma)){
					$amount++;
				}

			}

			return redirect()->to('mantenimiento')->with('success', true);
			//return json_encode($amount);
		}

		return redirect()->back()->withInput()->with('errors', $mantenimiento->errors());

	}

	public function show_ajax($id){
		$model = model('Mantenimientos');
		$resultado = $model->getMantenimiento($id);
		return $this->response->setJSON($resultado);
	}


	//mostrar la vista de editar
	public function edit($id){
		$model = model('Mantenimientos');
		$actividad = model('Actividad');
		$data['mantenimiento'] = $model->getMantenimiento($id);
		$data['actividad'] = $actividad->where('idMantenimiento',$id)->findAll();
		//dd($data['mantenimiento']);
		$data['tipoMantenimiento'] = ['PREVENTIVO','CORRECTIVO','TODOS'];
		$data['estadoAlerta'] = ['1' => 'PENDEIENTE', '2' => 'FINALIZADO'];
		return view('admin/mantenimiento-editar',$data);
	}

	//editar un mantenimiento
	public function update(){
		$arrayDatos = $this->request->getPost();
		$idManteniimiento = $arrayDatos['id_mantenimiento'];
		$model = model('Mantenimientos');

		//instanciamos el modelo de actividad para eliminar todas las actividades de este mantenimiento
		$actividad = model('Actividad');
		$actividad->where('idmantenimiento',$idManteniimiento)->delete();

		//ahora insertamos todas las actividades
		foreach($arrayDatos['actividad'] as $act){
			if(!empty($act)){
					$datosActividad = [
						"idmantenimiento" => $idManteniimiento,
						'actividad' => $act
					];
					$actividad->save($datosActividad);
			}

		}


		$respuesta = $model->find($idManteniimiento);

		if($respuesta != null){
				unset($arrayDatos['frecuencia']);
				unset($arrayDatos['cantidad_mantenimiento']);
				$respuesta = $model->update($idManteniimiento, $arrayDatos);

				return redirect()->to(base_url().route_to('mantenimientos.index'));
		}

	}


	public function destroy($id){
		$model = model('Mantenimientos');
		$respuesta = $model->find($id);

		if($respuesta != null){
			$respuesta = $model->delete($id);

			if($respuesta){
				$data = [
					'status' => 'success',
					'code' => 200,
					'message' => 'Mantenimiento eliminado con exito'
				];
			}
		} else {
			$data = [
				'status' => 'error',
				'code' => 400,
				'message' => 'Mantenimiento no existe'
			];
		}
		return json_encode($data);
	}
}
