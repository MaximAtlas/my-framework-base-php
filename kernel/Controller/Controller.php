<?php

namespace App\Kernel\Controller;

use App\Kernel\Auth\AuthInterface;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Http\RedirectInterface;
use App\Kernel\Http\Request;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Session\SessionInterface;
use App\Kernel\View\View;
use App\Kernel\View\ViewInterface;

abstract class Controller
{
    protected ViewInterface $view;

    private RequestInterface $request;

    protected RedirectInterface $redirect;

    protected SessionInterface $session;

    protected DatabaseInterface $database;

    protected AuthInterface $auth;

    public function view(string $name): void
    {
        $this->view->page($name);
    }

    public function setView(View $view): void
    {
        $this->view = $view;
    }

    public function request(): Request
    {
        return $this->request;
    }

    public function setRequest(RequestInterface $request): void
    {
        $this->request = $request;
    }

    public function setRedirect(RedirectInterface $redirect): void
    {
        $this->redirect = $redirect;
    }

    public function redirect($url): void
    {
        $this->redirect->to($url);
    }

    public function session(): SessionInterface
    {
        return $this->session;
    }

    public function setSession(SessionInterface $session): void
    {
        $this->session = $session;
    }

    public function db(): DatabaseInterface
    {
        return $this->database;
    }

    public function setDatabase(DatabaseInterface $database): void
    {
        $this->database = $database;
    }

    public function getAuth(): AuthInterface
    {
        return $this->auth;
    }

    public function setAuth(AuthInterface $auth): void
    {
        $this->auth = $auth;
    }
}
