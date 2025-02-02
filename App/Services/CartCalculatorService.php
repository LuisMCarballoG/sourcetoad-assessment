<?php

namespace App\Services;

class CartCalculatorService
{
    /**
     * @return float
     */
    public function taxRate(): float
    {
        return 0.07;
    }

    /**
     * @param float $subtotal
     * @return float
     */
    public function calculateTaxes(float $subtotal): float
    {
        return $subtotal * $this->taxRate();
    }

    /**
     * @param int $totalUnits
     * @return float
     */
    public function calculateShipping(int $totalUnits): float
    {
        return $totalUnits * 2.34;
    }

    /**
     * @param float $subtotal
     * @param float $taxes
     * @param float $shipping
     * @return float
     */
    public function calculateTotal(float $subtotal, float $taxes, float $shipping): float
    {
        return $subtotal + $taxes + $shipping;
    }
}
