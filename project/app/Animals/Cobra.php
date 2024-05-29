<?php

namespace App\Animals;

class Cobra extends Animal implements ReptileInterface
{
    protected $table = 'animals';
    public bool $toxic = true;
}
