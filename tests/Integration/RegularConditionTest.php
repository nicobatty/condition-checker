<?php
/**
 * User: Nicolas BATTY
 * Date: 09/12/2018
 * Time: 21:10
 */

namespace NicoBatty\ConditionChecker\Tests\Integration\Parser;

use NicoBatty\ConditionChecker\Condition\EqualCondition;
use NicoBatty\ConditionChecker\Condition\GreaterEqualCondition;
use NicoBatty\ConditionChecker\ConditionGroup\AllConditionGroup;
use NicoBatty\ConditionChecker\MainChecker;
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
        $skuCondition = new EqualCondition('sku', 'AZERTY2');
        $weightCondition = new EqualCondition('weight', 0.1);
        $priceCondition = new GreaterEqualCondition('price', 20.6);

        $group = new AllConditionGroup();
        $group->addCondition($skuCondition);
        $group->addCondition($weightCondition);
        $group->addCondition($priceCondition);

        return $group;
    }

    protected function getExpectedErrors()
    {
        return [
            'The "sku" attribute is not equal to "QWERTY1"',
            'The "price" attribute must be greater or equal than "20.5"'
        ];
    }
}
