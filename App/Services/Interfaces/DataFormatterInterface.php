<?php

namespace App\Services\Interfaces;

interface DataFormatterInterface
{
    /**
     * @param mixed[] $data
     * @return string
     */
    public function format(array $data): string;
}
