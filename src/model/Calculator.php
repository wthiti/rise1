<?php


namespace Rise1\Model;


use Rise1\Api\CalculatorInterface;
use Rise1\Api\PriceCalculatedInterface;

class Calculator implements PriceCalculatedInterface, CalculatorInterface
{
    /** @var ItemSetList $itemSetList */
    private $itemSetList;

    /** @var ItemSetBuilder $itemSetBuilder */
    private $itemSetBuilder;

    /** @var MemberDiscountBuilder $memberDiscountBuilder */
    private $memberDiscountBuilder;

    /** @var PriceCalculatedInterface $order */
    private $order;

    /**
     * Calculator constructor.
     * @param ItemSetList $itemSetList
     * @param ItemSetBuilder $itemSetBuilder
     * @param MemberDiscountBuilder $memberDiscountBuilder
     * @codeCoverageIgnore
     */
    public function __construct(
        ItemSetList $itemSetList,
        ItemSetBuilder $itemSetBuilder,
        MemberDiscountBuilder $memberDiscountBuilder
    ) {
        $this->itemSetList = $itemSetList;
        $this->itemSetBuilder = $itemSetBuilder;
        $this->memberDiscountBuilder = $memberDiscountBuilder;
    }

    /**
     * {@inheritDoc}
     */
    public function setOrderList(array $items): PriceCalculatedInterface
    {
        foreach ($items as $item) {
            $itemSet = $this->itemSetBuilder->build($item[0], $item[1]);
            $this->itemSetList->addItemSet($itemSet);
        }
        $this->order = $this->itemSetList;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function applyMemberShip(): PriceCalculatedInterface
    {
        $this->order = $this->memberDiscountBuilder->applyDiscount($this->order);
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCalculatedPrice(): float
    {
        return $this->order->getCalculatedPrice();
    }
}