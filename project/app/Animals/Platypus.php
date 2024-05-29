<?php

namespace App\Animals;

class Platypus extends Animal implements MammalInterface
{
    protected $table = 'animals';
    public bool $laysEggs = true;
    public bool $toxic = true;
}
