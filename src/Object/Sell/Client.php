<?php

namespace BusinessGazeta\AtolApi\Object\Sell;

use BusinessGazeta\AtolApi\Object\AbstractObject;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;

#[Assert\Expression(
    "this.getEmail() != null | this.getPhone() != null",
    message: 'В запросе обязательно должно быть заполнено хотя бы одно из полей: email или phone.'
)]
class Client extends AbstractObject implements JsonSerializable
{
    #[Assert\Email(
        message: 'Не корректный емайл',
    )]
    #[Assert\Length(
        max: 64,
        maxMessage: 'Длина строки не может быть больше чем {{ limit }} символов',
    )]
    private ?string $email = null;
    #[Assert\Length(
        min: 10,
        max: 64,
        minMessage: 'Номер телефона не может быть меньше чем {{ limit }} символов',
        maxMessage: 'Номер телефона не может быть больше чем {{ limit }} символов',
    )]
    private ?string $phone = null;
    #[Assert\Length(
        max: 256,
        maxMessage: 'Имя не может быть больше чем {{ limit }} символов',
    )]
    private ?string $name = null;
    #[Assert\Type(type: ['digit'])]
    #[Assert\Expression(
        "value === NULL or this.isCorrectLength(value, 12) or this.isCorrectLength(value, 10)",
        message: 'Допустимые значения длины инн: 10, 12',
    )]
    private ?string $inn = null;

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): Client
    {
        $this->email = $email;
        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): Client
    {
        $this->phone = $phone;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): Client
    {
        $this->name = $name;
        return $this;
    }

    public function getInn(): ?string
    {
        return $this->inn;
    }

    public function setInn(?string $inn): Client
    {
        $this->inn = $inn;
        return $this;
    }

    public function jsonSerialize(): array
    {
        return array_filter(
            [
                'email' => $this->getEmail(),
                'phone' => $this->getPhone(),
                'name' => $this->getName(),
                'inn' => $this->getInn()
            ]
        );
    }

    public function isCorrectLength(string $string, int $need): bool
    {
        return strlen($string) === $need;
    }
}
