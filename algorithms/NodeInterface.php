<?php

interface NodeInterface
{

    public function __construct(string $element);

    public function __toString(): string;
    
    public function getName(): string;

    /**
     * @return Node[]
     */
    public function getChildren(): array;

    public function addChild(Node $node): self;
    
}


class Node implements NodeInterface
{
    /** string $element */
    public $element;

    /** string $parent */
    public $parent;

    public function __construct(string $element)
    {

    }

    public function __toString(): string
    {

    }

    public function getName(): string
    {

    }

    /**
     * @return Node[]
     */
    public function getChildren(): array
    {

    }

    public function addChild(Node $element): self
    {

    }
}