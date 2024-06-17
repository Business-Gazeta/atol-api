<?php

namespace BusinessGazeta\AtolApi\Request\Sell;

use BusinessGazeta\AtolApi\Query\Sell\SellQuery;
use BusinessGazeta\AtolApi\Request\AbstractAtolRequest;
use BusinessGazeta\AtolApi\Response\Sell\SellResponse;

class SellRequest extends AbstractAtolRequest
{
    private $query;

    public function __construct(SellQuery $sellQuery)
    {
        $this->query = $sellQuery;
    }

    public function params(): array
    {
        return ['json' => $this->query];
    }

    public function uri(): string
    {
        return 'sell';
    }

    public function getResponseObject(): string
    {
        return SellResponse::class;
    }
}
