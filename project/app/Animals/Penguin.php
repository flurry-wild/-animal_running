<?php

namespace App\Animals;

class Penguin extends Animal implements BirdInterface
{
    protected $table = 'animals';
    public bool $fly = false;
}
