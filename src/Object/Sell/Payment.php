<?php

namespace BusinessGazeta\AtolApi\Object\Sell;

use BusinessGazeta\AtolApi\Object\AbstractObject;
use JsonSerializable;
use PaymentTypeEnum;
use VatTypeEnum;


class Payment extends AbstractObject implements JsonSerializable
{
    private PaymentTypeEnum $type;
    private string $sum;


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
     * @return string
     */
    public function getSum(): string
    {
        return $this->sum;
    }

    /**
     * @param string $sum
     */
    public function setSum(string $sum): void
    {
        $this->sum = $sum;
    }


}
