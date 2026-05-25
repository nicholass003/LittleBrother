<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v924\Serializer;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Common\Serializer\Camera\CameraAimAssistCategorySerializer;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Common\Serializer\Camera\CameraAimAssistPresetSerializer;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Common\Serializer\CameraAimAssistSerializer as BaseCameraAimAssistSerializer;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\v924\Serializer\Camera\CameraAimAssistActorPrioritySerializer;

class CameraAimAssistSerializer extends BaseCameraAimAssistSerializer{

    public function __construct(
        CameraAimAssistCategorySerializer $categorySerializer,
        CameraAimAssistPresetSerializer $presetSerializer,
        private CameraAimAssistActorPrioritySerializer $actorPrioritySerializer
    ){
        parent::__construct($categorySerializer, $presetSerializer);
    }

    public function actorPriority() : CameraAimAssistActorPrioritySerializer{ return $this->actorPrioritySerializer; }

    public function withActorPriority(CameraAimAssistActorPrioritySerializer $v) : self{ return $this->with('actorPrioritySerializer', $v); }
}