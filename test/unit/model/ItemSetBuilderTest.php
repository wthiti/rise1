<?php

namespace Rise1\Test\Unit\Model;

use Rise1\Api\DataProvider;
use Rise1\Model\ItemSet;
use Rise1\Model\ItemSetBuilder;
use PHPUnit\Framework\TestCase;
use Rise1\Model\PriceDiscountCalculator;

class ItemSetBuilderTest extends TestCase
{
    private $itemSetRuleData;

    protected function setUp(): void
    {
        parent::setUp();
        $this->itemSetRuleData = $this->createMock(DataProvider::class);
    }

    /**
     * @dataProvider itemSetBuilderCases
     * @param $itemSetName
     * @param $qty
     * @param $expected
     */
    public function testBuild($itemSetName, $qty, $expected): void
    {
        $this->itemSetRuleData
            ->expects($this->once())
            ->method('getData')
            ->willReturn($this->getRuleData());

        $target = new ItemSetBuilder($this->itemSetRuleData);
        $actual = $target->build($itemSetName, $qty);
        $this->assertInstanceOf($expected, $actual);
    }

    public function itemSetBuilderCases(): array
    {
        return [
            ['red', 1, ItemSet::class],
            ['green', 1, ItemSet::class],
            ['orange', 3, PriceDiscountCalculator::class]
        ];
    }

    private function getRuleData(): array
    {
        return [
            'item' => [
                'red' => 50,
                'green' => 40,
                'blue' => 30,
                'yellow' => 50,
                'pink' => 80,
                'purple' => 90,
                'orange' => 120
            ],
            'discount' => [
                'percent' => 0.05,
                'list' => ['orange', 'pink', 'green']
            ]
        ];
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

}
