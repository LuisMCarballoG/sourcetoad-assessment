<?php

namespace App\Services;

use App\Services\Interfaces\DataFormatterInterface;

class KeyValueFormatterService implements DataFormatterInterface
{
    /**
     * @param mixed[] $data
     * @return string
     */
    public function format(array $data): string
    {
        $output = '';
        array_walk_recursive($data, function ($value, $key) use (&$output) {
            $output .= "$key: $value\n";
        });
        return $output;
    }
}
