<?php


namespace App\Application\Persistence\Ships;


use App\Domain\Ships\ShipBuilder;
use App\Domain\Ships\ShipType;
use App\Domain\Ships\Spi\ShipsRepository;
use PDO;

class DatabaseShipsRepository implements ShipsRepository {

    /**
     * @var PDO
     */
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    function getAll($language = 'PL'): array {
        $sql = "select 
                    `name`,
                    `type`,
                    `fraction`,
                    `skill`,
                    `power`,
                    `agility`,
                    `hit_points`,
                    `shield`,
                    `description` 
                from `ships_translated` 
                where `language` = :language";

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':language', $language);
        $statement->execute();
        $ships = [];

        foreach ($statement as $row) {
            $ships[] = $this->createShip($row);
        }

        return $ships;
    }

    private function createShip(array $row) {
        return ShipBuilder::instance()
            ->name($row['name'])
            ->type(ShipType::of($row['type'], $row['fraction']))
            ->skill($row['skill'])
            ->power($row['power'])
            ->agility($row['agility'])
            ->hitPoints($row['hit_points'])
            ->shield($row['shield'])
            ->description($row['description'])
            ->build();
    }
}