<?php

namespace Core\Traits;

trait Singleton {

    private static $_instance;

    private function __construct() {
    }

    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    private function __clone() {
    }

    private function __wakeup() {
    }

}
