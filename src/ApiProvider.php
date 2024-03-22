<?php

namespace BusinessGazeta\AtolApi;
use BusinessGazeta\AtolApi\Request\AtolRequestInterface;
use GuzzleHttp\Client;

class ApiProvider
{
    private Client $client;

    private const URL = 'https://online.atol.ru/possystem/v4';

    private array $headers;

    /**
     * @param string $endpointUrl
     */
    public function __construct(string $token = '')
    {
        $this->headers = [
            'Content-type' => 'application/json',
            'charset' => 'utf-8',
        ];
        $this->client = new Client(
            [
                'headers' => $this->headers
            ]
        );
    }

    public function auth(AtolRequestInterface $request)
    {
        $data =
            [
                'headers' => $this->headers,
                $request->params()
            ];
        $result = $this->client->request('POST', self::URL . '/getToken', $data);
        return $result->getBody()->getContents();
    }

//    public function addHeader(string $key, string $value): self
//    {
//        $this->headers[$key] = $value;
//        return $this;
//    }

    final public function execute(
        AtolRequestInterface $request
    ) {
        $params = $request->params();
        return $this->client->request(
            'POST',
            self::URL . $request->uri(),
            $params
        )->getBody()->getContents();
    }
}
