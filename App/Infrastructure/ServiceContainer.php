<?php

namespace App\Infrastructure;

class ServiceContainer
{
    /** @var array<string, object> */
    private array $services = [];

    /** @var array<string, callable(): object> */
    private array $factories = [];

    /**
     * @param class-string $className
     * @param callable(): object $factory
     */
    public function register(string $className, callable $factory): void
    {
        $this->factories[$className] = $factory;
    }

    /**
     * @template T of object
     * @param class-string<T> $className
     * @return T
     */
    public function get(string $className): object
    {
        if (!isset($this->services[$className])) {
            $this->services[$className] = $this->factories[$className]();
        }
        /** @var T */
        return $this->services[$className];
    }
}
