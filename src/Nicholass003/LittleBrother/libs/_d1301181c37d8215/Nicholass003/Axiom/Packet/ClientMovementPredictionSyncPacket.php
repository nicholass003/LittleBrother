<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Common\BitSet;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\PacketRecipient;

final class ClientMovementPredictionSyncPacket implements Packet{

    public const ID = PacketIds::CLIENT_MOVEMENT_PREDICTION_SYNC;
    public const RECIPIENT = PacketRecipient::SERVER;

    public BitSet $flags;
    public float $scale;
    public float $width;
    public float $height;
    public float $movementSpeed;
    public float $underwaterMovementSpeed;
    public float $lavaMovementSpeed;
    public float $jumpStrength;
    public float $health;
    public float $hunger;
    /** @since v975 */
	public float $frictionModifier = 0.0;
    /** @since v975 */
	public float $bounciness = 0.0;
    /** @since v975 */
	public float $airDragModifier = 0.0;

    public int $actorUniqueId;
    public bool $actorFlyingState;
}