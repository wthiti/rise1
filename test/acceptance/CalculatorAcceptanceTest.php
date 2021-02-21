<?php

namespace Rise1\Model\Acceptance;

use PHPUnit\Framework\TestCase;
use Rise1\Api\CalculatorInterface;
use Rise1\Data\ItemSetRuleData;
use Rise1\Data\MembershipRuleData;
use Rise1\Model\Calculator;
use Rise1\Model\ItemSetBuilder;
use Rise1\Model\ItemSetList;
use Rise1\Model\MemberDiscountBuilder;
use Rise1\Repository\ItemSetListRepository;

class CalculatorAcceptanceTest extends TestCase
{
    /** @var CalculatorInterface $calculator */
    private $calculator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->calculator = new Calculator(
            new ItemSetList(new ItemSetListRepository()),
            new ItemSetBuilder(new ItemSetRuleData()),
            new MemberDiscountBuilder(new MembershipRuleData())
        );
    }

    public function testOrderRedAndGreen(): void
    {
        $expected = 90.0;

        $this->calculator->setOrderList([
            ['red', 1],
            ['green', 1]
        ]);

        $this->assertEquals($expected, $this->calculator->getCalculatedPrice());
    }

    public function testCustomerHaveMembershipCard(): void
    {
        $expected = 135.0;

        $this->calculator
            ->setOrderList([
                ['blue', 2],
                ['purple', 1]
            ])
            ->applyMemberShip();

        $this->assertEquals($expected, $this->calculator->getCalculatedPrice());
    }

    public function testOrderOrangeMoreThanTwoPerBill(): void
    {
        $expected = 342;

        $this->calculator->setOrderList([['orange',3]]);

        $this->assertEquals($expected, $this->calculator->getCalculatedPrice());
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

}
