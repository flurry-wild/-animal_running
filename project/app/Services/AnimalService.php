<?php

namespace App\Services;

use App\Animals\Animal;
use App\Animals\AnimalCollection;
use App\Enclosure\Enclosure;
use App\Enclosure\EnclosureCollection;
use Illuminate\Support\Facades\DB;

class AnimalService
{
    const NUMBER_EATING_ATTEMPTS = 5;

    public function run(AnimalCollection $animalCollection, EnclosureCollection $enclosureCollection)
    {
        foreach ($animalCollection->getIterator() as $animal) {
            /** @var Animal $animal */
            if ($animal->living) {
                $animal->incAge();
                $animal->decSatiety();

                $eat = false;
                $attempt = 1;
                while (! $eat && ($attempt < self::NUMBER_EATING_ATTEMPTS + 1)) {
                    $eat = $this->eat($animal, $enclosureCollection, $attempt);
                    ++$attempt;
                }

                $animal->givesBirth();
                $animal->log("\n");
            }
        }
    }

    public function eat(Animal $animal, EnclosureCollection $enclosureCollection, $attempt)
    {
        if (! $animal->living) {
            return false;
        }

        echo "Еда, Попытка № $attempt\n";

        /**
         * @var EnclosureCollection $enclosureCollection
         * @var Enclosure $enclosure
         */
        $enclosure = $enclosureCollection->getIterator()->getRandom();

        if ($enclosure->availability && ($enclosure->food_type === $animal->foodType || $animal->foodType === Enclosure::FOOD_TYPE_ALL)) {
            $needFood = rand(1, 10);
            if ($needFood > $enclosure->food_count) {
                $needFood = $enclosure->food_count;
            }

            DB::transaction(function() use ($enclosure, $animal, $needFood) {
                $enclosure->update(['food_count' => $enclosure->food_count - $needFood]);

                $animal->update(['satiety' => $animal->satiety + $needFood]);
            });

            $animal->log("Животное поело, его сытость увеличилась до $animal->satiety\n");

            return true;
        }

        $animal->log("Попытка № $attempt провалена, переходим в следующий вальер\n");
        return false;
    }
}
