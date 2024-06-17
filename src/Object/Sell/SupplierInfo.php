<?php

namespace BusinessGazeta\AtolApi\Object\Sell;

use BusinessGazeta\AtolApi\Object\AbstractObject;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;


class SupplierInfo extends AbstractObject implements JsonSerializable
{
    #[Assert\All([
        new Assert\Length(max: 19)
    ])]
    private ?array $phones = null;

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
        return array_filter(
            [
                'phones' => $this->getPhones()
            ]
        );
    }
}
