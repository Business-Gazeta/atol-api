<?php

namespace BusinessGazeta\AtolApi\Object\Response;

abstract class AbstractResponseObject implements AtolResponseObjectInterface
{
    private ?Error $error = null;
    private \DateTime $timestamp;

    /**
     * @return Error|null
     */
    public function getError(): ?Error
    {
        return $this->error;
    }

    /**
     * @param Error|null $error
     * @return AbstractResponseObject
     */
    public function setError(?Error $error): AbstractResponseObject
    {
        $this->error = $error;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTimestamp(): \DateTime
    {
        return $this->timestamp;
    }

    /**
     * @param \DateTime $timestamp
     * @return AbstractResponseObject
     */
    public function setTimestamp(\DateTime $timestamp): AbstractResponseObject
    {
        $this->timestamp = $timestamp;
        return $this;
    }
}
