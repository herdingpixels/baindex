<?php

namespace spec;

use Megawatt;
use Kilowatt;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MegawattSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(1.5);
        $this->shouldHaveType(Megawatt::class);
    }
  
    function it_converts_to_kw()
    {
        $this->beConstructedWith(1.5);
        $expected = new Kilowatt(1500);
        $this->convertToKW()->equals($expected)->shouldBe(true);
    }
    
    function it_should_show_error_msg_on_negative_value()
    {
        $this->beConstructedWith(-100);
        $this->shouldThrow(new \InvalidArgumentException("Megawatt can't be negative"))->duringInstantiation();
    }
    
    function it_should_return_its_components()
    {
        $this->beConstructedWith(1.5);
        $this->components()['unit']->shouldEqual('Megawatt');
        $this->components()['size']->shouldEqual(1.5);
    }
        
 
}
