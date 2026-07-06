<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\BlockPosition;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet\PlayerToggleCrafterSlotRequestPacket;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class PlayerToggleCrafterSlotRequestCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : PlayerToggleCrafterSlotRequestPacket{
        $pk = new PlayerToggleCrafterSlotRequestPacket();
        $x = LE::readSignedInt($in);
        $y = LE::readSignedInt($in);
        $z = LE::readSignedInt($in);
        $pk->position = new BlockPosition($x, $y, $z);
        $pk->slot = Byte::readUnsigned($in);
        $pk->disabled = CodecHelper::readBool($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof PlayerToggleCrafterSlotRequestPacket);
        LE::writeSignedInt($out, $pk->position->x);
        LE::writeSignedInt($out, $pk->position->y);
        LE::writeSignedInt($out, $pk->position->z);
        Byte::writeUnsigned($out, $pk->slot);
        CodecHelper::writeBool($out, $pk->disabled);
    }
}