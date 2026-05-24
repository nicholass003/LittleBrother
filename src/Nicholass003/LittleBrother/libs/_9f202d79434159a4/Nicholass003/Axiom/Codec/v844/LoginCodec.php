<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\LoginPacket;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Version\ProtocolVersion;
use pmmp\encoding\BE;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use function strlen;

class LoginCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : LoginPacket{
        $pk = new LoginPacket();
        $protocolVersion = ProtocolVersion::tryFrom(BE::readUnsignedInt($in));
        if(!$protocolVersion){
            throw new \InvalidArgumentException("Unsupported protocol");
        }
        $pk->protocol = $protocolVersion;
        $connRequest = CodecHelper::readString($in);
        $reader = new ByteBufferReader($connRequest);
        $authLen = LE::readUnsignedInt($reader);
        $pk->authInfoJson = $reader->readByteArray($authLen);
        $clientLen = LE::readUnsignedInt($reader);
        $pk->clientDataJwt = $reader->readByteArray($clientLen);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof LoginPacket);
        BE::writeUnsignedInt($out, $pk->protocol->value);
        $writer = new ByteBufferWriter();
        LE::writeUnsignedInt($writer, strlen($pk->authInfoJson));
        $writer->writeByteArray($pk->authInfoJson);
        LE::writeUnsignedInt($writer, strlen($pk->clientDataJwt));
        $writer->writeByteArray($pk->clientDataJwt);
        CodecHelper::writeString($out, $writer->getData());
    }
}