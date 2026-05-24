<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\EntityDiagnosticTimingInfo;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\MemoryCategoryCounter;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\SystemDiagnosticTimingInfo;

class ServerboundDiagnosticsPacket implements Packet{

    public const ID = PacketIds::SERVERBOUND_DIAGNOSTICS;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public float $avgFps;
    public float $avgServerSimTickTimeMS;
    public float $avgClientSimTickTimeMS;
    public float $avgBeginFrameTimeMS;
    public float $avgInputTimeMS;
    public float $avgRenderTimeMS;
    public float $avgEndFrameTimeMS;
    public float $avgRemainderTimePercent;
    public float $avgUnaccountedTimePercent;

    /** 
     * @since v924
     * @var list<MemoryCategoryCounter>
     */
    public array $memoryCategoryValues = [];
    /** 
     * @since v975
     * @var list<EntityDiagnosticTimingInfo>
     */
    public array $entityDiagnostics = [];
    /** 
     * @since v975
     * @var list<SystemDiagnosticTimingInfo>
     */
    public array $systemDiagnostics = [];

}