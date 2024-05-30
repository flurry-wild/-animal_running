<?php

namespace App\Animals;

use Illuminate\Database\Eloquent\Model;
use Exception;
use ReflectionClass;

class Animal extends Model
{
    const MAX_AGE = 30;
    const MALE_NICKNAMES = [
        'Денис', 'Михаил', 'Александр',  'Геннадий', 'Дмитрий', 'Константин', 'Роман', 'Анатолий', 'Андрей',
    ];

    const FEMALE_NICKNAMES = [
        'Светлана', 'Ольга', 'Анастасия', 'Анжелика', 'Кристина', 'Татьяна', 'Джессика', 'Мария', 'Алена'
    ];

    const GENDER_MAIL = 'male';
    const GENDER_FEMAIL = 'female';

    protected $fillable = ['nickname', 'gender', 'satiety', 'age', 'living'];

    protected static function getShortName(): string
    {
        return (new ReflectionClass(static::class))->getShortName();
    }

    protected static function booted()
    {
        parent::booted();

        $type = static::getShortName() === 'Animal' ? null : strtolower(static::getShortName());

        static::addGlobalScope('type', function ($builder) use ($type) {
            if (empty($type)) {
                return $builder;
            }
            return $builder->where('type', $type);
        });

        static::creating(function ($model) use ($type) {
            if (empty($type)) {
                throw new Exception('Undefined animal type');
            }
            $model->forceFill(['type' => $type]);
        });
    }

    public static function createOne()
    {
        $gender = rand(0, 1) ? static::GENDER_MAIL : static::GENDER_FEMAIL;;

        $animal = static::create([
            'gender' => $gender,
            'nickname' => ($gender === 'male') ? static::MALE_NICKNAMES[array_rand(self::MALE_NICKNAMES)] :
                static::FEMALE_NICKNAMES[array_rand(self::FEMALE_NICKNAMES)],
            'satiety' => rand(0, 100),
            'age' => 0,
            'living' => true
        ]);

        echo sprintf(
            "Новое животное $animal->nickname, %s, $animal->gender, Сытость:$animal->satiety\n",
            static::getShortName()
        );

        return $animal;
    }

    public function givesBirth()
    {
        if (! $this->living) {
            return;
        }

        $born = rand(0, 1);

        if ($born) {
            echo "Животное размножается\n";

            if ($this->type === 'housespider') {
                $this->type = 'houseSpider';
            }
            $animalClass = "App\\Animals\\".ucfirst($this->type);
            $animalClass::createOne();
        }
    }

    public function incAge()
    {
        $this->update(['age' => ++$this->age ]);
        echo sprintf("Животное $this->nickname, %s постарело до возраста $this->age\n", static::getShortName());

        if ($this->age > static::MAX_AGE) {
            $this->update(['living' => false]);

            echo "Животное умерло от старости:(\n";
        }
    }

    public function decSatiety()
    {
        if (! $this->living) {
            return;
        }

        $this->update(['satiety' => $this->satiety - rand(1, 10)]);
        echo "Животное потратило энергию, его сытость уменьшилась до $this->satiety\n";

        if ($this->satiety < 1) {
            $this->update(['living' => false]);

            echo "Животное умерло от голода:(\n";
        }
    }
}
