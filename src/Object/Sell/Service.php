<?php

namespace BusinessGazeta\AtolApi\Object\Sell;

use BusinessGazeta\AtolApi\Object\AbstractObject;
use JsonSerializable;
use Symfony\Component\Validator\Constraints as Assert;


class Service extends AbstractObject implements JsonSerializable
{
    #[Assert\Regex("^http(s?)\:\/\/[0-9a-zA-Zа-яА-Я]([-.\w]*[0-9a-zA-Zа-яА-Я])*(:(0-9)*)*(\/?)([a-
zA-Z0-9а-яА-Я\-\.\?\,\'\/\\\+&=%\$#_]*)?$")]
    private ?string $callbackUrl = null;

    public function jsonSerialize(): array
    {
        return array_filter(
            [
                'callback_url' => $this->getCallbackUrl()
            ]
        );
    }

    public function getCallbackUrl(): ?string
    {
        return $this->callbackUrl;
    }

    public function setCallbackUrl(?string $callbackUrl): Service
    {
        $this->callbackUrl = $callbackUrl;
        return $this;
    }
}
