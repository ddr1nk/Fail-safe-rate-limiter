<?php

namespace App;

use App\Controllers\IndexController;
use App\Data\Response\Response;
use App\Database\System\DatabaseConnection;
use App\Helpers\Logger;
use Error;
use Monolog\Handler\StreamHandler;
use Monolog\Level;

class Kernel
{
    protected Router $router;

    public function __construct()
    {
        $this->router = new Router();
    }

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

        if ($sigmaPart !== '/') {
            [$page, $action] = array_map(
                fn($element) => ucfirst($element),
                array_values(array_filter(explode('/', $sigmaPart))),
            );

            $controller = $this->router->getControllerByPage($page);
            $action .= 'Action';

            return fn() => $controller->$action(...$_GET);
        }

        return fn() => (new IndexController())->indexAction();
    }
}