<?php


namespace App\Domain\Ships;

use JsonSerializable;


interface Ship extends JsonSerializable {

    function getName(): string;

    function getType(): ShipType;
    
    function getSkill(): int;

    function getPower(): int;
    
    function getAgility(): int;
    
    function getHitPoints(): int;

    function getShield(): int;

    function getDescription(): string;
}

