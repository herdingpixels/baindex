<?php

namespace spec;

use _7X8;
use Megawatt;
use ISO;
use EnergyPrice;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class _7X8Spec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $size = new Megawatt(1.5);
        $price = new EnergyPrice(54.50, 'dollars', 'MWh');
        $iso = new ISO("ercot");
        
        $this->beConstructedWith($iso, $price, $size);
        
        $this->shouldHaveType(_7X8::class);
    }
}