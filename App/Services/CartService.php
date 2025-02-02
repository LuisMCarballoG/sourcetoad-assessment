<?php

namespace App\Services;

use App\DTO\AddressDTO;
use App\DTO\ItemDTO;
use App\Models\Cart;
use App\Models\Customer;

class CartService
{
    /**
     * @param CartCalculatorService $calculator
     * @param CartPrinterService $printer
     */
    public function __construct(
        private readonly CartCalculatorService $calculator,
        private readonly CartPrinterService $printer,
    ) {
    }

    /**
     * @return void
     */
    public function processOrder(): void
    {
        $customer = $this->createCustomer();
        $cart = $this->createCart($customer);
        $this->addItemsToCart($cart);

        $cart->setShippingAddress($customer->getAddresses()[0]);

        $this->printer->printCartSummary($cart, $this->calculator);
    }

    /**
     * @return Customer
     */
    private function createCustomer(): Customer
    {
        $customer = new Customer('John', 'Doe');
        $customer->addAddress(new AddressDTO('123 Main St', 'Apt 4B', 'Anytown', 'CA', '12345'));
        $customer->addAddress(new AddressDTO('456 Oak Rd', '', 'Otherville', 'NY', '67890'));
        return $customer;
    }

    /**
     * @param Customer $customer
     * @return Cart
     */
    private function createCart(Customer $customer): Cart
    {
        $cart = new Cart($customer);
        $cart->setShippingAddress($customer->getAddresses()[0]);
        return $cart;
    }

    /**
     * @param Cart $cart
     * @return void
     */
    private function addItemsToCart(Cart $cart): void
    {
        $items = [
            new ItemDTO(1, 'Premium Widget', 2, 64.00),
            new ItemDTO(2, 'Standard Widget', 5, 45.00),
            new ItemDTO(3, 'Basic Widget', 3, 23.00),
        ];

        foreach ($items as $item) {
            $cart->addItem($item);
        }
    }
}
