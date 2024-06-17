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

    /**
     * @return string|null
     */
    public function getOperation(): ?string
    {
        return $this->operation;
    }

    /**
     * @param string|null $operation
     */
    public function setOperation(?string $operation): void
    {
        $this->operation = $operation;
    }

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


    public function jsonSerialize(): array
    {
        $params = $this->mergeParams([], $this->getOperation(), 'operation');
        $params = $this->mergeParams($params, $this->getPhones(), 'phones');

        return $params;
    }
}
