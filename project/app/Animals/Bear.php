<?php

namespace App\Animals;

use App\Enclosure\Enclosure;

class Bear extends Animal implements MammalInterface
{
    protected $table = 'animals';
    public int $foodType = Enclosure::FOOD_TYPE_ALL;
    public bool $viviparous = true;
}
