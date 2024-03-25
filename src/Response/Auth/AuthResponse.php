<?php

namespace BusinessGazeta\AtolApi\Response\Auth;


use BusinessGazeta\AtolApi\Response\AtolResponseInterface;

class AuthResponse implements AtolResponseInterface
{
    public function parseData(string $result): array
    {
        $data = json_decode($result, true);
        if ($data['error']) {
            throw new \Exception($data['error']['text']);
        }
        return ['token' => $data['token']];
    }
}
