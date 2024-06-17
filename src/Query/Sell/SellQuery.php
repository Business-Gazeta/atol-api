<?php

namespace BusinessGazeta\AtolApi\Query\Sell;

use BusinessGazeta\AtolApi\Object\Sell\Receipt;
use BusinessGazeta\AtolApi\Object\Sell\Service;
use DateTime;
use DateTimeZone;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;

class SellQuery implements JsonSerializable
{
    private DateTime $timestamp;
    #[Assert\Length(
        min: 0,
        max: 128,
        minMessage: 'Строка должна состоять хотя бы из одного символа',
        maxMessage: 'Длина строки не может быть больше чем {{ limit }} символов',
    )]
    private string $externalId;
    #[Assert\Valid]
    private ?Service $service = null;
    #[Assert\Valid]
    private Receipt $receipt;

    public function __construct()
    {
        $this->timestamp = (new DateTime('now', new DateTimeZone('Europe/Moscow')));
    }


    public function jsonSerialize(): array
    {
        $params =
            [
                'timestamp' => $this->getTimestamp()->format('d.m.Y H:i:s'),
                'external_id' => $this->getExternalId(),
                'receipt' => $this->getReceipt()
            ];
        if ($this->getService()) {
            $params['service'] = $this->getService();
        }
        return array_filter($params);
    }

    public function getTimestamp(): DateTime
    {
        return $this->timestamp;
    }

    public function setTimestamp(DateTime $timestamp): SellQuery
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    public function getExternalId(): string
    {
        return $this->externalId;
    }

    public function setExternalId(string $externalId): SellQuery
    {
        $this->externalId = $externalId;
        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): SellQuery
    {
        $this->service = $service;
        return $this;
    }

    public function getReceipt(): Receipt
    {
        return $this->receipt;
    }

    public function setReceipt(Receipt $receipt): SellQuery
    {
        $this->receipt = $receipt;
        return $this;
    }
}
