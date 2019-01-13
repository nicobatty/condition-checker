<?php
/**
 * User: Nicolas BATTY
 * Date: 09/12/2018
 * Time: 21:10
 */

namespace NicoBatty\ConditionChecker\Tests\Integration\Parser;

use NicoBatty\ConditionChecker\Condition;
use NicoBatty\ConditionChecker\Operator\EqualOperator;
use NicoBatty\ConditionChecker\Operator\GreaterEqualOperator;
use NicoBatty\ConditionChecker\ConditionGroup\AllConditionGroup;
use NicoBatty\ConditionChecker\MainChecker;
use NicoBatty\ConditionChecker\RegularMessageResolver;
use PHPUnit\Framework\TestCase;

class RegularConditionTest extends TestCase
{
    public function testConditionCheck()
    {
        $conditionChecker = new MainChecker();
        $conditionChecker->setData($this->getWorkingData());
        $conditionChecker->setCondition($this->getConditionGroup());

        $this->assertSame($this->getExpectedErrors(), $conditionChecker->getAllErrors());
    }

    protected function getWorkingData()
    {
        return [
            'sku' => 'QWERTY1',
            'name' => 'Say My Name T-shirt',
            'price' => 20.5,
            'weight' => 0.1,
            'type' => 'T-shirt'
        ];
    }

    protected function getConditionGroup()
    {

        $equalOperator = new EqualOperator();
        $gteOperator = new GreaterEqualOperator();

        $regularMessageResolver = new RegularMessageResolver(
            'The "%key" attribute of value "%actual" is not equal to "%expected".'
        );

        $gteMessageResolver = new RegularMessageResolver(
            'The "%key" attribute of value "%actual" is not greater or equal than "%expected".'
        );

        $skuCondition = new Condition($equalOperator, $regularMessageResolver);
        $skuCondition->setKey('sku');
        $skuCondition->setValue('AZERTY2');

        $weightCondition = new Condition($equalOperator, $regularMessageResolver);
        $weightCondition->setKey('weight');
        $weightCondition->setValue(0.1);

        $priceCondition = new Condition($gteOperator, $gteMessageResolver);
        $priceCondition->setKey('price');
        $priceCondition->setValue(20.6);

        $group = new AllConditionGroup();
        $group->addCondition($skuCondition);
        $group->addCondition($weightCondition);
        $group->addCondition($priceCondition);

        return $group;
    }

    protected function getExpectedErrors()
    {
        return [
            'The "sku" attribute of value "QWERTY1" is not equal to "AZERTY2".',
            'The "price" attribute of value "20.5" is not greater or equal than "20.6".'
        ];
    }
}
