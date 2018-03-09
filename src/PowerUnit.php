<?php

abstract class PowerUnit
{
    protected $size;
    
    public function __construct(float $size)
    {
        if ($size < 0) {
            throw new InvalidArgumentException(get_class($this) . " can't be negative");
        } else {
            $this->size = $size;
        }
    }
    
    public function size(): float
    {
        return $this->size;
    }
    
    public function components()
    {
        return ['size' => $this->size, 'unit' => get_class($this)];
    }
    
    public function equals(PowerUnit $powerUnit)
    {
        return $this->components() === $powerUnit->components();
    }
    
}
