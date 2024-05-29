<?php

namespace App\Animals;

use App\Enclosure\Enclosure;

class Wolf extends Animal implements MammalInterface
{
    protected $table = 'animals';
    public int $foodType = Enclosure::FOOD_TYPE_MEAT;
}
