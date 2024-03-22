<?php

namespace BusinessGazeta\AtolApi\Object\Sell;

use BusinessGazeta\AtolApi\Object\AbstractObject;
use JsonSerializable;
use VatTypeEnum;


class Vat extends AbstractObject implements JsonSerializable
{
    private VatTypeEnum $type;
    private ?string $sum = null;

    /**
     * @return VatTypeEnum
     */
    public function getType(): VatTypeEnum
    {
        return $this->type;
    }

    /**
     * @param VatTypeEnum $type
     */
    public function setType(VatTypeEnum $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string|null
     */
    public function getSum(): ?string
    {
        return $this->sum;
    }

    /**
     * @param string|null $sum
     */
    public function setSum(?string $sum): void
    {
        $this->sum = $sum;
    }


    public function jsonSerialize()
    {
        $params = $this->mergeParams([], $this->getType()?->value, 'type');
        $params = $this->mergeParams($params, $this->getSum(), 'sum');
        return $params;

    }
}
