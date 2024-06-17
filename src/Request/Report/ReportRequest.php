<?php

namespace BusinessGazeta\AtolApi\Request\Report;

use BusinessGazeta\AtolApi\Request\AbstractAtolRequest;
use BusinessGazeta\AtolApi\Response\Report\ReportResponse;

class ReportRequest extends AbstractAtolRequest
{

    private string $uuid;
    private string $groupCode;

    /**
     * @param string $uuid
     * @param string $groupCode
     */
    public function __construct(string $uuid, string $groupCode)
    {
        $this->uuid = $uuid;
        $this->groupCode = $groupCode;
    }


    public function params(): array
    {
        return [];
    }

    public function uri(): string
    {
        return sprintf('%s/report/%s', $this->groupCode, $this->uuid);
    }

    public function getResponseObject(): string
    {
        return ReportResponse::class;
    }
}
