<?php

interface ContractInterface
{
    public function addBlock();
    public function changeTermMonths(): ContractInterface;
    public function changeStartDate(): ContractInterface;
    
    // possibly something about the block collection
}

// class Contract implements ContractInterface
// {
//     private $startDate;
//     private $termMonths;
//     private $contractList;
// }

interface BlockListInterface
{
    public function getBlock(): BlockInterface;
    public function removeBlock(BlockInterface $blockToRemove);
    public function addBlock(BlockInterface $block);
}