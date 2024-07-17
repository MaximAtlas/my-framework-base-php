<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class LoginController extends Controller
{
    public function index(): void
    {
        $this->view('login');
    }

    public function login(): void
    {
        $email = $this->request()->input('email');
        $password = $this->request()->input('password');

    }
}
