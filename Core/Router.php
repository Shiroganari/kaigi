<?php

namespace Core;

use Exception;

class Router
{
    protected array $routes = [];
    protected array $params = [];

    public function add($route, $params = [])
    {
        // Convert the route to a regular expression: escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);

        // Convert variables e.g. {controller}
        $route = preg_replace('/{([a-z]+)}/', '(?P<\1>[a-z-]+)', $route);

        // Convert variables with custom regular expressions e.g. {id:\d+}
        $route = preg_replace('/{([a-z]+):([^}]+)}/', '(?P<\1>\2)', $route);

        // Add start and end delimiters, and case-insensitive flag
        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;
    }

    public function match($url): bool
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }

                $this->params = $params;
                return true;
            }
        }

        return false;
    }

    public function dispatch($url)
    {
        $url = $this->removeQueryStringVariables($url);

        if (!$this->match($url)) {
            throw new Exception('No route matched.');
        }

        $controller = $this->params['controller'] . 'Controller';
        $controller = $this->convertToStudlyCaps($controller);
        $controller = $this->getNamespace() . $controller;

        if (!class_exists($controller)) {
            throw new Exception("Controller class $controller not found.");
        }

        $controller_object = new $controller($this->params);
        $action = $this->params['action'];
        $action = $this->convertToCamelCase($action);

        if (!is_callable([$controller_object, $action])) {
            throw new Exception("Method $action (in controller $controller) not found.");
        }

        $controller_object->$action();
    }

    protected function convertToStudlyCaps($string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    protected function convertToCamelCase($string): string
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }

    protected function removeQueryStringVariables($url)
    {
        if ($url == '') {
            return;
        }

        $parts = explode('&', $url, 2);

        if (strpos($parts[0], '=') === false) {
            $url = $parts[0];
        } else {
            $url = '';
        }

        return $url;
    }

    protected function getNamespace(): string
    {
        $namespace = 'App\Controllers\\';

        if (array_key_exists('namespace', $this->params)) {
            $namespace .= $this->params['namespace'] . '\\';
        }

        return $namespace;
    }
}