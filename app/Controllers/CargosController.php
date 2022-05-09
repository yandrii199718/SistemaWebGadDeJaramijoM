<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Cargos;

class CargosController extends BaseController
{
	public function index()
	{
		return view('admin/cargos');
	}

	public function tableCargos(){
		$Cargos = new Cargos;
		$data['data'] = 	$Cargos->findAll();
		return json_encode($data);
	}

	public function report(){
		$model = model('Cargos');
		$cargos = $model->findAll();


		require ROOTPATH. 'vendor/autoload.php';
		include __DIR__.'/reports/reports_charges.php';
	}


  // metodo para realizar un insert
	public function store() {
		if(!$this->validate('cargos')){
			$errors = $this->validator->getErrors();
			$data = [
				'status' => 'error',
				'code' => 400,
				'errores' => $errors
			];

		} else {
			//Realizar el registro del usuario
			$arrayCargo = $this->request->getPost();

			$modelo = model('Cargos');

			$idCargo = $modelo->save($arrayCargo);
			$data = [
				'status' => 'success',
				'code' => 200,
				'id' => $idCargo
			];
		}

		return $this->response->setJSON($data);
	}


  // metodo para mostrar un registro
  public function show($id){
		$model = model('Cargos');
		$resultado = $model->find($id);
		return $this->response->setJSON($resultado);
  }

  //metodo para realizar un edit de un registro
  public function update() {
		if(!$this->validate('cargos')){
			$errors = $this->validator->getErrors();
			$data = [
				'status' => 'error',
				'code' => 400,
				'errores' => $errors
			];

		} else {
			$arrayCargo = $this->request->getPost();

			$model = model('Cargos');
			$respuesta = $model->save($arrayCargo);

			$data = [
				'status' => 'success',
				'code' => 200,
				'editado' => $respuesta,
				'cargos' => 	$arrayCargo
			];
		}
		return $this->response->setJSON($data);
  }


  //metodo para realizar un delete
  public function destroy($id){
		$model = model('Cargos');
		$respuesta = $model->find($id);

		if($respuesta != null){
			$respuesta = $model->delete($id);

			if($respuesta){
				$data = [
					'status' => 'success',
					'code' => 200,
					'message' => 'Cargo eliminada con exito'
				];
			}
		} else {
			$data = [
				'status' => 'error',
				'code' => 400,
				'message' => 'Cargo no existe'
			];
		}
		return json_encode($data);
  }
}
