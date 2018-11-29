<?php

namespace core;

use core\base\BaseObject;

class Request extends BaseObject {
    private $_redirectedFrom;

    public function __construct() {
        session_start();

        $this->_redirectedFrom = isset($_SERVER['REDIRECT_URL'])
            ? $_SERVER['REDIRECT_URL']
            : false;
    }

    private function workWithGlobals(string $key, $value, &$global) {
        if (!is_null($key)) {
            if (is_null($value)) {
                return (isset($global[$key])) ? $global[$key] : false;
            } else {
                $global[$key] = $value;
            }
        }

        return $global;
    }

    public function get(string $key = null, $value = null) {
        return $this->workWithGlobals(
            $key, $value, $_GET
        );
    }

    public function isGet() {
        return ($_SERVER['REQUEST_METHOD'] == 'GET');
    }

    public function post(string $key = null, $value = null) {
        return $this->workWithGlobals(
            $key, $value, $_POST
        );
    }

    public function isPost() {
        return ($_SERVER['REQUEST_METHOD'] == 'POST');
    }

    public function isAjax() {
        $flag = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']))
            ? strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])
            : 'normal';

        return ($flag == 'xmlhttprequest');
    }

    public function session(string $key = null, $value = null) {
        return $this->workWithGlobals(
            $key, $value, $_SESSION
        );
    }

    public function cookie(string $key = null, $value = null) {
        if (!is_null($key)) {
            if (is_null($value)) {
                return (isset($_COOKIE[$key])) ? $_COOKIE[$key] : false;
            } else {
                setcookie(
                    $key,
                    $value,
                    strtotime('+30 days'),
                    '/',
                    $_SERVER['HTTP_HOST'],
                    true,
                    true
                );
            }
        }

        return $_COOKIE;
    }

    public function redirect(string $url, bool $isAbsolute = false) {
        if (!is_null($url)) {
            if (!$isAbsolute) {
                $redirect = ($url[0] == '/') ? $url : "/{$url}";
            } else {
                $redirect = $url;
            }
        } else {
            $redirect = "//" . $_SERVER['HTTP_HOST'];
        }

        header('Location: ' . $redirect);
    }

    public function goBack() {
        header('Location: ' . $this->_redirectedFrom);
    }

    protected function getPath() {

        $path = preg_replace("/\?(.*)$/", '', $_SERVER['REQUEST_URI']);

        return trim($path, '/');
    }
}
