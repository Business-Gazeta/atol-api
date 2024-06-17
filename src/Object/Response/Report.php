<?php

namespace BusinessGazeta\AtolApi\Object\Response;

class Report extends AbstractResponseObject
{

    private ?string $callbackUrl;
    private ?string $daemonCode;
    private ?string $deviceCode;
    private ?array $warnings;
    private string $externalId;
    private string $groupCode;
    private array $payload;
    private string $status;

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): Report
    {
        $this->status = $status;
        return $this;
    }
}
