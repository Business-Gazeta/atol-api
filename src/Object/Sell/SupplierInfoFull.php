<?php

namespace BusinessGazeta\AtolApi\Object\Sell;


class SupplierInfoFull extends SupplierInfo
{

    private ?string $name = null;
    private string $inn;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): SupplierInfoFull
    {
        $this->name = $name;
        return $this;
    }

    public function getInn(): string
    {
        return $this->inn;
    }

    public function setInn(string $inn): SupplierInfoFull
    {
        $this->inn = $inn;
        return $this;
    }


    public function jsonSerialize(): array
    {
        return array_filter([
                'phones' => $this->getPhones(),
                'name' => $this->getName(),
                'inn' => $this->getInn()
            ]
        );
    }
}
