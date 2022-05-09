<?php

namespace App\Controllers;
use App\Models\Provedores;

class ProvedorController extends BaseController
{
	public function index()
	{
		return view('admin/provedor');
	}

	public function tableClientes(){
		$model = model('Provedores');
		$data['data'] = $model->findAll();
		return json_encode($data);
	}


	public function report(){
		$model = model('Provedores');
		$provedores = $model->findAll();


		require ROOTPATH. 'vendor/autoload.php';
		include __DIR__.'/reports/reports_vendors.php';
	}

  // metodo para realizar un insert
	public function store()
	{
		if(!$this->validate('provedor')){
			$errors = $this->validator->getErrors();
			$data = [
				'status' => 'error',
				'code' => 400,
				'errores' => $errors
			];
		} else {
			$model = model('Provedores');
			$arrayProvedor = $this->request->getPost();

			$id = $model->insert($arrayProvedor);

			$data = [
				'status' => 'success',
				'code' => 200,
				'id' => $id
			];
		}

		return json_encode($data);
	}


  // metodo para mostrar un registro
  public function show($id){
		$model = model('Provedores');
		$resultado = $model->find($id);
		return $this->response->setJSON($resultado);
  }

  //metodo para realizar un edit de un registro
  public function update(){
		if(!$this->validate('provedor')){
			$errors = $this->validator->getErrors();
			$data = [
				'status' => 'error',
				'code' => 400,
				'errores' => $errors
			];
		} else {
			$model = model('Provedores');
			$id = $this->request->getPost('id_provedor');
			$respuesta = $model->find($id);
			if(count($respuesta) != 0){
				$arrayProvedor = $this->request->getPost();

				
				$respuesta = $model->save($arrayProvedor);

				$data = [
					'status' => 'success',
					'code' => 200,
					'estado' => $respuesta
				];
			}

		}

		return json_encode($data);
  }


  //metodo para realizar un delete
  public function destroy($id){

		$model = model('Provedores');
		$respuesta = $model->find($id);

		if($respuesta != null){
			$respuesta = $model->delete($id);

			if($respuesta){
				$data = [
					'status' => 'success',
					'code' => 200,
					'message' => 'Provedor eliminado con exito'
				];
			}
		} else {
			$data = [
				'status' => 'error',
				'code' => 400,
				'message' => 'Provedor no existe'
			];
		}
		return json_encode($data);
  }

}
