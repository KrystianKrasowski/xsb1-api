<?php

namespace App\Domain\Ships;

class GenericShip implements Ship {

    private $name;
    private $type;
    private $skill;
    private $power;
    private $agility;
    private $hitPoints;
    private $shield;
    private $description;

    public function __construct(string $name, ShipType $type, $skill, $power, $agility, $hitPoints, $shield, $description) {
        $this->name = $name;
        $this->type = $type;
        $this->skill = $skill;
        $this->power = $power;
        $this->agility = $agility;
        $this->hitPoints = $hitPoints;
        $this->shield = $shield;
        $this->description = $description;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getType(): ShipType {
        return $this->type;
    }

    public function getSkill(): int {
        return $this->skill;
    }

    public function getPower(): int {
        return $this->power;
    }

    public function getAgility(): int {
        return $this->agility;
    }

    public function getHitPoints(): int {
        return $this->hitPoints;
    }

    public function getShield(): int {
        return $this->shield;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function __toString() {
        return $this->type->getType() . "(" . $this->name . ")";
    }

    public function jsonSerialize() {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'skill' => $this->skill,
            'power' => $this->power,
            'agility' => $this->agility,
            'hitPoints' => $this->hitPoints,
            'shield' => $this->shield,
            'description' => $this->description,
        ];
    }
}