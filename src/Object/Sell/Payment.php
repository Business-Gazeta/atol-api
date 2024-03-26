<?php

namespace BusinessGazeta\AtolApi\Object\Sell;

use BusinessGazeta\AtolApi\Object\AbstractObject;
use JsonSerializable;
use BusinessGazeta\AtolApi\Enum\Sell\PaymentTypeEnum;


class Payment extends AbstractObject implements JsonSerializable
{
    private PaymentTypeEnum $type;
    private float $sum;


    public function jsonSerialize()
    {
        return
            [
                'type' => $this->getType()?->value,
                'sum' => $this->getSum()
            ];
    }

    /**
     * @return PaymentTypeEnum
     */
    public function getType(): PaymentTypeEnum
    {
        return $this->type;
    }

    /**
     * @param PaymentTypeEnum $type
     */
    public function setType(PaymentTypeEnum $type): void
    {
        $this->type = $type;
    }

    /**
     * @return float
     */
    public function getSum(): float
    {
        return (float)number_format($this->sum, 2);
    }

    /**
     * @param float $sum
     */
    public function setSum(float $sum): void
    {
        $this->sum = $sum;
    }


}
