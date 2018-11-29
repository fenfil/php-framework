<?php

namespace core\base;

use core\request;

abstract class Controller extends BaseObject {
    public $name;
    public $request;

    protected $view;

    public function __construct(Request $request, View $view) {
        $className = explode('\\', static::class);
        $this->name = strtolower(str_replace('Controller', '', array_pop($className)));

        $this->request = $request;

        $this->view = $view;
    }

    public function runAction(string $method, array $params) {
        if (method_exists($this, $method)) {
            return $this->{$method}(...$params);
        } else {
            throw new \Exception('Invalid action');
        }
    }

    public function render(string $view, array $data = []) {
        return ($this->request->isAjax())
            ? $this->json($data)
            : $this->view($view, $data);
    }

    private function json(array $data) {
        header('Content-Type: application/json');

        return json_encode($data, JSON_PRETTY_PRINT);
    }

    private function view(string $view, array $data = []) {
        try {
            $view = "/pages/{$this->name}/{$view}.twig";

            return $this->view->render($view, $data);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }
}
