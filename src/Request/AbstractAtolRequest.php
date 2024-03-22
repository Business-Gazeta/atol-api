<?php

namespace BusinessGazeta\AtolApi\Request;

abstract class AbstractAtolRequest implements AtolRequestInterface
{

    private string $uri = '';

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     */
    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }
//
//    public function params(): array
//    {
//        $class = explode('\\', get_class($this));
//        $action_object = array_pop($class);
//        $action = array_pop($class);
//        $object = array_pop($class);
//        $data = [
//            'encoding' => 'UTF-8',
//            'limit' => $this->getLimit(),
//            'offset' => $this->getOffset()
//        ];
//        if ($object === 'Request') {
//            $object = $action;
//            $action = lcfirst($action_object);
//        } else {
//            $data = array_merge($data, ['actionObject' => lcfirst($action_object)]);
//        }
//        return array_merge($data, [
//            'object' => $object,
//            'action' => $action,
//        ]);
////        return [
////            'object' => $object,
////            'action' => $action,
////            'actionObject' => lcfirst($action_object),
////            'encoding' => 'UTF-8',
////            'limit' => $this->getLimit(),
////            'offset' => $this->getOffset()
////        ];
//    }
//
//    public function mergeParams(array $params, $param, string $name): array
//    {
//        if (!is_null($param)) {
//            return array_merge($params, [$name => $param]);
//        }
//        return $params;
//    }

}
