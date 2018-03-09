<?php
require_once 'ISO.php';
require_once 'Kilowatt.php';
require_once 'Megawatt.php';
require_once '_5X16.php';
require_once '_2X16.php';
require_once '_7X8.php';
require_once '_7X24.php';

class BlockFactory
{
    private $className;
    
    private function create(string $blockType, PowerUnit $powerUnit, EnergyPrice $price, ISO $iso)
    {
        // if units don't match throw exception
        if (['Kilowatt' => 'kWh', 'Megawatt' => 'MWh'][get_class($powerUnit)] !== $price->components()['unit']) {
            throw new Exception('Incompatible power unit and price');  
        }        
        // if blocktype not found throw exception
        if (!class_exists("_" . $blockType)){
            throw new Exception('block type not found');
        }
        
        $blockType = "_" . $blockType;
        
        return new $blockType($iso, $price, $powerUnit);
    }
          
    public function createBlockWithDollarsAndMW(string $blockType, Megawatt $size, EnergyPrice $price, ISO $iso): BlockInterface
    {
        return $this->create($blockType, $size, $price, $iso);
    }
    
    public function createBlockWithDollarsAndKW(string $blockType, Kilowatt $size, EnergyPrice $price, ISO $iso): BlockInterface
    {
         return $this->create($blockType, $size, $price, $iso);
    }
    
    public function createBlockWithCentsAndKW(string $blockType, Kilowatt $size, EnergyPrice $price, ISO $iso): BlockInterface
    {
         return $this->create($blockType, $size, $price, $iso);
    }    
  
}
