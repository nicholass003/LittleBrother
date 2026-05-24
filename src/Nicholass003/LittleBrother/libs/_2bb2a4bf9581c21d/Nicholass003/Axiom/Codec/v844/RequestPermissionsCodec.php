<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\PlayerPermissions;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet\RequestPermissionsPacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class RequestPermissionsCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : RequestPermissionsPacket{
        $pk = new RequestPermissionsPacket();
        $pk->targetActorUniqueId = LE::readSignedLong($in);
        $pk->playerPermission = PlayerPermissions::safe(VarInt::readSignedInt($in));
        $pk->customFlags = LE::readUnsignedShort($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof RequestPermissionsPacket);
        LE::writeSignedLong($out, $pk->targetActorUniqueId);
        VarInt::writeSignedInt($out, $pk->playerPermission->value);
        LE::writeUnsignedShort($out, $pk->customFlags);
    }
}