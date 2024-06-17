<?php

namespace BusinessGazeta\AtolApi\Object\Sell;

use BusinessGazeta\AtolApi\Enum\Sell\VatTypeEnum;
use BusinessGazeta\AtolApi\Object\AbstractObject;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @TODO Необходимо сделать расчет суммы налога автоматическим, исходя из налоговой ставки и суммы
 */
class Vat extends AbstractObject implements JsonSerializable
{
    private VatTypeEnum $type;
    #[Assert\Expression(
        "value === null || this.isCorrectFloat(value, 100000000)",
        message: 'Максимальное значение цены – 999999999.99, и 2 знака после запятой',
    )]
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
        return (float)number_format($this->sum, 2, '.', '');
    }

    /**
     * @param float|null $sum
     * @return $this
     */
    public function setSum(?float $sum): Vat
    {
        $this->sum = $sum;
        return $this;
    }


    public function jsonSerialize(): array
    {
        return array_filter(
            [
                'type' => $this->getType(),
                'sum' => $this->getSum()
            ]
        );
    }

    public function isCorrectFloat(float $k, int $max, int $decimals = 2): bool
    {
        $parts = explode('.', $k);
        return (int)$k <= $max && (!isset($parts[1]) || strlen($parts[1]) < $decimals + 1);
    }
}
