<?php


namespace Rise1\Model;


use Rise1\Api\PriceCalculatedInterface;

class PriceDiscountCalculator implements PriceCalculatedInterface
{
    /** @var PriceCalculatedInterface $item */
    private $item;

    /** @var int $discount */
    private $discount;

    /**
     * PriceDiscountCalculator constructor.
     * @param PriceCalculatedInterface $item
     * @param float $discount
     * @codeCoverageIgnore
     */
    public function __construct(PriceCalculatedInterface $item, float $discount)
    {
        $this->item = $item;
        $this->discount = $discount;
    }

    /**
     * {@inheritDoc}
     */
    public function getCalculatedPrice(): float
    {
        return (1 - $this->discount) * $this->item->getCalculatedPrice();
    }
}