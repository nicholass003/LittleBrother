<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum\GameMode;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\UpdatePlayerGameTypePacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class UpdatePlayerGameTypeCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : UpdatePlayerGameTypePacket{
        $pk = new UpdatePlayerGameTypePacket();
        $pk->gameMode = GameMode::safe(VarInt::readSignedInt($in));
        $pk->playerActorUniqueId = CodecHelper::readActorUniqueId($in);
        $pk->tick = VarInt::readUnsignedLong($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof UpdatePlayerGameTypePacket);
        VarInt::writeSignedInt($out, $pk->gameMode->value);
        CodecHelper::writeActorUniqueId($out, $pk->playerActorUniqueId);
        VarInt::writeUnsignedLong($out, $pk->tick);
    }
}