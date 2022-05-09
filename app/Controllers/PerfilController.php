<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Usuarios;
class PerfilController extends BaseController
{
	public function index()
	{
		$id = session('id');

		$model = model('Usuarios');
		//dd(model('Usuarios')->getUsuario($id));
		$usuario = $model->getUsuario($id);
		$data = [
			'usuario' => $usuario,
		];
		return view('admin/perfil', $data);
	}

	public function update(){
		if(!$this->validate('usuario_update')){
			$errors = $this->validator->getErrors();
			$data = [
				'status' => 'error',
				'code' => 400,
				'errores' => $errors
			];

		} else {
			$arrayUsuario = $this->request->getPost();
			$idUsuario = $this->request->getPost('id_usuario');

			$password = $this->request->getPost('password');
			if(empty($password)){
				unset($arrayUsuario['password']); //elimino la password del array
			} else {
				$password = password_hash($password, PASSWORD_DEFAULT); //encripto la clave
				$remplazar = array('password' => $password); //agrego a un array para luego remplazar datos
				$arrayUsuario = array_replace($arrayUsuario, $remplazar); //remplazo la clave
			}

			if($imagefile = $this->request->getFile("imagen")) {
				// funcion uploadFiles esta creada en un helper llamado funcionesPersonalizadas_helpers
				$urlImagenesUsuario = URL_IMG_USUARIO.$idUsuario;
				echo $urlImagenesUsuario;

				if($imagen = uploadFiles($imagefile, $urlImagenesUsuario)){

					$arrayUsuario = array_replace($arrayUsuario, ['imagen' => $imagen]); //remplazo la clave

				}
			}

			if($idUsuario == session('id')){
				$model = model('usuarios');
				$respuesta = $model->save($arrayUsuario);

				$usuario = $model->getUsuario($idUsuario);

				session()->set([
            'id' => $idUsuario,
            'nombres' => $usuario[0]['nombres'],
            'imagen' => $usuario[0]['imagen']
        ]);
			}

			$data = [
				'status' => 'success',
				'code' => 200,
				'editado' => $respuesta,
				'usuario' => 	$arrayUsuario
			];
		}
		return redirect()->to('/perfil');
	}
}
