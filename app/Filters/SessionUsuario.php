<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class SessionUsuario implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        /**
         * validamos que exista una session para permitir al
         * usuario
         */
        if(!session('type') == 'admin'){
          return redirect()->to(base_url('/'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
