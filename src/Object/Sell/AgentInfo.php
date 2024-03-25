<?php

namespace BusinessGazeta\AtolApi\Object\Sell;

use BusinessGazeta\AtolApi\Enum\Sell\AgentInfoTypeEnum;
use BusinessGazeta\AtolApi\Object\AbstractObject;
use JsonSerializable;



class AgentInfo extends AbstractObject implements JsonSerializable
{
    private AgentInfoTypeEnum $type;
    private ?PayingAgent $payingAgent = null;
    private ?ReceivePaymentsOperator $receivePaymentsOperator = null;
    private ?MoneyTransferOperator $moneyTransferOperator = null;

    public function jsonSerialize()
    {
        $params =
            [
                'type' => $this->getType()->value
            ];
        $params = $this->mergeParams($params, $this->getPayingAgent()?->jsonSerialize(), 'paying_agent');
        $params = $this->mergeParams($params, $this->getReceivePaymentsOperator()?->jsonSerialize(), 'receive_payments_operator');
        $params = $this->mergeParams($params, $this->getMoneyTransferOperator()?->jsonSerialize(), 'money_transfer_operator');

        return $params;
    }


    public function __construct(AgentInfoTypeEnum $type)
    {
        $this->type = $type;
    }

    /**
     * @return AgentInfoTypeEnum
     */
    public function getType(): AgentInfoTypeEnum
    {
        return $this->type;
    }

    /**
     * @param AgentInfoTypeEnum $type
     */
    public function setType(AgentInfoTypeEnum $type): void
    {
        $this->type = $type;
    }

    /**
     * @return PayingAgent|null
     */
    public function getPayingAgent(): ?PayingAgent
    {
        return $this->payingAgent;
    }

    /**
     * @param PayingAgent|null $payingAgent
     */
    public function setPayingAgent(?PayingAgent $payingAgent): void
    {
        $this->payingAgent = $payingAgent;
    }

    /**
     * @return ReceivePaymentsOperator|null
     */
    public function getReceivePaymentsOperator(): ?ReceivePaymentsOperator
    {
        return $this->receivePaymentsOperator;
    }

    /**
     * @param ReceivePaymentsOperator|null $receivePaymentsOperator
     */
    public function setReceivePaymentsOperator(?ReceivePaymentsOperator $receivePaymentsOperator): void
    {
        $this->receivePaymentsOperator = $receivePaymentsOperator;
    }

    /**
     * @return MoneyTransferOperator|null
     */
    public function getMoneyTransferOperator(): ?MoneyTransferOperator
    {
        return $this->moneyTransferOperator;
    }

    /**
     * @param MoneyTransferOperator|null $moneyTransferOperator
     */
    public function setMoneyTransferOperator(?MoneyTransferOperator $moneyTransferOperator): void
    {
        $this->moneyTransferOperator = $moneyTransferOperator;
    }

}
