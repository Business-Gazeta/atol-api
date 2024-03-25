<?php

namespace BusinessGazeta\AtolApi;

use BusinessGazeta\AtolApi\Request\AtolRequestInterface;
use GuzzleHttp\Client;

class ApiProvider
{
    private Client $client;

//    private const URL = 'https://online.atol.ru/possystem/v4';
    private const URL = 'https://testonline.atol.ru/possystem/v4';

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
        if ($token) {
            $this->setToken($token);
        } else {
            $this->client = new Client(
                [
                    'headers' => $this->headers
                ]
            );
        }
    }

    public function setToken(string $token): void
    {
        $this->headers = array_merge($this->headers, ['Token' => $token]);
        $this->client = new Client(
            [
                'headers' => $this->headers
            ]
        );
    }

    public function auth(AtolRequestInterface $request): void
    {
        try {
            $result = $this->client->post(self::URL . '/getToken', $request->params())->getBody()->getContents();
            $data = $request->getResponse()->parseData(json_decode($result, true));
            $this->setToken($data['token']);
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
//            throw new \Exception($exception->getMessage());
        }
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
//        $params = ['json' => []];
        print_R(json_encode($params));
//        var_dump($this->client);
//        die();
        try {
            $result =  $this->client->request(
                'POST',
                self::URL . $request->uri(),
                $params
            )->getBody()->getContents();
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
            die();
        }
        return $result;
    }
}
