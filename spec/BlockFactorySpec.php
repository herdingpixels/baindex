<?php

namespace spec;

use BlockFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use ISO;
use Megawatt;
use Kilowatt;
use EnergyPrice;

class BlockFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BlockFactory::class);
    }
    
    function it_creates_a_5X16_block()
    {
        $iso = new ISO('ercot');
        $size = new Megawatt(1.5);
        $price = new EnergyPrice(61.50, 'dollars', 'MWh');
        $this->createBlockWithDollarsAndMW("5X16", $size, $price,$iso)->shouldReturnAnInstanceOf('_5X16');
    }
    
    function it_creates_a_2X16_block()
    {
        $iso = new ISO('ercot');
        $size = new Megawatt(1.5);
        $price = new EnergyPrice(61.50, 'dollars', 'MWh');
        $this->createBlockWithDollarsAndMW("2X16", $size, $price,$iso)->shouldReturnAnInstanceOf('_2X16');
    } 
    
    function it_creates_a_7X8_block()
    {
        $iso = new ISO('ercot');
        $size = new Megawatt(1.5);
        $price = new EnergyPrice(61.50, 'dollars', 'MWh');
        $this->createBlockWithDollarsAndMW("7X8", $size, $price,$iso)->shouldReturnAnInstanceOf('_7X8');
    }
    
    function it_creates_a_7X24_block()
    {
        $iso = new ISO('ercot');
        $size = new Megawatt(1.5);
        $price = new EnergyPrice(61.50, 'dollars', 'MWh');
        $this->createBlockWithDollarsAndMW("7X24", $size, $price,$iso)->shouldReturnAnInstanceOf('_7X24');
    }
    
    function it_throws_exception_for_invalid_block()
    {
        $iso = new ISO('ercot');
        $size = new Megawatt(1.5);
        $price = new EnergyPrice(61.50, 'dollars', 'MWh');
        $this->shouldThrow(new \Exception("block type not found"))->during('createBlockWithDollarsAndMW', ["7X25", $size, $price,$iso]);
    }     
    
    function it_creates_a_block_from_dollars_and_kw()
    {
        $iso = new ISO('ercot');
        $size = new Kilowatt(2000);
        $price = new EnergyPrice(0.06150, 'dollars', 'kWh');
        $this->createBlockWithDollarsAndKW("5X16", $size, $price,$iso)->shouldReturnAnInstanceOf('_5X16');       
    }
    
    function it_creates_a_block_from_cents_and_kw()
    {
        $iso = new ISO('ercot');
        $size = new Kilowatt(2000);
        $price = new EnergyPrice(6.15, 'cents', 'kWh');
        $this->createBlockWithCentsAndKW("5X16", $size, $price,$iso)->shouldReturnAnInstanceOf('_5X16');     
    }    
    
    function it_throws_exception_if_incompatible_size_and_price()
    {
        $iso = new ISO('PJM');
        $size = new Kilowatt(2000);
        $price = new EnergyPrice(44.75, 'dollars', 'MWh');
        $this->shouldThrow(new \Exception("Incompatible power unit and price"))->during('createBlockWithDollarsAndKW', ["5X16", $size, $price, $iso]);
    }
}
