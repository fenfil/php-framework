<?php

namespace core\base;

use Twig_Environment;

class View extends BaseObject {
    public $title;

    private $_renderer;
    private $_data;

    public function __construct(Twig_Environment $renderer, array $data) {
        $this->_renderer = $renderer;
        $this->_data = $data;
    }

    public function render(string $view, array $data = []) {
        $this->_data = [
            'app' => $this->_data,
            'view' => ['title' => $this->title],
        ];

        $this->_data = array_merge(
            $this->_data,
            $data
        );

        return $this->_renderer->render($view, $this->_data);
    }
}
