<?php
require_once 'helpers.php';

class EnergyPrice
{
    private $amount;
    private $currency;
    private $energyUnit;
    private $errorMsg;
    
    public function __construct(float $amount, string $currency, string $energyUnit)
    {
        if ($this->isPriceValid($amount)) {
            $this->amount = $amount;
        } else {
            throw new InvalidArgumentException($this->errorMsg);
        }
        
        if ($this->isCurrencyValid($currency)) {
            $this->currency = $currency;
        } else {
            throw new InvalidArgumentException($this->errorMsg);
        }
        
        if ($this->isEnergyUnitValid($energyUnit)) {
            $this->energyUnit = $energyUnit;
        } else {
            throw new InvalidArgumentException($this->errorMsg);
        }
    }
    
    private function isPriceValid(float $amount): bool
    {
        if ($amount > 0) {
            return true;
        }
        
        $this->errorMsg = 'Price must be greater than zero';
        return false;
    }
    
    private function isCurrencyValid(string $currency): bool
    {
        
        if (in_array(clean_string_lower($currency), ['dollars', 'cents'])) {
            return true;
        }
        
        $this->errorMsg = 'Currency must be dollars or cents';
        return false;       
    }
    
    private function isEnergyUnitValid(string $energyUnit): bool
    {
        
        if (in_array(clean_string_lower($energyUnit), ['mwh', 'kwh'])) {
            return true;
        }
        
        $this->errorMsg = 'Energy must be kWh, or MWh';
        return false;       
    }
    
    public function components()
    {
        return ['amount' => $this->amount, 'currency' => $this->currency, 'unit' => $this->energyUnit];
    }
}