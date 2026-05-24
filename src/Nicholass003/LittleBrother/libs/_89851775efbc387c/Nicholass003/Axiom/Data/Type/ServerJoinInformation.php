<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type;

class ServerJoinInformation{

    /** @since v975 */
    public readonly ?ClientStoreEntrypointConfig $clientStoreEntrypointConfig;
    /** @since v975 */
    public readonly ?PresenceConfig $presenceConfig;

    public function __construct(
        public readonly ?GatheringJoinInfo $gatheringJoinInfo,
        ?ClientStoreEntrypointConfig $clientStoreEntrypointConfig = null,
        ?PresenceConfig $presenceConfig = null
    ){
        $this->clientStoreEntrypointConfig = $clientStoreEntrypointConfig;
        $this->presenceConfig = $presenceConfig;
    }
}