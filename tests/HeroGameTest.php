<?php

use PHPUnit\Framework\TestCase;
use src\HeroGame;
use src\Monster;
use src\Orderus;

class HeroGameTest extends TestCase
{
    protected $heroGame;

    protected function setUp(): void
    {
        $this->heroGame = new HeroGame();
        $this->heroGame->orderus = $this->createMock(Orderus::class);
        $this->heroGame->monster = $this->createMock(Monster::class);
    }

    public function testInitCharactersStats()
    {
        $this->heroGame->initCharactersStats();

        $this->assertInstanceOf(Orderus::class, $this->heroGame->orderus);
        $this->assertInstanceOf(Monster::class, $this->heroGame->monster);
    }

    public function testOrderusHasHigherSpeed()
    {
        $this->heroGame->orderus->speed = 50;
        $this->heroGame->monster->speed = 40;
        $this->assertTrue($this->heroGame->hasOrderusHigherSpeed());
    }

    public function testMonsterHasHigherSpeed()
    {
        $this->heroGame->orderus->speed = 40;
        $this->heroGame->monster->speed = 50;
        $this->assertTrue($this->heroGame->hasMonsterHigherSpeed());
    }

    public function testOrderusAndMonsterEqualSpeed()
    {
        $this->heroGame->orderus->speed = 40;
        $this->heroGame->monster->speed = 40;
        $this->assertFalse($this->heroGame->hasOrderusHigherSpeed());
        $this->assertFalse($this->heroGame->hasMonsterHigherSpeed());
    }

    public function testOrderusHasHigherLuck()
    {
        $this->heroGame->orderus->luck = 30;
        $this->heroGame->monster->luck = 20;
        $this->assertTrue($this->heroGame->hasOrderusHigherLuck());
    }

    public function testMonsterHasHigherLuck()
    {
        $this->heroGame->orderus->luck = 20;
        $this->heroGame->monster->luck = 30;
        $this->assertTrue($this->heroGame->hasMonsterHigherLuck());
    }

    public function testOrderusAttacksIfFaster()
    {
        $this->heroGame->orderus->speed = 50;
        $this->heroGame->monster->speed = 40;

        $this->heroGame->initCharactersPosition();

        $this->assertSame($this->heroGame->orderus, $this->heroGame->attacker);
        $this->assertSame($this->heroGame->monster, $this->heroGame->defender);
    }

    public function testMonsterAttacksIfFaster()
    {
        $this->heroGame->orderus->speed = 40;
        $this->heroGame->monster->speed = 50;

        $this->heroGame->initCharactersPosition();

        $this->assertSame($this->heroGame->monster, $this->heroGame->attacker);
        $this->assertSame($this->heroGame->orderus, $this->heroGame->defender);
    }

    public function testOrderusAttacksIfEqualSpeedButHigherLuck()
    {
        $this->heroGame->orderus->speed = 50;
        $this->heroGame->monster->speed = 50;

        $this->heroGame->orderus->luck = 30;
        $this->heroGame->monster->luck = 20;

        $this->heroGame->initCharactersPosition();

        $this->assertSame($this->heroGame->orderus, $this->heroGame->attacker);
        $this->assertSame($this->heroGame->monster, $this->heroGame->defender);
    }

    public function testMonsterAttacksIfEqualSpeedButHigherLuck()
    {

        $this->heroGame->orderus->speed = 50;
        $this->heroGame->monster->speed = 50;

        $this->heroGame->orderus->luck = 20;
        $this->heroGame->monster->luck = 30;

        $this->heroGame->initCharactersPosition();

        $this->assertSame($this->heroGame->monster, $this->heroGame->attacker);
        $this->assertSame($this->heroGame->orderus, $this->heroGame->defender);
    }

    public function testCalculateBaseDamage()
    {
        $this->heroGame->initCharactersStats();
        $this->heroGame->initCharactersPosition();

        $baseDamage = $this->heroGame->calculateBaseDamage();
        $expectedBaseDamage = $this->heroGame->attacker->strenght - $this->heroGame->defender->defence;

        $this->assertIsNumeric($baseDamage);
        $this->assertGreaterThanOrEqual($expectedBaseDamage, $baseDamage);
    }

    public function testCalculateDamageAvoidedAttack()
    {
        $this->heroGame->monster->luck = 100;

        $this->heroGame->initCharactersStats();
        $this->heroGame->initCharactersPosition();

        $this->expectOutputRegex('/Apărătorul a evitat atacul!/');
        $this->heroGame->calculateDamage();

        $this->assertEquals(0, $this->heroGame->damage);
    }

    public function testCalculateDamage()
    {
        $this->heroGame->initCharactersStats();
        $this->heroGame->initCharactersPosition();

        $this->heroGame->calculateDamage();

        $this->assertIsNumeric($this->heroGame->damage);
        $this->assertGreaterThanOrEqual(0, $this->heroGame->damage);
    }

    public function testBattleExecution()
    {
        $this->heroGame->initCharactersStats();
        $this->heroGame->initCharactersPosition();

        $this->expectOutputRegex('/Incepe atacul \d+/');
        $this->heroGame->startBattle();
        $this->expectOutputRegex('/(a câștigat lupta|Remiză)/');

    }
}