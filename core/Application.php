<?php

namespace Core;

use core\base\Controller;
use core\base\View;
use core\traits\Singleton;
use core\Router;
use core\Request;
use Twig_Environment;
use Twig_Loader_Filesystem;

class Application {
    use Singleton;

    public $request;
    public $connection;
    public $controller;

    private $_config;

    public function init(array $configuration) {
        $this->_config = $configuration;

        $this->request = $this->getRequest();
        $this->connection = $this->getConnection();

        $router = $this->getRouter();
        $renderer = $this->getRenderer();

        if ($router->controller) {
            $controllerName = $router->controller;
            $this->controller = new $controllerName($this->request, $renderer);

            $response = $this->controller->runAction(
                $router->action,
                $router->params
            );

            echo $response;
        } else {
            throw new \Exception('Invalid controller');
        }
    }

    private function getRequest() {
        return new Request();
    }

    private function getRouter() {
        return new Router(
            $this->request->path,
            $this->_config['routes']
        );
    }

    private function getRenderer() {
        $templatesDirectory = $this->_config['view']['templates'];

        $loader = new Twig_Loader_Filesystem($templatesDirectory);
        $twig = new Twig_Environment($loader, $this->_config['view']['params']);

        $view = new View($twig, $this->_config['app']);

        return $view;
    }

    private function getConnection()
    {
        // TODO: объект Doctrine
    }

}
