<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Camera;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum\CameraSetInstructionEaseType;

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