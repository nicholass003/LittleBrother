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

namespace Nicholass003\LittleBrother\Auth;

use pocketmine\entity\InvalidSkinException;
use pocketmine\network\mcpe\JwtException;
use pocketmine\network\mcpe\JwtUtils;
use pocketmine\network\mcpe\NetworkSession;
use pocketmine\network\mcpe\protocol\LoginPacket;
use pocketmine\network\mcpe\protocol\types\login\AuthenticationInfo;
use pocketmine\network\mcpe\protocol\types\login\AuthenticationType;
use pocketmine\network\mcpe\protocol\types\login\clientdata\ClientData;
use pocketmine\network\mcpe\protocol\types\login\clientdata\ClientDataToSkinDataHelper;
use pocketmine\player\Player;
use pocketmine\player\PlayerInfo;
use pocketmine\player\XboxLivePlayerInfo;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use function base64_decode;
use function chr;
use function gettype;
use function is_object;
use function json_decode;
use function json_encode;
use function md5;
use function ord;
use const JSON_THROW_ON_ERROR;

final class LoginProcessor{

	private static function calculateUuidFromXuid(string $xuid) : UuidInterface{
		$hash = md5("pocket-auth-1-xuid:" . $xuid, true);

		$hash[6] = chr((ord($hash[6]) & 0x0f) | 0x30);
		$hash[8] = chr((ord($hash[8]) & 0x3f) | 0x80);

		return Uuid::fromBytes($hash);
	}

	public static function process(NetworkSession $session, LoginPacket $packet) : AuthResult{
		$authInfoJson = json_decode(
			$packet->authInfoJson,
			false,
			flags: JSON_THROW_ON_ERROR
		);

		if(!is_object($authInfoJson)){
			throw new \RuntimeException(
				"Unexpected auth info type: " . gettype($authInfoJson)
			);
		}

		$mapper = self::createMapper();

		$authInfo = $mapper->map(
			$authInfoJson,
			new AuthenticationInfo()
		);

		try{
			[, $authClaims] = JwtUtils::parse($authInfo->Token);
		}catch(JwtException $e){
			throw new \RuntimeException(
				"Failed parsing auth token: " . $e->getMessage()
			);
		}

		$authenticated = false;
		$authRequired = true;
		$clientPublicKey = null;

		if($authInfo->AuthenticationType === AuthenticationType::FULL->value){
			$username = (string) $authClaims["xname"];
			$xuid = (string) $authClaims["xid"];
			$uuid = self::calculateUuidFromXuid($xuid);

			$clientPublicKey = base64_decode(
				(string) $authClaims["cpk"],
				true
			);

			if($clientPublicKey === false){
				throw new \RuntimeException("Invalid self-signed key");
			}

			$authenticated = true;

		}elseif($authInfo->AuthenticationType === AuthenticationType::SELF_SIGNED->value){
			$username = (string) $authClaims["xname"];
			$xuid = "";

			if(!Uuid::isValid((string) $authClaims["leguuid"])){
				throw new \RuntimeException("Invalid UUID");
			}

			$uuid = Uuid::fromString((string) $authClaims["leguuid"]);

			$clientPublicKey = base64_decode(
				(string) $authClaims["cpk"],
				true
			);

			if($clientPublicKey === false){
				throw new \RuntimeException("Invalid self-signed key");
			}
		}else{
			throw new \RuntimeException("Unsupported authentication type");
		}

		if(!Player::isValidUserName($username)){
			throw new \RuntimeException("Invalid username");
		}

		try{
			[, $clientClaims] = JwtUtils::parse($packet->clientDataJwt);
		}catch(JwtException $e){
			throw new \RuntimeException(
				"Failed parsing client data: " . $e->getMessage()
			);
		}

		ClientDataUpgrader::upgrade($clientClaims);

		$clientClaimsObject = json_decode(
			json_encode($clientClaims, JSON_THROW_ON_ERROR),
			false,
			flags: JSON_THROW_ON_ERROR
		);

		$clientData = $mapper->map(
			$clientClaimsObject,
			new ClientData()
		);

		try{
			$skin = $session->getTypeConverter()
				->getSkinAdapter()
				->fromSkinData(
					ClientDataToSkinDataHelper::fromClientData($clientData)
				);

		}catch(\InvalidArgumentException | InvalidSkinException $e){
			throw new \RuntimeException(
				"Invalid skin: " . $e->getMessage()
			);
		}

		$playerInfo = $xuid !== ""
			? new XboxLivePlayerInfo(
				$xuid,
				$username,
				$uuid,
				$skin,
				$clientData->LanguageCode,
				(array) $clientData
			)
			: new PlayerInfo(
				$username,
				$uuid,
				$skin,
				$clientData->LanguageCode,
				(array) $clientData
			);

		return new AuthResult(
			$playerInfo,
			$clientClaims,
			$authenticated,
			$authRequired,
			$clientPublicKey
		);
	}

	public static function complete(NetworkSession $session, AuthResult $result) : void{
		$reflection = new \ReflectionObject($session);

		$infoProperty = $reflection->getProperty("info");
		$infoProperty->setAccessible(true);
		$infoProperty->setValue($session, $result->playerInfo);

		$connectedProperty = $reflection->getProperty("connected");
		$connectedProperty->setAccessible(true);
		$connectedProperty->setValue($session, true);

		$authMethod = $reflection->getMethod("setAuthenticationStatus");
		$authMethod->setAccessible(true);

		$authMethod->invoke(
			$session,
			$result->authenticated,
			$result->authRequired,
			null,
			$result->clientPublicKey
		);
	}

	private static function createMapper() : \JsonMapper{
		$mapper = new \JsonMapper();
		$mapper->bExceptionOnMissingData = true;
		$mapper->bStrictObjectTypeChecking = true;
		$mapper->bEnforceMapType = false;
		return $mapper;
	}
}