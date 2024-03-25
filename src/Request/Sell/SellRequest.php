<?php

namespace BusinessGazeta\AtolApi\Request\Sell;

use BusinessGazeta\AtolApi\Query\Sell\SellQuery;
use BusinessGazeta\AtolApi\Request\AbstractAtolRequest;
use BusinessGazeta\AtolApi\Response\Sell\SellResponse;

class SellRequest extends AbstractAtolRequest
{
    private $query;

    public function __construct(SellQuery $sellQuery, SellResponse $response, string $groupCode)
    {
        $this->query = $sellQuery;
        $this->setResponse($response);
        $this->setUri($groupCode . '/sell');
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
