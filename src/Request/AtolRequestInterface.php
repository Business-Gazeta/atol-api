<?php

namespace BusinessGazeta\AtolApi\Request;


interface AtolRequestInterface
{
    public function params(): array;
    public function uri(): string;
}
