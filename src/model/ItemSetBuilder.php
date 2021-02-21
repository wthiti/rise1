<?php


namespace Rise1\Model;


use Rise1\Api\DataProvider;
use Rise1\Api\PriceCalculatedInterface;
use Rise1\Data\ItemSetRuleData;

class ItemSetBuilder
{
    /** @var DataProvider $rule */
    private $rule;

    /**
     * ItemSetBuilder constructor.
     * @param DataProvider $rule
     * @codeCoverageIgnore
     */
    public function __construct(DataProvider $rule)
    {
        $this->rule = $rule;
    }

    /**
     * @param string $itemSetName
     * @param $qty
     * @return PriceCalculatedInterface
     */
    public function build(string $itemSetName, $qty): PriceCalculatedInterface
    {
        $data = $this->rule->getData();
        $itemTemplate = $data[ItemSetRuleData::ITEM];
        $price = $itemTemplate[$itemSetName];
        $itemSet = new ItemSet($price, $qty);

        $discountList = $data[ItemSetRuleData::DISCOUNT]['list'];
        $discountPercent = $data[ItemSetRuleData::DISCOUNT]['percent'];
        if (in_array($itemSetName, $discountList) && $qty > 1) {
            return new PriceDiscountCalculator($itemSet, $discountPercent);
        } else {
            return $itemSet;
        }
    }
}