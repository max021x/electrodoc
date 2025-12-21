<?php

namespace Core;

use Core\Viewer;

class Router
{

    protected array $routes = [];
    protected array $globalMiddlewares = [];
    protected array $routeMiddlewares = [];

    public function add(string $method, string $uri, string $controller, array $middlewares = []): void
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'middlewares' => $middlewares
        ];
    }

    protected function runMiddleware(array $middlewares, callable $target)
    {
        $next = $target;
        foreach (array_reverse($middlewares) as $middleware) {
            $next = fn() => (new $middleware)->handle($next);
        }

        return $next();
    }

    public function  addGlobalMiddleware(string $middleware)
    {
        $this->globalMiddlewares[] = $middleware;
    }


    public function addRouteMiddleware(string $name, string $middleware)
    {
        $this->routeMiddlewares[$name] = $middleware;
    }

    public function dispatch(string $uri, string $method): ?string
    {
        $route = $this->findRoute($uri, $method);

        if (!$route) {
            return static::notFound();
        }

        $middlewares =  [
            ...$this->globalMiddlewares,
            ...array_map(fn($name) => $this->routeMiddlewares[$name], $route['middlewares'])
        ];

        return $this->runMiddleware($middlewares, function () use ($route) {
            [$controller, $action] = explode('@', $route['controller']);
            return $this->callAction($controller, $action, $route['params']);
        });
    }

    public function findRoute(string $uri, string $method): ?array
    {
        foreach ($this->routes as $route) {

            $params = $this->matchRoute($route['uri'], $uri);

            if ($params !== null && $route['method'] === $method) {
                return [...$route, 'params' => $params];
            }
        }

        return null;
    }

    protected function matchRoute(string $routeUri, string $requestUri): ?array
    {
        $routeSegments = explode("/", trim($routeUri, "/"));
        $requestSegments = explode("/", trim($requestUri, "/"));

        if (count($requestSegments) !== count($routeSegments)) {
            return null;
        }

        $params = [];

        foreach ($routeSegments as $index => $routeSegment) {
            if (str_starts_with($routeSegment, "{") && str_ends_with($routeSegment, "}")) {
                $params[trim($routeSegment, "{}")] = $requestSegments[$index];
            } elseif ($routeSegment !== $requestSegments[$index]) {
                return null;
            }
        }

        return $params;
    }

    protected function callAction(string $controller, string $action, array $params): ?string
    {
        $controllerClass = "App\\Controllers\\$controller";

        return (new $controllerClass)->$action(...$params);
    }

    public static function notFound()
    {
        http_response_code(404);
        echo Viewer::render('errors/404', ['dnone' => true], 'layouts/main');
        exit;
    }


    public static function unauthorized()
    {
        http_response_code(401);
        echo Viewer::render('errors/401', ['dnone' => true], 'layouts/main');
        exit;
    }

    public static function forbidden()
    {
        http_response_code(403);
        echo Viewer::render('errors/403', ['dnone' => true], 'layouts/main');
        exit;
    }


    public static function redirect(string $uri): void
    {
        header("Location: $uri");
        exit();
    }
}
