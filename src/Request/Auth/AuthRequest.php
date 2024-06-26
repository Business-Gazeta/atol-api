<?php

namespace BusinessGazeta\AtolApi\Request\Auth;

use BusinessGazeta\AtolApi\Query\Auth\AuthQuery;
use BusinessGazeta\AtolApi\Request\AbstractAtolRequest;
use BusinessGazeta\AtolApi\Response\Auth\AuthResponse;

class AuthRequest extends AbstractAtolRequest
{
    private AuthQuery $query;

    public function __construct(AuthQuery $authQuery)
    {
        $this->query = $authQuery;
    }

    public function params(): array
    {
        return ['json' => $this->query];
    }

    public function uri(): string
    {
        return 'getToken';
    }

    public function getResponseObject(): string
    {
        return AuthResponse::class;
    }
}
