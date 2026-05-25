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

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\ItemStack;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\ItemStackWrapper;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet\Packet;

abstract class ItemStackWrapperTranslationHandler extends RuntimeIdTranslationHandler{

	/**
	 * @param Packet $packet   The decoded packet (will be modified in place)
	 * @param int    $protocol The protocol we are translating TO
	 * @param bool   $inbound  true if inbound (client→server), false if outbound
	 */
	abstract public function translate(int $protocol, Packet $packet, bool $inbound) : void;

	/**
	 * @param ItemStackWrapper $wrapper
	 * @param int              $protocol
	 * @param bool             $inbound
	 *
	 * @return ItemStackWrapper
	 */
	protected function translateWrapper(ItemStackWrapper $wrapper, int $protocol, bool $inbound) : ItemStackWrapper{
		$stack = $wrapper->itemStack;

		// Null item stacks don't need mapping
		if($stack->id === 0 && $stack->count === 0 && $stack->blockRuntimeId === 0){
			return $wrapper; // keep as is
		}

		// Map blockRuntimeId (only if non‑zero)
		$newBlockRuntimeId = $stack->blockRuntimeId;
		if($newBlockRuntimeId !== 0){
			$newBlockRuntimeId = $this->translateBlockId($newBlockRuntimeId, $protocol, $inbound);
		}

		$newStack = new ItemStack(
			$stack->id,
			$stack->meta,
			$stack->count,
			$newBlockRuntimeId,
			$stack->rawExtraData
		);

		return new ItemStackWrapper($wrapper->stackId, $newStack, $wrapper->stackIdVariant);
	}

	/**
	 * @param ItemStackWrapper[] $wrappers
	 * @return ItemStackWrapper[]
	 */
	protected function translateWrappers(array $wrappers, int $protocol, bool $inbound) : array{
		$result = [];
		foreach($wrappers as $i => $wrapper){
			$result[$i] = $this->translateWrapper($wrapper, $protocol, $inbound);
		}
		return $result;
	}
}