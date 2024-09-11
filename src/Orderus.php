<?php

namespace src;

use src\skills\Context;
use src\skills\MagicShield;
use src\skills\RapidStrike;

class Orderus
{
    public $name = 'Orderus';
    public $health;
    public $strength;
    public $defence;
    public $speed;
    public $luck;

    public $skills = [];

    public function __construct()
    {
        $this->health = rand(70, 100);
        $this->strength = rand(70, 80);
        $this->defence = rand(45, 55);
        $this->speed = rand(40, 50);
        $this->luck = rand(10, 30);

        $this->skills[] = new RapidStrike();
        $this->skills[] = new MagicShield();
    }

    public function applyAttackSkills($damage)
    {
        return $this->applySkills($damage, Context::ATTACK);
    }

    public function applyDefenseSkills($damage)
    {
        return $this->applySkills($damage, Context::DEFENSE);
    }

    private function applySkills($damage, $context)
    {
        foreach ($this->skills as $skill) {
            $damage = $skill->apply($damage, $context);
        }
        return $damage;
    }
}