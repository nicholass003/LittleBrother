<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Common\Serializer;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Common\Serializer\Enchant\EnchantOptionSerializer;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Support\ForkableInterface;

class EnchantmentSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private EnchantOptionSerializer $optionSerializer
    ){}

    public function option() : EnchantOptionSerializer{ return $this->optionSerializer; }

    public function withOption(EnchantOptionSerializer $v) : self{ return $this->with('optionSerializer', $v); }
}