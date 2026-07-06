<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\Camera;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type\Vec3;
use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum\CameraSetInstructionEaseType;

class CameraRotationOption{

    /** 
     * @since v924
     * @var CameraSetInstructionEaseType $easeType
     */
    public readonly CameraSetInstructionEaseType $easeType;

    public function __construct(
        public readonly Vec3 $value,
        public readonly float $time,
        CameraSetInstructionEaseType $easeType = CameraSetInstructionEaseType::LINEAR
    ){
        $this->easeType = $easeType;
    }
}