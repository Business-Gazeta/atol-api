<?php

namespace BusinessGazeta\AtolApi\Response\Sell;


use BusinessGazeta\AtolApi\Response\AtolResponseInterface;

class SellResponse implements AtolResponseInterface
{
    public function parseData(string $result): array
    {
        $data = json_decode($result, true);
        if ($data['error']) {
            throw new \Exception($data['error']['text']);
        }
        return ['uuid' => $data['uuid']];
    }
}
