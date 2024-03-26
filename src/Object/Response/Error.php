<?php

namespace BusinessGazeta\AtolApi\Object\Response;

class Error
{
    private string $errorId;
    private int $code;
    private string $text;
    private \DateTime $timestamp;

    public function __construct(string $errorId, int $code, string $text, \DateTime $timestamp) {
        $this->errorId = $errorId;
        $this->code = $code;
        $this->text = $text;
        $this->timestamp = $timestamp;
    }

    /**
     * @return string
     */
    public function getErrorId(): string
    {
        return $this->errorId;
    }

    /**
     * @param string $errorId
     * @return Error
     */
    public function setErrorId(string $errorId): Error
    {
        $this->errorId = $errorId;
        return $this;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     * @return Error
     */
    public function setCode(int $code): Error
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return Error
     */
    public function setText(string $text): Error
    {
        $this->text = $text;
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
     * @return Error
     */
    public function setTimestamp(\DateTime $timestamp): Error
    {
        $this->timestamp = $timestamp;
        return $this;
    }


}
