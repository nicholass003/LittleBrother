<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\v975;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\PresenceConfig;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet\ServerPresenceInfoPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class ServerPresenceInfoCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ServerPresenceInfoPacket{
        $pk = new ServerPresenceInfoPacket();
        $pk->presenceConfig = CodecHelper::readOptional($in, $this->readPresenceConfig(...));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ServerPresenceInfoPacket);
        CodecHelper::writeOptional($out, $pk->presenceConfig, $this->writePresenceConfig(...));
    }

    protected function readPresenceConfig(ByteBufferReader $in) : PresenceConfig{
        $experienceName = CodecHelper::readString($in);
        $worldName = CodecHelper::readString($in);
        return new PresenceConfig($experienceName, $worldName);
    }

    protected function writePresenceConfig(ByteBufferWriter $out, PresenceConfig $data) : void{
        CodecHelper::writeString($out, $data->experienceName);
        CodecHelper::writeString($out, $data->worldName);
    }
}