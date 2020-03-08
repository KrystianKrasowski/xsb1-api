<?php
declare(strict_types=1);


namespace Tests\Domain\Ships;


use App\Domain\Ships\Api\Ships;
use App\Domain\Ships\ShipsFactory;
use App\Domain\Ships\Spi\ShipsRepository;
use App\Domain\Ships\StaticShipsRepository;
use Tests\TestCase;

class ShipsTest extends TestCase {

    /**
     * @var ShipsRepository
     */
    private $shipsRepository;

    /**
     * @var Ships
     */
    private $ships;

    protected function setUp() {
        $this->shipsRepository = $this->createMock(ShipsRepository::class);
        $this->ships = ShipsFactory::of($this->shipsRepository);
    }

    public function testAllShips() {
        $expectedShips = [
            StaticShipsRepository::kirKanos(),
        ];

        $this->shipsRepository->method('getAll')
            ->willReturn($expectedShips);

        $this->assertThat($this->ships->getAll(), $this->equalTo($expectedShips));
    }
}