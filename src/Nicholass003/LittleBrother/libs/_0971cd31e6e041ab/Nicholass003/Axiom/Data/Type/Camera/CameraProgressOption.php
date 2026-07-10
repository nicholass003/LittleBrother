<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Camera;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\CameraSetInstructionEaseType;

class CameraProgressOption{

    /** 
     * @since v924
     * @var CameraSetInstructionEaseType $easeType
     */
    public readonly CameraSetInstructionEaseType $easeType;

    public function __construct(
        public readonly float $value,
        public readonly float $time,
        CameraSetInstructionEaseType $easeType = CameraSetInstructionEaseType::LINEAR,
    ){
        $this->easeType = $easeType;
    }
}