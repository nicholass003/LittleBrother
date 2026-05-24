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

namespace Nicholass003\LittleBrother\Command;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\CortexPE\Commando\BaseCommand;
use Nicholass003\LittleBrother\LittleBrother;
use Nicholass003\LittleBrother\Protocol\ProtocolVersion;
use pocketmine\command\CommandSender;
use pocketmine\network\mcpe\protocol\ProtocolInfo;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;
use pocketmine\utils\TextFormat;

class ProtocolCommand extends BaseCommand{

	/** @var LittleBrother */
	protected Plugin $plugin;

	protected function prepare() : void{
		$this->setPermission('littlebrother.command');
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void{
		$sender->sendMessage(TextFormat::GRAY . "-----------------------------");

		if($sender instanceof Player){
			$protocolVersion = $this->plugin->getProtocolStorage()->get($sender->getNetworkSession());

			if($protocolVersion === null){
				$sender->sendMessage(TextFormat::RED . "Protocol version could not be detected.");
				return;
			}

			$mcVersion = ProtocolVersion::MINECRAFT_VERSIONS[$protocolVersion] ?? "Unknown";

			$sender->sendMessage(
				TextFormat::AQUA . "Your Client Information\n" .
				TextFormat::GRAY . " - Protocol Version : " . TextFormat::GREEN . $protocolVersion . "\n" .
				TextFormat::GRAY . " - Minecraft Version : " . TextFormat::YELLOW . $mcVersion
			);
		}

		$sender->sendMessage("");
		$sender->sendMessage(
			TextFormat::LIGHT_PURPLE . "Server Information\n" .
			TextFormat::GRAY . " - Current Protocol : " . TextFormat::GREEN . ProtocolInfo::CURRENT_PROTOCOL
		);

		$sender->sendMessage("");
		$sender->sendMessage(TextFormat::LIGHT_PURPLE . "Supported Protocols:");

		foreach(ProtocolVersion::SUPPORTED_PROTOCOLS as $protocol){
			$mcVersion = ProtocolVersion::MINECRAFT_VERSIONS[$protocol] ?? "Unknown";

			$sender->sendMessage(
				TextFormat::GRAY . " - " .
				TextFormat::GREEN . "v{$protocol} " .
				TextFormat::GRAY . "(" . TextFormat::YELLOW . $mcVersion . TextFormat::GRAY . ")"
			);
		}

		$sender->sendMessage(TextFormat::GRAY . "-----------------------------");
	}

}