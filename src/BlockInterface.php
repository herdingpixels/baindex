<?php
require_once 'ISO.php';
//require_once 'Kilowatt.php';
//require_once 'Megawatt.php';
require_once 'PowerUnit.php';
require_once 'EnergyPrice.php';

interface BlockInterface{
    public function components();
    public function updateSize(PowerUnit $size): Block;
    public function updatePrice(EnergyPrice $price): Block;
    public function updateISO(ISO $iso): Block;
}