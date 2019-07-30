<?php
/**
 * @author Nicolas Batty <nicolas.batty@gmail.com>
 */

namespace NicoBatty\ConditionChecker;

use NicoBatty\ConditionChecker\Operator\OperatorInterface;

class Condition implements ConditionInterface
{

    protected $operator;

    /**
     * @var MessageResolverInterface
     */
    private $messageResolver;

    /**
     * @var KeyPathResolver
     */
    private $keyPathResolver;

    /**
     * Condition Key
     *
     * @var string
     */
    protected $key;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var string
     */
    protected $template;

    /**
     * @var string
     */
    protected $format;

    /**
     * @param KeyPathResolver $keyPathResolver
     * @param OperatorInterface $operator
     * @param MessageResolverInterface $messageResolver
     */
    public function __construct(
        KeyPathResolver $keyPathResolver,
        OperatorInterface $operator,
        MessageResolverInterface $messageResolver
    )
    {
        $this->keyPathResolver = $keyPathResolver;
        $this->operator = $operator;
        $this->messageResolver = $messageResolver;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return self
     */
    public function setKey(string $key): self
    {
        $this->key = $key;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return self
     */
    public function setValue($value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @param $template
     * @return Condition
     */
    public function setTemplate($template): self
    {
        $this->template = $template;

        return $this;
    }

    public function getTemplate(): string
    {
        return $this->template ?: $this->operator->getDefaultMessage();
    }

    /**
     * @return string
     */
    public function getFormat(): ?string
    {
        return $this->format;
    }

    /**
     * @param string $format
     * @return self
     */
    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function verifyData(array $data): array
    {
        $value = $this->getValueFromData($data);
        if (!$this->operator->isValid($value, $this->value)) {
            return [$this->getResolvedMessage($value, $data)];
        }
        return [];
    }

    protected function getResolvedMessage($value, array $data): string
    {
        return $this->messageResolver->getResolvedMessage($this, $value, $data);
    }

    protected function getValueFromData(array $data)
    {
        return $this->keyPathResolver->getValueFromKey($data, $this->key);
    }
}
