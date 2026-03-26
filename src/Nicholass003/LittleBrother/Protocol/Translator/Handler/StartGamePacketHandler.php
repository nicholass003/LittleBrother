<?php

/*
 * Copyright (c) 2024 - present nicholass003
 *        _      _           _                ___   ___ ____
 *       (_)    | |         | |              / _ \ / _ \___ \
 *  _ __  _  ___| |__   ___ | | __ _ ___ ___| | | | | | |__) |
 * | '_ \| |/ __| '_ \ / _ \| |/ _` / __/ __| | | | | | |__ <
 * | | | | | (__| | | | (_) | | (_| \__ \__ \ |_| | |_| |__) |
 * |_| |_|_|\___|_| |_|\___/|_|\__,_|___/___/\___/ \___/____/
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author  nicholass003
 * @link    https://github.com/nicholass003/
 *
 *
 */

declare(strict_types=1);

namespace Nicholass003\LittleBrother\Protocol\Translator\Handler;

use Nicholass003\LittleBrother\Protocol\ProtocolVersion;
use Nicholass003\LittleBrother\Protocol\Translator\ManualPacketHandler;
use Nicholass003\LittleBrother\Schema\PacketContext;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;
use pocketmine\network\mcpe\protocol\serializer\CommonTypes;
use pocketmine\network\mcpe\protocol\types\CacheableNbt;
use pocketmine\network\mcpe\protocol\types\EducationUriResource;
use pocketmine\network\mcpe\protocol\types\Experiments;
use pocketmine\network\mcpe\protocol\types\NetworkPermissions;
use pocketmine\network\mcpe\protocol\types\PlayerMovementSettings;
use pocketmine\network\mcpe\protocol\types\ServerJoinInformation;
use pocketmine\network\mcpe\protocol\types\ServerTelemetryData;
use pocketmine\network\mcpe\protocol\types\SpawnSettings;

final class StartGamePacketHandler extends ManualPacketHandler{

	public function translateInbound(int $protocol, ByteBufferReader $in) : string{
		return $this->passthrough($in);
	}

	public function translateOutbound(int $protocol, ByteBufferReader $in) : string{
		$out = new ByteBufferWriter();
		$context = new PacketContext($this->plugin->getTypeRegistryFactory()->getTypeRegistry());

		CommonTypes::putActorUniqueId($out, CommonTypes::getActorUniqueId($in));
		CommonTypes::putActorRuntimeId($out, CommonTypes::getActorRuntimeId($in));

		VarInt::writeSignedInt($out, VarInt::readSignedInt($in)); // playerGamemode
		CommonTypes::putVector3($out, CommonTypes::getVector3($in)); // playerPosition
		LE::writeFloat($out, LE::readFloat($in)); // pitch
		LE::writeFloat($out, LE::readFloat($in)); // yaw

		$this->translateLevelSettings($in, $out, $protocol, $context);

		CommonTypes::putString($out, CommonTypes::getString($in)); // levelId
		CommonTypes::putString($out, CommonTypes::getString($in)); // worldName
		CommonTypes::putString($out, CommonTypes::getString($in)); // premiumWorldTemplateId
		CommonTypes::putBool($out, CommonTypes::getBool($in)); // isTrial

		PlayerMovementSettings::read($in)->write($out);

		LE::writeUnsignedLong($out, LE::readUnsignedLong($in)); // currentTick
		VarInt::writeSignedInt($out, VarInt::readSignedInt($in)); // enchantmentSeed

		// Block palette
		$count = VarInt::readUnsignedInt($in);
		VarInt::writeUnsignedInt($out, $count);
		for($i = 0; $i < $count; $i++){
			CommonTypes::putString($out, CommonTypes::getString($in));
			$out->writeByteArray((new CacheableNbt(CommonTypes::getNbtCompoundRoot($in)))->getEncodedNbt());
		}

		CommonTypes::putString($out, CommonTypes::getString($in)); // multiplayerCorrelationId
		CommonTypes::putBool($out, CommonTypes::getBool($in)); // enableNewInventorySystem
		CommonTypes::putString($out, CommonTypes::getString($in)); // serverSoftwareVersion
		$out->writeByteArray((new CacheableNbt(CommonTypes::getNbtCompoundRoot($in)))->getEncodedNbt()); // playerActorProperties
		LE::writeUnsignedLong($out, LE::readUnsignedLong($in)); // blockPaletteChecksum
		CommonTypes::putUUID($out, CommonTypes::getUUID($in)); // worldTemplateId
		CommonTypes::putBool($out, CommonTypes::getBool($in)); // enableClientSideChunkGeneration

		CommonTypes::putBool($out, CommonTypes::getBool($in)); // blockNetworkIdsAreHashes

		if($protocol <= ProtocolVersion::BE_1_21_120){
			CommonTypes::putBool($out, false); // enableTickDeathSystems
		}

		NetworkPermissions::decode($in)->encode($out);

		// serverJoinInformation
		$serverJoinInformation = CommonTypes::readOptional($in, ServerJoinInformation::read(...));
		if($protocol >= ProtocolVersion::BE_1_26_0){
			CommonTypes::writeOptional(
				$out,
				$serverJoinInformation,
				fn(ByteBufferWriter $out, ServerJoinInformation $v) => $v->write($out)
			);
		}

		// serverTelemetryData
		$serverTelemetryData = ServerTelemetryData::read($in);
		if($protocol >= ProtocolVersion::BE_1_26_0){
			$serverTelemetryData->write($out);
		}

		return $out->getData();
	}

