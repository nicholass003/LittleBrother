<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Inventory;

final class FullContainerName{

    public function __construct(
        public readonly int $containerId,
        public readonly ?int $dynamicId = null
    ){}
}