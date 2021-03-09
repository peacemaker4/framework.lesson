<?php


namespace Framework\Providers;



use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ViewProvider extends Provider {
    protected $twig;

    function register() {
        $defaultPath = path('views');
        $defaultCache = path('cache/views');

        $loader = new FilesystemLoader(config('views.path', $defaultPath));
        $this->twig = new Environment($loader, [
            'cache' => config('views.cache', $defaultCache)
        ]);
    }

    function twig(): Environment{
        return $this->twig;
    }

    function boot() {

    }
}