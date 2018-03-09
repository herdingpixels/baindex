<?php

namespace spec;

use EnergyPrice;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EnergyPriceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(54.50, 'dollars', 'MWh');
        $this->shouldHaveType(EnergyPrice::class);
    }
    
    function it_should_not_be_initializable_with_bad_price()
    {
        $this->beConstructedWith(-4, 'dollars', 'MWh');
        $this->shouldThrow(new \InvalidArgumentException("Price must be greater than zero"))->duringInstantiation();
    }
    
    function it_should_not_be_initializable_with_bad_currency()
    {
        $this->beConstructedWith(4, 'euros', 'MWh');
        $this->shouldThrow(new \InvalidArgumentException("Currency must be dollars or cents"))->duringInstantiation();
    }
    
    function it_should_not_be_initializable_with_bad_energy_unit()
    {
        $this->beConstructedWith(4, 'dollars', 'joules');
        $this->shouldThrow(new \InvalidArgumentException("Energy must be kWh, or MWh"))->duringInstantiation();
    }
    
    function it_should_display_data_in_array()
    {
        $this->beConstructedWith(54.50, 'dollars', 'MWh');
        $this->components()->shouldHaveKeyWithValue('currency', 'dollars');
        
    }

}
