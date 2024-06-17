<?php

namespace BusinessGazeta\AtolApi\Object\Response;

class Auth extends AbstractResponseObject
{
    private string $token;

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return Auth
     */
    public function setToken(string $token): Auth
    {
        $this->token = $token;
        return $this;
    }
}
