<?php
declare(strict_types=1);

use App\Application\Persistence\Ships\DatabaseShipsRepository;
use App\Domain\Ships\Api\Ships;
use App\Domain\Ships\ShipsImpl;
use App\Domain\Ships\Spi\ShipsRepository;
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

        PDO::class => function (ContainerInterface $container) {
            $settings = $container->get('settings');
            $db = $settings['database'];
            return new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'], $db['user'], $db['password']);
        },

        ShipsRepository::class => function (ContainerInterface $container) {
            $pdo = $container->get(PDO::class);
            return new DatabaseShipsRepository($pdo);
        },

        Ships::class => function (ContainerInterface $container) {
            $shipsRepository = $container->get(ShipsRepository::class);
            return new ShipsImpl($shipsRepository);
        }
    ]);
};
