<?php

namespace BusinessGazeta\AtolApi\Object\Sell;

use BusinessGazeta\AtolApi\Enum\Sell\CompanySnoEnum;
use BusinessGazeta\AtolApi\Object\AbstractObject;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;

class Company extends AbstractObject implements JsonSerializable
{
    #[Assert\Email(
        message: 'Не корректный емайл',
    )]
    #[Assert\Length(
        max: 64,
        maxMessage: 'Длина строки не может быть больше чем {{ limit }} символов',
    )]
    private string $email;
    private ?CompanySnoEnum $sno = null;
    #[Assert\Type(type: ['digit'])]
    #[Assert\Expression(
        "value === NULL or this.isCorrectLength(value, 12) or this.isCorrectLength(value, 10)",
        message: 'Допустимые значения длины инн: 10, 12',
    )]
    private string $inn;
    #[Assert\Length(
        min: 0,
        max: 256,
        maxMessage: 'Платежный адрес может быть больше чем {{ limit }} символов',
    )]
    private string $paymentAddress;
    #[Assert\Length(
        min: 1,
        max: 256,
        minMessage: 'Адрес расчетов. не может быть меньше чем {{ limit }} символов',
        maxMessage: 'Адрес расчетов. не может быть больше чем {{ limit }} символов',
    )]
    private ?string $location = null;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): Company
    {
        $this->email = $email;
        return $this;
    }

    public function getSno(): ?CompanySnoEnum
    {
        return $this->sno;
    }

    public function setSno(?CompanySnoEnum $sno): Company
    {
        $this->sno = $sno;
        return $this;
    }

    public function getInn(): string
    {
        return $this->inn;
    }

    public function setInn(string $inn): Company
    {
        $this->inn = $inn;
        return $this;
    }

    public function getPaymentAddress(): string
    {
        return $this->paymentAddress;
    }

    public function setPaymentAddress(string $paymentAddress): Company
    {
        $this->paymentAddress = $paymentAddress;
        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): Company
    {
        $this->location = $location;
        return $this;
    }

    public function jsonSerialize(): array
    {
        return array_filter(
            [
                'email' => $this->getEmail(),
                'inn' => $this->getInn(),
                'payment_address' => $this->getPaymentAddress(),
                'sno' => $this->getSno()?->value,
                'location' => $this->getLocation()
            ]
        );
    }

    public function isCorrectLength(string $string, int $need): bool
    {
        return strlen($string) === $need;
    }
}
