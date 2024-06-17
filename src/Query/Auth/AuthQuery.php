<?php

namespace BusinessGazeta\AtolApi\Query\Auth;

use JsonSerializable;



class AuthQuery implements JsonSerializable
{
    private string $login;
    private string $pass;

    public function __construct(string $login, string $pass)
    {
        $this->login = $login;
        $this->pass = $pass;
    }


    public function jsonSerialize(): array
    {
        return [
            'login' => $this->getLogin(),
            'pass' => $this->getPass()
        ];
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getPass(): string
    {
        return $this->pass;
    }
}
