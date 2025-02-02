<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Customer;

class CartPrinterService
{
    /**
     * @param Cart $cart
     * @param CartCalculatorService $calculator
     * @return void
     */
    public function printCartSummary(Cart $cart, CartCalculatorService $calculator): void
    {
        $this->printCustomerInfo($cart);
        $this->printAddresses($cart->getCustomer());
        $this->printSelectedShippingAddress($cart);
        $this->printItemsWithoutCosts($cart);
        $this->printItemsWithTaxesAndShipping($cart, $calculator);
        $this->printFinancialSummary($cart, $calculator);
    }

    /**
     * @param Cart $cart
     * @return void
     */
    private function printCustomerInfo(Cart $cart): void
    {
        echo "Customer:\n  " . $cart->getCustomer()->getFullName() . "\n\n";
    }

    /**
     * @param Customer $customer
     * @return void
     */
    private function printAddresses(Customer $customer): void
    {
        echo "Addresses:\n";
        foreach ($customer->getAddresses() as $address) {
            echo "  " . $address->getFormattedAddress() . "\n";
        }
        echo "\n";
    }

    /**
     * @param Cart $cart
     * @return void
     */
    private function printSelectedShippingAddress(Cart $cart): void
    {
        echo "Selected Shipping Address:\n";
        if ($cart->getShippingAddress() !== null) {
            echo "  " . $cart->getShippingAddress()->getFormattedAddress() . "\n\n";
        } else {
            echo "  No shipping address selected\n\n";
        }
    }

    /**
     * @param Cart $cart
     * @return void
     */
    private function printItemsWithoutCosts(Cart $cart): void
    {
        echo "Items (Base Prices):\n";
        foreach ($cart->getItems() as $item) {
            printf(
                "  %s | Subtotal: $%.2f\n",
                $item->getFullDescription(),
                $item->getCost(),
            );
        }
        echo "\n";
    }

    /**
     * @param Cart $cart
     * @param CartCalculatorService $calculator
     * @return void
     */
    private function printItemsWithTaxesAndShipping(Cart $cart, CartCalculatorService $calculator): void
    {
        $totalUnits = $cart->getTotalUnits();
        $shippingPerUnit = $totalUnits > 0
            ? $calculator->calculateShipping($cart->getTotalUnits()) / $totalUnits
            : 0;

        echo "Items with Taxes and Shipping:\n";
        foreach ($cart->getItems() as $item) {
            $unitPriceWithTax = $item->price * (1 + $calculator->taxRate());
            $unitTotal = $unitPriceWithTax + $shippingPerUnit;
            $totalPerItem = $unitTotal * $item->quantity;

            printf(
                "  %s\n  Unit Cost: $%.2f (Price: $%.2f + Tax: $%.2f + Shipping: $%.2f)\n  Total: $%.2f\n\n",
                $item->getFullDescription(),
                $unitTotal,
                $item->price,
                $item->price * $calculator->taxRate(),
                $shippingPerUnit,
                $totalPerItem,
            );
        }
    }

    /**
     * @param Cart $cart
     * @param CartCalculatorService $calculator
     * @return void
     */
    private function printFinancialSummary(Cart $cart, CartCalculatorService $calculator): void
    {
        $subtotal = $cart->getSubtotal();
        $taxes = $calculator->calculateTaxes($subtotal);
        $shipping = $calculator->calculateShipping($cart->getTotalUnits());
        $total = $calculator->calculateTotal($subtotal, $taxes, $shipping);

        echo "Financial Summary:\n";
        printf(
            "  Subtotal:  $%.2f\n  Taxes:     $%.2f\n  Shipping:  $%.2f\n  Total:     $%.2f\n",
            $subtotal,
            $taxes,
            $shipping,
            $total,
        );
    }
}
