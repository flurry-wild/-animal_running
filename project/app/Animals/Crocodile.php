<?php

namespace App\Animals;

class Crocodile extends Animal implements ReptileInterface
{
    protected $table = 'animals';
    public bool $laysEggs = true;
    public bool $predator = true;
}
