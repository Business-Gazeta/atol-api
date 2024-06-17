<?php

namespace BusinessGazeta\AtolApi\Request;

use BusinessGazeta\AtolApi\Response\AtolResponseInterface;

abstract class AbstractAtolRequest implements AtolRequestInterface
{
    abstract public function params(): array;
    abstract public function uri(): string;

    abstract public function getResponseObject(): string;
}
