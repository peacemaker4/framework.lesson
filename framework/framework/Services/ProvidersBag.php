<?php


namespace Framework\Services;


use Framework\Providers\Provider;

class ProvidersBag extends Service {
    /** @var Provider[]|array */
    protected $providers = [];

    public function register(string $provider){
        if (isset($providers[$provider]))
            throw new \Exception("Provider [$provider] is already registered.");

        if (!is_a($provider, Provider::class, true))
            throw new \Exception("Provider [$provider] is not instance of " . Provider::class);

        $this->providers[$provider] = new $provider($this->app);
        $this->providers[$provider]->register();
    }

    public function boot(){
        foreach ($this->providers as $provider)
            $provider->boot();
    }

    public function get(string $provider){
        if(!isset($this->providers[$provider]))
            throw new \Exception("Provider [$provider] is not registered.");

        return $this->providers[$provider];
    }
}