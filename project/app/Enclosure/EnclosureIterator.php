<?php

namespace App\Enclosure;

use Iterator;

class EnclosureIterator implements Iterator
{
    private int $position = 0;
    protected EnclosureCollection $collection;

    public function __construct(EnclosureCollection $collection)
    {
        $this->collection = $collection;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function current(): Enclosure
    {
        return $this->collection->items[$this->position];
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
        return isset($this->collection->items[$this->position]);
    }

    public function getRandom(): Enclosure
    {
        return $this->collection->items->random(1)->first();
    }
}
