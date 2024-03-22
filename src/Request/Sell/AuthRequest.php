<?php

namespace BusinessGazeta\AtolApi\Request\Sell;

use BusinessGazeta\AtolApi\Query\Auth\AuthQuery;
use BusinessGazeta\AtolApi\Request\AbstractAtolRequest;

class AuthRequest extends AbstractAtolRequest
{
    private $query;

    public function __construct(AuthQuery $authQuery)
    {
        $this->query = $authQuery;
        $this->setUri('getToken');
    }
    public function params(): array
    {
        return [ 'json' => $this->query->jsonSerialize()];
    }

    public function uri(): string
    {
        return $this->getUri();
    }
}
