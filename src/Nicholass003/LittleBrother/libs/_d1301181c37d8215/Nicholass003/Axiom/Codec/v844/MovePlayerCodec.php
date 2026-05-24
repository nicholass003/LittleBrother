<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Enum\MovePlayerMode;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet\MovePlayerPacket;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class MovePlayerCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : MovePlayerPacket{
        $pk = new MovePlayerPacket();
        $pk->actorRuntimeId = CodecHelper::readActorRuntimeId($in);
        $pk->position = CodecHelper::readVec3($in);
        $pk->pitch = LE::readFloat($in);
        $pk->yaw = LE::readFloat($in);
        $pk->headYaw = LE::readFloat($in);
        $pk->mode = MovePlayerMode::safe(Byte::readUnsigned($in));
        $pk->onGround = CodecHelper::readBool($in);
        $pk->ridingActorRuntimeId = CodecHelper::readActorRuntimeId($in);
        if($pk->mode === MovePlayerMode::MODE_TELEPORT){
            $pk->teleportCause = LE::readSignedInt($in);
            $pk->teleportItem = LE::readSignedInt($in);
        }
        $pk->tick = VarInt::readUnsignedLong($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof MovePlayerPacket);
        CodecHelper::writeActorRuntimeId($out, $pk->actorRuntimeId);
        CodecHelper::writeVec3($out, $pk->position);
        LE::writeFloat($out, $pk->pitch);
        LE::writeFloat($out, $pk->yaw);
        LE::writeFloat($out, $pk->headYaw);
        Byte::writeUnsigned($out, $pk->mode->value);
        CodecHelper::writeBool($out, $pk->onGround);
        CodecHelper::writeActorRuntimeId($out, $pk->ridingActorRuntimeId);
        if($pk->mode === MovePlayerMode::MODE_TELEPORT){
            LE::writeSignedInt($out, $pk->teleportCause);
            LE::writeSignedInt($out, $pk->teleportItem);
        }
        VarInt::writeUnsignedLong($out, $pk->tick);
    }
}