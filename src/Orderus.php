<?php

namespace src;

use src\skills\Context;
use src\skills\MagicShield;
use src\skills\RapidStrike;

class Orderus extends Character
{
    public $skills = [];

    public function __construct()
    {
        $this->health = rand(70, 100);
        $this->strength = rand(70, 80);
        $this->defence = rand(45, 55);
        $this->speed = rand(40, 50);
        $this->luck = rand(10, 30);

        $this->loadSkills();
    }

    public function getName(): string
    {
        return 'Orderus';
    }

    public function loadSkills(): void
    {
        $this->skills[] = new RapidStrike();
        $this->skills[] = new MagicShield();
    }
}