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

    public function addChild( $node) : array ;
    
}


