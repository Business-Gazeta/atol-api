<?php

namespace BusinessGazeta\AtolApi\Object\Sell;

use BusinessGazeta\AtolApi\Object\AbstractObject;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;



class MoneyTransferOperator extends AbstractObject implements JsonSerializable
{
    #[Assert\All([
        new Assert\Length(max: 19)
    ])]
    private ?array $phones = null;
    #[Assert\Length(
        max: 64,
        maxMessage: 'Длина строки не может быть больше чем {{ limit }} символов',
    )]
    private ?string $name = null;
    #[Assert\Length(
        max: 256,
        maxMessage: 'Адресс может быть больше чем {{ limit }} символов',
    )]
    private ?string $address = null;
    #[Assert\Type(type: ['digit'])]
    #[Assert\Expression(
        "value === NULL or this.isCorrectLength(value, 12) or this.isCorrectLength(value, 10)",
        message: 'Допустимые значения длины инн: 10, 12',
    )]
    private ?string $inn = null;

    public function getPhones(): ?array
    {
        return $this->phones;
    }

    public function setPhones(?array $phones): MoneyTransferOperator
    {
        $this->phones = $phones;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): MoneyTransferOperator
    {
        $this->name = $name;
        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): MoneyTransferOperator
    {
        $this->address = $address;
        return $this;
    }

    public function getInn(): ?string
    {
        return $this->inn;
    }

    public function setInn(?string $inn): MoneyTransferOperator
    {
        $this->inn = $inn;
        return $this;
    }

    public function jsonSerialize(): array
    {
        return array_filter(
            [
                'phones' => $this->getPhones(),
                'address' => $this->getAddress(),
                'inn' => $this->getInn()
            ]
        );
    }
    public function isCorrectLength(string $string, int $need):bool
    {
        return strlen($string) === $need;
    }
}
