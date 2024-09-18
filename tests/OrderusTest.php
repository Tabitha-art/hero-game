<?php


use PHPUnit\Framework\TestCase;
use src\Orderus;
use src\skills\MagicShield;
use src\skills\RapidStrike;

class OrderusTest extends TestCase
{
    protected $orderus;
    public function setUp(): void
    {
        $this->orderus = new Orderus();
    }
    public function testOrderusInitialStats()
    {
        $this->assertGreaterThanOrEqual(70, $this->orderus->health);
        $this->assertLessThanOrEqual(100, $this->orderus->health);

        $this->assertGreaterThanOrEqual(70, $this->orderus->strength);
        $this->assertLessThanOrEqual(80, $this->orderus->strength);

        $this->assertGreaterThanOrEqual(45, $this->orderus->defence);
        $this->assertLessThanOrEqual(55, $this->orderus->defence);

        $this->assertGreaterThanOrEqual(40, $this->orderus->speed);
        $this->assertLessThanOrEqual(50, $this->orderus->speed);

        $this->assertGreaterThanOrEqual(10, $this->orderus->luck);
        $this->assertLessThanOrEqual(30, $this->orderus->luck);
    }

    public function testOrderusSkills()
    {
        $this->assertNotEmpty($this->orderus->skills);
        $this->assertCount(2, $this->orderus->skills);

        $this->assertInstanceOf(RapidStrike::class, $this->orderus->skills[0]);
        $this->assertInstanceOf(MagicShield::class, $this->orderus->skills[1]);
    }

    public function testOrderusName()
    {
        $this->assertEquals('Orderus', $this->orderus->getName());
    }

    public function testApplyAttackSkills()
    {
        $damage = 30;

        $this->orderus->skills = [
            new RapidStrike(1.0)
        ];

        $newDamage = $this->orderus->applyAttackSkills($damage);

        $this->assertEquals($damage * 2, $newDamage);
    }

    public function testApplyDefenseSkills()
    {
        $damage = 30;

        $this->orderus->skills = [
            new MagicShield(1.0)
        ];

        $newDamage = $this->orderus->applydefenseSkills($damage);

        $this->assertEquals($damage / 2, $newDamage);
    }


}