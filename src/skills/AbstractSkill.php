<?php

namespace src\skills;

use src\Character;

abstract class AbstractSkill implements SkillInterface
{
    abstract protected function getChance();
    abstract protected function shouldApply($context);
    abstract protected function applyEffect($damage, Character $character);

    protected function isTriggered()
    {
        return rand(0, 100) / 100 <= $this->getChance();
    }

    public function apply($damage, $context, Character $character)
    {
        if ($this->shouldApply($context) && $this->isTriggered()) {
            return $this->applyEffect($damage, $character);
        }
        return $damage;
    }

}