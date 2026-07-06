<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\v975;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum\EntityIds;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum\LevelSoundType;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\LevelSoundEventPacket;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class LevelSoundEventCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : LevelSoundEventPacket{
        $pk = new LevelSoundEventPacket();
        $pk->sound = LevelSoundType::safe(VarInt::readUnsignedInt($in));
        $pk->position = CodecHelper::readVec3($in);
        $pk->extraData = VarInt::readSignedInt($in);
        $pk->entityType = EntityIds::safe(CodecHelper::readString($in));
        $pk->isBabyMob = CodecHelper::readBool($in);
        $pk->disableRelativeVolume = CodecHelper::readBool($in);
        $pk->actorUniqueId = LE::readSignedLong($in);
        $pk->firePosition = CodecHelper::readOptional($in, CodecHelper::readVec3(...));
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof LevelSoundEventPacket);
        VarInt::writeUnsignedInt($out, $pk->sound->value);
        CodecHelper::writeVec3($out, $pk->position);
        VarInt::writeSignedInt($out, $pk->extraData);
        CodecHelper::writeString($out, $pk->entityType->value);
        CodecHelper::writeBool($out, $pk->isBabyMob);
        CodecHelper::writeBool($out, $pk->disableRelativeVolume);
        LE::writeSignedLong($out, $pk->actorUniqueId);
        CodecHelper::writeOptional($out, $pk->firePosition, CodecHelper::writeVec3(...));
    }
}