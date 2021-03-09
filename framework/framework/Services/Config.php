<?php


namespace Framework\Services;


use Framework\Application;
use League\Flysystem\FileAttributes;
use League\Flysystem\Filesystem;
use League\Flysystem\Local\LocalFilesystemAdapter;

class Config extends Service {
    protected $root;
    protected $cache;

    public function __construct(Application $app) {
        parent::__construct($app);
        $this->root = $this->app->rootPath();
        $this->cache = [];

        $this->cacheAll();
    }

    public function get(string $key, $default = null){
        $parts = explode('.', $key);
        $res = $this->cache[array_shift($parts)] ?? $default;

        if ($res === $default)
            return $res;

        foreach ($parts as $part)
            $res = $res[$part] ?? $default;

        return $res;
    }

    protected function cacheAll(){
        $files = $this->scan();

        foreach($files as $file){
            $name = explode(DIRECTORY_SEPARATOR, $file);
            $name = explode('.', array_pop($name))[0];
            $data = require "{$this->root}/{$file}";

            if(is_array($data))
                $this->cache[$name] = $data;
        }
    }

    protected function scan(){
        $adapter = $this->app->get(LocalFilesystemAdapter::class, [
            $this->root
        ]);

        /** @var  Filesystem $fs*/
        $fs = $this->app->get(Filesystem::class, [$adapter]);

        $dir = $fs->listContents('config');
        return $dir
            ->filter(function (FileAttributes $attributes){
                return $attributes->isFile();
            })
            ->map(function (FileAttributes $attributes){
                return $attributes->path();
            })
            ->toArray();
    }

}