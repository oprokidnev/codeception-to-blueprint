<?php declare(strict_types=1);

namespace Oprokidnev\CodeceptToBlueprint\Blueprint\Call\Request;


class Header
{
    protected $name;
    protected $value;

    /**
     * Header constructor.
     *
     * @param $name
     * @param $value
     */
    public function __construct(string $name, string $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Header
     */
    public function setName(string $name): Header
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return Header
     */
    public function setValue(string $value): Header
    {
        $this->value = $value;

        return $this;
    }


}