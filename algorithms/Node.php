<?php


class Node implements NodeInterface
{
    /** string $element */
    public $element;

    /** string $parent */
    public $parent;

    /** array $parent */
    public $array = [];

    public function __construct(string $element)
    {
        $this->parent = $element;
        $this->element = $element;
        $this->array[$element];

        $this->addChild($this->element);

        //print_r($this->array);
    }

    public function __toString(): string
    {
        return $this->parent;
    }

    /** Результат*/
    public function getName(): string
    {
        return $this->parent;
    }

    /**
     * @return Node[]
     */
    public function getChildren(): array
    {

        return [1,2,3,4];
    }

    /**
     * @return $this
     */

    //Если оставить Node в аргументах и тип вывода self, то выводит ошибку.

    public function addChild($element) : array
    {

        $this->array[$this->parent][] = $element;

        print_r($this->array);

        return $this->array;
    }
}