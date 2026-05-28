<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Education\EducationUriResource;

class LevelSettingsData{

    /** @deprecated v924 */
    public readonly string $serverIdentifier;
    /** @deprecated v924 */
    public readonly string $worldIdentifier;
    /** @deprecated v924 */
    public readonly string $scenarioIdentifier;
    /** @deprecated v924 */
    public readonly string $ownerIdentifier;
    /** @since v1001 */
    public readonly int $serverEditorConnectionPolicy;
    /** @since v1001 */
    public readonly bool $allowAnonymousBlockDropsInEditorWorlds;

    /**
     * @param array<string, mixed> $gameRules
     */
    public function __construct(
        public readonly int $seed,
        public readonly SpawnSettings $spawnSettings,
        public readonly int $generator,
        public readonly int $worldGamemode,
        public readonly bool $hardcore,
        public readonly int $difficulty,
        public readonly BlockPosition $spawnPosition,
        public readonly bool $hasAchievementsDisabled,
        public readonly int $editorWorldType,
        public readonly bool $createdInEditorMode,
        public readonly bool $exportedFromEditorMode,
        public readonly int $time,
        public readonly int $eduEditionOffer,
        public readonly bool $hasEduFeaturesEnabled,
        public readonly string $eduProductUUID,
        public readonly float $rainLevel,
        public readonly float $lightningLevel,
        public readonly bool $hasConfirmedPlatformLockedContent,
        public readonly bool $isMultiplayerGame,
        public readonly bool $hasLANBroadcast,
        public readonly int $xboxLiveBroadcastMode,
        public readonly int $platformBroadcastMode,
        public readonly bool $commandsEnabled,
        public readonly bool $isTexturePacksRequired,
        public readonly array $gameRules,
        public readonly Experiments $experiments,
        public readonly bool $hasBonusChestEnabled,
        public readonly bool $hasStartWithMapEnabled,
        public readonly int $defaultPlayerPermission,
        public readonly int $serverChunkTickRadius,
        public readonly bool $hasLockedBehaviorPack,
        public readonly bool $hasLockedResourcePack,
        public readonly bool $isFromLockedWorldTemplate,
        public readonly bool $useMsaGamertagsOnly,
        public readonly bool $isFromWorldTemplate,
        public readonly bool $isWorldTemplateOptionLocked,
        public readonly bool $onlySpawnV1Villagers,
        public readonly bool $disablePersona,
        public readonly bool $disableCustomSkins,
        public readonly bool $muteEmoteAnnouncements,
        public readonly string $vanillaVersion,
        public readonly int $limitedWorldWidth,
        public readonly int $limitedWorldLength,
        public readonly bool $isNewNether,
        public readonly ?EducationUriResource $eduSharedUriResource,
        public readonly ?bool $experimentalGameplayOverride,
        public readonly int $chatRestrictionLevel,
        public readonly bool $disablePlayerInteractions,
        string $serverIdentifier = '',
        string $worldIdentifier = '',
        string $scenarioIdentifier = '',
        string $ownerIdentifier = '',
        int $serverEditorConnectionPolicy = 0,
        bool $allowAnonymousBlockDropsInEditorWorlds = false
    ){
        $this->serverIdentifier = $serverIdentifier;
        $this->worldIdentifier = $worldIdentifier;
        $this->scenarioIdentifier = $scenarioIdentifier;
        $this->ownerIdentifier = $ownerIdentifier;
        $this->serverEditorConnectionPolicy = $serverEditorConnectionPolicy;
        $this->allowAnonymousBlockDropsInEditorWorlds = $allowAnonymousBlockDropsInEditorWorlds;
    }
}