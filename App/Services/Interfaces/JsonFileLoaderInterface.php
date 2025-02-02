<?php

namespace App\Services\Interfaces;

interface JsonFileLoaderInterface
{
    /** @return array<string, mixed> */
    public function getData(): array;
}
