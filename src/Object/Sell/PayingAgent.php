<?php

namespace BusinessGazeta\AtolApi\Object\Sell;

use BusinessGazeta\AtolApi\Object\AbstractObject;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;



class PayingAgent extends AbstractObject implements JsonSerializable
{
    #[Assert\Length(
        max: 24,
        maxMessage: 'Максимальная длина строки – 24 символа.',
    )]
    private ?string $operation = null;
    #[Assert\All([
        new Assert\Length(max: 19)
    ])]
    private ?array $phones = null;

    public function jsonSerialize(): array
    {
        return array_filter(
            [
                'operation' => $this->getOperation(),
                'phones' => $this->getPhones()
            ]
        );
    }

    public function getOperation(): ?string
    {
        return $this->operation;
    }

    public function setOperation(?string $operation): PayingAgent
    {
        $this->operation = $operation;
        return $this;
    }

    public function getPhones(): ?array
    {
        return $this->phones;
    }

    public function setPhones(?array $phones): PayingAgent
    {
        $this->phones = $phones;
        return $this;
    }
}
