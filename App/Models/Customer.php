<?php

namespace App\Models;

use App\DTO\AddressDTO;

class Customer
{
    /** @var AddressDTO[] */
    private array $addresses = [];

    /**
     * @param string $first_name
     * @param string $last_name
     */
    public function __construct(
        public readonly string $first_name,
        public readonly string $last_name,
    ) {
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return "$this->first_name $this->last_name";
    }

    /**
     * @param AddressDTO $address
     * @return void
     */
    public function addAddress(AddressDTO $address): void
    {
        $this->addresses[] = $address;
    }

    /**
     * @return AddressDTO[]
     */
    public function getAddresses(): array
    {
        return $this->addresses;
    }
}
