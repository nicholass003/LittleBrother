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

namespace Nicholass003\LittleBrother\Protocol;

use Nicholass003\LittleBrother\Protocol\Encryption\EncryptionInjector;
use Nicholass003\LittleBrother\Protocol\Translator\PacketBatchTranslator;
use Nicholass003\LittleBrother\Utils\Debugger;
use pocketmine\network\mcpe\NetworkSession;
use pocketmine\network\mcpe\PacketSender as PacketSenderInterface;
use function strlen;

class PacketSender implements PacketSenderInterface{
	public bool $injected = false;

	public function __construct(
		private PacketSenderInterface $inner,
		private NetworkSession $session,
		private PacketBatchTranslator $translator,
		private int $protocol
	){}

	public function send(string $payload, bool $immediate, ?int $receiptId) : void{
		Debugger::log("PacketSender::send - Batch length: " . strlen($payload));

		$isIntercepted = $this->injected;
		Debugger::log("PacketSender::send - Intercepted: " . ($isIntercepted ? "YES" : "NO"));

		if(!$isIntercepted){
			$this->isEncrypted();
		}

		$this->inner->send($payload, $immediate, $receiptId);
	}

	public function close(string $reason = "unknown reason") : void{
		$this->inner->close($reason);
	}

	private function isEncrypted() : bool{
		static $prop = null;

		if($prop === null){
			$ref = new \ReflectionClass($this->session);
			$prop = $ref->getProperty("cipher");
			$prop->setAccessible(true);
		}

		$cipher = $prop->getValue($this->session);

		if($cipher !== null && !$this->injected){
			Debugger::log("PacketSender::send - Injecting encryption interceptor");
			EncryptionInjector::inject($this->session, $this->translator, $this->protocol);
			$this->injected = true;
		}

		return $cipher !== null;
	}
}