<?php

class Megawatt extends PowerUnit
{   
    public function convertToKW(): Kilowatt
    {
        return new Kilowatt($this->size * 1000);
    }
}