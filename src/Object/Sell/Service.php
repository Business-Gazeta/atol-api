<?php

namespace BusinessGazeta\AtolApi\Object\Sell;

use BusinessGazeta\AtolApi\Object\AbstractObject;
use JsonSerializable;


class Service extends AbstractObject implements JsonSerializable
{
    private ?string $callbackUrl = null;

    public function jsonSerialize()
    {
        return $this->mergeParams([], $this->getCallbackUrl(), 'callback_url');
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
