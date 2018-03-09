<?php

class TermMonths
{
    private $amount;
    
    public function __construct(int $months)
    {
        $this->amount = $months;
    }
   

    public function months(): int
    {
        return $this->amount;
    }
    
    public function years(): float
    {
        return $this->amount / 12;
    }
}
