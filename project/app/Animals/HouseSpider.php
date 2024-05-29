<?php

namespace App\Animals;

class HouseSpider extends Animal implements InsectInterface
{
    protected $table = 'animals';
    public bool $toxic = false;
}
