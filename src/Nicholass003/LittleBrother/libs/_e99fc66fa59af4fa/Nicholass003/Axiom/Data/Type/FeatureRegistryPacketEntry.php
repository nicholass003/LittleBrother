<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type;

final class FeatureRegistryPacketEntry{

    public function __construct(
        public readonly string $featureName,
        public readonly string $featureJson
    ){}
}