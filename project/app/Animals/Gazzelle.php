<?php

namespace App\Animals;

use App\Enclosure\Enclosure;

class Gazzelle extends Animal implements MammalInterface
{
    protected $table = 'animals';
    public int $foodType = Enclosure::FOOD_TYPE_PLANT;
    public bool $viviparous = true;
}
