<?php

namespace spec;

use Kilowatt;
use Megawatt;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class KilowattSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(1500);
        $this->shouldHaveType(Kilowatt::class);
    }
  
    function it_converts_to_mw()
    {
        $this->beConstructedWith(1500);
        $expected = new Megawatt(1.5);
        $this->convertToMW()->equals($expected)->shouldBe(true);
    }
  
    function it_should_not_initialize_with_negative_value()
    {
          $this->beConstructedWith(-100);
          $this->shouldThrow('\InvalidArgumentException')->duringInstantiation();
    }
    
}
