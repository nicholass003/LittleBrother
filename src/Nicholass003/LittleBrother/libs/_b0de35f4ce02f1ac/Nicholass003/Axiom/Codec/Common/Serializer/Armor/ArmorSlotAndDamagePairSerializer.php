<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Common\Serializer\Armor;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Armor\ArmorSlotAndDamagePair;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Enum\ArmorSlot;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class ArmorSlotAndDamagePairSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : ArmorSlotAndDamagePair{
        $slot = ArmorSlot::safe(Byte::readUnsigned($in));
        $damage = LE::readUnsignedShort($in);
        return new ArmorSlotAndDamagePair($slot, $damage);
    }

    public function write(ByteBufferWriter $out, ArmorSlotAndDamagePair $pair) : void{
        Byte::writeUnsigned($out, $pair->slot->value);
        LE::writeUnsignedShort($out, $pair->damage);
    }
}