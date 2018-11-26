<?php

namespace Core\Base;

abstract class BaseObject {
    public function __get($name) {
        $method = "get" . ucfirst($name);

        if (method_exists($this, $method)) {
            return $this->{$method}();
        }
    }

    public function __set($name, $value) {
        $method = "set" . ucfirst($name);

        if (method_exists($this, $method)) {
            return $this->{$method}($value);
        } else {
            $this->{$name} = $value;
        }
    }
}
