<?php

namespace BusinessGazeta\AtolApi\Object\Sell;

use BusinessGazeta\AtolApi\Object\AbstractObject;
use JsonSerializable;
use BusinessGazeta\AtolApi\Enum\Sell\PaymentMethodEnum;
use BusinessGazeta\AtolApi\Enum\Sell\PaymentObjectEnum;
use Symfony\Component\Validator\Constraints as Assert;

class Item extends AbstractObject implements JsonSerializable
{
    #[Assert\Length(
        max: 128,
        maxMessage: 'Длина строки не может быть больше чем {{ limit }} символов',
    )]
    private string $name;
    #[Assert\Expression(
        "value === null || this.isCorrectFloat(value, 42949673)",
        message: 'Максимальное значение цены – 42 949 672.95 и 2 знака после запятой',
    )]
    private float $price;
    #[Assert\Expression(
        "value === null || this.isCorrectFloat(value, 99999.999, 3)",
        message: 'Максимальное значение – 99 999.999 и 3 знака после запятой',
    )]
    private float $quantity;
    #[Assert\Expression(
        "value === null || this.isCorrectFloat(value, 42949673)",
        message: 'Максимальное значение цены – 42 949 672.95 и 2 знака после запятой',
    )]
    private float $sum;
    #[Assert\Length(
        max: 16,
        maxMessage: 'Максимальная длина строки – 16 символов.',
    )]
    private ?string $measurementUnit = null;
    #[Assert\Regex("^([a-fA-F0-9]{2}$)|(^([a-fA-F0-9]{2}\\s){1,31}[a-fA-F0-9]{2}|01(?<gtin>\\d{14})21(?<serial>[a-zA-Z0-9!\" % &'()*+\\/\\-.,:;=<>?_]{13})([a-zA-Z0-
