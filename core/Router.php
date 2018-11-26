<?php

namespace Core;

use Core\Base\BaseObject;

class Router extends BaseObject {
    public $route = [];
    public $params = [];

    private $_rules;

    public function __construct(string $path, array $rules) {
        $this->_rules = $rules;
        $this->handle($path);
    }

    public function handle(string $path) {
        if ($path == '') $path = '/';

        foreach ($this->_rules as $rule => $route) {
            $pattern = preg_replace("/{[\w]+}/", "([\w]+)", $rule);
            $pattern = "~^" . $pattern . "$~";

            if (preg_match($pattern, $path)) {
                $params = $this->getParamsFromRule($rule);
                $values = $this->getValuesFromPath($path, $pattern);

                $this->route = $route;
                $this->params = $values;

                $_GET = array_merge(
                    array_combine($params, $values),
                    $_GET
                );

                break;
            }
        }
    }

    private function getParamsFromRule(string $path) {
        $matches = [];
        $params = [];

        preg_match_all("/{[\w]+}/", $path, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $params[] = preg_replace("/[\W]+/", '', $match[0]);
        }

        return $params;
    }

    private function getValuesFromPath(string $path, string $pattern) {
        $matches = [];
        $values = [];

        preg_match_all($pattern, $path, $matches, PREG_SET_ORDER);
        unset($matches[0][0]);

        foreach ($matches[0] as $match) {
            $values[] = $match;
        }

        return $values;
    }

    public function getController() {
        return ($this->route[0]) ? $this->route[0] : false;
    }

    public function getAction() {
        return ($this->route[1]) ? $this->route[1] : false;
    }
}
