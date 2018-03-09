<?php

class Contract
{
    private $data = [];
    
    public function __construct(TermMonths $termMonths, DateTime $startDate, BlockList $blockList)
    {
        $this->data['termMonths'] = $termMonths;
        $this->data['startDate'] = $startDate;
        $this->data['blockList'] = $blockList;
    }
    
    public function data(): array
    {
        return $this->data;
    }

    public function addBlock(Block $block)
    {
        $this->data['blockList']->addBlock($block);
    }

    public function updateStartDate(DateTime $newDate): Contract
    {
        return new Contract($this->data['termMonths'],$newDate,$this->data['blockList']);
    }

    public function updateTermsMonth(TermMonths $newTermMonths): Contract
    {
        return new Contract($newTermMonths, $this->data['startDate'], $this->data['blockList']);
    }
    
}
