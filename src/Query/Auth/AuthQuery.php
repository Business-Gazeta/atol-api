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


    public function jsonSerialize()
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
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPass(): string
    {
        return $this->pass;
    }

    /**
     * @param string $pass
     */
    public function setPass(string $pass): void
    {
        $this->pass = $pass;
    }



}
