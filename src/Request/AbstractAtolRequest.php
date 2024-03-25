<?php

namespace BusinessGazeta\AtolApi\Request;

use BusinessGazeta\AtolApi\Response\AtolResponseInterface;

abstract class AbstractAtolRequest implements AtolRequestInterface
{

    private string $uri = '';
    private AtolResponseInterface $response;

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

    /**
     * @return AtolResponseInterface
     */
    public function getResponse(): AtolResponseInterface
    {
        return $this->response;
    }

    /**
     * @param AtolResponseInterface $response
     */
    public function setResponse(AtolResponseInterface $response): void
    {
        $this->response = $response;
    }

}
