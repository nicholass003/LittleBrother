<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\Type;

/** @since v975 */
class PresenceConfig{

    /** @since v1001 */
    public readonly string $richPresenceId;

    public function __construct(
        public readonly string $experienceName,
        public readonly string $worldName,
        string $richPresenceId = ''
    ){
        $this->richPresenceId = $richPresenceId;
    }
}