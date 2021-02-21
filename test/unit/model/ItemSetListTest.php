<?php

namespace Rise1\Test\Unit\Model;

use Rise1\Api\ItemSetListRepositoryInterface;
use Rise1\Api\PriceCalculatedInterface;
use Rise1\Model\ItemSetList;
use PHPUnit\Framework\TestCase;

class ItemSetListTest extends TestCase
{
    /** @var \PHPUnit\Framework\MockObject\MockObject|ItemSetListRepositoryInterface $itemSetListRepository */
    private $itemSetListRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->itemSetListRepository = $this->createMock(ItemSetListRepositoryInterface::class);
    }

    /**
     * @dataProvider itemSetListCases
     * @param array $itemSetArray
     * @param float $expected
     */
    public function testGetCalculatedForMultipleItems(array $itemSetArray, float $expected): void
    {
        $target = new ItemSetList($this->itemSetListRepository);
        $this->itemSetListRepository->expects($this->once())
            ->method('getItemList')
            ->willReturn($itemSetArray);
        $actual = $target->getCalculatedPrice();
        $this->assertEquals($expected, $actual);
    }

    public function itemSetListCases(): array
    {
        return [
            [[$this->createMockItemSet(30,1), $this->createMockItemSet(10,1)],40.0],
            [[$this->createMockItemSet(100,2)], 200.0]
        ];
    }

    public function testAddItemSet(): void
    {
        $target = new ItemSetList($this->itemSetListRepository);
        $this->itemSetListRepository->expects($this->once())
            ->method('addItem');
        $target->addItemSet($this->createMockItemSet(10,2));
    }

    private function createMockItemSet(float $price, int $qty): PriceCalculatedInterface
    {
        $itemSet = $this->createMock(PriceCalculatedInterface::class);
        $itemSet->expects($this->any())
            ->method('getCalculatedPrice')
            ->willReturn((float) $price * $qty);
        return $itemSet;
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

}
