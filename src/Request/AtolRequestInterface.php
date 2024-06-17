<?php

namespace BusinessGazeta\AtolApi\Request;

use BusinessGazeta\AtolApi\Response\AtolResponseInterface;

interface AtolRequestInterface
{
    public function params(): array;
    public function uri(): string;
    public function getResponseObject(): string;
}
