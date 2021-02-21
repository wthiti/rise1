<?php

namespace Rise1\Test\Unit\Model;

use Rise1\Api\DataProvider;
use Rise1\Api\PriceCalculatedInterface;
use Rise1\Model\MemberDiscountBuilder;
use PHPUnit\Framework\TestCase;
use Rise1\Model\PriceDiscountCalculator;

class MemberDiscountBuilderTest extends TestCase
{
    private $membershipRuleData;

    protected function setUp(): void
    {
        parent::setUp();
        $this->membershipRuleData = $this->createMock(DataProvider::class);
    }

    public function testApplyDiscount(): void
    {
        $this->membershipRuleData
            ->expects($this->once())
            ->method('getData')
            ->willReturn($this->getRuleData());

        $target = new MemberDiscountBuilder($this->membershipRuleData);
        $actual = $target->applyDiscount($this->getMockPriceCalculatedObject(10.0));
        $this->assertInstanceOf(PriceDiscountCalculator::class, $actual);
    }

    private function getRuleData(): array
    {
        return [
            'membership_discount' => 0.1
        ];
    }

    private function getMockPriceCalculatedObject($price): PriceCalculatedInterface
    {
        $item = $this->createMock(PriceCalculatedInterface::class);
        $item->expects($this->any())
            ->method('getCalculatedPrice')
            ->willReturn($price);
        return $item;
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
