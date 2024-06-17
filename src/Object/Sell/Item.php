<?php

namespace BusinessGazeta\AtolApi\Object\Sell;

use BusinessGazeta\AtolApi\Enum\Sell\PaymentMethodEnum;
use BusinessGazeta\AtolApi\Enum\Sell\PaymentObjectEnum;
use BusinessGazeta\AtolApi\Object\AbstractObject;
use JsonSerializable;
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


    public function jsonSerialize(): array
    {
        return
            array_filter(
                [
                    'name' => $this->getName(),
                    'price' => $this->getPrice(),
                    'quantity' => $this->getQuantity(),
                    'sum' => $this->getSum(),
                    'vat' => ['type' => $this->getVat()->getType()],
                    'measurement_unit' => $this->getMeasurementUnit(),
                    'payment_method' => $this->getPaymentMethod(),
                    'payment_object' => $this->getPaymentObject(),
                    'nomenclature_code' => $this->getNomenclatureCode(),
                    'agent_info' => $this->getAgentInfo(),
                    'supplier_info' => $this->getSupplierInfo(),
                    'user_data' => $this->getUserData(),
                    'excise' => $this->getExcise(),
                    'country_code' => $this->getCountryCode(),
                    'declaration_number' => $this->getDeclarationNumber()
                ]
            );
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Item
    {
        $this->name = $name;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): Item
    {
        $this->price = $price;
        return $this;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): Item
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getSum(): float
    {
        return $this->getPrice() * $this->getQuantity();
    }

    public function getMeasurementUnit(): ?string
    {
        return $this->measurementUnit;
    }

    public function setMeasurementUnit(?string $measurementUnit): Item
    {
        $this->measurementUnit = $measurementUnit;
        return $this;
    }

    public function getNomenclatureCode(): ?string
    {
        return $this->nomenclatureCode;
    }

    public function setNomenclatureCode(?string $nomenclatureCode): Item
    {
        $this->nomenclatureCode = $nomenclatureCode;
        return $this;
    }

    public function getPaymentMethod(): ?PaymentMethodEnum
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(?PaymentMethodEnum $paymentMethod): Item
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    public function getPaymentObject(): ?PaymentObjectEnum
    {
        return $this->paymentObject;
    }

    public function setPaymentObject(?PaymentObjectEnum $paymentObject): Item
    {
        $this->paymentObject = $paymentObject;
        return $this;
    }

    public function getVat(): Vat
    {
        return $this->vat;
    }

    public function setVat(Vat $vat): Item
    {
        $this->vat = $vat;
        return $this;
    }

    public function getAgentInfo(): ?AgentInfo
    {
        return $this->agentInfo;
    }

    public function setAgentInfo(?AgentInfo $agentInfo): Item
    {
        $this->agentInfo = $agentInfo;
        return $this;
    }

    public function getSupplierInfo(): ?SupplierInfoFull
    {
        return $this->supplierInfo;
    }

    public function setSupplierInfo(?SupplierInfoFull $supplierInfo): Item
    {
        $this->supplierInfo = $supplierInfo;
        return $this;
    }

    public function getUserData(): ?string
    {
        return $this->userData;
    }

    public function setUserData(?string $userData): Item
    {
        $this->userData = $userData;
        return $this;
    }

    public function getExcise(): ?float
    {
        return $this->excise;
    }

    public function setExcise(?float $excise): Item
    {
        $this->excise = $excise;
        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function setCountryCode(?string $countryCode): Item
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    public function getDeclarationNumber(): ?string
    {
        return $this->declarationNumber;
    }

    public function setDeclarationNumber(?string $declarationNumber): Item
    {
        $this->declarationNumber = $declarationNumber;
        return $this;
    }

    public function isCorrectFloat(float $k, int $max, int $decimals = 2): bool
    {
        $parts = explode('.', $k);
        return (int)$k <= $max && (!isset($parts[1]) || strlen($parts[1]) < $decimals + 1);
    }
}
