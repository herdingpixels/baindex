<?php

namespace spec;

use ISO;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ISOSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('ercot');
        $this->shouldHaveType(ISO::class);
    }
    
    function it_should_not_initialize_bad_iso() {
        $this->beConstructedWith("miso");
        $this->shouldThrow('\InvalidArgumentException')->duringInstantiation();
    }
  
  function it_should_return_string_of_ISO()
  {
      $this->beConstructedWith("ercot");
      $this->name()->shouldEqual('ERCOT');
  }
}
