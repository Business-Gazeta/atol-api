<?php

namespace BusinessGazeta\AtolApi\Response;


interface AtolResponseInterface
{
    public function parseData(array $data): array;

}
