<?php

namespace BusinessGazeta\AtolApi\Object\Response;

class Sell extends AbstractResponseObject
{
    private string $uuid;
    private string $status;

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     * @return Sell
     */
    public function setUuid(string $uuid): Sell
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Sell
     */
    public function setStatus(string $status): Sell
    {
        $this->status = $status;
        return $this;
    }


    public function getBasic(): string
    {
        return $this->uuid;
    }
}
