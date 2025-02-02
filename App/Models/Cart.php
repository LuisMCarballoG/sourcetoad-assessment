<?php

namespace App\Models;

use App\DTO\AddressDTO;
use App\DTO\ItemDTO;

class Cart
{
    /** @var ItemDTO[] */
    private array $items = [];

    /**
     * @var AddressDTO|null
     */
    private ?AddressDTO $shipping_address = null;

    /**
     * @param Customer $customer
     */
    public function __construct(
        private readonly Customer $customer,
    ) {
    }

    /**
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * @param AddressDTO $address
     * @return void
     */
    public function setShippingAddress(AddressDTO $address): void
    {
        $this->shipping_address = $address;
    }

    /**
     * @return AddressDTO|null
     */
    public function getShippingAddress(): ?AddressDTO
    {
        return $this->shipping_address;
    }

    /**
     * @param ItemDTO $item
     * @return void
     */
    public function addItem(ItemDTO $item): void
    {
        $this->items[] = $item;
    }

    /**
     * @return ItemDTO[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return float
     */
    public function getSubtotal(): float
    {
        return array_reduce(
            $this->items,
            fn (float $sum, ItemDTO $item) => $sum + $item->price * $item->quantity,
            0.0,
        );
    }

    /**
     * @return int
     */
    public function getTotalUnits(): int
    {
        return array_reduce(
            $this->items,
            fn (int $sum, ItemDTO $item) => $sum + $item->quantity,
            0,
        );
    }
}
