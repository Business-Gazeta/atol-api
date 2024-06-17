<?php

namespace BusinessGazeta\AtolApi\Object\Sell;

use BusinessGazeta\AtolApi\Enum\Sell\PaymentTypeEnum;
use BusinessGazeta\AtolApi\Object\AbstractObject;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;


class Payment extends AbstractObject implements JsonSerializable
{
    private PaymentTypeEnum $type;
    #[Assert\Expression(
        "value === null || this.isCorrectFloat(value, 100000000)",
        message: 'Максимальное значение цены – 999999999.99, и 2 знака после запятой',
    )]
    private float $sum;


    public function jsonSerialize(): array
    {
        return array_filter(
            [
                'type' => $this->getType()?->value,
                'sum' => $this->getSum()
            ]
        );
    }

    public function getType(): PaymentTypeEnum
    {
        return $this->type;
    }

    public function setType(PaymentTypeEnum $type): Payment
    {
        $this->type = $type;
        return $this;
    }

    public function getSum(): float
    {
        return $this->sum;
    }

    public function setSum(float $sum): Payment
    {
        $this->sum = $sum;
        return $this;
    }

    public function isCorrectFloat(float $k, int $max, int $decimals = 2): bool
    {
        $parts = explode('.', $k);
        return (int)$k <= $max && (!isset($parts[1]) || strlen($parts[1]) < $decimals + 1);
    }

}
