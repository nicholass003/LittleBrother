<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Common\Serializer;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Common\Serializer\Armor\ArmorSlotAndDamagePairSerializer;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Support\ForkableInterface;

class ArmorSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private ArmorSlotAndDamagePairSerializer $slotAndDamagePairSerializer
    ){}

    public function slotAndDamagePair() : ArmorSlotAndDamagePairSerializer{
        return $this->slotAndDamagePairSerializer;
    }

    public function withSlotAndDamagePair(ArmorSlotAndDamagePairSerializer $v) : self{ return $this->with('slotAndDamagePairSerializer', $v); }
}