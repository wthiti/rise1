<?php

namespace Rise1\Test\Unit\Model;

use Rise1\Model\ItemSet;
use PHPUnit\Framework\TestCase;

class ItemSetTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @dataProvider itemSetCases
     * @param float $price
     * @param int $qty
     * @param float $expected
     */
    public function testGetCalculatedPriceItem(float $price, int $qty, float $expected): void
    {
        $actual = (new ItemSet($price, $qty))->getCalculatedPrice();
        $this->assertEquals($expected, $actual);
    }

    public function itemSetCases(): array
    {
        return [
            [80, 1, 80.0],
            [80, 2, 160.0],
            [80, 0, 0.0]
        ];
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

}
