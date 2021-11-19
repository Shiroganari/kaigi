<?php

namespace Core;

use Exception;

abstract class Controller
{
    protected array $route_params = [];
    protected array $post_params = [];

    public function __construct($route_params)
    {
        $this->route_params = $route_params;

        $param_string = urldecode(file_get_contents('php://input'));
        parse_str($param_string, $this->post_params);
    }

    public function __call($name, $args)
    {
        $method = $name . 'Action';

        if (!method_exists($this, $method)) {
            throw new Exception("Method $method not found in controller " . get_class($this));
        }

        if ($this->before() !== false) {
            call_user_func_array([$this, $method], $args);
            $this->after();
        }
    }

    protected function before()
    {
    }

    protected function after()
    {
    }
}