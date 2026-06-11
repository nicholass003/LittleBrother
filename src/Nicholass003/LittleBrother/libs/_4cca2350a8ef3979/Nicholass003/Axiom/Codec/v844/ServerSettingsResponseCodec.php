<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet\ServerSettingsResponsePacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class ServerSettingsResponseCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ServerSettingsResponsePacket{
        $pk = new ServerSettingsResponsePacket();
        $pk->formId = VarInt::readUnsignedInt($in);
        $pk->formData = CodecHelper::readString($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ServerSettingsResponsePacket);
        VarInt::writeUnsignedInt($out, $pk->formId);
        CodecHelper::writeString($out, $pk->formData);
    }
}