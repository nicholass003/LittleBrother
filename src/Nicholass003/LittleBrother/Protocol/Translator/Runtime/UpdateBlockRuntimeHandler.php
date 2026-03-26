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

namespace Nicholass003\LittleBrother\Protocol\Translator\Runtime;

use Nicholass003\LittleBrother\Convert\Block\RuntimeBlockMapper;
use Nicholass003\LittleBrother\LittleBrother;
use Nicholass003\LittleBrother\Protocol\Translator\RuntimePacketHandler;
use Nicholass003\LittleBrother\Schema\PacketContext;
use Nicholass003\LittleBrother\Utils\Debugger;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;
use function count;

class UpdateBlockRuntimeHandler implements RuntimePacketHandler{

	/** @var array<int, int> */
	private array $mappingCache = [];

	public function __construct(
		private RuntimeBlockMapper $mapper
	){}

	public function translateOutbound(int $protocol, string $payload) : string{
		$in = new ByteBufferReader($payload);
		$out = new ByteBufferWriter();
		$context = new PacketContext(LittleBrother::getInstance()->getTypeRegistryFactory()->getTypeRegistry());

		$pos = $context->getTypeRegistry()->read($in, 'blockpos', $protocol, $context);
		$context->getTypeRegistry()->write($out, 'blockpos', $pos, $protocol, $context);

		$runtimeId = VarInt::readUnsignedInt($in);

		$runtimeId = $this->mapper->serverToClient($protocol, $runtimeId);

		VarInt::writeUnsignedInt($out, $runtimeId);

		$flags = VarInt::readUnsignedInt($in);
		$layer = VarInt::readUnsignedInt($in);

		VarInt::writeUnsignedInt($out, $flags);
		VarInt::writeUnsignedInt($out, $layer);

		return $out->getData();
	}

	public function translateInbound(int $protocol, string $payload) : string{
		$in = new ByteBufferReader($payload);
		$out = new ByteBufferWriter();
		$context = new PacketContext(LittleBrother::getInstance()->getTypeRegistryFactory()->getTypeRegistry());

		$pos = $context->getTypeRegistry()->read($in, 'blockpos', $protocol, $context);
		$context->getTypeRegistry()->write($out, 'blockpos', $pos, $protocol, $context);

		$runtimeId = VarInt::readUnsignedInt($in);

		$cacheKey = ($protocol << 17) | $runtimeId;

		if(isset($this->mappingCache[$cacheKey])){
			$mappedId = $this->mappingCache[$cacheKey];
			Debugger::debug("Inbound Runtime ID cached: $runtimeId -> $mappedId");
			$runtimeId = $mappedId;
		}else{
			Debugger::debug("Inbound Runtime ID Before : " . $runtimeId);

			$mappedId = $this->mapper->clientToServer($protocol, $runtimeId);

			if($mappedId !== $runtimeId){
				Debugger::debug("Inbound Runtime ID After : " . $mappedId);

				if(count($this->mappingCache) < 10000){
					$this->mappingCache[$cacheKey] = $mappedId;
				}
			}else{
				Debugger::debug("Inbound Runtime ID unchanged (already in target format)");
			}

			$runtimeId = $mappedId;
		}

		VarInt::writeUnsignedInt($out, $runtimeId);

		$flags = VarInt::readUnsignedInt($in);
		$layer = VarInt::readUnsignedInt($in);

		VarInt::writeUnsignedInt($out, $flags);
		VarInt::writeUnsignedInt($out, $layer);

		return $out->getData();
	}

	public function clearCache() : void{
		$this->mappingCache = [];
	}
}