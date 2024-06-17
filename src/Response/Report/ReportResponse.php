<?php

namespace BusinessGazeta\AtolApi\Response\Report;

use BusinessGazeta\AtolApi\Object\Response\AtolResponseObjectInterface;
use BusinessGazeta\AtolApi\Object\Response\Error;
use BusinessGazeta\AtolApi\Object\Response\Report;
use BusinessGazeta\AtolApi\Response\AtolResponseInterface;

class ReportResponse implements AtolResponseInterface
{
    public function parseData(string $result): AtolResponseObjectInterface
    {
        try {
            $data = json_decode($result, true, 8, JSON_THROW_ON_ERROR);

            $report = new Report();

            if (isset($data['error'])) {
                $report->setError(
                    new Error(
                        $data['error']['error_id'],
                        $data['error']['code'],
                        $data['error']['text'],
                        new \DateTime($data['error']['timestamp'])
                    )
                );
            } else {
                $report->setTimestamp(new \DateTime($data['timestamp']))
                    ->setStatus($data['status']);
            }

            return $report;
        } catch (\Exception $exception) {
            throw new \Exception(
                sprintf(
                    '%s, error response: %s',
                    $exception->getMessage(),
                    $result
                )
            );
        }
    }
}
