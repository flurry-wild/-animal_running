<?php

namespace App\Animals;

use IteratorAggregate;
use Traversable;

class AnimalCollection implements IteratorAggregate
{
    public array $animals;
    private array $animalClasses = [
        Gazzelle::class, Bear::class, Crocodile::class, Penguin::class, Parrot::class, Tarantula::class,
        HouseSpider::class, Wolf::class, Platypus::class, Snake::class, Cobra::class
    ];

    public function __construct()
    {
        if (empty(Animal::get()->toArray())) {
            foreach ($this->animalClasses as $animalClass) {
                /** @var Animal $animalClass::createOne() */
                $this->animals[] = $animalClass::createOne();
            }
        } else {
            foreach ($this->animalClasses as $animalClass) {
                $this->animals[] = $animalClass::first();
            }
        }
    }

    public function getIterator(): Traversable
    {
        return new AnimalIterator($this);
    }
}
