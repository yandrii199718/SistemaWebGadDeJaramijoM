<?php

namespace App\Controllers;
use App\Models\Usuarios;


class UsuariosController extends BaseController
{

	public function index()
	{
		//var_dump(getSedess());
		return view('admin/usuarios');
	}

	public function tableUsuarios(){
		$Usuario = new Usuarios;
		$data['data'] = $Usuario->getUsuario();
		return json_encode($data);
	}

	public function reporte(){
		$model = model('Usuarios');
		$usuarios = $model->getUsuario();


		require ROOTPATH. 'vendor/autoload.php';
		include __DIR__.'/reports/reports_users.php';

	}


  // metodo para realizar un insert
	public function store() {
		if(!$this->validate('usuario')){
			$errors = $this->validator->getErrors();
			$data = [
				'status' => 'error',
				'code' => 400,
				'errores' => $errors
			];

		} else {
			//Realizar el registro del usuario
			$arrayUsuario = $this->request->getPost();

			//obtengo la clave del usuarios
			$password = $this->request->getPost('password');
			$password = password_hash($password, PASSWORD_DEFAULT); //encripto la clave
			$remplazar = array(
				'password' => $password,
				'imagen' => 'no_image.jpg'
			); //agrego a un array para luego remplazar datos

			$arrayUsuario = array_replace($arrayUsuario, $remplazar); //remplazo la clave
			$modelo = model('Usuarios');

			try {
			    $idUsuario = $modelo->insert($arrayUsuario);
			} catch (mysqli_sql_exception $e) {
			    echo 'Error de conexión: ' . $e->getMessage();
			    exit;
			}


			if($idUsuario != 0){

				if($imagefile = $this->request->getFile("imagen")) {
					// funcion uploadFiles esta creada en un helper llamado funcionesPersonalizadas_helpers
					$urlImagenesUsuario = URL_IMG_USUARIO.$idUsuario;
					if($imagen = uploadFiles($imagefile, $urlImagenesUsuario)){

						$dataEditar = [
								'id_usuario' => $idUsuario,
								'imagen' => $imagen
						];
						$modelo->save($dataEditar);

					}
				}
			}

			$data = [
				'status' => 'success',
				'code' => 200,
				'id' => $idUsuario
			];
		}

		return $this->response->setJSON($data);
	}


  // metodo para mostrar un registro
  public function show($id){
			$model = model('Usuarios');
			$resultado = $model->getUsuario($id);
			return $this->response->setJSON($resultado);
  }

  //metodo para realizar un edit de un registro
  public function update() {
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
				if($imagen = uploadFiles($imagefile, $urlImagenesUsuario)){

					$arrayUsuario = array_replace($arrayUsuario, ['imagen' => $imagen]); //remplazo la clave

				}
			}


			$model = model('Usuarios');
			$respuesta = $model->save($arrayUsuario);

			$data = [
				'status' => 'success',
				'code' => 200,
				'editado' => $respuesta,
				'usuario' => 	$arrayUsuario
			];
		}
		return $this->response->setJSON($data);
  }


  //metodo para realizar un delete
  public function destroy($id){
		$model = model('Usuarios');
		$respuesta = $model->find($id);

		if($respuesta != null){
			$respuesta = $model->delete($id);

			if($respuesta){
				$data = [
					'status' => 'success',
					'code' => 200,
					'message' => 'Usuario eliminado con exito'
				];
			}
		} else {
			$data = [
				'status' => 'error',
				'code' => 400,
				'message' => 'Usuario no existe'
			];
		}
		return json_encode($data);
  }

}


/*
$validation =  \Config\Services::validation();
if($this->validate(
 */
/*
	[
		"usuario"	=> [
				"rules"	=> "required|min_length[4]|max_length[20]",
				"errors"	=>	[
						"required"	=> "Campo usuario es requerido",
						"min_length" => "Ingresa como minimo 4 caracteres",
						"max_length" => "Maximo de caracteres 20",
				]
		],
		"password"	=> [
				"rules"	=> "required|min_length[4]|max_length[20]",
				"errors"	=>	[
						"required"	=> "Campo nombre es requerido",
						"min_length" => "Ingresa como minimo 4 caracteres",
						"max_length" => "Maximo de caracteres 20",
				]
		],
		"dni"	=> [
				"rules"	=> "required|numeric|min_length[4]",
				"errors"	=>	[
						"required"	=> "Campo nombre es requerido"
				]
		],
		"nombres"	=> [
				"rules"	=> "required|min_length[4]",
				"errors"	=>	[
						"required"	=> "Campo nombre es requerido"
				]
		],
		"telefono"	=> [
				"rules"	=> "required|numeric|min_length[4]",
				"errors"	=>	[
						"required"	=> "Campo nombre es requerido"
				]
		],
		"email"	=> [
				"rules"	=> "required|valid_email",
				"errors"	=>	[
						"required"	=> "Campo nombre es requerido"
				]
		],
		"cargo"	=> [
				"rules"	=> "required|numeric|min_length[4]",
				"errors"	=>	[
						"required"	=> "Campo nombre es requerido"
				]
		],
		"area"	=> [
				"rules"	=> "required|numeric|min_length[4]",
				"errors"	=>	[
						"required"	=> "Campo nombre es requerido"
				]
		],
		"permisos"	=> [
				"rules"	=> "required|numeric|min_length[4]",
				"errors"	=>	[
						"required"	=> "Campo nombre es requerido"
				]
		]
	]
)){
	$data = array(
			'message' => 'success',
	);
} else
{

				$data = array(
						'message' => 'error',
						$validation->getErrors(),
				);

}

return $this->response->setJSON($data);
*/
