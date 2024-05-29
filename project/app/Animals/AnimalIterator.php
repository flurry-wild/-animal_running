<?php

namespace App\Animals;

use Iterator;

class AnimalIterator implements Iterator
{
    private int $position = 0;
    protected AnimalCollection $collection;

    public function __construct(AnimalCollection $collection)
    {
        $this->collection = $collection;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function current(): Animal
    {
        return $this->collection->animals[$this->position];
    }

    public function key(): int
    {
        return $this->position;
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function valid(): bool
    {
        return isset($this->collection->animals[$this->position]);
    }
}
