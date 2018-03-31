<?php declare(strict_types=1);

namespace Oprokidnev\CodeceptToBlueprint\Blueprint\Call;


use Oprokidnev\CodeceptToBlueprint\Blueprint\Call\Request\Parameter;

class Request
{
    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $uri;

    /**
     * @var Request\Parameter[]
     */
    protected $parameters;
    /**
     * @var Request\Header[]
     */
    protected $headers;

    /**
     * @var string|null
     */
    protected $body;

    /**
     * Request constructor.
     *
     * @param string $uri
     */
    public function __construct(string $uri, string $method)
    {
        $this->uri = $uri;
        $this->method = $method;
    }


    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return Request
     */
    public function setMethod(string $method): Request
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     * @return Request
     */
    public function setUri(string $uri): Request
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * @return Request\Parameter[]
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @param Request\Parameter[] $parameters
     * @return Request
     */
    public function setParameters(array $parameters): Request
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * @return Request\Header[]
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param Request\Header[] $headers
     * @return Request
     */
    public function setHeaders(array $headers): Request
    {
        $this->headers = $headers;

        return $this;
    }

    public function addParameter(Parameter $parameter)
    {
        $this->parameters[] = $parameter;

        return $this;
    }

}