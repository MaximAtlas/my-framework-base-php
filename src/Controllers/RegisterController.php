<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class RegisterController extends Controller
{
    public function index(): void
    {
        $this->view('register');
    }

    public function register(): void
    {
        $validation = $this->request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);
        if (! $validation) {
            foreach ($this->request()->errors() as $field => $error) {
                $this->session->set($field, $error);
            }
            $this->redirect->to('/register');

        }
        $userid = $this->db()->insert('user',
            [
                'email' => $this->request()->input('email'),
                'password' => password_hash($this->request()->input('password'), PASSWORD_DEFAULT),
            ]);
        dd("User was create with $userid id");
    }
}
