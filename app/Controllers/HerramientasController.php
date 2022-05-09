<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Herramientas;

class HerramientasController extends BaseController
{
	public function index()
	{
		return view('admin/herramientas');
	}

	public function tableHerramientas(){
		$Herramientas = new Herramientas;
		//$data['data'] = 	$Herramientas->findAll();
		if(session('rol') == ROL_ADMIN){
			$data['data'] = 	$Herramientas->getHerramientas(null);
		} else {
			$data['data'] = 	$Herramientas->getHerramientas(null, session('idsede'));
		}

		return json_encode($data);
	}

	public function report(){
		$model = model('Herramientas');
		$herramientas = $model->getHerramientas(null);

		//var_dump($mantenimientos); exit;


		require ROOTPATH. 'vendor/autoload.php';
		include __DIR__.'/reports/reports_tools.php';
	}


  // metodo para realizar un insert
	public function store() {
		if(!$this->validate('herramientas')){
			$errors = $this->validator->getErrors();
			$data = [
				'status' => 'error',
				'code' => 400,
				'errores' => $errors
			];

		} else {
			//Realizar el registro del usuario
			$arrayHerramienta = $this->request->getPost();
			unset($arrayHerramienta['imagen']);

			$modelo = model('Herramientas');

			if(session('rol') != ROL_ADMIN){
				$arrayHerramienta['idsede'] = session('idsede');
			}

			$idHerramienta = $modelo->insert($arrayHerramienta);

			if($idHerramienta != 0){
				$imagen = null;
				if($imagefile = $this->request->getFile("imagen")) {

					if ($imagefile->isValid() && ! $imagefile->hasMoved()) {
							$imagen = $imagefile->getName(); // getRandomName() nombre aleatorio de imagen

							$imagefile->move(URL_IMG_HERRAMIENTAS.$idHerramienta.'/', $imagen);

							//editar herramienta para editar el nombre de la imagen
							$dataEditar = [
									'id_herramienta' => $idHerramienta,
							    'imagen' => $imagen
							];
							$modelo->save($dataEditar);

					}

					$data = [
						'status' => 'success',
						'code' => 200,
						'id' => $idHerramienta
					];

				}
			}

		}

		return $this->response->setJSON($data);
	}


  // metodo para mostrar un registro
  public function show($id){
		$model = model('Herramientas');
		$resultado = $model->getHerramientas($id);
		return $this->response->setJSON($resultado);
  }

  //metodo para realizar un edit de un registro
  public function update() {
		if(!$this->validate('herramientas')){
			$errors = $this->validator->getErrors();
			$data = [
				'status' => 'error',
				'code' => 400,
				'errores' => $errors
			];

		} else {
			$arrayHerramienta = $this->request->getPost();
			$id = $this->request->getPost('id_herramienta');

			if(session('rol') != ROL_ADMIN){
				$arrayHerramienta['idsede'] = session('idsede');
			}

			$model = model('Herramientas');
/*
			$urlImagenesHerramientas = ROOTPATH.'assets/uploads/herramientas/'.$id;
			$config['upload_path'] = $urlImagenesHerramientas;
			$config['allowed_types'] = 'gif/jpg/png';
			$this->load->library('upload', $config);

			if($this->upload->do_upload('imagen')){
				echo $this->upload->data('file_name');
			} else {
				echo $this->upload->display_errors():
			}
			exit;*/


			if($imagefile = $this->request->getFile("imagen")) {

				//print_r($imagefile->getType());  //obtengo el tipo en este caso tipe 'file'
				//print_r($imagefile->getMimeType());  // obtengo el tipo en este caso 'image/jpg'

				if ($imagefile->isValid() && ! $imagefile->hasMoved()) {

					// funcion uploadFiles esta creada en un helper llamado funcionesPersonalizadas_helpers
					$urlImagen = URL_IMG_HERRAMIENTAS.$id;
					if($imagen = uploadFiles($imagefile, $urlImagen)){

						$arrayHerramienta = array_replace($arrayHerramienta, ['imagen' => $imagen]); //remplazo la clave

					}

						//$imagen = $imagefile->getName(); // getRandomName() nombre aleatorio de imagen

				}
			}
			$respuesta = $model->save($arrayHerramienta);
			$data = [
				'status' => 'success',
				'code' => 200,
				'editado' => $respuesta,
				'usuario' => 	$arrayHerramienta
			];
		}
		return $this->response->setJSON($data);
  }


  //metodo para realizar un delete
  public function destroy($id){
		$model = model('Herramientas');
		$respuesta = $model->find($id);

		if($respuesta != null){
			$respuesta = $model->delete($id);

			//eliminamos el directorio con sus archivos
			$urlImagenesHerramientas = ROOTPATH.'assets/uploads/herramientas/'.$id;
			eliminarDirectorioArchivos($urlImagenesHerramientas);

			if($respuesta){

				$data = [
					'status' => 'success',
					'code' => 200,
					'message' => 'Herramienta eliminada con exito'
				];
			}
		} else {
			$data = [
				'status' => 'error',
				'code' => 400,
				'message' => 'Herramienta no existe'
			];
		}
		return json_encode($data);
  }
}
