<?php


namespace App\Domain\Ships\Spi;


interface ShipsRepository {

    function getAll($language = 'PL'): array;
}