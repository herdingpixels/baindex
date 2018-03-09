<?php

namespace spec;

use Contract;
use TermMonths;
use BlockList;
use BlockFactory;
use ISO;
use Megawatt;
use Kilowatt;
use EnergyPrice;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ContractSpec extends ObjectBehavior
{
    function let(BlockList $blockList)
    {
        $date = new \DateTime();
        $date->setDate(2001, 2, 3);
        $this->beConstructedWith(new TermMonths(24), $date, $blockList);
        
    }
    
    function it_is_initializable()
    {
        $this->shouldHaveType(Contract::class);
    }
    
    function it_adds_a_block()
    {
        $date = new \DateTime();
        $date->setDate(2001, 2, 3);
        $iso = new ISO('ercot');
        $size = new Megawatt(1.5);
        $price = new EnergyPrice(61.50, 'dollars', 'MWh');
        $factory = new BlockFactory();
        
        $this->beConstructedWith(new TermMonths(24), $date, new BlockList);
        
        $block = $factory->createBlockWithDollarsAndMW("2X16", $size, $price, $iso);
        $this->addBlock($block);
        $this->data()['blockList']->count()->shouldEqual(1);
    }
    
    function it_returns_new_contract_on_date_change()
    {
        $date = new \DateTime();
        $date->setDate(2001, 2, 3);
        
        $newDate = new \DateTime();
        $newDate->setDate(2001, 3, 3);
        
        $this->beConstructedWith(new TermMonths(24), $date, new BlockList);
        $newContract = $this->updateStartDate($newDate);
        $newContract->shouldReturnAnInstanceOf('Contract');
        $newContract->data()['startDate']->shouldEqual($newDate);
    }
    
    function it_returns_new_contract_on_term_change()
    {
        $date = new \DateTime();
        $date->setDate(2001, 2, 3);
        $newTermMonths = new TermMonths(12);
        
        $this->beConstructedWith(new TermMonths(24), $date, new BlockList);
        
        $newContract = $this->updateTermsMonth($newTermMonths);
        $newContract->shouldReturnAnInstanceOf('Contract');
        $newContract->data()['termMonths']->shouldEqual($newTermMonths);
    }
}
