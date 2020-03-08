<?php


namespace App\Domain\Ships\Api;


use App\Domain\Ships\Ship;

interface Ships {

    /**
     * @return Ship[]
     */
    function getAll($language = 'PL'): array;
}