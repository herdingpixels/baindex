<?php

namespace spec;

use BlockList;
use BlockFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Megawatt;
use EnergyPrice;
use ISO;

class BlockListSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BlockList::class);
    }
    
    function it_counts()
    {
        $this->count()->shouldEqual(0);
    }
    
    function it_adds_block()
    {
        $factory = new BlockFactory();
        $block = $factory->createBlockWithDollarsAndMW(
            "5X16",
            new Megawatt(1.5), 
            new EnergyPrice(61.50, 'dollars', 'MWh'),
            new ISO('ercot')
        );
        $this->addBlock($block);
        $this->count()->shouldEqual(1);   
    }
    
    function it_throws_exception_if_block_type_already_there()
    {
        $factory = new BlockFactory();
        $block1 = $factory->createBlockWithDollarsAndMW(
            "5X16",
            new Megawatt(1.5), 
            new EnergyPrice(61.50, 'dollars', 'MWh'),
            new ISO('ercot')
        );
        $block2 = $factory->createBlockWithDollarsAndMW(
            "5X16",
            new Megawatt(1.5), 
            new EnergyPrice(61.50, 'dollars', 'MWh'),
            new ISO('ercot')
        );
        $this->addBlock($block1);
        $this->shouldThrow('\Exception')->during('addBlock', [$block2]);        
    }
    
    function it_adds_two_blocks()
    {
        $factory = new BlockFactory();
        $block1 = $factory->createBlockWithDollarsAndMW(
            '5X16',
            new Megawatt(1.5), 
            new EnergyPrice(61.50, 'dollars', 'MWh'),
            new ISO('ercot')
        );
        $block2 = $factory->createBlockWithDollarsAndMW(
            '2X16',
            new Megawatt(1.5), 
            new EnergyPrice(61.50, 'dollars', 'MWh'),
            new ISO('ercot')
        );       
        $this->addBlock($block1);
        $this->addBlock($block2);
        $this->count()->shouldEqual(2);  
    }
    
    function it_throws_exception_if_7X24_block_type_already_there()
    {
        $factory = new BlockFactory();
        
        $block1 = $factory->createBlockWithDollarsAndMW(
           '7X24',
            new Megawatt(1.5), 
            new EnergyPrice(61.50, 'dollars', 'MWh'),
            new ISO('ercot')
        );
        $block2 = $factory->createBlockWithDollarsAndMW(
            '5X16',
            new Megawatt(1.5), 
            new EnergyPrice(61.50, 'dollars', 'MWh'),
            new ISO('ercot')
        );
        $this->addBlock($block1);
        $this->shouldThrow('\Exception')->during('addBlock', [$block2]);        
    }
    
    function it_throws_exception_if_7X24_is_added_to_non_empty_list()
    {
        $factory = new BlockFactory();

        $block1 = $factory->createBlockWithDollarsAndMW(
            '2X16',
            new Megawatt(1.5), 
            new EnergyPrice(61.50, 'dollars', 'MWh'),
            new ISO('ercot')
        );
        $block2 = $factory->createBlockWithDollarsAndMW(
            '7X24',
            new Megawatt(1.5), 
            new EnergyPrice(61.50, 'dollars', 'MWh'),
            new ISO('ercot')
        );
        $this->addBlock($block1);
        $this->shouldThrow('\Exception')->during('addBlock', [$block2]);       
    }
}
