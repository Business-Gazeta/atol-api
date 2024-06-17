<?php

namespace BusinessGazeta\AtolApi\Object\Sell;

use BusinessGazeta\AtolApi\Object\AbstractObject;
use JsonSerializable;
use BusinessGazeta\AtolApi\Enum\Sell\PaymentTypeEnum;
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

    public function isCorrectFloat(float $k, int $max, int $decimals = 2): bool
    {
        $parts = explode('.', $k);
        return (int)$k <= $max && (!isset($parts[1]) || strlen($parts[1]) < $decimals + 1);
    }

}
