<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\Packet;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet\StartGamePacket;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class StartGameCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : StartGamePacket{
        $pk = new StartGamePacket();
        $pk->actorUniqueId = CodecHelper::readActorUniqueId($in);
        $pk->actorRuntimeId = CodecHelper::readActorRuntimeId($in);
        $pk->gamemode = VarInt::readSignedInt($in);

        $pk->position = CodecHelper::readVec3($in);

        $pk->pitch = LE::readFloat($in);
        $pk->yaw = LE::readFloat($in);

        $pk->levelSettings = $codec->levelSettings()->read($in);

        $pk->levelId = CodecHelper::readString($in);
        $pk->worldName = CodecHelper::readString($in);
        $pk->premiumWorldTemplateId = CodecHelper::readString($in);
        $pk->isTrial = CodecHelper::readBool($in);

        $pk->movement = $codec->movementSettings()->read($in);

        $pk->currentTick = LE::readUnsignedLong($in);
        $pk->enchantmentSeed = VarInt::readSignedInt($in);

        $pk->blockPalette = $codec->blockPalette()->read($in);

        $pk->multiplayerCorrelationId = CodecHelper::readString($in);
        $pk->enableNewInventorySystem = CodecHelper::readBool($in);
        $pk->serverSoftwareVersion = CodecHelper::readString($in);

        $pk->playerActorProperties = CodecHelper::readNbt($in);

        $pk->blockPaletteChecksum = LE::readUnsignedLong($in);

        $pk->worldTemplateId = CodecHelper::readUUID($in);

        $pk->enableClientSideChunkGeneration = CodecHelper::readBool($in);
        $pk->blockNetworkIdsAreHashes = CodecHelper::readBool($in);
        $pk->enableTickDeathSystems = CodecHelper::readBool($in);

        $pk->networkPermissions = $codec->networkPermissions()->read($in);

        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof StartGamePacket);

        CodecHelper::writeActorUniqueId($out, $pk->actorUniqueId);
        CodecHelper::writeActorRuntimeId($out, $pk->actorRuntimeId);
        VarInt::writeSignedInt($out, $pk->gamemode);

        CodecHelper::writeVec3($out, $pk->position);

        LE::writeFloat($out, $pk->pitch);
        LE::writeFloat($out, $pk->yaw);

        $codec->levelSettings()->write($out, $pk->levelSettings);

        CodecHelper::writeString($out, $pk->levelId);
        CodecHelper::writeString($out, $pk->worldName);
        CodecHelper::writeString($out, $pk->premiumWorldTemplateId);
        CodecHelper::writeBool($out, $pk->isTrial);

        $codec->movementSettings()->write($out, $pk->movement);

        LE::writeUnsignedLong($out, $pk->currentTick);
        VarInt::writeSignedInt($out, $pk->enchantmentSeed);

        $codec->blockPalette()->write($out, $pk->blockPalette);

        CodecHelper::writeString($out, $pk->multiplayerCorrelationId);
        CodecHelper::writeBool($out, $pk->enableNewInventorySystem);
        CodecHelper::writeString($out, $pk->serverSoftwareVersion);

        CodecHelper::writeNbt($out, $pk->playerActorProperties);

        LE::writeUnsignedLong($out, $pk->blockPaletteChecksum);

        CodecHelper::writeUUID($out, $pk->worldTemplateId);

        CodecHelper::writeBool($out, $pk->enableClientSideChunkGeneration);
        CodecHelper::writeBool($out, $pk->blockNetworkIdsAreHashes);
        CodecHelper::writeBool($out, $pk->enableTickDeathSystems);

        $codec->networkPermissions()->write($out, $pk->networkPermissions);
    }
}