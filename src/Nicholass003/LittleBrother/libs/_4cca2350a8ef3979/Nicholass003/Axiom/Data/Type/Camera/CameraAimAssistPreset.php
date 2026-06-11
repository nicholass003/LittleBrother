<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Camera;

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