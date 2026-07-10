<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Inventory;

final class FullContainerName{

    public function __construct(
        public readonly int $containerId,
        public readonly ?int $dynamicId = null
    ){}
}