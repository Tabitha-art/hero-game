<?php

namespace src\skills;

use src\Character;
class RapidStrike extends AbstractSkill
{
    protected function shouldApply($context)
    {
        return $context === Context::ATTACK;
    }

    protected function applyEffect($damage, Character $character)
    {
        echo "{$character->getName()} folosește Rapid Strike!\n";
        return $damage * 2;
    }
}