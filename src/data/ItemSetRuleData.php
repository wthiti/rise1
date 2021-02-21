<?php


namespace Rise1\Data;


use Rise1\Api\DataProvider;

class ItemSetRuleData implements DataProvider
{
    const ITEM = 'item';
    const DISCOUNT = 'discount';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getData(): array
    {
        return [
            self::ITEM => [
                'red' => 50.0,
                'green' => 40.0,
                'blue' => 30.0,
                'yellow' => 50.0,
                'pink' => 80.0,
                'purple' => 90.0,
                'orange' => 120.0
            ],
            self::DISCOUNT => [
                'percent' => 0.05,
                'list' => ['orange', 'pink', 'green']
            ]
        ];
    }
}