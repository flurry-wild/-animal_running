<?php

namespace App\Animals;

use Illuminate\Database\Eloquent\Collection;
use IteratorAggregate;
use Traversable;

class AnimalCollection implements IteratorAggregate
{
    public Collection $animals;
    private array $animalClasses = [
        Gazzelle::class, Bear::class, Crocodile::class, Penguin::class, Parrot::class, Tarantula::class,
        HouseSpider::class, Wolf::class, Platypus::class, Snake::class, Cobra::class
    ];

    public function __construct()
    {
        $this->animals = new Collection();

        if (empty(Animal::get()->toArray())) {
            foreach ($this->animalClasses as $animalClass) {
                /** @var Animal $animalClass::createOne() */
                $this->animals->push($animalClass::createOne());
            }
        } else {
            foreach ($this->animalClasses as $animalClass) {
                foreach ($animalClass::get() as $animal) {
                    $this->animals->push($animal);
                }
            }
        }
    }

    public function getIterator(): Traversable
    {
        return new AnimalIterator($this);
    }
}
