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

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getInn(): ?string
    {
        return $this->inn;
    }

    /**
     * @param string|null $inn
     */
    public function setInn(?string $inn): void
    {
        $this->inn = $inn;
    }

    public function jsonSerialize()
    {
        $params = $this->mergeParams([], $this->getEmail(), 'email');
        $params= $this->mergeParams($params, $this->getPhone(), 'phone');
        $params = $this->mergeParams($params, $this->getName(), 'name');
        $params = $this->mergeParams($params, $this->getInn(), 'inn');

        return $params;
    }

    public function isCorrectLength(string $string, int $need):bool
    {
        return strlen($string) === $need;
    }
}
