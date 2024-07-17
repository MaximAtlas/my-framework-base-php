<?php

use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\MovieController;
use App\Controllers\RegisterController;
use App\Kernel\Router\Routes;

return [
    Routes::get('/home', [HomeController::class, 'index']),

    Routes::get('/', [HomeController::class, 'index']),
    Routes::get('/movies', [MovieController::class, 'index']),
    Routes::get('/admin/movies/add', [MovieController::class, 'add']),
    Routes::post('/admin/movies/add', [MovieController::class, 'store']),
    Routes::get('/register', [RegisterController::class, 'index']),
    Routes::post('/register', [RegisterController::class, 'register']),
    Routes::get('/login', [LoginController::class, 'index']),
    Routes::post('/login', [LoginController::class, 'login']),
];
