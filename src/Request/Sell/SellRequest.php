<?php

namespace BusinessGazeta\AtolApi\Request\Sell;

use BusinessGazeta\AtolApi\Query\Auth\AuthQuery;
use BusinessGazeta\AtolApi\Query\Sell\SellQuery;
use BusinessGazeta\AtolApi\Request\AbstractAtolRequest;
use BusinessGazeta\AtolApi\Response\Auth\AuthResponse;

class SellRequest extends AbstractAtolRequest
{
    private $query;

    public function __construct(SellQuery $sellQuery, AuthResponse $response)
    {
        $this->query = $sellQuery;
        $this->setResponse($response);
        $this->setUri('/v4-online-atol-ru_4179/sell');
    }
    public function params(): array
    {
        return ['json' => $this->query];
    }

    public function uri(): string
    {
        return $this->getUri();
    }
}
