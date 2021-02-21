<?php


namespace Rise1\Model;


use Rise1\Api\PriceCalculatedInterface;

class ItemSet implements PriceCalculatedInterface
{
    /** @var int $price */
    private $price;

    /** @var int $qty */
    private $qty;

    /**
     * ItemSet constructor.
     * @param float $price
     * @param int $qty
     * @codeCoverageIgnore
     */
    public function __construct(float $price, int $qty)
    {
        $this->price = $price;
        $this->qty = $qty;
    }

    /**
     * {@inheritDoc}
     */
    public function getCalculatedPrice(): float
    {
        return (float) $this->price * $this->qty;
    }

}