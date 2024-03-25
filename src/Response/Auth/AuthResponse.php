<?php

namespace BusinessGazeta\AtolApi\Response\Auth;


use BusinessGazeta\AtolApi\Response\AtolResponseInterface;

class AuthResponse implements AtolResponseInterface
{
    public function parseData(array $data): array
    {
        if ($data['error']) {
            throw new \Exception($data['error']['text']);
        }
        return ['token' => $data['token']];
    }
}
