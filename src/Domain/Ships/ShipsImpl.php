<?php


namespace App\Domain\Ships;


use App\Domain\Ships\Api\Ships;
use App\Domain\Ships\Spi\ShipsRepository;

class ShipsImpl implements Ships {

    private $shipsRepository;

    public function __construct(ShipsRepository $shipsRepository) {
        $this->shipsRepository = $shipsRepository;
    }

    /**
     * @param string $language
     * @return Ship[]
     */
    public function getAll($language = 'PL'): array {
        return $this->shipsRepository->getAll($language);
    }
}