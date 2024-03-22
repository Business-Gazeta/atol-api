<?php

namespace BusinessGazeta\AtolApi\Object\Sell;

use BusinessGazeta\AtolApi\Object\AbstractObject;
use JsonSerializable;



class PayingAgent extends AbstractObject implements JsonSerializable
{
    private ?string $operation = null;
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


    public function jsonSerialize()
    {
        $params = $this->mergeParams([], $this->getOperation(), 'operation');
        $params = $this->mergeParams($params, $this->getPhones(), 'phones');

        return $params;
    }
}
