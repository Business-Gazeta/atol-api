<?php

namespace BusinessGazeta\AtolApi\Object;

abstract class AbstractObject
{
    public function mergeParams(array $params, $param, string $name): array
    {
        if (!is_null($param)) {
            return array_merge($params, [$name => $param]);
        }
        return $params;
    }
}
