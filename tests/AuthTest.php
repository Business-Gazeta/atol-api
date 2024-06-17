<?php

namespace BusinessGazeta\AtolApi\Tests;

use BusinessGazeta\AtolApi\Query\Auth\AuthQuery;
use BusinessGazeta\AtolApi\Request\Auth\AuthRequest;
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    public function testAuthOperation(): void
    {

        $login = md5(random_bytes(6));
        $pass = md5(random_bytes(6));

        $auth_request = new AuthRequest(
            new AuthQuery(
                $login,
                $pass
            )
        );

        self::assertEquals(
            [
                'login' => $login,
                'pass' => $pass
            ],
            $auth_request->params()['json']->jsonSerialize()
        );
    }

    public function testAuth(): void
    {

    }
}
