<?php

namespace BusinessGazeta\AtolApi\Response;


interface AtolResponseInterface
{
    public function parseData(string $result): array;

}
