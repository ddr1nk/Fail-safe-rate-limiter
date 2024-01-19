<?php

namespace App;

use App\Data\Response\Response;
use App\Database\DatabaseConnection;
use Error;

class Kernel
{
    public function runApplication(): void
    {
        $this->loadNecessary();

        $callback = $this->handleRequest();

        $this->handleResponse($callback);
    }

    private function loadNecessary(): void
    {
        DatabaseConnection::getConnection();
    }

    /**
     * @param callable $action
     *
     * @return void
     */
    private function handleResponse(callable $action): void
    {
        try {
            /** @var Response $response */
            $response = $action();

            $response->output();
        } catch (Error) {
            echo "Передаем какие-то ненужные параметры или нужных нет =)";
            die;
        }
    }

    private function handleRequest(): callable
    {
        $requestUri = $_SERVER['REQUEST_URI'];

        $getParamsPosition = strpos($requestUri, '?');

        $sigmaPart = $getParamsPosition ? substr($requestUri, 0, $getParamsPosition) : $requestUri;

        [$controllerClass, $action] = array_map(
            fn($element) => ucfirst($element),
            array_values(array_filter(explode('/', $sigmaPart))),
        );

        $action .= 'Action';
        $controllerClass = '\\App\\Controllers\\' . $controllerClass . 'Controller';
        $controller = new $controllerClass();

        $params = $_GET;

        return fn() => $controller->$action(...$params);
    }
}