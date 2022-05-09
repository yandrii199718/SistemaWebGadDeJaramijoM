<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Permisos implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        /**
         * validamos que exista una session para permitir al
         * usuario
         */
         //dd($arguments);
         //


        if(!session()->is_logged){
            return redirect()->to('login');
        }

        if(!in_array(session('rol'), $arguments)){
          //return redirect()->to('inicio');
          throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }



        if(!session('type') == 'admin'){
          //return redirect()->to(base_url('/'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
