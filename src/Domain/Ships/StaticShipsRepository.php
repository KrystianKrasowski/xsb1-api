<?php


namespace App\Domain\Ships;


use App\Domain\Ships\Spi\ShipsRepository;

class StaticShipsRepository implements ShipsRepository {

    static function kirKanos(): Ship {
        return ShipBuilder::tieInterceptor()
            ->name("Kir Kanos")
            ->skill(6)
            ->power(3)
            ->agility(3)
            ->hitPoints(3)
            ->shield(0)
            ->description("Kiedy atakujesz w zasięgu 2-3, możesz wydać 1 żeton uników, aby dodać 1 :damage: do swojego wyniku.")
            ->build();
    }

    static function epsilonLeader(): Ship {
        return ShipBuilder::tieFighterFo()
            ->name("Lider Epsilon")
            ->skill(6)
            ->power(2)
            ->agility(3)
            ->hitPoints(3)
            ->shield(1)
            ->description("Na poczkątku fazy walki usuń po 1 żetonie stresu z każdego przyjaznego statku w zasięgu 1")
            ->build();
    }

    function getAll($language = "PL"): array {
        return [
            self::kirKanos(),
            self::epsilonLeader(),
        ];
    }
}