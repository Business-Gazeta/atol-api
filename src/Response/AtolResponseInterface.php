<?php

namespace BusinessGazeta\AtolApi\Response;

use BusinessGazeta\AtolApi\Object\Response\AtolResponseObjectInterface;

interface AtolResponseInterface
{
    public function parseData(string $result): AtolResponseObjectInterface;

}
