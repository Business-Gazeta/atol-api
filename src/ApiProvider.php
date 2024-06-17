<?php

namespace BusinessGazeta\AtolApi;

use BusinessGazeta\AtolApi\Object\Response\AtolResponseObjectInterface;
use BusinessGazeta\AtolApi\Request\AtolRequestInterface;
use BusinessGazeta\AtolApi\Response\AtolResponseInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;

class ApiProvider
{
    private Client $client;

    private array $headers = [
        'Content-type' => 'application/json',
        'charset' => 'utf-8',
    ];

    public function __construct(string $endpointUrl)
    {
        $this->client = new Client(
            [
                'base_uri' => $endpointUrl,
                'headers' => $this->headers
            ]
        );
    }

    public function setToken(string $token): void
    {
        $this->headers['Token'] = $token;
    }

    final public function execute(AtolRequestInterface $requestObject): AtolResponseObjectInterface
    {
        try {
            $result = $this->client->post(
                $requestObject->uri(),
                $requestObject->params()
            )->getBody()->getContents();
            return $this->getResponse($requestObject, $result);
        } catch (BadResponseException $exception) {
            throw new \Exception($exception->getResponse()->getBody()->getContents());
        }
    }

    public function getResponse(AtolRequestInterface $requestObject, string $response): AtolResponseObjectInterface
    {
        $responseObject = $requestObject->getResponseObject();
        /** @var AtolResponseInterface $obj $obj */
        $obj = new $responseObject;
        return $obj->parseData($response);
    }
}
