<?php

namespace App\Enclosure;

use IteratorAggregate;
use Traversable;
use Illuminate\Database\Eloquent\Collection;

class EnclosureCollection implements IteratorAggregate
{
    const COUNT = 3;

    public Collection $items;

    public function __construct()
    {
        $this->items = new Collection();

        if (Enclosure::get()->count() < 1) {
            for ($i = 0; $i < self::COUNT; $i++) {
                $this->items->push(Enclosure::createOne(
                    rand(0, 1),
                    rand(0, 1),
                    rand(0, 500),
                    rand(Enclosure::FOOD_TYPE_PLANT, Enclosure::FOOD_TYPE_MEAT)
                ));
            }
        } else {
            $this->items = Enclosure::get();
        }
    }

    public function getIterator(): Traversable
    {
        return new EnclosureIterator($this);
    }
}
