<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\UpdateBlockPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class UpdateBlockCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : UpdateBlockPacket{
        $pk = new UpdateBlockPacket();
        $pk->blockPosition = CodecHelper::readBlockPosition($in);
        $pk->blockRuntimeId = VarInt::readUnsignedInt($in);
        $pk->flags = VarInt::readUnsignedInt($in);
        $pk->dataLayerId = VarInt::readUnsignedInt($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof UpdateBlockPacket);
        CodecHelper::writeBlockPosition($out, $pk->blockPosition);
        VarInt::writeUnsignedInt($out, $pk->blockRuntimeId);
        VarInt::writeUnsignedInt($out, $pk->flags);
        VarInt::writeUnsignedInt($out, $pk->dataLayerId);
    }
}