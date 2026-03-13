<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_445984b8c85f5437\muqsit\simplepackethandler\interceptor;

use Closure;
use pocketmine\network\mcpe\NetworkSession;
use pocketmine\network\mcpe\protocol\ClientboundPacket;
use pocketmine\network\mcpe\protocol\ServerboundPacket;

interface IPacketInterceptor{

	/**
	 * @template TServerboundPacket of ServerboundPacket
	 * @param Closure(TServerboundPacket, NetworkSession) : bool $handler
	 * @return IPacketInterceptor
	 */
	public function interceptIncoming(Closure $handler) : IPacketInterceptor;

	/**
	 * @template TClientboundPacket of ClientboundPacket
	 * @param Closure(TClientboundPacket, NetworkSession) : bool $handler
	 * @return IPacketInterceptor
	 */
	public function interceptOutgoing(Closure $handler) : IPacketInterceptor;

	/**
	 * @template TServerboundPacket of ServerboundPacket
	 * @param Closure(TServerboundPacket, NetworkSession) : bool $handler
	 * @return IPacketInterceptor
	 */
	public function unregisterIncomingInterceptor(Closure $handler) : IPacketInterceptor;

	/**
	 * @template TClientboundPacket of ClientboundPacket
	 * @param Closure(TClientboundPacket, NetworkSession) : bool $handler
	 * @return IPacketInterceptor
	 */
	public function unregisterOutgoingInterceptor(Closure $handler) : IPacketInterceptor;
}