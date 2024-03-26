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

    /**
     * @return array|null
     */
    public function getPhones(): ?array
    {
        return $this->phones;
    }

    /**
     * @param array|null $phones
     */
    public function setPhones(?array $phones): void
    {
        $this->phones = $phones;
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
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
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
        $params = $this->mergeParams([], $this->getPhones(), 'phones');
        $params = $this->mergeParams($params, $this->getPhones(), 'phones');
        $params = $this->mergeParams($params, $this->getAddress(), 'address');
        $params = $this->mergeParams($params, $this->getInn(), 'inn');


        return $params;
    }
    public function isCorrectLength(string $string, int $need):bool
    {
        return strlen($string) === $need;
    }
}
