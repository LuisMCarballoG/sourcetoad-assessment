<?php

namespace App\DTO;

class ItemDTO
{
    /**
     * @param int $id
     * @param string $name
     * @param int $quantity
     * @param float $price
     */
    public function __construct(
        public readonly int    $id,
        public readonly string $name,
        public readonly int    $quantity,
        public readonly float  $price,
    ) {
    }

    /**
     * @return float|int
     */
    public function getCost(): float|int
    {
        return $this->quantity * $this->price;
    }

    /**
     * @return string
     */
    public function getFullDescription(): string
    {
        return sprintf(
            "ID: %d, Name: %s, Qty: %d, Price: $%.2f",
            $this->id,
            $this->name,
            $this->quantity,
            $this->price,
        );
    }
}
