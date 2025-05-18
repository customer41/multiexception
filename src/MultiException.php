<?php

declare(strict_types=1);

namespace Customer41\MultiException;

class MultiException
    extends \Exception
    implements \ArrayAccess, \Countable, \IteratorAggregate
{
    protected array $errors = [];

    public function add(\Exception $value): void
    {
        $this->errors[] = $value;
    }

    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->errors);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->errors[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->errors[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->errors[$offset]);
    }

    public function count(): int
    {
        return count($this->errors);
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->errors);
    }
}
