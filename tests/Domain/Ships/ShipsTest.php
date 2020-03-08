<?php
declare(strict_types=1);


namespace Tests\Domain\Ships;


use App\Domain\Ships\Api\Ships;
use App\Domain\Ships\ShipBuilder;
use App\Domain\Ships\ShipsFactory;
use App\Domain\Ships\Spi\ShipsRepository;
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
            ShipBuilder::tieInterceptor()
                ->name("Kir Kanos")
                ->skill(6)
                ->power(3)
                ->agility(3)
                ->hitPoints(3)
                ->shield(0)
                ->description("Kiedy atakujesz w zasięgu 2-3, możesz wydać 1 żeton uników, aby dodać 1 :damage: do swojego wyniku.")
                ->build(),
        ];

        $this->shipsRepository->method('getAll')
            ->willReturn($expectedShips);

        $this->assertThat($this->ships->getAll(), $this->equalTo($expectedShips));
    }
}