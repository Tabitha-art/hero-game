<?php

namespace src\skills;

abstract class AbstractSkill implements SkillInterface
{
    protected $chance;

    public function apply($damage, $context)
    {
        if ($this->shouldApply($context)) {
            if (rand(0, 100) / 100 <= $this->chance) {
                return $this->applyEffect($damage);
            }
        }
        return $damage;
    }

    abstract protected function shouldApply($context);
    abstract protected function applyEffect($damage);
}