<?php
/**
 * @author Nicolas Batty <nicolas.batty@gmail.com>
 */

namespace NicoBatty\ConditionChecker\Tests\Unit;


use NicoBatty\ConditionChecker\Condition;
use NicoBatty\ConditionChecker\MessageResolverInterface;
use NicoBatty\ConditionChecker\Operator\OperatorInterface;
use PHPUnit\Framework\TestCase;

class ConditionTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     * @param string $key
     * @param array $data
     * @param string $value
     */
    public function testVerifyValidData($key, $data, $value)
    {
        $operator = $this->createMock(OperatorInterface::class);
        $operator->expects($this->once())
            ->method('isValid')
            ->with($value, $value)
            ->willReturn(true);

        $messageResolver = $this->createMock(MessageResolverInterface::class);

        /** @var OperatorInterface $operator */
        /** @var MessageResolverInterface $messageResolver */
        $condition = new Condition($operator, $messageResolver);
        $condition->setKey($key);
        $condition->setValue($value);

        $this->assertSame([], $condition->verifyData($data));
    }

    /**
     * @dataProvider additionProvider
     * @param string $key
     * @param array $data
     * @param string $value
     */
    public function testVerifyInvalidData($key, $data, $value)
    {
        $operator = $this->createMock(OperatorInterface::class);
        $operator->expects($this->once())
            ->method('isValid')
            ->with($value, $value)
            ->willReturn(false);

        $messageResolver = $this->createMock(MessageResolverInterface::class);
        $messageResolver->expects($this->once())
            ->method('getResolvedMessage')
            ->with($key, $data, $value)
            ->willReturn('The return data is invalid.');

        /** @var OperatorInterface $operator */
        /** @var MessageResolverInterface $messageResolver */
        $condition = new Condition($operator, $messageResolver);
        $condition->setKey($key);
        $condition->setValue($value);

        $this->assertSame(['The return data is invalid.'], $condition->verifyData($data));
    }

    public function additionProvider()
    {
        return [
            [
                'john',
                [
                    'foo' => 'bar',
                    'john' => 'doe'
                ],
                'doe'
            ],
        ];
    }
}