<?php
/**
 * User: Nicolas BATTY
 * Date: 09/12/2018
 * Time: 21:10
 */

namespace NicoBatty\ConditionChecker\Tests\Integration\Parser;

use NicoBatty\ConditionChecker\Condition;
use NicoBatty\ConditionChecker\ConditionGroup;
use NicoBatty\ConditionChecker\MainChecker;
use PHPUnit\Framework\TestCase;

class RegularConditionTest extends TestCase
{
    public function testConditionCheck()
    {
        $conditionChecker = new MainChecker();
        $conditionChecker->setData($this->getWorkingData());
        $conditionChecker->setConditionGroup($this->getConditionGroup());

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
        $condition = new Condition('sku');
        $condition->equal('QWERTY1');

        $group = new ConditionGroup();
        $group->any();
        $group->addCondition($condition);

        return $group;
    }

    protected function getExpectedErrors()
    {
        return [
            'The "sku" attribute is not equal to "QWERTY1"'
        ];
    }
}
