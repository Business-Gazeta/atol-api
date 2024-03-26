<?php

namespace BusinessGazeta\AtolApi\Object\Sell;


class SupplierInfoFull extends SupplierInfo
{

    private ?string $name = null;
    private string $inn;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getInn(): string
    {
        return $this->inn;
    }

    /**
     * @param string $inn
     */
    public function setInn(string $inn): void
    {
        $this->inn = $inn;
    }



    public function jsonSerialize()
    {
        $params = $this->mergeParams([], $this->getPhones(), 'phones');
        $params = $this->mergeParams($params, $this->getName(), 'name');
        $params = array_merge($params, ['inn' => $this->getInn()]);
        return $params;
    }
}
