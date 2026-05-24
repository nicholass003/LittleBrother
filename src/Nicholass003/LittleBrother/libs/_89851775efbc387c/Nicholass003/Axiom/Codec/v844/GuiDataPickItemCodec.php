<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet\GuiDataPickItemPacket;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class GuiDataPickItemCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : GuiDataPickItemPacket{
        $pk = new GuiDataPickItemPacket();
        $pk->itemDescription = CodecHelper::readString($in);
        $pk->itemEffects = CodecHelper::readString($in);
        $pk->hotbarSlot = LE::readSignedInt($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof GuiDataPickItemPacket);
        CodecHelper::writeString($out, $pk->itemDescription);
        CodecHelper::writeString($out, $pk->itemEffects);
        LE::writeSignedInt($out, $pk->hotbarSlot);
    }
}