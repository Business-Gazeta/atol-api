<?php

namespace BusinessGazeta\AtolApi\Object\Sell;

use BusinessGazeta\AtolApi\Object\AbstractObject;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;

#[Assert\Expression(
    "this.getEmail() | this.getPhone()",
    message: 'В запросе обязательно должно быть заполнено хотя бы одно из полей: email или phone.'
)]
class Client extends AbstractObject implements JsonSerializable
{
    private ?string $email = null;
    private ?string $phone = null;
    private ?string $name = null;
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
}
