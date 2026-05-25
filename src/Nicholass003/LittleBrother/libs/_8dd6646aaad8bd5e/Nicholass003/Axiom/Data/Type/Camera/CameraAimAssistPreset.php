<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Camera;

class CameraAimAssistPreset{

    /**
     * @param list<string> $liquidTargetingList
     * @param list<CameraAimAssistPresetItemSettings> $itemSettings
     */
    public function __construct(
        public readonly string $identifier,
        public readonly CameraAimAssistPresetExclusionDefinition $exclusionList,
        public readonly array $liquidTargetingList,
        public readonly array $itemSettings,
        public readonly ?string $defaultItemSettings,
        public readonly ?string $defaultHandSettings
    ){}
}