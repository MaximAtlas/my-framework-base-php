<?php

namespace App\Kernel\Router;

class Routes
{
    public function __construct(
        private string $uri,
        private string $method,
        private $action
    ) {}

    public static function get($uri, $action): static
    {
        return new static($uri, 'GET', $action);
    }

    public static function post($uri, $action): static
    {
        return new static($uri, 'POST', $action);
    }

    public function initRoutes() {}

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getAction()
    {
        return $this->action;
    }
}
