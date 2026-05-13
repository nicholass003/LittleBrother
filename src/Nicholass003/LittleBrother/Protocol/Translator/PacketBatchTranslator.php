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

namespace Nicholass003\LittleBrother\Protocol\Translator;

use Nicholass003\LittleBrother\Utils\Debugger;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;
use pocketmine\network\mcpe\compression\Compressor;
use pocketmine\network\mcpe\compression\ZlibCompressor;
use pocketmine\network\mcpe\protocol\DataPacket;
use pocketmine\network\mcpe\protocol\ProtocolInfo;
use pocketmine\network\mcpe\protocol\serializer\PacketBatch;
use pocketmine\network\mcpe\protocol\types\CompressionAlgorithm;
use function chr;
use function ord;
use function strlen;
use function substr;

class PacketBatchTranslator{
	private Compressor $compressor;

	private bool $bypassTranslation = false;

	public function __construct(
		private PacketTranslator $translator,
	){
		$this->compressor = ZlibCompressor::getInstance();
	}

	public function translate(int $protocol, string $payload, bool $inbound = false) : string{
		if(strlen($payload) <= 1 || $this->bypassTranslation){
			return $payload;
		}

		$compressionId = ord($payload[0]);
		Debugger::log("PacketBatchTranslator - Compression ID: $compressionId");

		$compressed = substr($payload, 1);

		try{
			if($compressionId === CompressionAlgorithm::ZLIB){
				$decompressed = $this->compressor->decompress($compressed);
			}else{
				$decompressed = $compressed;
			}
		}catch(\Throwable $e){
			Debugger::log("Failed to decompress: " . $e->getMessage());
			return $payload;
		}

		$translated = $this->translateBatch($protocol, $decompressed, $inbound);

		try{
			if($compressionId === CompressionAlgorithm::ZLIB){
				$recompressed = $this->compressor->compress($translated);
			}else{
				$recompressed = $translated;
			}
		}catch(\Throwable $e){
			Debugger::log("Failed to recompress: " . $e->getMessage());
			return $payload;
		}

		return chr($compressionId) . $recompressed;
	}

	public function setBypass(bool $bypass) : void{
		$this->bypassTranslation = $bypass;
	}

	private function translateBatch(int $protocol, string $data, bool $inbound) : string{
		$reader = new ByteBufferReader($data);

		try{
			$packets = [];

			foreach(PacketBatch::decodeRaw($reader) as $buffer){
				$packetReader = new ByteBufferReader($buffer);

				$header = VarInt::readUnsignedInt($packetReader);
				$packetId = $header & DataPacket::PID_MASK;

				Debugger::log("Trying To Translate Packet Id: " . $packetId, $packetId === ProtocolInfo::PLAYER_AUTH_INPUT_PACKET);

				if(
					$packetId === ProtocolInfo::NETWORK_SETTINGS_PACKET ||
					$packetId === ProtocolInfo::PLAY_STATUS_PACKET ||
					$packetId === ProtocolInfo::SERVER_TO_CLIENT_HANDSHAKE_PACKET ||
					$packetId === ProtocolInfo::CLIENT_TO_SERVER_HANDSHAKE_PACKET ||
					$packetId === ProtocolInfo::LOGIN_PACKET
				){
					$packets[] = $buffer;
					continue;
				}

				Debugger::log("Packet size before: " . strlen($buffer), $packetId === ProtocolInfo::PLAYER_AUTH_INPUT_PACKET);
				Debugger::log("Direction: " . ($inbound ? "Client -> Server" : "Server -> Client"));

				$translated = $inbound ? $this->translator->translateInbound(
					$protocol,
					$buffer
				) : $this->translator->translateOutbound(
					$protocol,
					$buffer
				);

				if($translated !== null){
					$buffer = $translated;
					Debugger::log("Packet size after: " . strlen($buffer), $packetId === ProtocolInfo::PLAYER_AUTH_INPUT_PACKET);
				}

				$packets[] = $buffer;
			}

		}catch(\Throwable $e){
			Debugger::log("Failed to decode: " . $e->getMessage());
			return $data;
		}

		$writer = new ByteBufferWriter();
		PacketBatch::encodeRaw($writer, $packets);

		return $writer->getData();
	}
}