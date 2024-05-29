<?php

namespace App\Enclosure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enclosure extends Model
{
    use HasFactory;

    const FOOD_TYPE_PLANT = 1;
    const FOOD_TYPE_MEAT = 2;
    const FOOD_TYPE_ALL = 3;

    protected $fillable = ['availability', 'covered', 'food_count', 'food_type'];

    public static function createOne(bool $availability, bool $covered, int $foodCount, int $foodType)
    {
        return static::create([
            'availability' => $availability,
            'covered' => $covered,
            'food_count' => $foodCount,
            'food_type' => $foodType
        ]);
    }
}
