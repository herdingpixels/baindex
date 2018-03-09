<?php

class Kilowatt extends PowerUnit
{   
    public function convertToMW(): Megawatt
    {
        return new Megawatt($this->size / 1000);
    }
}