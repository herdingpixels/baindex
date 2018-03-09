<?php
require_once 'BlockInterface.php';

abstract class Block implements BlockInterface
{
    private $iso;
    private $size;
    private $price;
    private $data = [];
    
    public function __construct(ISO $iso, EnergyPrice $price, PowerUnit $size)
    {
        $this->iso = $iso;
        $this->price = $price;
        $this->size = $size;
        $this->data['iso'] = $iso->name();
        $this->data['price'] = $price->components();
        $this->data['size'] = $size->components();
    }
    
    public function components()
    {
        return $this->data;
    }
    
    public function updateSize(PowerUnit $size): Block
    {
        $class = get_class($this);
        if (get_class($size) === get_class($this->size)) {
            return new $class($this->iso, $this->price, $size);
        }
        
        throw new Exception("You can't change MW->kW or kW->MW");      
    }
    
    public function updatePrice(EnergyPrice $price): Block
    {
        $class = get_class($this);
        if ($this->price->getPrice()['currency'] === $price->getPrice()['currency']) {
            return new $class($this->iso, $price, $this->size);
        }
        
        throw new Exception("You can't change dollars->cents or cents->dollars");    
    }
    
    public function updateISO(ISO $iso): Block
    {
        $class = get_class($this);
        return new $class($iso, $this->price, $this->size);
    }
    
}