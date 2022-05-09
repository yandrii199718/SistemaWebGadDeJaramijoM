<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Sedes;

class SedesController extends BaseController
{
	public function index()
	{
		return view('admin/sedes');
	}

	public function tableSedes(){
		$Sedes = new Sedes;
		$data['data'] = 	$Sedes->findAll();
		return json_encode($data);
	}

	public function report(){
		$model = model('Sedes');
		$sedes = $model->findAll();


		require ROOTPATH. 'vendor/autoload.php';
		include __DIR__.'/reports/reports_venues.php';
	}


  // metodo para realizar un insert
	public function store() {
		if(!$this->validate('sedes')){
			$errors = $this->validator->getErrors();
			$data = [
				'status' => 'error',
				'code' => 400,
				'errores' => $errors
			];

		} else {
			//Realizar el registro del usuario
			$arraySedes = $this->request->getPost();


			$modelo = model('Sedes');

			try {
			    $idSedes = $modelo->insert($arraySedes);
			} catch (mysqli_sql_exception $e) {
			    echo 'Error de conexión: ' . $e->getMessage();
			    exit;
			}

			if($idSedes != 0){

				if($imagefile = $this->request->getFile("imagen_sede")) {
					// funcion uploadFiles esta creada en un helper llamado funcionesPersonalizadas_helpers
					$urlImagenesUsuario = URL_IMG_SEDE.$idSedes;
					if($imagen = uploadFiles($imagefile, $urlImagenesUsuario)){

						$dataEditar = [
								'id_sede' => $idSedes,
								'imagen_sede' => $imagen
						];
						$modelo->save($dataEditar);

					}
				}
			}

			$data = [
				'status' => 'success',
				'code' => 200,
				'id' => $idSedes
			];
		}

		return $this->response->setJSON($data);
	}


  // metodo para mostrar un registro
  public function show($id){
		$model = model('Sedes');
		$resultado = $model->find($id);
		return $this->response->setJSON($resultado);
  }

  //metodo para realizar un edit de un registro
  public function update() {
		if(!$this->validate('sedes')){
			$errors = $this->validator->getErrors();
			$data = [
				'status' => 'error',
				'code' => 400,
				'errores' => $errors
			];

		} else {
			$arraySedes = $this->request->getPost();

			$model = model('Sedes');

			if($imagefile = $this->request->getFile("imagen_sede")) {
				// funcion uploadFiles esta creada en un helper llamado funcionesPersonalizadas_helpers
				$urlImagenesUsuario = URL_IMG_SEDE.$arraySedes['id_sede'];
				if($imagen = uploadFiles($imagefile, $urlImagenesUsuario)){

					$arraySedes = array_replace($arraySedes, ['imagen_sede' => $imagen]); //remplazo la clave

				}
			}

			$respuesta = $model->save($arraySedes);

			$data = [
				'status' => 'success',
				'code' => 200,
				'editado' => $respuesta,
				'Sedes' => 	$arraySedes
			];
		}
		return $this->response->setJSON($data);
  }


  //metodo para realizar un delete
  public function destroy($id){
		$model = model('Sedes');
		$respuesta = $model->find($id);

		if($respuesta != null){
			$respuesta = $model->delete($id);

			if($respuesta){
				$data = [
					'status' => 'success',
					'code' => 200,
					'message' => 'Sede eliminada con exito'
				];
			}
		} else {
			$data = [
				'status' => 'error',
				'code' => 400,
				'message' => 'Sede no existe'
			];
		}
		return json_encode($data);
  }
}
