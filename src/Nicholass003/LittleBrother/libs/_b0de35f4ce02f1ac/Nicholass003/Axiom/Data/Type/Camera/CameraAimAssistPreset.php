<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Camera;

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