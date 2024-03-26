<?php

namespace BusinessGazeta\AtolApi\Request\Sell;

use BusinessGazeta\AtolApi\Query\Sell\SellQuery;
use BusinessGazeta\AtolApi\Request\AbstractAtolRequest;
use BusinessGazeta\AtolApi\Response\Sell\SellResponse;

class SellRequest extends AbstractAtolRequest
{
    private $query;

    public function __construct(SellQuery $sellQuery, string $groupCode)
    {
        $this->query = $sellQuery;
        $this->setResponse(new SellResponse());
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
