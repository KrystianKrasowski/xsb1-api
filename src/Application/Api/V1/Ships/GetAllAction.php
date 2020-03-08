<?php


namespace App\Application\Api\V1\Ships;


use App\Domain\Ships\Api\Ships;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetAllAction {

    /**
     * @var Ships
     */
    private $ships;

    public function __construct(Ships $ships) {
        $this->ships = $ships;
    }

    public function __invoke(Request $request, Response $response, $args): Response {
        $language = $this->getLanguage($request);
        $body = $response->getBody();
        $body->write(json_encode($this->ships->getAll($language)));
        return $response
            ->withBody($body)
            ->withHeader('Content-Type', 'application/json');
    }

    private function getLanguage(Request $request) {
        $language = $request->getHeader('Accept-Language')[0];

        if ($language != null && $language != "") {
            return trim(strtoupper($language));
        }

        return null;
    }
}