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

class InterceptEncryptionContext extends EncryptionContext{

	private PacketBatchTranslator $translator;
	private int $protocol;

	public function __construct(
		EncryptionContext $original,
		PacketBatchTranslator $translator,
		int $protocol
	){
		$this->translator = $translator;
		$this->protocol = $protocol;

		$ref = new \ReflectionClass(EncryptionContext::class);

		foreach([
			"key",
			"decryptCipher",
			"decryptCounter",
			"encryptCipher",
			"encryptCounter"
		] as $propName){
			$prop = $ref->getProperty($propName);
			$prop->setAccessible(true);
			$prop->setValue($this, $prop->getValue($original));
		}
	}

	public function decrypt(string $payload) : string{
		Debugger::log("DECRYPT INTERCEPT - Before decrypt: " . strlen($payload) . " bytes");

		$plaintext = parent::decrypt($payload);

		Debugger::log("After decrypt: " . strlen($plaintext) . " bytes, first byte: " . (isset($plaintext[0]) ? ord($plaintext[0]) : 'none'));

		$translated = $this->translator->translate($this->protocol, $plaintext, true);

		Debugger::log("After translate: " . strlen($translated) . " bytes");
		return $translated;
	}

	public function encrypt(string $payload) : string{
		Debugger::log("ENCRYPT INTERCEPT - Before translate: " . strlen($payload) . " bytes");

		$translated = $this->translator->translate($this->protocol, $payload);

		Debugger::log("After translate: " . strlen($translated) . " bytes");

		$encrypted = parent::encrypt($translated);

		Debugger::log("After encrypt: " . strlen($encrypted) . " bytes");
		return $encrypted;
	}
}