<?php

namespace BusinessGazeta\AtolApi\Response\Auth;


use BusinessGazeta\AtolApi\Object\Response\Auth;
use BusinessGazeta\AtolApi\Object\Response\Error;
use BusinessGazeta\AtolApi\Response\AtolResponseInterface;

class AuthResponse implements AtolResponseInterface
{
    public function parseData(string $result): Auth
    {
        try {
            $data = json_decode($result, true, 2, JSON_THROW_ON_ERROR);

            $auth = new Auth();

            if (isset($data['error'])) {
                $auth->setError(
                    new Error(
                        $data['error']['error_id'],
                        $data['error']['code'],
                        $data['error']['text'],
                        new \DateTime($data['error']['timestamp'])
                    )
                );
            } else {
                $auth->setTimestamp(new \DateTime($data['timestamp']))
                    ->setToken($data['token']);
            }

            return $auth;
        } catch (\Exception $exception) {
            throw new \Exception(
                sprintf(
                    '%s, error response: %s',
                    $exception->getMessage(),
                    $result
                )
            );
        }
    }
}
