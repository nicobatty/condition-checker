<?php
/**
 * User: Nicolas BATTY
 * Date: 09/12/2018
 * Time: 21:10
 */

namespace NicoBatty\ConditionChecker\Tests\Integration\Parser;

use NicoBatty\ConditionChecker\ConditionFactory;
use NicoBatty\ConditionChecker\ConditionGroupFactory;
use NicoBatty\ConditionChecker\Formatter\CurrencyFormatter;
use NicoBatty\ConditionChecker\GroupType\AllGroupType;
use NicoBatty\ConditionChecker\GroupType\AnyGroupType;
use NicoBatty\ConditionChecker\KeyPathResolver;
use NicoBatty\ConditionChecker\Operator\EqualOperator;
use NicoBatty\ConditionChecker\Operator\GreaterEqualOperator;
use NicoBatty\ConditionChecker\MainChecker;
use NicoBatty\ConditionChecker\RegularMessageResolver;
use PHPUnit\Framework\TestCase;

class RegularConditionTest extends TestCase
{
    /**
     * @throws \Exception
     */
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
            'price' => [
                'value' => 20.5,
                'currency' => 'EUR'
            ],
            'weight' => 0.9,
            'type' => 'T-shirt'
        ];
    }

    /**
     * @return \NicoBatty\ConditionChecker\ConditionGroup
     * @throws \Exception
     */
    protected function getConditionGroup()
    {
        $group = $this->getConditionGroupFactory()->create([
            'group' => 'all',
            'conditions' => [
                [
                    'group' => 'any',
                    'conditions' => [
                        [
                            'key' => 'type',
                            'operator' => 'neq',
                            'value' => 'Sweater',
                        ],
                        [
                            'key' => 'weight',
                            'operator' => 'lt',
                            'value' => 0.4,
                        ]
                    ]
                ],
                [
                    'key' => 'sku',
                    'operator' => 'eq',
                    'value' => 'AZERTY2',
                ],
                [
                    'key' => 'price.value',
                    'operator' => 'gte',
                    'value' => 20.6,
                    'format' => 'currency',
                ]
            ]
        ]);

        return $group;
    }

    protected function getConditionGroupFactory(): ConditionGroupFactory
    {
        $keyPathResolver = new KeyPathResolver();

        $operators = [
            'eq' => new EqualOperator(),
            'neq' => new EqualOperator(true),
            'gte' => new GreaterEqualOperator(),
            'lt' => new GreaterEqualOperator(true),
        ];

        $formatters = [
            'currency' => new CurrencyFormatter($keyPathResolver),
        ];

        $messageResolvers = [
            ConditionFactory::DEFAULT_RESOLVER_KEY => new RegularMessageResolver($formatters),
        ];

        $conditionFactory = new ConditionFactory($keyPathResolver, $operators, $messageResolvers);

        $groupTypes = [
            'all' => new AllGroupType(),
            'any' => new AnyGroupType(),
        ];

        $conditionGroupFactory = new ConditionGroupFactory($conditionFactory, $groupTypes);

        return $conditionGroupFactory;
    }

    protected function getExpectedErrors()
    {
        return [
            'The "sku" attribute of value "QWERTY1" is not equal to "AZERTY2".',
            'The "price.value" attribute of value "20.5 EUR" is not greater or equal than "20.6 EUR".'
        ];
    }
}
