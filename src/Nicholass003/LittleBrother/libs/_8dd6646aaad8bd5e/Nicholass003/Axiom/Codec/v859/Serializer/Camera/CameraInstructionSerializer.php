<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v859\Serializer\Camera;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Common\Serializer\Camera\CameraInstructionSerializer as BaseCameraInstructionSerializer;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Common\Serializer\Camera\Instruction\CameraFadeInstructionSerializer;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Common\Serializer\Camera\Instruction\CameraFovInstructionSerializer;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Common\Serializer\Camera\Instruction\CameraSetInstructionSerializer;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Common\Serializer\Camera\Instruction\CameraTargetInstructionSerializer;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v859\Serializer\Camera\Instruction\CameraSplineInstructionSerializer;

class CameraInstructionSerializer extends BaseCameraInstructionSerializer{

    public function __construct(
        CameraSetInstructionSerializer $set,
        CameraFadeInstructionSerializer $fade,
        CameraTargetInstructionSerializer $target,
        CameraFovInstructionSerializer $fov,
        private CameraSplineInstructionSerializer $splineSerializer
    ){
        parent::__construct($set, $fade, $target, $fov);
    }

    public function spline() : CameraSplineInstructionSerializer{ return $this->splineSerializer; }

    public function withSpline(CameraSplineInstructionSerializer $v) : self{ return $this->with('splineSerializer', $v); }
}