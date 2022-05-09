<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Areas;
class AreasController extends BaseController
{
	public function index()
	{
		return view('admin/areas');
	}

	public function tableAreas(){
		$Areas = new Areas;
		$data['data'] = 	$Areas->findAll();
		return json_encode($data);
	}

	public function report(){
		$model = model('Areas');
		$areas = $model->findAll();


		require ROOTPATH. 'vendor/autoload.php';
		include __DIR__.'/reports/reports_areas.php';
	}


  // metodo para realizar un insert
	public function store() {
		if(!$this->validate('areas')){
			$errors = $this->validator->getErrors();
			$data = [
				'status' => 'error',
				'code' => 400,
				'errores' => $errors
			];

		} else {
			//Realizar el registro del usuario
			$arrayArea = $this->request->getPost();

			$modelo = model('Areas');

			$idArea = $modelo->save($arrayArea);
			$data = [
				'status' => 'success',
				'code' => 200,
				'id' => $idArea
			];
		}

		return $this->response->setJSON($data);
	}


  // metodo para mostrar un registro
  public function show($id){
		$model = model('Areas');
		$resultado = $model->find($id);
		return $this->response->setJSON($resultado);
  }

  //metodo para realizar un edit de un registro
  public function update() {
		if(!$this->validate('areas')){
			$errors = $this->validator->getErrors();
			$data = [
				'status' => 'error',
				'code' => 400,
				'errores' => $errors
			];

		} else {
			$arrayArea = $this->request->getPost();

			$model = model('Areas');
			$respuesta = $model->save($arrayArea);

			$data = [
				'status' => 'success',
				'code' => 200,
				'editado' => $respuesta,
				'usuario' => 	$arrayArea
			];
		}
		return $this->response->setJSON($data);
  }


  //metodo para realizar un delete
  public function destroy($id){
		$model = model('Areas');
		$respuesta = $model->find($id);

		if($respuesta != null){
			$respuesta = $model->delete($id);

			if($respuesta){
				$data = [
					'status' => 'success',
					'code' => 200,
					'message' => 'Area eliminada con exito'
				];
			}
		} else {
			$data = [
				'status' => 'error',
				'code' => 400,
				'message' => 'Area no existe'
			];
		}
		return json_encode($data);
  }
}
