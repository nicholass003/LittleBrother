<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Graphics\ParameterKeyframeValue;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Vec3;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Enum\GraphicsOverrideParameterType;

/** @since v859 */
class GraphicsOverrideParameterPacket implements Packet{

    public const ID = PacketIds::GRAPHICS_OVERRIDE_PARAMETER;
    public const RECIPIENT = PacketRecipient::CLIENT;

    /** @var list<ParameterKeyframeValue> */
    public array $values = [];
    /** @since v924 */
    public ?float $unknownFloat = null;
    /** @since v924 */
    public ?Vec3 $unknownVec3 = null;
    public string $biomeIdentifier;
    public GraphicsOverrideParameterType $parameterType;
    public bool $reset;
}