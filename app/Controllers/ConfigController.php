<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Configuracion;

class ConfigController extends BaseController
{
	public function index()
	{
    $model = model('Configuracion');
    $data['configuracion'] = $model->first();
    $data['condicion'] = ['ACTIVO','INACTIVO'];
    $data['estado'] = ['ACTIVO','INACTIVO'];

		return view('admin/config', $data);
	}



  //metodo para realizar un edit de un registro
  public function update() {
		$arrayConfiguracion = $this->request->getPost();
    $id = $this->request->getPost('id_configuracion');

    if($imagefile = $this->request->getFile("logo")) {
      // funcion uploadFiles esta creada en un helper llamado funcionesPersonalizadas_helpers
      $urlImagenesUsuario = URL_IMG_CONFIGURACION.'1';
      echo $urlImagenesUsuario;

      if($imagen = uploadFiles($imagefile, $urlImagenesUsuario)){

        $arrayConfiguracion = array_replace($arrayConfiguracion, ['logo' => $imagen]); //remplazo la clave

      }
    }

    $model = model('Configuracion');
    $respuesta = $model->update($id, $arrayConfiguracion);
    if($respuesta){
      return redirect()->back()->with('success', 'Perfil actualizado');
    }
    return redirect()->back()->withInput()->with('errors', $model->errors());
  }

}
