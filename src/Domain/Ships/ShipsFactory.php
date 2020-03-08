<?php


namespace App\Domain\Ships;


use App\Domain\Ships\Api\Ships;
use App\Domain\Ships\Spi\ShipsRepository;

class ShipsFactory {

    public static function of(ShipsRepository $repository): Ships {
        return new ShipsImpl($repository);
    }
}