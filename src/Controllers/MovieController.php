<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class MovieController extends Controller
{
    public function index(): void
    {
        $this->view('movies');
    }

    public function add()
    {
        $this->view('admin/movies/add');

    }

    public function store()
    {

        $validation = $this->request()->validate([
            'name' => ['required', 'min:3', 'max:50'],
        ]);
        if (! $validation) {
            foreach ($this->request()->errors() as $field => $error) {
                $this->session->set($field, $error);
            }
            $this->redirect->to('/admin/movies/add');

        }
        $id = $this->db()->insert('movies', ['name' => $this->request()->input('name')]);
        dd($id);

    }
}
