<?php

class BlockList
{
    private $blocks = [];
    public function count(): int
    {
        return count($this->blocks);
    }

    public function addBlock(BlockInterface $blockToAdd)
    {
        if ($this->count() > 0 && $this->isBlockTypePresent($blockToAdd)) {
            throw new Exception('This block type already exists');
        }
        
        if ($this->count() > 0 && $this->isATCBlockTypePresent()) {
            throw new Exception('A 7X24 block type already exists');
        }
        
        if ($this->count() > 0 && get_class($blockToAdd) === "_7X24") {
            throw new Exception("Can't add an ATC block to non-empty block list");
        }
        
        $this->blocks[] = $blockToAdd;
    }
    
    // TODO? public function removeBlock(BlockInterface $blockToRemove);
    
    private function mapToStrings(): array
    {
        $callBack = function($value) {
            return get_class($value);
        };
        $blocksToClassNames = array_map($callBack, $this->blocks);
        
        return $blocksToClassNames;
    }
    
    
    private function isBlockTypePresent(BlockInterface $block): bool
    {
        $classStr = get_class($block);       
       
        return in_array($classStr, $this->mapToStrings());
    }
    
    private function isATCBlockTypePresent(): bool
    {     
        return in_array("_7X24", $this->mapToStrings());
    }
}