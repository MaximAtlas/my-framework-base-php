<?php

namespace App\Kernel;

use App\Kernel\Container\Container;

class Application
{
    //TODO:   private int $id;

    //TODO: private string $name;

    //TODO: private float $version;

    //TODO:private bool $debug;

    //TODO:  private string $env;

    private Container $container;

    public function __construct()
    {
        //$this->container = new Container();
    }

    public function start(): void
    {

        //$this->container->router->dispatch($this->container->request->getUri(), $this->container->request->getMethod());
    }
}
