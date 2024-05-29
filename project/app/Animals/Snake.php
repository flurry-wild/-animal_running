<?php

namespace App\Animals;

class Snake extends Animal implements ReptileInterface
{
    protected $table = 'animals';
    public bool $toxic = false;
}
