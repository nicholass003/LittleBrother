<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\BlockPickRequestPacket;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class BlockPickRequestCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : BlockPickRequestPacket{
        $pk = new BlockPickRequestPacket();
        $pk->blockPosition = CodecHelper::readSignedBlockPosition($in);
        $pk->addUserData = CodecHelper::readBool($in);
        $pk->hotbarSlot = Byte::readUnsigned($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof BlockPickRequestPacket);
        CodecHelper::writeSignedBlockPosition($out, $pk->blockPosition);
        CodecHelper::writeBool($out, $pk->addUserData);
        Byte::writeUnsigned($out, $pk->hotbarSlot);
    }
}