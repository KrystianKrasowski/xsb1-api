<?php

namespace Tests\Application\Api\V1\Ships;

use App\Domain\Ships\Api\Ships;
use App\Domain\Ships\StaticShipsRepository;
use Psr\Container\ContainerInterface;
use Slim\App;
use Tests\TestCase;

class GetAllActionTest extends TestCase {

    private $allShips;

    /**
     * @var Ships
     */
    private $shipsApi;

    /**
     * @var App
     */
    private $application;

    /**
     * @var ContainerInterface
     */
    private $container;

    private $response;

    protected function setUp() {
        $this->allShips = [
            StaticShipsRepository::kirKanos()
        ];
        $this->shipsApi = $this->createMock(Ships::class);
        $this->application = $this->getAppInstance();
        $this->container = $this->application->getContainer();
        $this->container->set(Ships::class, $this->shipsApi);

        $this->shipsApi
            ->method('getAll')
            ->willReturn([
                StaticShipsRepository::kirKanos(),
            ]);

        $this->response = $this->application->handle($this->createRequest('GET', '/v1/ships'));
    }

    public function testBody() {
        $response = (string) $this->response->getBody();
        $this->assertThat($response, $this->equalTo(json_encode($this->allShips)));
    }

    public function testContentType() {
        $this->assertThat($this->response->getHeader('Content-Type'), $this->equalTo(['application/json']));
    }

    public function testStatusCode() {
        $this->assertThat($this->response->getStatusCode(), $this->equalTo(200));
    }
}
