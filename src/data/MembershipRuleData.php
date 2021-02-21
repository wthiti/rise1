<?php


namespace Rise1\Data;


use Rise1\Api\DataProvider;

class MembershipRuleData implements DataProvider
{
    const MEMBERSHIP_DISCOUNT = 'membership_discount';

    /**
     * @inheritDoc
     * @codeCoverageIgnore
     */
    public function getData(): array
    {
        return [
            self::MEMBERSHIP_DISCOUNT => 0.1
        ];
    }
}