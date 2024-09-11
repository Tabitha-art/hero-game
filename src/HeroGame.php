<?php

namespace src;

class HeroGame
{
    public $attacker;
    public $defender;
    public $orderus;
    public $monster;
    public $damage;
    public $turns = 20;

    public function initCharactersStats()
    {
        $this->orderus = new Orderus();
        echo "{$this->orderus->name} health: {$this->orderus->health}\n";
        echo "{$this->orderus->name} strength: {$this->orderus->strength}\n";
        echo "{$this->orderus->name} defence: {$this->orderus->defence}\n";
        echo "{$this->orderus->name} speed: {$this->orderus->speed}\n";
        echo "{$this->orderus->name} luck: {$this->orderus->luck}\n";

        $this->monster = new Monster();
        echo "{$this->monster->name} health: {$this->monster->health}\n";
        echo "{$this->monster->name} strength: {$this->monster->strength}\n";
        echo "{$this->monster->name} defence: {$this->monster->defence}\n";
        echo "{$this->monster->name} speed: {$this->monster->speed}\n";
        echo "{$this->monster->name} luck: {$this->monster->luck}\n";
    }


    public function initCharactersPosition()
    {
        if($this->orderus->speed > $this->monster->speed)
        {
            $this->attacker = $this->orderus;
            $this->defender = $this->monster;
        }
        elseif($this->orderus->speed < $this->monster->speed)
        {
            $this->attacker = $this->monster;
            $this->defender = $this->orderus;
        }
        else
        {
            if($this->orderus->luck > $this->monster->luck)
            {
                $this->attacker = $this->orderus;
                $this->defender = $this->monster;
            }
            elseif($this->orderus->luck < $this->monster->luck)
            {
                $this->attacker = $this->orderus;
                $this->defender = $this->monster;
            }
        }
    }

    public function calculateBaseDamage()
    {
      return $this->attacker->strength - $this->defender->defence;
    }

    public function calculateDamage()
    {
        $this->damage = $this->calculateBaseDamage();

        if (rand(0, 100) <= $this->defender->luck) {
            echo "Apărătorul a evitat atacul!\n";
            $this->damage = 0;
            return;
        }

        if($this->attacker instanceof Orderus)
        {
            $this->damage = $this->orderus->applyAttackSkills($this->damage);
        } else
        {
            $this->damage = $this->orderus->applyDefenseSkills($this->damage);
        }

    }

    public function switchRoles()
    {
        $temp = $this->attacker;
        $this->attacker = $this->defender;
        $this->defender = $temp;
    }


    public function startBattle()
    {
       $this->initCharactersStats();
       $this->initCharactersPosition();
       $this->fight();
    }


    public function fight()
    {
        for($i=1; $i<=$this->turns; $i++)
        {
            echo "Incepe atacul $i\n";
            echo "{$this->attacker->name} atacă\n";

            $this->calculateDamage();

            $this->defender->health -= $this->damage;
            echo "Dauna produsa: $this->damage\n";
            echo "Sănătatea rămasă a lui {$this->defender->name}: {$this->defender->health}\n";

            if ($this->defender->health <= 0)
            {
                echo "{$this->attacker->name} a câștigat lupta!\n";
                return;
            }

            $this->switchRoles();
        }

        echo "Remiză! Niciun câștigător după 20 de runde.\n";
    }

}