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
        $this->orderus->displayStats();

        $this->monster = new Monster();
        $this->monster->displayStats();
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

        $this->damage = $this->attacker->applyAttackSkills($this->damage);
        $this->damage = $this->defender->applyDefenseSkills($this->damage);
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
            echo "{$this->attacker->getName()} atacă\n";

            $this->calculateDamage();

            $this->defender->health -= $this->damage;
            echo "Dauna produsa: $this->damage\n";
            echo "Sănătatea rămasă a lui {$this->defender->getName()}: {$this->defender->health}\n";

            if ($this->defender->health <= 0)
            {
                echo "{$this->attacker->getName()} a câștigat lupta!\n";
                return;
            }

            $this->switchRoles();
        }

        echo "Remiză! Niciun câștigător după 20 de runde.\n";
    }

}