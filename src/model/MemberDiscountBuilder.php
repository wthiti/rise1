<?php


namespace Rise1\Model;


use Rise1\Api\DataProvider;
use Rise1\Api\PriceCalculatedInterface;
use Rise1\Data\MembershipRuleData;

class MemberDiscountBuilder
{
    /** @var DataProvider $membershipRuleData */
    private $membershipRuleData;

    /**
     * MemberDiscountBuilder constructor.
     * @param DataProvider $memberShipRuleData
     * @codeCoverageIgnore
     */
    public function __construct(DataProvider $memberShipRuleData)
    {
        $this->membershipRuleData = $memberShipRuleData;
    }

    /**
     * @param PriceCalculatedInterface $orderData
     * @return PriceCalculatedInterface
     */
    public function applyDiscount(PriceCalculatedInterface $orderData): PriceCalculatedInterface
    {
        $ruleData = $this->membershipRuleData->getData();
        $percentDiscount = $ruleData[MembershipRuleData::MEMBERSHIP_DISCOUNT];
        return new PriceDiscountCalculator($orderData, $percentDiscount);
    }
}