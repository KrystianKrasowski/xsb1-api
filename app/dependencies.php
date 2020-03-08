<?php
declare(strict_types=1);

use App\Domain\Ships\Api\Ships;
use App\Domain\Ships\ShipsImpl;
use App\Domain\Ships\StaticShipsRepository;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get('settings');

            $loggerSettings = $settings['logger'];
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },

        Ships::class => function () {
            $shipsRepository = new StaticShipsRepository();
            return new ShipsImpl($shipsRepository);
        }
    ]);
};
