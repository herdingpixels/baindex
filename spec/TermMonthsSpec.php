<?php

namespace spec;

use TermMonths;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TermMonthsSpec extends ObjectBehavior
{
    
    function it_returns_term_length_in_months()
    {
        $this->beConstructedWith(24);
        $this->months()->shouldEqual(24);
    }
    
    function it_returns_term_length_in_years()
    {
        $this->beConstructedWith(36);
        $this->years()->shouldEqual(3.0);
    }
}
