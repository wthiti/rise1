<?php

namespace Rise1\Test\Unit\Model;

use Rise1\Api\PriceCalculatedInterface;
use Rise1\Model\PriceDiscountCalculator;
use PHPUnit\Framework\TestCase;

class PriceDiscountCalculatorTest extends TestCase
{
    /**
     * @dataProvider priceDiscountCalculatorCases
     * @param $item
     * @param $expected
     */
    public function testGetCalculatedPriceWithDiscount($item, $expected): void
    {
        $target = new PriceDiscountCalculator($item, 0.1);
        $this->assertEquals($expected, $target->getCalculatedPrice());
    }

    public function priceDiscountCalculatorCases(): array
    {
        return [
            [$this->createPriceCalculatedInterfaceMock(100.0), 90.0],
            [$this->createPriceCalculatedInterfaceMock(0.0), 0.0]
        ];
    }

    private function createPriceCalculatedInterfaceMock($calculatedPrice): PriceCalculatedInterface
    {
        $item = $this->createMock(PriceCalculatedInterface::class);
        $item->expects($this->any())
            ->method('getCalculatedPrice')
            ->willReturn($calculatedPrice);
        return $item;
    }
}
