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

use pocketmine\network\mcpe\NetworkSession;
use function count;

final class ProtocolStorage{

	/** @var \SplObjectStorage<NetworkSession, int> */
	private \SplObjectStorage $protocols;

	public function __construct(){
		$this->protocols = new \SplObjectStorage();
	}

	public function set(NetworkSession $session, int $protocol) : void{
		$this->protocols[$session] = $protocol;
	}

	public function get(NetworkSession $session) : ?int{
		return isset($this->protocols[$session]) ? $this->protocols[$session] : null;
	}

	public function remove(NetworkSession $session) : void{
		if($this->protocols->contains($session)){
			$this->protocols->detach($session);
		}
	}

	public function has(NetworkSession $session) : bool{
		return $this->protocols->contains($session);
	}

	public function count() : int{
		return count($this->protocols);
	}
}