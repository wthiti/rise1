<?php

namespace Rise1\Api;

interface CalculatorInterface
{
    /**
     * @param array $items
     * @return PriceCalculatedInterface
     */
    public function setOrderList(array $items): PriceCalculatedInterface;

    /**
     * @return PriceCalculatedInterface
     */
    public function applyMemberShip(): PriceCalculatedInterface;

    /**
     * @return float
     */
    public function getCalculatedPrice(): float;
}