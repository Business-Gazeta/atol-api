<?php

namespace BusinessGazeta\AtolApi\Response\Auth;


use BusinessGazeta\AtolApi\Object\Response\Auth;
use BusinessGazeta\AtolApi\Object\Response\Error;
use BusinessGazeta\AtolApi\Response\AtolResponseInterface;

class AuthResponse implements AtolResponseInterface
{
    private Auth $object;

    public function __construct() {
        $this->object = new Auth();
    }
    public function parseData(string $result): Auth
    {
        $data = json_decode($result, true);

        $this->object->setTimestamp(new \DateTime($data['timestamp']));
        if ($data['error']) {
            $error = new Error($data['error']['error_id'], $data['error']['code'], $data['error']['text'], new \DateTime($data['error']['timestamp']));
            $this->object->setError($error);
        } else {
            $this->object->setToken($data['token']);
        }
        return $this->object;
    }

    /**
     * @return Auth
     */
    public function getObject(): Auth
    {
        return $this->object;
    }

    /**
     * @param Auth $object
     * @return AuthResponse
     */
    public function setObject(Auth $object): AuthResponse
    {
        $this->object = $object;
        return $this;
    }


}
