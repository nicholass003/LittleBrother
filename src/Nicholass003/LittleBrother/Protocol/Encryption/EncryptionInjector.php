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

namespace Nicholass003\LittleBrother\Protocol\Encryption;

use Nicholass003\LittleBrother\Protocol\Translator\PacketBatchTranslator;
use Nicholass003\LittleBrother\Utils\Debugger;
use pocketmine\network\mcpe\encryption\EncryptionContext;
use pocketmine\network\mcpe\NetworkSession;
use function ord;
use function spl_object_id;
use function strlen;
























































class EncryptionInjector{

	/** @var array<int, bool> */
	private static array $injected = [];

	public static function inject(NetworkSession $session, PacketBatchTranslator $translator, int $protocol) : void{
		$sessionId = spl_object_id($session);

		if(isset(self::$injected[$sessionId])){
			Debugger::log("EncryptionInjector - Session already injected, skipping");
			return;
		}

		$ref = new \ReflectionClass(NetworkSession::class);

		$cipherProp = $ref->getProperty("cipher");
		$cipherProp->setAccessible(true);

		$cipher = $cipherProp->getValue($session);

		if(!$cipher instanceof EncryptionContext){
			Debugger::log("EncryptionInjector - No cipher found");
			return;
		}

		Debugger::log("EncryptionInjector - Injecting interceptor");

		$intercept = new InterceptEncryptionContext(
			$cipher,
			$translator,
			$protocol
		);

		$cipherProp->setValue($session, $intercept);

		self::$injected[$sessionId] = true;
	}
}