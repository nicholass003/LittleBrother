<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Skin\SkinData;

class PlayerListEntry{

    public function __construct(
        public readonly string $uuid,
        public readonly ?int $actorUniqueId = null,
        public readonly ?string $username = null,
        public readonly ?string $xboxUserId = null,
        public readonly ?string $platformChatId = null,
        public readonly ?int $buildPlatform = null,
        public readonly ?SkinData $skinData = null,
        public readonly ?bool $isTeacher = null,
        public readonly ?bool $isHost = null,
        public readonly ?bool $isSubClient = null,
        public readonly ?int $color = null,
        public readonly ?bool $skinVerified = null
    ){}
}