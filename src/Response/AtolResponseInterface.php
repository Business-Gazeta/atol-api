<?php

namespace BusinessGazeta\AtolApi\Response;


use BusinessGazeta\AtolApi\Object\Response\AbstractResponseObject;

interface AtolResponseInterface
{
    public function parseData(string $result): AbstractResponseObject;

}
