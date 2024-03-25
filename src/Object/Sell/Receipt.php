<?php

namespace BusinessGazeta\AtolApi\Object\Sell;

use BusinessGazeta\AtolApi\Object\AbstractObject;
use BusinessGazeta\AtolApi\Enum\Sell\CompanySnoEnum;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;

class Receipt extends AbstractObject implements JsonSerializable
{

    private Client $client;
    private Company $company;
    private ?AgentInfo $agentInfo = null;
    private ?SupplierInfo $supplierInfo = null;
    /**
     * @var Item []
     */
    private array $items;
    /**
     * @var Payment []
     */
    private array $payments;
    /**
     * @var Vat []
     */
    private ?array $vats = null;
    private float $total;
    private ?string $additionalCheckProps = null;
    private ?string $cashier = null;
    private ?AdditionalUserProps $additionalUserProps = null;
    private ?string $deviceNumber = null;

    public function jsonSerialize()
    {
        $params =
            [
                'client' => $this->getClient(),
                'company' => $this->getCompany(),
                'total' => $this->getTotal(),
                'items' => $this->getItems(),
                'payments' => $this->getPayments(),
            ];
        $params = $this->mergeParams($params, $this->getAgentInfo(), 'agent_info');
        $params = $this->mergeParams($params, $this->getSupplierInfo(), 'supplier_info');
        $params = $this->mergeParams($params, $this->getVats(), 'vats');
        $params = $this->mergeParams($params, $this->getAdditionalCheckProps(), 'additional_check_props');
        $params = $this->mergeParams($params, $this->getCashier(), 'cashier');
        $params = $this->mergeParams($params, $this->getAdditionalUserProps(), 'additional_user_props');
        $params = $this->mergeParams($params, $this->getDeviceNumber(), 'device_number');

        return $params;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client): void
    {
        $this->client = $client;
    }

    /**
     * @return Company
     */
    public function getCompany(): Company
    {
        return $this->company;
    }

    /**
     * @param Company $company
     */
    public function setCompany(Company $company): void
    {
        $this->company = $company;
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
     * @return SupplierInfo|null
     */
    public function getSupplierInfo(): ?SupplierInfo
    {
        return $this->supplierInfo;
    }

    /**
     * @param SupplierInfo|null $supplierInfo
     */
    public function setSupplierInfo(?SupplierInfo $supplierInfo): void
    {
        $this->supplierInfo = $supplierInfo;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param array $items
     */
    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    /**
     * @return array
     */
    public function getPayments(): array
    {
        return $this->payments;
    }

    /**
     * @param array $payments
     */
    public function setPayments(array $payments): void
    {
        $this->payments = $payments;
    }

    /**
     * @return array|null
     */
    public function getVats(): ?array
    {
        return $this->vats;
    }

    /**
     * @param array|null $vats
     */
    public function setVats(?array $vats): void
    {
        $this->vats = $vats;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
        return (float)number_format($this->total, 2);
    }

    /**
     * @param float $total
     */
    public function setTotal(float $total): void
    {
        print_r($total);
        $this->total = sprintf('%05.2f', $total);
    }

    /**
     * @return string|null
     */
    public function getAdditionalCheckProps(): ?string
    {
        return $this->additionalCheckProps;
    }

    /**
     * @param string|null $additionalCheckProps
     */
    public function setAdditionalCheckProps(?string $additionalCheckProps): void
    {
        $this->additionalCheckProps = $additionalCheckProps;
    }

    /**
     * @return string|null
     */
    public function getCashier(): ?string
    {
        return $this->cashier;
    }

    /**
     * @param string|null $cashier
     */
    public function setCashier(?string $cashier): void
    {
        $this->cashier = $cashier;
    }

    /**
     * @return AdditionalUserProps|null
     */
    public function getAdditionalUserProps(): ?AdditionalUserProps
    {
        return $this->additionalUserProps;
    }

    /**
     * @param AdditionalUserProps|null $additionalUserProps
     */
    public function setAdditionalUserProps(?AdditionalUserProps $additionalUserProps): void
    {
        $this->additionalUserProps = $additionalUserProps;
    }

    /**
     * @return string|null
     */
    public function getDeviceNumber(): ?string
    {
        return $this->deviceNumber;
    }

    /**
     * @param string|null $deviceNumber
     */
    public function setDeviceNumber(?string $deviceNumber): void
    {
        $this->deviceNumber = $deviceNumber;
    }


}
