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

    private string $endpointUrl;
    private array $headers = [
        'Content-type' => 'application/json',
        'charset' => 'utf-8',
    ];

    public function __construct(string $endpointUrl)
    {
        $this->endpointUrl = $endpointUrl;
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
        $this->client = new Client(
            [
                'base_uri' => $this->endpointUrl,
                'headers' => $this->headers
            ]
        );
    }

    final public function execute(AtolRequestInterface $requestObject, string $method = 'POST'): AtolResponseObjectInterface
    {
        try {
            $result = $this->client->request(
                $method,
                $requestObject->uri(),
                $requestObject->params()
            )->getBody()->getContents();
            return $this->getResponse($requestObject, $result);
        } catch (BadResponseException $exception) {
            print_r($exception->getMessage());
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
