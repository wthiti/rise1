<?php

namespace Rise1\Test\Unit\Model;

use Rise1\Api\PriceCalculatedInterface;
use Rise1\Model\Calculator;
use PHPUnit\Framework\TestCase;
use Rise1\Model\ItemSetBuilder;
use Rise1\Model\ItemSetList;
use Rise1\Model\MemberDiscountBuilder;

class CalculatorTest extends TestCase
{
    /** @var \PHPUnit\Framework\MockObject\MockObject|ItemSetBuilder $itemSetBuilder */
    private $itemSetBuilder;

    private $itemSetList;

    private $memberDiscountBuilder;

    private $target;

    protected function setUp(): void
    {
        parent::setUp();
        $this->itemSetBuilder = $this->createMock(ItemSetBuilder::class);
        $this->itemSetList = $this->createMock(ItemSetList::class);
        $this->memberDiscountBuilder = $this->createMock(MemberDiscountBuilder::class);
        $this->target = new Calculator(
            $this->itemSetList,
            $this->itemSetBuilder,
            $this->memberDiscountBuilder
        );
    }

    public function testSetOrderList(): void
    {
        $actual = $this->mockCalculatorSetItems();

        $this->assertSame($this->target, $actual);
    }

    public function testApplyMemberShip(): void
    {
        $this->mockCalculatorSetItems();

        $this->memberDiscountBuilder->expects($this->once())
            ->method('applyDiscount')
            ->willReturn($this->createMockItemSet(90.0));

        $actual = $this->target->applyMemberShip();
        $this->assertSame($this->target, $actual);
    }

    public function testGetCalculatedPrice(): void
    {
        $this->mockCalculatorSetItems();

        $this->itemSetList->expects($this->once())
            ->method('getCalculatedPrice')
            ->willReturn(100.0);

        $this->assertEquals(100.0, $this->target->getCalculatedPrice());
    }

    private function createMockItemSet(float $price): PriceCalculatedInterface
    {
        $itemSet = $this->createMock(PriceCalculatedInterface::class);
        $itemSet->expects($this->any())
            ->method('getCalculatedPrice')
            ->willReturn($price);
        return $itemSet;
    }

    private function mockCalculatorSetItems(): PriceCalculatedInterface
    {
        $itemName = 'orange';
        $qty = 1;
        $price = 100.0;

        $mockItemSet = $this->createMockItemSet($price);

        $this->itemSetBuilder->expects($this->once())
            ->method('build')
            ->with($this->equalTo($itemName), $this->equalTo($qty))
            ->willReturn($mockItemSet);

        $this->itemSetList->expects($this->once())
            ->method('addItemSet')
            ->with($this->equalTo($mockItemSet));

        return $this->target->setOrderList([[$itemName,$qty]]);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
