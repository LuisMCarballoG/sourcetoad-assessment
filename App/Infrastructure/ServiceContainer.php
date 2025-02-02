<?php

namespace App\Infrastructure;

class ServiceContainer
{
    private array $services = [];
    private array $factories = [];

    public function register(string $className, callable $factory): void
    {
        $this->factories[$className] = $factory;
    }

    public function get(string $className): object
    {
        if (!isset($this->services[$className])) {
            $this->services[$className] = $this->factories[$className]();
        }
        return $this->services[$className];
    }
}
