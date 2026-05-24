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

namespace Nicholass003\LittleBrother\Utils;

use Nicholass003\LittleBrother\LittleBrother;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use function date;
use function file_exists;
use function file_put_contents;
use function unlink;
use const FILE_APPEND;
use const LOCK_EX;
use const PHP_EOL;

class Debugger{

	private const LOG_FILE = "debug.log";

	public static function debug(string $message, bool $ignore = false, string $color = TextFormat::GRAY) : void{
		if($ignore){
			return;
		}
		$plugin = LittleBrother::getInstance();
		if(LittleBrother::IS_DEVELOPMENT || $plugin->isDebugEnabled){
			$server = Server::getInstance();
			$server->getLogger()->debug($color . $message . TextFormat::RESET);
		}
	}

	public static function log(string $message, bool $ignore = false) : void{
		if($ignore){
			return;
		}
		$plugin = LittleBrother::getInstance();
		if(LittleBrother::IS_DEVELOPMENT || $plugin->isLogEnabled){
			$time = date("Y-m-d H:i:s");
			$line = "[" . $time . "] " . $message . PHP_EOL;

			file_put_contents(
				Server::getInstance()->getDataPath() . self::LOG_FILE,
				$line,
				FILE_APPEND | LOCK_EX
			);
		}
	}

	public static function clear() : void{
		$file = Server::getInstance()->getDataPath() . self::LOG_FILE;
		if(file_exists($file)){
			unlink($file);
		}
	}
}