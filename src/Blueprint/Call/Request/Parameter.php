<?php declare(strict_types=1);

namespace Oprokidnev\CodeceptToBlueprint\Blueprint\Call\Request;

class Parameter
{
    /**
     * @var bool
     */
    protected $required = false;

    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var string|null
     */
    protected $type;

    /**
     * @var string|null
     */
    protected $description;

    /**
     * Parameter constructor.
     *
     * @param bool $required
     * @param null|string $name
     * @param null|string $type
     * @param null|string $description
     */
    public function __construct(bool $required, ?string $name, ?string $type, ?string $description)
    {
        $this->required = $required;
        $this->name = $name;
        $this->type = $type;
        $this->description = $description;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * @param bool $required
     */
    public function setRequired(bool $required): void
    {
        $this->required = $required;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return null|string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param null|string $type
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }


}