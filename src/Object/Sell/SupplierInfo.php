<?php

namespace BusinessGazeta\AtolApi\Object\Sell;

use BusinessGazeta\AtolApi\Object\AbstractObject;
use JsonSerializable;



class SupplierInfo extends AbstractObject implements JsonSerializable
{

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


    public function jsonSerialize()
    {
        return $this->mergeParams([], $this->getPhones(), 'phones');
    }
}
