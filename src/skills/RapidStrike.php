<?php

namespace src\skills;

class RapidStrike extends AbstractSkill
{
    protected $chance = 0.1;

    protected function shouldApply($context)
    {
        return $context === Context::ATTACK;
    }

    protected function applyEffect($damage)
    {
        echo "Orderus folosește Rapid Strike!\n";
        return $damage * 2;
    }
}