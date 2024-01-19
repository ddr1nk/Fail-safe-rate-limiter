<?php

namespace App;

use App\Data\Response\Response;
use App\Database\System\DatabaseConnection;
use App\Helpers\Logger;
use Error;
use Monolog\Handler\StreamHandler;
use Monolog\Level;

class Kernel
{
    /**
     * @return void
     */
    public function runApplication(): void
    {
        $this->loadNecessary();

        $callback = $this->handleRequest();

        $this->handleResponse($callback);
    }

    /**
     * @return void
     */
    private function loadNecessary(): void
    {
        Logger::getInstance()->pushHandler(
            new StreamHandler(dirname(__DIR__) . '/logs/monolog.log', Level::Debug),
        );

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

    /**
     * @return callable
     */
    private function handleRequest(): callable
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $getParamsPosition = strpos($requestUri, '?');
        $sigmaPart = $getParamsPosition ? substr($requestUri, 0, $getParamsPosition) : $requestUri;

        if (!str_replace('/', '', $sigmaPart)) {
            return fn() => $this->emptyResponse();
        }

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

    /**
     * @return callable
     */
    private function emptyResponse(): callable
    {
        return function () {
            echo "Салам =)";
        };
    }
}