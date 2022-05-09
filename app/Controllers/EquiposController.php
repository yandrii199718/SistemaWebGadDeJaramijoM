<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\Equipos;

class EquiposController extends BaseController
{
public function index()
{
	return view('admin/equipos');
}

public function tableEquipos(){
	$Equipos = new Equipos;
	//$data['data'] = 	$Equipos->findAll();

	if(session('rol') == ROL_ADMIN){
		$data['data'] = 	$Equipos->getEquipos(null);
	} else {
		$data['data'] = 	$Equipos->getEquipos(null, session('idsede'));
	}
	return json_encode($data);
}

public function report(){
	$model = model('Equipos');
	$equipos = $model->getEquipos(null);

	//var_dump($mantenimientos); exit;


	require ROOTPATH. 'vendor/autoload.php';
	include __DIR__.'/reports/reports_teams.php';
}


// metodo para realizar un insert
public function store() {
	if(!$this->validate('equipos')){
		$errors = $this->validator->getErrors();
		$data = [
			'status' => 'error',
			'code' => 400,
			'errores' => $errors
		];

	} else {
		//Realizar el registro del usuario
		$arrayEquipos = $this->request->getPost();
		unset($arrayEquipos['imagen']);

		if(session('rol') != ROL_ADMIN){
			$arrayEquipos['idsede'] = session('idsede');
		}

		$modelo = model('Equipos');

		$id = $modelo->insert($arrayEquipos);

		if($id != 0){
			$imagen = null;
			if($this->request->getFile("imagen")) {
				$imagefile = $this->request->getFile("imagen");
				$archivoFile = $this->request->getFile("manual");

				// funcion uploadFiles esta creada en un helper llamado funcionesPersonalizadas_helpers
				$urlImagenesEquipos = URL_IMG_EQUIPOS.$id;
				if($imagen = uploadFiles($imagefile, $urlImagenesEquipos)){

					$dataEditar = [
							'id_equipo' => $id,
							'imagen' => $imagen
					];
					$modelo->save($dataEditar);

				}

				// funcion uploadFiles esta creada en un helper llamado funcionesPersonalizadas_helpers
				/*
				$urlManualEquipos = URL_MANUAL_EQUIPOS.$id;
				if($manual = uploadFiles($archivoFile, $urlManualEquipos)){

					$dataEditar = [
							'id_equipo' => $id,
							'manual' => $manual
					];
					$modelo->save($dataEditar);
				}*/

				$data = [
					'status' => 'success',
					'code' => 200,
					'id' => $id
				];

			}
		}

	}

	return $this->response->setJSON($data);
}


// metodo para mostrar un registro
public function show($id){
	$model = model('Equipos');
	$resultado = $model->getEquipos($id);
	return $this->response->setJSON($resultado);
}

//metodo para realizar un edit de un registro
public function update() {
	if(!$this->validate('equipos')){
		$errors = $this->validator->getErrors();
		$data = [
			'status' => 'error',
			'code' => 400,
			'errores' => $errors
		];

	} else {
		$arrayEquipos = $this->request->getPost();
		$id = $this->request->getPost('id_equipo');

		if(session('rol') != ROL_ADMIN){
			$arrayEquipos['idsede'] = session('idsede');
		}

		$model = model('Equipos');


		if($this->request->getFile("imagen")) {
			$imagefile = $this->request->getFile("imagen");
			//$archivoFile = $this->request->getFile("manual");
			//print_r($imagefile->getType());  //obtengo el tipo en este caso tipe 'file'
			//print_r($imagefile->getMimeType());  // obtengo el tipo en este caso 'image/jpg'

			// funcion uploadFiles esta creada en un helper llamado funcionesPersonalizadas_helpers
			$urlImagenesEquipos = URL_IMG_EQUIPOS.$id;
			if($imagen = uploadFiles($imagefile, $urlImagenesEquipos)){

				$arrayEquipos = array_replace($arrayEquipos, ['imagen' => $imagen]); //remplazo la clave

			}

			// funcion uploadFiles esta creada en un helper llamado funcionesPersonalizadas_helpers
			/*
			$urlManualEquipos = URL_MANUAL_EQUIPOS.$id;
			if($manual = uploadFiles($archivoFile, $urlManualEquipos)){

				$arrayEquipos = array_replace($arrayEquipos, ['manual' => $manual]); //remplazo la clave

			}*/


			$respuesta = $model->save($arrayEquipos);
		}

		$data = [
			'status' => 'success',
			'code' => 200,
			'editado' => $respuesta,
			'equipo' => 	$arrayEquipos
		];
	}
	return $this->response->setJSON($data);
}


//metodo para realizar un delete
public function destroy($id){
	$model = model('Equipos');
	$respuesta = $model->find($id);

	if($respuesta != null){
		$respuesta = $model->delete($id);

		//eliminamos el directorio con sus archivos
		$urlImagenesEquipos = URL_IMG_EQUIPOS.$id;
		eliminarDirectorioArchivos($urlImagenesEquipos);

		//eliminamos el directorio con sus archivos
		$urlImagenesEquipos = URL_MANUAL_EQUIPOS.$id;
		eliminarDirectorioArchivos($urlImagenesEquipos);

		if($respuesta){

			$data = [
				'status' => 'success',
				'code' => 200,
				'message' => 'Equipo eliminado con exito'
			];
		}
	} else {
		$data = [
			'status' => 'error',
			'code' => 400,
			'message' => 'Equipo no existe'
		];
	}
	return json_encode($data);
}

//visualizar archivo Pdf
	public function getPdf($nombre, $id){
		$archivo = URL_MANUAL_EQUIPOS.$id.'/'.$nombre;
        //$tofile= realpath("uploaddir/".$fname);
        header('Content-Type: application/pdf');
				header('Content-Disposition: inline; filename=preuba.pdf');
        readfile($archivo);
				//$servidor = $_SERVER['HTTP_HOST'];
		//echo $servidor;
				exit;
	}
}
