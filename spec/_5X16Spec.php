<?php

namespace spec;

use _5X16;
use Megawatt;
use ISO;
use EnergyPrice;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class _5X16Spec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $size = new Megawatt(1.5);
        $price = new EnergyPrice(54.50, 'dollars', 'MWh');
        $iso = new ISO("ercot");
        
        $this->beConstructedWith($iso, $price, $size);
        
        $this->shouldHaveType(_5X16::class);
    }
}
