<?php


namespace App\Domain\Ships;


class ShipBuilder {

    private $name;
    private $type;
    private $skill;
    private $power;
    private $agility;
    private $hitPoints;
    private $shield;
    private $description;

    private function __construct() {
    }

    public static function instance(): ShipBuilder {
        return new ShipBuilder();
    }

    public static function tieInterceptor(): ShipBuilder {
        $builder = new ShipBuilder();
        $builder->type = ShipType::tieInterceptor();
        return $builder;
    }

    public static function tieFighterFo(): ShipBuilder {
        $builder = new ShipBuilder();
        $builder->type = ShipType::tieFighterFo();
        return $builder;
    }

    public function name($name) {
        $this->name = $name;
        return $this;
    }

    public function skill($skill) {
        $this->skill = $skill;
        return $this;
    }

    public function power($power) {
        $this->power = $power;
        return $this;
    }

    public function agility($agility) {
        $this->agility = $agility;
        return $this;
    }

    public function hitPoints($hitPoints) {
        $this->hitPoints = $hitPoints;
        return $this;
    }

    public function shield($shield) {
        $this->shield = $shield;
        return $this;
    }

    public function description($description) {
        $this->description = $description;
        return $this;
    }

    public function build() {
        return new GenericShip(
            $this->name,
            $this->type,
            $this->skill,
            $this->power,
            $this->agility,
            $this->hitPoints,
            $this->shield,
            $this->description
        );
    }
}