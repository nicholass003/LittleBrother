<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\ClientCacheStatusPacket;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class ClientCacheStatusCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ClientCacheStatusPacket{
        $pk = new ClientCacheStatusPacket();
        $pk->enabled = CodecHelper::readBool($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ClientCacheStatusPacket);
        CodecHelper::writeBool($out, $pk->enabled);
    }
}