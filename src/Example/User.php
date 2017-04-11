<?php

namespace d0niek\GenericCollection\Example;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
class User
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    #region Getters & Setters

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    #endregion Getters & Setters
}
