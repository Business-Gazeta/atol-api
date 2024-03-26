<?php

namespace BusinessGazeta\AtolApi\Query\Sell;

use BusinessGazeta\AtolApi\Object\Sell\Receipt;
use BusinessGazeta\AtolApi\Object\Sell\Service;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;

class SellQuery implements JsonSerializable
{
    private string $timestamp;
    #[Assert\Length(
        min: 0,
        max: 128,
        minMessage: 'Строка должна сотоят хотябы из одного сивола',
        maxMessage: 'Длина строки не может быть больше чем {{ limit }} символов',
    )]
    private string $externalId;
    #[Assert\Valid]
    private ?Service $service = null;
    #[Assert\Valid]
    private Receipt $receipt;

    public function jsonSerialize()
    {

        $params =
            [
                'timestamp' => $this->getTimestamp(),
                'external_id' => $this->getExternalId(),
                'receipt' => $this->getReceipt()
            ];
        if ($this->getService()) {
            $params = array_merge($params, ['service' => $this->getService()]);
        }
        return $params;
    }

    /**
     * @return string
     */
    public function getTimestamp(): string
    {
        return $this->timestamp;
    }


    /**
     * @param \DateTime|string $timestamp
     * @return void
     */
    public function setTimestamp(\DateTime | string $timestamp): void
    {
        if (is_string($timestamp)) {
            $this->timestamp = $timestamp;
        } else {
            $this->timestamp = $timestamp->format('m-d-Y H:i:s');
        }
    }

    /**
     * @return string
     */
    public function getExternalId(): string
    {
        return $this->externalId;
    }

    /**
     * @param string $externalId
     */
    public function setExternalId(string $externalId): void
    {
        $this->externalId = $externalId;
    }

    /**
     * @return Service|null
     */
    public function getService(): ?Service
    {
        return $this->service;
    }

    /**
     * @param Service|null $service
     */
    public function setService(?Service $service): void
    {
        $this->service = $service;
    }

    /**
     * @return Receipt
     */
    public function getReceipt(): Receipt
    {
        return $this->receipt;
    }

    /**
     * @param Receipt $receipt
     */
    public function setReceipt(Receipt $receipt): void
    {
        $this->receipt = $receipt;
    }


}
