<?php declare(strict_types=1);

namespace Oprokidnev\CodeceptToBlueprint\Blueprint\Call;


class Response
{
    /**
     * @var string
     */
    protected $body;

    /**
     * @var string|null
     */
    protected $schema;

    /**
     * @var int|null
     */
    protected $status = 200;

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * Request constructor.
     *
     * @param string $body
     */
    public function __construct(?string $body, ?int $status = 200, ?string $schema = null)
    {
        $this->body = $body;
        $this->status = $status;
        $this->schema = $schema;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return Request
     */
    public function setBody(string $body): Request
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getSchema(): ?string
    {
        return $this->schema;
    }

    /**
     * @param null|string $schema
     * @return Response
     */
    public function setSchema(?string $schema): Response
    {
        $this->schema = $schema;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int|null $status
     */
    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;

        return $this;
    }


}
