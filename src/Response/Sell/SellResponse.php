<?php

namespace BusinessGazeta\AtolApi\Response\Sell;


use BusinessGazeta\AtolApi\Object\Response\Error;
use BusinessGazeta\AtolApi\Object\Response\Sell;
use BusinessGazeta\AtolApi\Response\AtolResponseInterface;

class SellResponse implements AtolResponseInterface
{
    private Sell $object;


    public function __construct() {
        $this->object = new Sell();
    }
    public function parseData(string $result): Sell
    {
        $data = json_decode($result, true);

        $this->object->setTimestamp(new \DateTime($data['timestamp']));
        if ($data['error']) {
            $error = new Error($data['error']['error_id'], $data['error']['code'], $data['error']['text'], new \DateTime($data['error']['timestamp']));
            $this->object->setError($error);
        } else {
            $this->object->setUuid($data['uuid']);
            $this->object->setStatus($data['status']);
        }
        return $this->object;
    }

    /**
     * @return Sell
     */
    public function getObject(): Sell
    {
        return $this->object;
    }

    /**
     * @param Sell $object
     * @return SellResponse
     */
    public function setObject(Sell $object): SellResponse
    {
        $this->object = $object;
        return $this;
    }


}
