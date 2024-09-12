<?php

namespace src;

use src\skills\Context;

abstract class Character
{
    public $health;
    public $strength;
    public $defence;
    public $speed;
    public $luck;
    public $skills = [];

    abstract public function getName();
    abstract public function loadSkills();

    public function displayStats()
    {
        echo "Statistici pentru {$this->getName()}:\n";
        echo "Health: {$this->health}\n";
        echo "Strength: {$this->strength}\n";
        echo "Defence: {$this->defence}\n";
        echo "Speed: {$this->speed}\n";
        echo "Luck: {$this->luck}%\n";
    }

    public function applySkills($damage, $context)
    {
        foreach ($this->skills as $skill) {
            $newDamage = $skill->apply($damage, $context, $this);
            if ($newDamage !== $damage) {
                return $newDamage;
            }
        }
        return $damage;
    }

    public function applyAttackSkills($damage)
    {
        return $this->applySkills($damage, Context::ATTACK);
    }

    public function applyDefenseSkills($damage)
    {
        return $this->applySkills($damage, Context::DEFENSE);
    }
}