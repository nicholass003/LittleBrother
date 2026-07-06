<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\v944;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\BlockActorDataPacket;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class BlockActorDataCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : BlockActorDataPacket{
        $pk = new BlockActorDataPacket();
        $pk->blockPosition = CodecHelper::readSignedBlockPosition($in);
        $pk->nbtData = CodecHelper::readNbt($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof BlockActorDataPacket);
        CodecHelper::writeSignedBlockPosition($out, $pk->blockPosition);
        CodecHelper::writeNbt($out, $pk->nbtData);
    }
}