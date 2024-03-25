<?php

namespace BusinessGazeta\AtolApi\Object\Sell;

use BusinessGazeta\AtolApi\Object\AbstractObject;
use JsonSerializable;
use BusinessGazeta\AtolApi\Enum\Sell\VatTypeEnum;


class Vat extends AbstractObject implements JsonSerializable
{
    private VatTypeEnum $type;
    private ?float $sum = null;

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
    public function setType(VatTypeEnum $type): Vat
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getSum(): ?float
    {
        return (float)number_format($this->sum, 2);
    }

    /**
     * @param float|null $sum
     */
    public function setSum(?float $sum): Vat
    {
        $this->sum = $sum;
        return $this;
    }


    public function jsonSerialize()
    {
        $params = $this->mergeParams([], $this->getType()?->value, 'type');
        $params = $this->mergeParams($params, $this->getSum(), 'sum');
        return $params;

    }
}
