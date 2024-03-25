<?php

namespace BusinessGazeta\AtolApi\Object\Sell;

use BusinessGazeta\AtolApi\Object\AbstractObject;
use BusinessGazeta\AtolApi\Enum\Sell\CompanySnoEnum;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;

class Company extends AbstractObject implements JsonSerializable
{
    private string $email;
    private ?CompanySnoEnum $sno = null;
    private string $inn;
    private string $paymentAddress;
    private ?string $location = null;

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return CompanySnoEnum|null
     */
    public function getSno(): ?CompanySnoEnum
    {
        return $this->sno;
    }

    /**
     * @param CompanySnoEnum|null $sno
     */
    public function setSno(?CompanySnoEnum $sno): void
    {
        $this->sno = $sno;
    }

    /**
     * @return string
     */
    public function getInn(): string
    {
        return $this->inn;
    }

    /**
     * @param string $inn
     */
    public function setInn(string $inn): void
    {
        $this->inn = $inn;
    }

    /**
     * @return string
     */
    public function getPaymentAddress(): string
    {
        return $this->paymentAddress;
    }

    /**
     * @param string $paymentAddress
     */
    public function setPaymentAddress(string $paymentAddress): void
    {
        $this->paymentAddress = $paymentAddress;
    }

    /**
     * @return string|null
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @param string|null $location
     */
    public function setLocation(?string $location): void
    {
        $this->location = $location;
    }




    public function jsonSerialize()
    {
        $params =
            [
                'email' => $this->getEmail(),
                'inn' => $this->getInn(),
                'payment_address' => $this->getPaymentAddress()
            ];
        $params = $this->mergeParams($params, $this->sno?->value, 'sno');
        $params = $this->mergeParams($params, $this->getLocation(), 'location');

        return $params;
    }
}
