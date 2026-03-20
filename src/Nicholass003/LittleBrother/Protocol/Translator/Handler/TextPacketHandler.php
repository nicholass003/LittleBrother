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
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;
use pocketmine\network\mcpe\protocol\serializer\CommonTypes;
use pocketmine\network\mcpe\protocol\TextPacket;

final class TextPacketHandler extends ManualPacketHandler{

	private const CATEGORY_MESSAGE_ONLY = 0;
	private const CATEGORY_AUTHORED_MESSAGE = 1;
	private const CATEGORY_MESSAGE_WITH_PARAMETERS = 2;

	private const CATEGORY_DUMMY_STRINGS = [
		self::CATEGORY_MESSAGE_ONLY => [
			'raw',
			'tip',
			'systemMessage',
			'textObjectWhisper',
			'textObjectAnnouncement',
			'textObject'
		],
		self::CATEGORY_AUTHORED_MESSAGE => [
			'chat',
			'whisper',
			'announcement'
		],
		self::CATEGORY_MESSAGE_WITH_PARAMETERS => [
			'translate',
			'popup',
			'jukeboxPopup'
		]
	];

	/**
	 * Derive the correct category from type.
	 * This ensures category always matches type, regardless of what the client sent.
	 */
	private static function categoryFromType(int $type) : int{
		return match($type){
			TextPacket::TYPE_CHAT,
			TextPacket::TYPE_WHISPER,
			TextPacket::TYPE_ANNOUNCEMENT => self::CATEGORY_AUTHORED_MESSAGE,

			TextPacket::TYPE_TRANSLATION,
			TextPacket::TYPE_POPUP,
			TextPacket::TYPE_JUKEBOX_POPUP => self::CATEGORY_MESSAGE_WITH_PARAMETERS,

			default => self::CATEGORY_MESSAGE_ONLY, // RAW, TIP, SYSTEM, JSON_*
		};
	}

	public function translateInbound(int $protocol, ByteBufferReader $in) : string{
		$out = new ByteBufferWriter();

		if($protocol <= ProtocolVersion::BE_1_21_120){
			$type = Byte::readUnsigned($in);

			CommonTypes::putBool($out, CommonTypes::getBool($in));

			$category = self::categoryFromType($type);

			Byte::writeUnsigned($out, $category);
			Byte::writeUnsigned($out, $type);

		}elseif($protocol === ProtocolVersion::BE_1_21_130){
			$needsTranslation = CommonTypes::getBool($in);
			CommonTypes::putBool($out, $needsTranslation);

			$category = Byte::readUnsigned($in);

			foreach(self::CATEGORY_DUMMY_STRINGS[$category] ?? [] as $_){
				CommonTypes::getString($in);
			}

			$type = Byte::readUnsigned($in);

			$category = self::categoryFromType($type);

			Byte::writeUnsigned($out, $category);
			Byte::writeUnsigned($out, $type);
		}else{
			$needsTranslation = CommonTypes::getBool($in);
			CommonTypes::putBool($out, $needsTranslation);

			$category = Byte::readUnsigned($in);
			$type = Byte::readUnsigned($in);

			$category = self::categoryFromType($type);

			Byte::writeUnsigned($out, $category);
			Byte::writeUnsigned($out, $type);
		}

		switch($type){
			case TextPacket::TYPE_CHAT:
			case TextPacket::TYPE_WHISPER:
			case TextPacket::TYPE_ANNOUNCEMENT:
				CommonTypes::putString($out, CommonTypes::getString($in));
				CommonTypes::putString($out, CommonTypes::getString($in));
				break;
			case TextPacket::TYPE_RAW:
			case TextPacket::TYPE_TIP:
			case TextPacket::TYPE_SYSTEM:
			case TextPacket::TYPE_JSON_WHISPER:
			case TextPacket::TYPE_JSON:
			case TextPacket::TYPE_JSON_ANNOUNCEMENT:
				CommonTypes::putString($out, CommonTypes::getString($in));
				break;
			case TextPacket::TYPE_TRANSLATION:
			case TextPacket::TYPE_POPUP:
			case TextPacket::TYPE_JUKEBOX_POPUP:
				CommonTypes::putString($out, CommonTypes::getString($in));
				$count = VarInt::readUnsignedInt($in);
				VarInt::writeUnsignedInt($out, $count);
				for($i = 0; $i < $count; $i++){
					CommonTypes::putString($out, CommonTypes::getString($in));
				}
				break;
		}

		CommonTypes::putString($out, CommonTypes::getString($in));
		CommonTypes::putString($out, CommonTypes::getString($in));

		if($protocol <= ProtocolVersion::BE_1_21_120){
			CommonTypes::putString($out, CommonTypes::getString($in));
		}else{
			$opt = CommonTypes::readOptional($in, CommonTypes::getString(...));
			CommonTypes::writeOptional($out, $opt, CommonTypes::putString(...));
		}

		return $out->getData();
	}

	public function translateOutbound(int $protocol, ByteBufferReader $in) : string{
		$out = new ByteBufferWriter();

		$needsTranslation = CommonTypes::getBool($in);
		$category = Byte::readUnsigned($in);
		$type = Byte::readUnsigned($in);

		if($protocol <= ProtocolVersion::BE_1_21_120){
			Byte::writeUnsigned($out, $type);

			CommonTypes::putBool($out, $needsTranslation);

		}elseif($protocol === ProtocolVersion::BE_1_21_130){
			CommonTypes::putBool($out, $needsTranslation);

			Byte::writeUnsigned($out, $category);

			foreach(self::CATEGORY_DUMMY_STRINGS[$category] ?? [] as $dummy){
				CommonTypes::putString($out, $dummy);
			}

			Byte::writeUnsigned($out, $type);
		}else{
			CommonTypes::putBool($out, $needsTranslation);
			Byte::writeUnsigned($out, $category);
			Byte::writeUnsigned($out, $type);
		}
		switch($type){
			case TextPacket::TYPE_CHAT:
			case TextPacket::TYPE_WHISPER:
			case TextPacket::TYPE_ANNOUNCEMENT:
				CommonTypes::putString($out, CommonTypes::getString($in));
				CommonTypes::putString($out, CommonTypes::getString($in));
				break;
			case TextPacket::TYPE_RAW:
			case TextPacket::TYPE_TIP:
			case TextPacket::TYPE_SYSTEM:
			case TextPacket::TYPE_JSON_WHISPER:
			case TextPacket::TYPE_JSON:
			case TextPacket::TYPE_JSON_ANNOUNCEMENT:
				CommonTypes::putString($out, CommonTypes::getString($in));
				break;
			case TextPacket::TYPE_TRANSLATION:
			case TextPacket::TYPE_POPUP:
			case TextPacket::TYPE_JUKEBOX_POPUP:
				CommonTypes::putString($out, CommonTypes::getString($in));

				$count = VarInt::readUnsignedInt($in);
				VarInt::writeUnsignedInt($out, $count);
				for($i = 0; $i < $count; $i++){
					CommonTypes::putString($out, CommonTypes::getString($in));
				}
				break;
		}

		CommonTypes::putString($out, CommonTypes::getString($in));
		CommonTypes::putString($out, CommonTypes::getString($in));

		if($protocol <= ProtocolVersion::BE_1_21_120){
			$opt = CommonTypes::readOptional($in, CommonTypes::getString(...));
			CommonTypes::putString($out, $opt ?? "");
		}else{
			$opt = CommonTypes::readOptional($in, CommonTypes::getString(...));
			CommonTypes::writeOptional($out, $opt, CommonTypes::putString(...));
		}

		return $out->getData();
	}
}