<?php

namespace BusinessGazeta\AtolApi\Object\Sell;

use BusinessGazeta\AtolApi\Object\AbstractObject;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;

class Receipt extends AbstractObject implements JsonSerializable
{

    #[Assert\Valid]
    private Client $client;
    #[Assert\Valid]
    private Company $company;
    #[Assert\Valid]
    private ?AgentInfo $agentInfo = null;
    #[Assert\Valid]
    private ?SupplierInfo $supplierInfo = null;
    #[Assert\Count(
        min: 1,
        max: 100,
        minMessage: 'Ограничение по количеству от 1 до 100',
        maxMessage: 'Ограничение по количеству от 1 до 100',
    )]
    #[Assert\Valid]
    /**
     * @var Item []
     */
    private array $items;
    #[Assert\Expression(
        "value === null || this.isCorrectFloat(value, 100000000)",
        message: 'Максимальное значение цены – 999999999.99, и 2 знака после запятой',
    )]
    private float $total;
    #[Assert\Length(
        max: 16,
        maxMessage: 'Максимальная длина строки – 16 символов.',
    )]
    private ?string $additionalCheckProps = null;
    #[Assert\Length(
        max: 64,
        maxMessage: 'Максимальная длина строки – 64 символов.',
    )]
    private ?string $cashier = null;
    #[Assert\Valid]
    private ?AdditionalUserProps $additionalUserProps = null;
    #[Assert\Length(
        min: 1,
        max: 20,
        minMessage: 'Локация не может быть меньше чем {{ limit }} символов',
        maxMessage: 'Локация не может быть больше чем {{ limit }} символов',
    )]
    private ?string $deviceNumber = null;

    public function jsonSerialize(): array
    {
        return [
            'client' => $this->getClient(),
            'company' => $this->getCompany(),
            'total' => $this->getTotal(),
            'items' => $this->getItems(),
            'payments' => $this->getPayments(),
            'agent_info' => $this->getAgentInfo(),
            'supplier_info' => $this->getSupplierInfo(),
            'vats' => $this->getVats(),
            'additional_check_props' => $this->getAdditionalCheckProps(),
            'cashier' => $this->getCashier(),
            'additional_user_props' => $this->getAdditionalUserProps(),
            'device_number' => $this->getDeviceNumber()
        ];
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
        $payments = [];
        foreach ($this->items as $item) {
            $type = $item->getPaymentMethod()->value;
            $payments[$type]['type'] = $type;
            $payments[$type]['sum'][] = $item->getSum();
        }
        return array_values(
            array_map(
                static function ($item) {
                    return [
                        'type' => $item['type'],
                        'sum' => array_sum($item['sum'])
                    ];
                },
                $payments
            )
        );
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
        $vats = [];
        foreach ($this->items as $item) {
            $vat = $item->getVat();
            $type = $vat->getType()->value;
            $vats[$type]['type'] = $type;
            $vats[$type]['sum'][] = $vat->getSum();
        }
        return array_values(
            array_map(
                static function ($item) {
                    return [
                        'type' => $item['type'],
                        'sum' => array_sum($item['sum'])
                    ];
                },
                $vats
            )
        );
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
        return array_sum(
            array_map(
                static function (Item $item) {
                    return $item->getSum();
                },
                $this->getItems()
            )
        );
    }

    /**
     * @param float $total
     */
    public function setTotal(float $total): void
    {
        $this->total = $total;
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

    public function isCorrectFloat(float $k, int $max, int $decimals = 2): bool
    {
        $parts = explode('.', $k);
        return (int)$k <= $max && (!isset($parts[1]) || strlen($parts[1]) < $decimals + 1);
    }

}
