<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Common;

final class BitSet{

    private const INT_BITS = PHP_INT_SIZE * 8;

    /**
     * @param list<int> $parts
     */
    public function __construct(
        public readonly int $length,
        private array $parts
    ){}

    public function get(int $index) : bool{
        if($index < 0 || $index >= $this->length){
            return false;
        }
        $partIndex = intdiv($index, self::INT_BITS);
        $bitIndex = $index % self::INT_BITS;

        return (($this->parts[$partIndex] ?? 0) & (1 << $bitIndex)) !== 0;
    }

    public function has(int $flag) : bool{
        return $this->get($flag);
    }

    public function with(int $index, bool $value) : self{
        $parts = $this->parts;
        $partIndex = intdiv($index, self::INT_BITS);
        $bitIndex = $index % self::INT_BITS;
        if($value){
            $parts[$partIndex] = ($parts[$partIndex] ?? 0) | (1 << $bitIndex);
        }else{
            $parts[$partIndex] = ($parts[$partIndex] ?? 0) & ~(1 << $bitIndex);
        }

        return new self($this->length, $parts);
    }

    public function withFlag(int $flag, bool $value) : self{
        return $this->with($flag, $value);
    }

    /**
     * @return list<int>
     */
    public function getParts() : array{
        return $this->parts;
    }
}