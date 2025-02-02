<?php

namespace App\DTO;

class AddressDTO
{
    /**
     * @param string $line_1
     * @param string $line_2
     * @param string $city
     * @param string $state
     * @param string $zip
     */
    public function __construct(
        public readonly string $line_1,
        public readonly string $line_2,
        public readonly string $city,
        public readonly string $state,
        public readonly string $zip,
    ) {
    }

    /**
     * @return string
     */
    public function getFormattedAddress(): string
    {
        return sprintf(
            "Line 1: %s, Line 2: %s, City: %s, State: %s, Zip %s",
            $this->line_1,
            $this->line_2,
            $this->city,
            $this->state,
            $this->zip,
        );
    }
}
