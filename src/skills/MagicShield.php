<?php

namespace src\skills;

class MagicShield extends AbstractSkill
{
    protected $chance = 0.2;

    protected function shouldApply($context)
    {
        return $context === Context::DEFENSE;
    }

    protected function applyEffect($damage)
    {
        echo "Orderus folosește Magic Shield!\n";
        return $damage / 2;
    }

}