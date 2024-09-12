<?php

namespace src\skills;

use src\Character;

interface SkillInterface
{
    public function apply($damage, $context, Character $character);
}