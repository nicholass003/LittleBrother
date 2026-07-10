<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\TransferPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class TransferCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : TransferPacket{
        $pk = new TransferPacket();
        $pk->address = CodecHelper::readString($in);
        $pk->port = LE::readUnsignedShort($in);
        $pk->reloadWorld = CodecHelper::readBool($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof TransferPacket);
        CodecHelper::writeString($out, $pk->address);
        LE::writeUnsignedShort($out, $pk->port);
        CodecHelper::writeBool($out, $pk->reloadWorld);
    }
}