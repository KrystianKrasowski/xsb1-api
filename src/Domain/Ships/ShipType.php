<?php


namespace App\Domain\Ships;


class ShipType {

    const TiePhantom = "Tie Phantom";
    const TieInterceptor = "Tie Interceptor";

    private $type;

    public static function tiePhantom(): ShipType {
        return new ShipType(self::TiePhantom);
    }

    public static function tieInterceptor(): ShipType {
        return new ShipType(self::TieInterceptor);
    }

    public function getType(): string {
        return $this->type;
    }

    private function __construct(string $type) {
        $this->type = $type;
    }
}