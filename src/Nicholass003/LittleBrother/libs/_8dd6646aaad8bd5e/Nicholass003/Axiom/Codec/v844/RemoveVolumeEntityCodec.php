<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\RemoveVolumeEntityPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class RemoveVolumeEntityCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : RemoveVolumeEntityPacket{
        $pk = new RemoveVolumeEntityPacket();
        $pk->entityNetId = VarInt::readUnsignedInt($in);
        $pk->dimension = VarInt::readSignedInt($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof RemoveVolumeEntityPacket);
        VarInt::writeUnsignedInt($out, $pk->entityNetId);
        VarInt::writeSignedInt($out, $pk->dimension);
    }
}