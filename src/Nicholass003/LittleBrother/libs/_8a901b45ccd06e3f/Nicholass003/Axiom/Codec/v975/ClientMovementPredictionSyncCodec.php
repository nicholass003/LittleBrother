<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\v975;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum\EntityMetadataFlag;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\ClientMovementPredictionSyncPacket;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class ClientMovementPredictionSyncCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : ClientMovementPredictionSyncPacket{
        $pk = new ClientMovementPredictionSyncPacket();
        $pk->flags = CodecHelper::readBitSet($in, EntityMetadataFlag::ROTATION_LOCKED_TO_VEHICLE->value);
        $pk->scale = LE::readFloat($in);
        $pk->width = LE::readFloat($in);
        $pk->height = LE::readFloat($in);
        $pk->movementSpeed = LE::readFloat($in);
        $pk->underwaterMovementSpeed = LE::readFloat($in);
        $pk->lavaMovementSpeed = LE::readFloat($in);
        $pk->jumpStrength = LE::readFloat($in);
        $pk->health = LE::readFloat($in);
        $pk->hunger = LE::readFloat($in);
        $pk->frictionModifier = LE::readFloat($in);
        $pk->bounciness = LE::readFloat($in);
        $pk->airDragModifier = LE::readFloat($in);
        $pk->actorUniqueId = CodecHelper::readActorUniqueId($in);
        $pk->actorFlyingState = CodecHelper::readBool($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof ClientMovementPredictionSyncPacket);
        CodecHelper::writeBitSet($out, $pk->flags);
        LE::writeFloat($out, $pk->scale);
        LE::writeFloat($out, $pk->width);
        LE::writeFloat($out, $pk->height);
        LE::writeFloat($out, $pk->movementSpeed);
        LE::writeFloat($out, $pk->underwaterMovementSpeed);
        LE::writeFloat($out, $pk->lavaMovementSpeed);
        LE::writeFloat($out, $pk->jumpStrength);
        LE::writeFloat($out, $pk->health);
        LE::writeFloat($out, $pk->hunger);
        LE::writeFloat($out, $pk->frictionModifier);
        LE::writeFloat($out, $pk->bounciness);
        LE::writeFloat($out, $pk->airDragModifier);
        CodecHelper::writeActorUniqueId($out, $pk->actorUniqueId);
        CodecHelper::writeBool($out, $pk->actorFlyingState);
    }
}