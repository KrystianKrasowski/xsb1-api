<?php


namespace App\Domain\Ships;


use JsonSerializable;

class ShipType implements JsonSerializable {

    const TiePhantom = "Tie Phantom";
    const TieInterceptor = "Tie Interceptor";
    const TieFighterFo = "Tie Fighter/FO";
    const Empire = "Empire";

    private $type;
    private $fraction;

    public static function tiePhantom(): ShipType {
        return new ShipType(self::TiePhantom, self::Empire);
    }

    public static function tieInterceptor(): ShipType {
        return new ShipType(self::TieInterceptor, self::Empire);
    }

    public static function tieFighterFo() {
        return new ShipType(self::TieFighterFo, self::Empire);
    }

    public function getType(): string {
        return $this->type;
    }

    public function jsonSerialize() {
        return [
            'type' => $this->type,
            'fraction' => $this->fraction,
        ];
    }

    private function __construct(string $type, string $fraction) {
        $this->type = $type;
        $this->fraction = $fraction;
    }
}