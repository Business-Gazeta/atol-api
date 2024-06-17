<?php

namespace BusinessGazeta\AtolApi\Tests\Object\Sell;

use BusinessGazeta\AtolApi\Object\Sell\Client;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testParams()
    {
        $client = new Client();

        $client->setEmail('test@ya.ru');

        self::assertJsonStringEqualsJsonString(
            json_encode(
                [
                    'email' => 'test@ya.ru'
                ]
            ),
            json_encode(
                $client->jsonSerialize()
            )
        );
    }

}