	private function translateLevelSettings(ByteBufferReader $in, ByteBufferWriter $out, int $protocol, PacketContext $context) : void{
		LE::writeUnsignedLong($out, LE::readUnsignedLong($in));          // seed
		SpawnSettings::read($in)->write($out);
		VarInt::writeSignedInt($out, VarInt::readSignedInt($in));        // generator
		VarInt::writeSignedInt($out, VarInt::readSignedInt($in));        // worldGamemode
		CommonTypes::putBool($out, CommonTypes::getBool($in));           // hardcore
		VarInt::writeSignedInt($out, VarInt::readSignedInt($in));        // difficulty
		$pos = $context->getTypeRegistry()->read($in, 'blockpos', $protocol, $context);
		$context->getTypeRegistry()->write($out, 'blockpos', $pos, $protocol, $context);
		CommonTypes::putBool($out, CommonTypes::getBool($in));           // hasAchievementsDisabled
		VarInt::writeSignedInt($out, VarInt::readSignedInt($in));        // editorWorldType
		CommonTypes::putBool($out, CommonTypes::getBool($in));           // createdInEditorMode
		CommonTypes::putBool($out, CommonTypes::getBool($in));           // exportedFromEditorMode
		VarInt::writeSignedInt($out, VarInt::readSignedInt($in));        // time
		VarInt::writeSignedInt($out, VarInt::readSignedInt($in));        // eduEditionOffer
		CommonTypes::putBool($out, CommonTypes::getBool($in));           // hasEduFeaturesEnabled
		CommonTypes::putString($out, CommonTypes::getString($in));       // eduProductUUID
		LE::writeFloat($out, LE::readFloat($in));                        // rainLevel
		LE::writeFloat($out, LE::readFloat($in));                        // lightningLevel
		CommonTypes::putBool($out, CommonTypes::getBool($in));           // hasConfirmedPlatformLockedContent
		CommonTypes::putBool($out, CommonTypes::getBool($in));           // isMultiplayerGame
		CommonTypes::putBool($out, CommonTypes::getBool($in));           // hasLANBroadcast
		VarInt::writeSignedInt($out, VarInt::readSignedInt($in));        // xboxLiveBroadcastMode
		VarInt::writeSignedInt($out, VarInt::readSignedInt($in));        // platformBroadcastMode
		CommonTypes::putBool($out, CommonTypes::getBool($in));           // commandsEnabled
		CommonTypes::putBool($out, CommonTypes::getBool($in));           // isTexturePacksRequired
		CommonTypes::putGameRules($out, CommonTypes::getGameRules($in, true), true); // gameRules
		Experiments::read($in)->write($out);                             // experiments
		CommonTypes::putBool($out, CommonTypes::getBool($in));           // hasBonusChestEnabled
		CommonTypes::putBool($out, CommonTypes::getBool($in));           // hasStartWithMapEnabled
		VarInt::writeSignedInt($out, VarInt::readSignedInt($in));        // defaultPlayerPermission
		LE::writeSignedInt($out, LE::readSignedInt($in));                // serverChunkTickRadius
		CommonTypes::putBool($out, CommonTypes::getBool($in));           // hasLockedBehaviorPack
		CommonTypes::putBool($out, CommonTypes::getBool($in));           // hasLockedResourcePack
		CommonTypes::putBool($out, CommonTypes::getBool($in));           // isFromLockedWorldTemplate
		CommonTypes::putBool($out, CommonTypes::getBool($in));           // useMsaGamertagsOnly
		CommonTypes::putBool($out, CommonTypes::getBool($in));           // isFromWorldTemplate
		CommonTypes::putBool($out, CommonTypes::getBool($in));           // isWorldTemplateOptionLocked
		CommonTypes::putBool($out, CommonTypes::getBool($in));           // onlySpawnV1Villagers
		CommonTypes::putBool($out, CommonTypes::getBool($in));           // disablePersona
		CommonTypes::putBool($out, CommonTypes::getBool($in));           // disableCustomSkins
		CommonTypes::putBool($out, CommonTypes::getBool($in));           // muteEmoteAnnouncements
		CommonTypes::putString($out, CommonTypes::getString($in));       // vanillaVersion
		LE::writeSignedInt($out, LE::readSignedInt($in));                // limitedWorldWidth
		LE::writeSignedInt($out, LE::readSignedInt($in));                // limitedWorldLength
		CommonTypes::putBool($out, CommonTypes::getBool($in));           // isNewNether
		EducationUriResource::read($in)->write($out);
		CommonTypes::writeOptional(
			$out,
			CommonTypes::readOptional($in, CommonTypes::getBool(...)),
			CommonTypes::putBool(...)
		);
		Byte::writeUnsigned($out, Byte::readUnsigned($in));              // chatRestrictionLevel
		CommonTypes::putBool($out, CommonTypes::getBool($in));           // disablePlayerInteractions

		if($protocol <= ProtocolVersion::BE_1_21_130){
			CommonTypes::putString($out, ''); // serverIdentifier
			CommonTypes::putString($out, ''); // worldIdentifier
			CommonTypes::putString($out, ''); // scenarioIdentifier
			CommonTypes::putString($out, ''); // ownerIdentifier
		}
	}
}