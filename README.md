### Calculator Class ###

Running Test

```./vendor/bin/phpunit --testdox test```

Result

```
PHPUnit 9.5.2 by Sebastian Bergmann and contributors.

Calculator Acceptance (Rise1\Model\Acceptance\CalculatorAcceptance)
 ✔ Order red and green
 ✔ Customer have membership card
 ✔ Order orange more than two per bill

Calculator (Rise1\Test\Unit\Model\Calculator)
 ✔ Set order list
 ✔ Apply member ship
 ✔ Get calculated price

Item Set Builder (Rise1\Test\Unit\Model\ItemSetBuilder)
 ✔ Build with data set #0
 ✔ Build with data set #1
 ✔ Build with data set #2

Item Set List (Rise1\Test\Unit\Model\ItemSetList)
 ✔ Get calculated for multiple items with data set #0
 ✔ Get calculated for multiple items with data set #1
 ✔ Add item set

Item Set (Rise1\Test\Unit\Model\ItemSet)
 ✔ Get calculated price item with data set #0
 ✔ Get calculated price item with data set #1
 ✔ Get calculated price item with data set #2

Member Discount Builder (Rise1\Test\Unit\Model\MemberDiscountBuilder)
 ✔ Apply discount

Price Discount Calculator (Rise1\Test\Unit\Model\PriceDiscountCalculator)
 ✔ Get calculated price with discount with data set #0
 ✔ Get calculated price with discount with data set #1

Time: 00:00.010, Memory: 6.00 MB

OK (18 tests, 31 assertions)
```