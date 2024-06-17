<?php

namespace BusinessGazeta\AtolApi\Request\Sell;

use BusinessGazeta\AtolApi\Query\Sell\SellQuery;
use BusinessGazeta\AtolApi\Request\AbstractAtolRequest;
use BusinessGazeta\AtolApi\Response\Sell\SellResponse;

class SellRequest extends AbstractAtolRequest
{
    private SellQuery $query;
    private string $groupCode;

    public function __construct(SellQuery $sellQuery, string $groupCode)
    {
        $this->query = $sellQuery;
        $this->groupCode = $groupCode;
    }

    public function params(): array
    {
        return ['json' => $this->query];
    }

    public function uri(): string
    {
        return sprintf('%s/%s', $this->groupCode, 'sell');
    }

    public function getResponseObject(): string
    {
        return SellResponse::class;
    }
}
