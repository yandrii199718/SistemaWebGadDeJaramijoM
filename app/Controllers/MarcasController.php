<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Marcas;

class MarcasController extends BaseController
{
	public function index()
	{
		return view('admin/marcas');
	}

	public function tableMarcas(){
		$Marcas = new Marcas;
		$data['data'] = 	$Marcas->findAll();
		return json_encode($data);
	}

	public function report(){
		$model = model('Marcas');
		$marcas = $model->findAll();


		require ROOTPATH. 'vendor/autoload.php';
		include __DIR__.'/reports/reports_trademarks.php';
	}


  // metodo para realizar un insert
	public function store() {
		if(!$this->validate('marcas')){
			$errors = $this->validator->getErrors();
			$data = [
				'status' => 'error',
				'code' => 400,
				'errores' => $errors
			];

		} else {
			//Realizar el registro del usuario
			$arrayMarca = $this->request->getPost();

			$modelo = model('Marcas');

			$idMarca = $modelo->save($arrayMarca);
			$data = [
				'status' => 'success',
				'code' => 200,
				'id' => $idMarca
			];
		}

		return $this->response->setJSON($data);
	}


  // metodo para mostrar un registro
  public function show($id){
		$model = model('Marcas');
		$resultado = $model->find($id);
		return $this->response->setJSON($resultado);
  }

  //metodo para realizar un edit de un registro
  public function update() {
		if(!$this->validate('marcas')){
			$errors = $this->validator->getErrors();
			$data = [
				'status' => 'error',
				'code' => 400,
				'errores' => $errors
			];

		} else {
			$arrayMarca = $this->request->getPost();

			$model = model('Marcas');
			$respuesta = $model->save($arrayMarca);

			$data = [
				'status' => 'success',
				'code' => 200,
				'editado' => $respuesta,
				'marcas' => 	$arrayMarca
			];
		}
		return $this->response->setJSON($data);
  }


  //metodo para realizar un delete
  public function destroy($id){
		$model = model('Marcas');
		$respuesta = $model->find($id);

		if($respuesta != null){
			$respuesta = $model->delete($id);

			if($respuesta){
				$data = [
					'status' => 'success',
					'code' => 200,
					'message' => 'Marca eliminada con exito'
				];
			}
		} else {
			$data = [
				'status' => 'error',
				'code' => 400,
				'message' => 'Marca no existe'
			];
		}
		return json_encode($data);
  }
}
