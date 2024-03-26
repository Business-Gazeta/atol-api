<?php

namespace BusinessGazeta\AtolApi;

use BusinessGazeta\AtolApi\Object\Response\AtolResponseObjectInterface;
use BusinessGazeta\AtolApi\Request\AtolRequestInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;

class ApiProvider
{
    private Client $client;

//    private const URL = 'https://online.atol.ru/possystem/v4/';
    private const URL = 'https://testonline.atol.ru/possystem/v4/';

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

    public function auth(AtolRequestInterface $request): AtolResponseObjectInterface
    {
        try {
            $result = $this->client->post(self::URL . 'getToken', $request->params())->getBody()->getContents();
            $data = $request->getResponse()->parseData($result);
            if (!$data->getError()) {
                $this->setToken($data->getBasic());
            } else {
                throw new \Exception($data->getError()->getText());
            }
        } catch (BadResponseException $exception) {
            throw new \Exception($exception->getResponse()->getBody()->getContents());
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

        return $data;
    }

    final public function execute(AtolRequestInterface $request): AtolResponseObjectInterface {
        $params = $request->params();
        try {
            $result =  $this->client->request(
                'POST',
                self::URL . $request->uri(),
                $params
            )->getBody()->getContents();
            return $request->getResponse()->parseData($result);
        } catch (BadResponseException $exception) {
            throw new \Exception($exception->getResponse()->getBody()->getContents());
        }
//        var_dump($result);
//        die();

    }
}
