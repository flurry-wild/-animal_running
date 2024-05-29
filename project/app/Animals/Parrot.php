<?php

namespace App\Animals;

class Parrot extends Animal implements BirdInterface
{
    protected $table = 'animals';
}
