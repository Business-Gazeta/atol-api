<?php

namespace BusinessGazeta\AtolApi\Object\Sell;
use Symfony\Component\Validator\Constraints as Assert;

use BusinessGazeta\AtolApi\Object\AbstractObject;
use JsonSerializable;


class Service extends AbstractObject implements JsonSerializable
{
    #[Assert\Regex("^http(s?)\:\/\/[0-9a-zA-Zа-яА-Я]([-.\w]*[0-9a-zA-Zа-яА-Я])*(:(0-9)*)*(\/?)([a-
zA-Z0-9а-яА-Я\-\.\?\,\'\/\\\+&=%\$#_]*)?$")]
    private ?string $callbackUrl = null;

    public function jsonSerialize(): array
    {
        return [
            'callback_url' => $this->getCallbackUrl()
        ];
    }

    /**
     * @return string|null
     */
    public function getCallbackUrl(): ?string
    {
        return $this->callbackUrl;
    }

    /**
     * @param string|null $callbackUrl
     */
    public function setCallbackUrl(?string $callbackUrl): void
    {
        $this->callbackUrl = $callbackUrl;
    }
}
