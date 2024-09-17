<?php

use PHPUnit\Framework\TestCase;
use src\Monster;

class MonsterTest extends TestCase
{
    protected $monster;
    public function setUp(): void
    {
        $this->monster = new Monster();
    }
    public function testMonsterInitialStats()
    {

        $this->assertGreaterThanOrEqual(60, $this->monster->health);
        $this->assertLessThanOrEqual(90, $this->monster->health);

        $this->assertGreaterThanOrEqual(60, $this->monster->strength);
        $this->assertLessThanOrEqual(90, $this->monster->strength);

        $this->assertGreaterThanOrEqual(40, $this->monster->defence);
        $this->assertLessThanOrEqual(60, $this->monster->defence);

        $this->assertGreaterThanOrEqual(40, $this->monster->speed);
        $this->assertLessThanOrEqual(60, $this->monster->speed);

        $this->assertGreaterThanOrEqual(25, $this->monster->luck);
        $this->assertLessThanOrEqual(40, $this->monster->luck);
    }

    public function testMonsterSkills()
    {
        $this->assertEmpty($this->monster->skills);
    }

    public function testMonsterName()
    {
        $this->assertEquals('Monster', $this->monster->getName());
    }
}