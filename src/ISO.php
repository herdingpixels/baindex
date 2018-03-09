<?php
require_once 'helpers.php';

class ISO
{
    private $iso_str;
    private $iso_list = ['ERCOT', 'CAISO', 'PJM'];
    
    public function __construct($iso_str)
    {
        // TODO: write logic here
        if (in_array(clean_string_upper($iso_str), $this->iso_list)) {
            $this->iso_str = clean_string_upper($iso_str);
        } else {
            throw new InvalidArgumentException("{$iso_str} not found");
        }
    }
    
    public function name()
    {
        return strtoupper($this->iso_str);
    }
}
