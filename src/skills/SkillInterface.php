<?php

namespace src\skills;

interface SkillInterface
{
    public function apply($damage , $context);
}