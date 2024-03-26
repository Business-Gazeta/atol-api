<?php

namespace BusinessGazeta\AtolApi\Object\Sell;

use BusinessGazeta\AtolApi\Object\AbstractObject;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;



class AdditionalUserProps extends AbstractObject implements JsonSerializable
{
    #[Assert\Length(
        max: 64,
        maxMessage: 'Максимальная длина имени – 64 символа.',
    )]
    private string $name;
    #[Assert\Length(
        max: 256,
        maxMessage: 'Платежный адресс может быть больше чем {{ limit }} символов',
    )]
    private string $value;

    public function jsonSerialize()
    {
        return [
            'name' => $this->getName(),
            'value' => $this->getValue()
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }

}
