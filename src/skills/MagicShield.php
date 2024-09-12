<?php

namespace src\skills;

use src\Character;

class MagicShield extends AbstractSkill
{
    protected function getChance()
    {
        return 0.2;
    }

    protected function shouldApply($context)
    {
        return $context === Context::DEFENSE;
    }

    protected function applyEffect($damage, Character $character)
    {
        echo "{$character->getName()} folosește Magic Shield!\n";
        return $damage / 2;
    }
}