<?php
// helpers

use Framework\Application;
use Framework\Providers\HttpProvider;
use Framework\Providers\ViewProvider;
use Framework\Services\Config;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Laminas\Diactoros\Response\TextResponse;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Environment;

/**
 * @param string|null $class
 * @return Application|mixed
 */

function app(string $class = null){
    $app = Application::instance();

    if(empty($class))
        return $app;

    return $app->get($class);
}

function config(string $key, $default = null){
    return app(Config::class)
        ->get($key, $default);
}

/**
 * @param string|null $key
 * @return mixed|ServerRequestInterface|null
 */

function request(string $key = null) {
    /** @var ServerRequestInterface $request */

    $request = app(HttpProvider::class)->request();

    if(empty($key))
        return $request;

    $data = array_merge(
        $request->getQueryParams(),
        $request->getParsedBody()
    );

    return $data[$key] ?? null;
}

function path(string $path = null){
    $path = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $path);
    $path = trim(trim($path, DIRECTORY_SEPARATOR));

    $root = app()->rootPath();
    return $root . DIRECTORY_SEPARATOR . $path;
}

function response($body){
    if(is_string($body))
        return new TextResponse($body);

    elseif(is_array($body))
        return new JsonResponse($body);

    return $body;
}

function redirect(string $url){
    return new RedirectResponse($url);
}

function view($view, array $vars = []){
    /** @var Environment $twig */

    $twig = app(ViewProvider::class)->twig();
    $result = $twig->render($view, $vars);
    return new HtmlResponse($result);
}