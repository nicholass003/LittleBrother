<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\ResourcePack;

class ResourcePackInfoEntry{

    public function __construct(
        public readonly string $packId,
        public readonly string $version,
        public readonly int $sizeBytes,
        public readonly string $encryptionKey,
        public readonly string $subPackName,
        public readonly string $contentId,
        public readonly bool $hasScripts,
        public readonly bool $isAddonPack,
        public readonly bool $isRtxCapable,
        public readonly string $cdnUrl
    ){}
}