9!\" % &'()*+\\/\\-.,:;=<>?_]{1,119})?|(?<gtin>\\d{14})(?<serial>[a-zA-Z0-9!\" %&'()*+\\/\\-.,:;=<>?_]{11})[a-zA-Z0-9!\" %&'()*+\\/\\-.,:;=<>?_]{4})$")]
    #[Assert\Length(
        max: 150,
        maxMessage: 'Максимальная длина – 150 символов.',
    )]
    private ?string $nomenclatureCode = null;
    private ?PaymentMethodEnum $paymentMethod = null;
    private ?PaymentObjectEnum $paymentObject = null;
    #[Assert\Valid]
    private Vat $vat;
    private ?AgentInfo $agentInfo = null;
    private ?SupplierInfoFull $supplierInfo = null;
    #[Assert\Length(
        max: 64,
        maxMessage: 'Максимальная длина строки – 64 символа.',
    )]
    private ?string $userData = null;
    #[Assert\PositiveOrZero]
    #[Assert\Expression(
        "value === null || this.isCorrectFloat(value, 100000000)",
        message: 'Максимальное значение цены – 999999999.99, и 2 знака после запятой',
    )]
    private ?float $excise = null;
    #[Assert\Length(
        min: 3,
        max: 3,
        minMessage: 'Если переданный код страны происхождения имеет длину меньше 3 цифр, то он дополняется справа пробелами',
        maxMessage: 'Код страны происхождения имеет длину ровно 3 цифры',
    )]
    private ?string $countryCode = null;
    #[Assert\Length(
        max: 32,
        maxMessage: 'Максимум 32 символа',
    )]
    private ?string $declarationNumber = null;


    public function jsonSerialize()
    {
        $params =
            [
                'name' => $this->getName(),
                'price' => $this->getPrice(),
                'quantity' => $this->getQuantity(),
                'sum' => $this->getSum(),
                'vat' => $this->getVat()->jsonSerialize()
            ];
        $params = $this->mergeParams($params, $this->getMeasurementUnit(), 'measurement_unit');
        $params= $this->mergeParams($params, $this->getPaymentMethod()?->value, 'payment_method');
        $params= $this->mergeParams($params, $this->getPaymentObject()?->value, 'payment_object');
        $params= $this->mergeParams($params, $this->getNomenclatureCode(), 'nomenclature_code');
//        $params= $this->mergeParams($params, $this->getVat()->jsonSerialize(), 'vat');
        $params= $this->mergeParams($params, $this->getAgentInfo()?->jsonSerialize(), 'agent_info');
        $params= $this->mergeParams($params, $this->getSupplierInfo()?->jsonSerialize(), 'supplier_info');
        $params= $this->mergeParams($params, $this->getUserData(), 'user_data');
        $params= $this->mergeParams($params, $this->getExcise(), 'excise');
        $params= $this->mergeParams($params, $this->getCountryCode(), 'country_code');
        $params= $this->mergeParams($params, $this->getDeclarationNumber(), 'declaration_number');

        return $params;
    }
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return (float)number_format($this->price,2);
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getQuantity(): float
    {
        return (float)number_format($this->quantity, 3);
    }

    /**
     * @param float $quantity
     */
    public function setQuantity(float $quantity): void
    {
        $this->quantity = $quantity;
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

    /**
     * @return string|null
     */
    public function getMeasurementUnit(): ?string
    {
        return $this->measurementUnit;
    }

    /**
     * @param string|null $measurementUnit
     */
    public function setMeasurementUnit(?string $measurementUnit): void
    {
        $this->measurementUnit = $measurementUnit;
    }

    /**
     * @return string|null
     */
    public function getNomenclatureCode(): ?string
    {
        return $this->nomenclatureCode;
    }

    /**
     * @param string|null $nomenclatureCode
     */
    public function setNomenclatureCode(?string $nomenclatureCode): void
    {
        $this->nomenclatureCode = $nomenclatureCode;
    }

    /**
     * @return PaymentMethodEnum|null
     */
    public function getPaymentMethod(): ?PaymentMethodEnum
    {
        return $this->paymentMethod;
    }

    /**
     * @param PaymentMethodEnum|null $paymentMethod
     */
    public function setPaymentMethod(?PaymentMethodEnum $paymentMethod): void
    {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * @return PaymentObjectEnum|null
     */
    public function getPaymentObject(): ?PaymentObjectEnum
    {
        return $this->paymentObject;
    }

    /**
     * @param PaymentObjectEnum|null $paymentObject
     */
    public function setPaymentObject(?PaymentObjectEnum $paymentObject): void
    {
        $this->paymentObject = $paymentObject;
    }

    /**
     * @return Vat
     */
    public function getVat(): Vat
    {
        return $this->vat;
    }

    /**
     * @param Vat $vat
     */
    public function setVat(Vat $vat): void
    {
        $this->vat = $vat;
    }

    /**
     * @return AgentInfo|null
     */
    public function getAgentInfo(): ?AgentInfo
    {
        return $this->agentInfo;
    }

    /**
     * @param AgentInfo|null $agentInfo
     */
    public function setAgentInfo(?AgentInfo $agentInfo): void
    {
        $this->agentInfo = $agentInfo;
    }

    /**
     * @return SupplierInfoFull|null
     */
    public function getSupplierInfo(): ?SupplierInfoFull
    {
        return $this->supplierInfo;
    }

    /**
     * @param SupplierInfoFull|null $supplierInfo
     */
    public function setSupplierInfo(?SupplierInfoFull $supplierInfo): void
    {
        $this->supplierInfo = $supplierInfo;
    }

    /**
     * @return string|null
     */
    public function getUserData(): ?string
    {
        return $this->userData;
    }

    /**
     * @param string|null $userData
     */
    public function setUserData(?string $userData): void
    {
        $this->userData = $userData;
    }

    /**
     * @return float|null
     */
    public function getExcise(): ?float
    {
        return (float)number_format($this->excise, 2);
    }

    /**
     * @param float|null $excise
     */
    public function setExcise(?float $excise): void
    {
        $this->excise = $excise;
    }

    /**
     * @return string|null
     */
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    /**
     * @param string|null $countryCode
     */
    public function setCountryCode(?string $countryCode): void
    {
        $this->countryCode = $countryCode;
    }

    /**
     * @return string|null
     */
    public function getDeclarationNumber(): ?string
    {
        return $this->declarationNumber;
    }

    /**
     * @param string|null $declarationNumber
     */
    public function setDeclarationNumber(?string $declarationNumber): void
    {
        $this->declarationNumber = $declarationNumber;
    }

    public function isCorrectFloat(float $k, int $max, int $decimals = 2): bool
    {
        $parts = explode('.', $k);
        return (int)$k <= $max && (!isset($parts[1]) || strlen($parts[1]) < $decimals + 1);
    }

}
