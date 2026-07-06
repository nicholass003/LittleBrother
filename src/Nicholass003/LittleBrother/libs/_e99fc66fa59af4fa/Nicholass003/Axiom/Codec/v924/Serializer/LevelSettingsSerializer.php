<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\v924\Serializer;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Common\Serializer\ExperimentsSerializer;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Common\Serializer\GameRulesSerializer;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Codec\Common\Serializer\LevelSettingsSerializer as BaseLevelSettingsSerializer;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\Education\EducationUriResource;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\LevelSettingsData;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class LevelSettingsSerializer extends BaseLevelSettingsSerializer{

    public function __construct(
        ExperimentsSerializer $experimentsSerializer,
        GameRulesSerializer $gameRulesSerializer
    ){
        parent::__construct($experimentsSerializer, $gameRulesSerializer);
    }

    public function read(ByteBufferReader $in) : LevelSettingsData{
        return new LevelSettingsData(
            LE::readUnsignedLong($in),
            $this->readSpawnSettings($in),
            VarInt::readSignedInt($in),
            VarInt::readSignedInt($in),
            CodecHelper::readBool($in),
            VarInt::readSignedInt($in),
            CodecHelper::readBlockPosition($in),

            CodecHelper::readBool($in),
            VarInt::readSignedInt($in),
            CodecHelper::readBool($in),
            CodecHelper::readBool($in),

            VarInt::readSignedInt($in),
            VarInt::readSignedInt($in),
            CodecHelper::readBool($in),
            CodecHelper::readString($in),

            LE::readFloat($in),
            LE::readFloat($in),
            CodecHelper::readBool($in),

            CodecHelper::readBool($in),
            CodecHelper::readBool($in),
            VarInt::readSignedInt($in),
            VarInt::readSignedInt($in),

            CodecHelper::readBool($in),
            CodecHelper::readBool($in),

            $this->gameRules()->read($in, true),
            $this->experiments()->read($in),

            CodecHelper::readBool($in),
            CodecHelper::readBool($in),

            VarInt::readSignedInt($in),
            LE::readSignedInt($in),

            CodecHelper::readBool($in),
            CodecHelper::readBool($in),
            CodecHelper::readBool($in),
            CodecHelper::readBool($in),
            CodecHelper::readBool($in),
            CodecHelper::readBool($in),
            CodecHelper::readBool($in),
            CodecHelper::readBool($in),
            CodecHelper::readBool($in),
            CodecHelper::readBool($in),

            CodecHelper::readString($in),

            LE::readSignedInt($in),
            LE::readSignedInt($in),
            CodecHelper::readBool($in),

            $this->readEducationUri($in),
            CodecHelper::readOptional($in, CodecHelper::readBool(...)),

            Byte::readUnsigned($in),
            CodecHelper::readBool($in)
        );
    }

    public function write(ByteBufferWriter $out, LevelSettingsData $d) : void{
        LE::writeUnsignedLong($out, $d->seed);
        $this->writeSpawnSettings($out, $d->spawnSettings);

        VarInt::writeSignedInt($out, $d->generator);
        VarInt::writeSignedInt($out, $d->worldGamemode);
        CodecHelper::writeBool($out, $d->hardcore);
        VarInt::writeSignedInt($out, $d->difficulty);
        CodecHelper::writeBlockPosition($out, $d->spawnPosition);

        CodecHelper::writeBool($out, $d->hasAchievementsDisabled);
        VarInt::writeSignedInt($out, $d->editorWorldType);
        CodecHelper::writeBool($out, $d->createdInEditorMode);
        CodecHelper::writeBool($out, $d->exportedFromEditorMode);

        VarInt::writeSignedInt($out, $d->time);
        VarInt::writeSignedInt($out, $d->eduEditionOffer);
        CodecHelper::writeBool($out, $d->hasEduFeaturesEnabled);
        CodecHelper::writeString($out, $d->eduProductUUID);

        LE::writeFloat($out, $d->rainLevel);
        LE::writeFloat($out, $d->lightningLevel);
        CodecHelper::writeBool($out, $d->hasConfirmedPlatformLockedContent);

        CodecHelper::writeBool($out, $d->isMultiplayerGame);
        CodecHelper::writeBool($out, $d->hasLANBroadcast);
        VarInt::writeSignedInt($out, $d->xboxLiveBroadcastMode);
        VarInt::writeSignedInt($out, $d->platformBroadcastMode);

        CodecHelper::writeBool($out, $d->commandsEnabled);
        CodecHelper::writeBool($out, $d->isTexturePacksRequired);

        $this->gameRules()->write($out, $d->gameRules, true);
        $this->experiments()->write($out, $d->experiments);

        CodecHelper::writeBool($out, $d->hasBonusChestEnabled);
        CodecHelper::writeBool($out, $d->hasStartWithMapEnabled);

        VarInt::writeSignedInt($out, $d->defaultPlayerPermission);
        LE::writeSignedInt($out, $d->serverChunkTickRadius);

        CodecHelper::writeBool($out, $d->hasLockedBehaviorPack);
        CodecHelper::writeBool($out, $d->hasLockedResourcePack);
        CodecHelper::writeBool($out, $d->isFromLockedWorldTemplate);
        CodecHelper::writeBool($out, $d->useMsaGamertagsOnly);
        CodecHelper::writeBool($out, $d->isFromWorldTemplate);
        CodecHelper::writeBool($out, $d->isWorldTemplateOptionLocked);
        CodecHelper::writeBool($out, $d->onlySpawnV1Villagers);
        CodecHelper::writeBool($out, $d->disablePersona);
        CodecHelper::writeBool($out, $d->disableCustomSkins);
        CodecHelper::writeBool($out, $d->muteEmoteAnnouncements);

        CodecHelper::writeString($out, $d->vanillaVersion);

        LE::writeSignedInt($out, $d->limitedWorldWidth);
        LE::writeSignedInt($out, $d->limitedWorldLength);
        CodecHelper::writeBool($out, $d->isNewNether);

        $this->writeEducationUri($out, $d->eduSharedUriResource ?? new EducationUriResource("", ""));
        CodecHelper::writeOptional($out, $d->experimentalGameplayOverride, CodecHelper::writeBool(...));

        Byte::writeUnsigned($out, $d->chatRestrictionLevel);
        CodecHelper::writeBool($out, $d->disablePlayerInteractions);
    }
}