<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Skin;

class SkinData{

    /**
     * @param SkinAnimation[] $animations
     * @param PersonaSkinPiece[] $personaPieces
     * @param PersonaPieceTintColor[] $pieceTintColors
     */
    public function __construct(
        public readonly string $skinId,
        public readonly string $playFabId,
        public readonly string $resourcePatch,
        public readonly SkinImage $skinImage,
        public readonly array $animations,
        public readonly SkinImage $capeImage,
        public readonly string $geometryData,
        public readonly string $geometryDataEngineVersion,
        public readonly string $animationData,
        public readonly string $capeId,
        public readonly string $fullSkinId,
        public readonly string $armSize,
        public readonly string $skinColor,
        public readonly array $personaPieces,
        public readonly array $pieceTintColors,
        public readonly bool $isPremium,
        public readonly bool $isPersona,
        public readonly bool $isPersonaCapeOnClassic,
        public readonly bool $isPrimaryUser,
        public readonly bool $isOverride,
        public readonly bool $isVerified
    ){}
}