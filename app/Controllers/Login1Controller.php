<?php


namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\Usuarios;

class Login1Controller extends BaseController
{
    public function index(){
        if(!session()->is_logged){
            return view('admin/login1');
        }

        if(session('rol') == 'ADMINISTRADOR'){
            return redirect()->to('/admin');
          } else if(session('rol') == 'TECNICO'){
            return redirect()->to(base_url().route_to('tecnico'));
          }
  
      }
  



    public function signin(){
        //dd($this->request->getPost()); //depuramos para saber si llegan los datos

        if(!$this->validate([
            'usuario' => 'required',
            'pass' => 'required'
        ])){

        }
        $usuario = $this->request->getPost('usuario');
        $pass = $this->request->getPost('pass');
        //return 'usuario '.$usuario.' '.$pass;


        $Usuario = new Usuarios();
        //$datosUsuario = $Usuario->getUsuario(null, $usuario);
        $datosUsuario = $Usuario->getUsuario(['usuario' => $usuario]);

        if(count($datosUsuario) == 0){
          return redirect()->back()->with('msg', [
             'type' => 'red',
              'body' => 'Ususario no registrado'
          ]);
        }

        //print_r($datosUsuario); exit;
        if(!password_verify($pass, $datosUsuario[0]['password'])){
          return redirect()->back()->with('msg', [
              'type' => 'red',
              'body' => 'Credenciales invalidas'
          ]);
        }

        session()->set([
            'id' => $datosUsuario[0]['id_usuario'],
            'nombres' => $datosUsuario[0]['nombres'],
            'imagen' => $datosUsuario[0]['imagen'],
            'rol' => $datosUsuario[0]['nombre_cargo'],
            'idsede' => $datosUsuario[0]['idsede'],
            'sede'  => $datosUsuario[0]['nombre_sede'],
            'is_logged' => true
        ]);


        return redirect()->to('/login1')->with('msg',[
            'type' => 'green',
            'body' => 'Bienvenido'
        ]);

        echo "Validaciones correctas";


    }



    public function signout(){
        session()->destroy();
        return redirect()->to('/login1');
    }

}
