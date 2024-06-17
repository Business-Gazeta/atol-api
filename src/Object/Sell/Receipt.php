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
     * @var Item[] $items
     */
    private array $items;
    /**
     * @var Payment[] $payments
     */
    private array $payments;
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
        return array_filter(
            [
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
        ]
        );
    }

    /**
     * @return array
     */
    public function getPayments(): array
    {
        return $this->payments;
    }

    public function setPayments(array $payments): Receipt
    {
        $this->payments = $payments;
        return $this;
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

    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(Client $client): Receipt
    {
        $this->client = $client;
        return $this;
    }

    public function getCompany(): Company
    {
        return $this->company;
    }

    public function setCompany(Company $company): Receipt
    {
        $this->company = $company;
        return $this;
    }

    public function getAgentInfo(): ?AgentInfo
    {
        return $this->agentInfo;
    }

    public function setAgentInfo(?AgentInfo $agentInfo): Receipt
    {
        $this->agentInfo = $agentInfo;
        return $this;
    }

    public function getSupplierInfo(): ?SupplierInfo
    {
        return $this->supplierInfo;
    }

    public function setSupplierInfo(?SupplierInfo $supplierInfo): Receipt
    {
        $this->supplierInfo = $supplierInfo;
        return $this;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): Receipt
    {
        $this->items = $items;
        return $this;
    }

    public function getAdditionalCheckProps(): ?string
    {
        return $this->additionalCheckProps;
    }

    public function setAdditionalCheckProps(?string $additionalCheckProps): Receipt
    {
        $this->additionalCheckProps = $additionalCheckProps;
        return $this;
    }

    public function getCashier(): ?string
    {
        return $this->cashier;
    }

    public function setCashier(?string $cashier): Receipt
    {
        $this->cashier = $cashier;
        return $this;
    }

    public function getAdditionalUserProps(): ?AdditionalUserProps
    {
        return $this->additionalUserProps;
    }

    public function setAdditionalUserProps(?AdditionalUserProps $additionalUserProps): Receipt
    {
        $this->additionalUserProps = $additionalUserProps;
        return $this;
    }

    public function getDeviceNumber(): ?string
    {
        return $this->deviceNumber;
    }

    public function setDeviceNumber(?string $deviceNumber): Receipt
    {
        $this->deviceNumber = $deviceNumber;
        return $this;
    }

    public function isCorrectFloat(float $k, int $max, int $decimals = 2): bool
    {
        $parts = explode('.', $k);
        return (int)$k <= $max && (!isset($parts[1]) || strlen($parts[1]) < $decimals + 1);
    }

}
