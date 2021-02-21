<?php

namespace Rise1\Api;

interface PriceCalculatedInterface
{
    /**
     * @return float
     */
    public function getCalculatedPrice(): float;
}