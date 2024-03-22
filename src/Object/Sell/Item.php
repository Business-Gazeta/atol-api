<?php

namespace BusinessGazeta\AtolApi\Object\Sell;

use BusinessGazeta\AtolApi\Object\AbstractObject;
use JsonSerializable;
use PaymentMethodEnum;
use PaymentObjectEnum;

class Item extends AbstractObject implements JsonSerializable
{
    private string $name;
    private string $price;
    private string $quantity;
    private string $sum;
    private ?string $measurementUnit = null;
    private ?string $nomenclatureCode = null;
    private ?PaymentMethodEnum $paymentMethod = null;
    private ?PaymentObjectEnum $paymentObject = null;
    private Vat $vat;
    private ?AgentInfo $agentInfo = null;
    private ?SupplierInfoFull $supplierInfo = null;
    private ?string $userData = null;
    private ?int $excise = null;
    private ?string $countryCode = null;
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
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @param string $price
     */
    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getQuantity(): string
    {
        return $this->quantity;
    }

    /**
     * @param string $quantity
     */
    public function setQuantity(string $quantity): void
    {
        $this->quantity = $quantity;
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
     * @return int|null
     */
    public function getExcise(): ?int
    {
        return $this->excise;
    }

    /**
     * @param int|null $excise
     */
    public function setExcise(?int $excise): void
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

}
