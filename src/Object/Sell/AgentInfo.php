<?php

namespace BusinessGazeta\AtolApi\Object\Sell;

use BusinessGazeta\AtolApi\Enum\Sell\AgentInfoTypeEnum;
use BusinessGazeta\AtolApi\Object\AbstractObject;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;


class AgentInfo extends AbstractObject implements JsonSerializable
{
    private AgentInfoTypeEnum $type;
    #[Assert\Valid]
    private ?PayingAgent $payingAgent = null;
    #[Assert\Valid]
    private ?ReceivePaymentsOperator $receivePaymentsOperator = null;
    #[Assert\Valid]
    private ?MoneyTransferOperator $moneyTransferOperator = null;

    public function jsonSerialize(): array
    {
        return [
            'type' => $this->getType()->value,
            'paying_agent' => $this->getPayingAgent(),
            'receive_payments_operator' => $this->getReceivePaymentsOperator(),
            'money_transfer_operator' => $this->getMoneyTransferOperator()
        ];
    }


    public function __construct(AgentInfoTypeEnum $type)
    {
        $this->type = $type;
    }

    public function getType(): AgentInfoTypeEnum
    {
        return $this->type;
    }

    public function setType(AgentInfoTypeEnum $type): AgentInfo
    {
        $this->type = $type;
        return $this;
    }

    public function getPayingAgent(): ?PayingAgent
    {
        return $this->payingAgent;
    }

    public function setPayingAgent(?PayingAgent $payingAgent): AgentInfo
    {
        $this->payingAgent = $payingAgent;
        return $this;
    }

    public function getReceivePaymentsOperator(): ?ReceivePaymentsOperator
    {
        return $this->receivePaymentsOperator;
    }

    public function setReceivePaymentsOperator(?ReceivePaymentsOperator $receivePaymentsOperator): AgentInfo
    {
        $this->receivePaymentsOperator = $receivePaymentsOperator;
        return $this;
    }

    public function getMoneyTransferOperator(): ?MoneyTransferOperator
    {
        return $this->moneyTransferOperator;
    }

    public function setMoneyTransferOperator(?MoneyTransferOperator $moneyTransferOperator): AgentInfo
    {
        $this->moneyTransferOperator = $moneyTransferOperator;
        return $this;
    }
}
