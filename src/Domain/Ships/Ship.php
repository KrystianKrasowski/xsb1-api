<?php


namespace App\Domain\Ships;


interface Ship {

    function getName(): string;

    function getType(): ShipType;
    
    function getSkill(): int;

    function getPower(): int;
    
    function getAgility(): int;
    
    function getHitPoints(): int;

    function getShield(): int;

    function getDescription(): string;
}

