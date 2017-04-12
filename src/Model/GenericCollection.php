<?php

namespace d0niek\GenericCollection\Model;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
class GenericCollection implements \JsonSerializable
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $namespace;

    /**
     * @var string
     */
    private $class;

    /**
     * @var string
     */
    private $use;

    /**
     * @param string $type
     * @param string $namespace
     * @param string $class
     * @param string $use
     */
    public function __construct(string $type, string $namespace, string $class = '', string $use = '')
    {
        $this->type = str_replace('/', '\\', $type);
        $this->namespace = str_replace('/', '\\', $namespace);
        $this->class = str_replace('/', '\\', $class);
        $this->use = str_replace('/', '\\', $use);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [
            'type' => $this->type,
            'namespace' => $this->namespace,
            'class' => $this->class,
            'use' => $this->use,
        ];
        return $array;
    }

    /**
     * Compare object with other GenericCollection
     *
     * @param \d0niek\GenericCollection\Model\GenericCollection $genericCollection
     *
     * @return int
     */
    public function compare(GenericCollection $genericCollection): int
    {
        $getters = ['getType', 'getNamespace', 'getClass', 'getUse'];
        foreach ($getters as $getter) {
            $result = $this->$getter() <=> $genericCollection->$getter();
            if ($result !== 0) {
                return $result;
            }
        }

        return 0;
    }

    #region Getter & Setter

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * @param string $namespace
     */
    public function setNamespace(string $namespace): void
    {
        $this->namespace = $namespace;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @param string $class
     */
    public function setClass(string $class): void
    {
        $this->class = $class;
    }

    /**
     * @return string
     */
    public function getUse(): string
    {
        return $this->use;
    }

    /**
     * @param string $use
     */
    public function setUse(string $use): void
    {
        $this->use = $use;
    }

    #endregion Getter & Setter
}
