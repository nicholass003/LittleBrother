<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Version\Protocol;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecBuilder;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ActorEventCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ActorPickRequestCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\AddActorCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\AddBehaviorTreeCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\AddItemActorCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\AddPaintingCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\AddPlayerCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\AddVolumeEntityCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\AgentActionEventCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\AgentAnimationCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\AnimateCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\AnimateEntityCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\AnvilDamageCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\AutomationClientConnectCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\AvailableActorIdentifiersCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\AvailableCommandsCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\AwardAchievementCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\BiomeDefinitionListCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\BlockActorDataCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\BlockEventCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\BlockPickRequestCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\BookEditCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\BossEventCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\CameraAimAssistCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\CameraAimAssistPresetsCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\CameraCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\CameraInstructionCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\CameraPresetsCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\CameraShakeCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ChangeDimensionCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ChangeMobPropertyCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ChunkRadiusUpdatedCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ClientboundCloseFormCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ClientboundControlSchemeSetCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ClientboundDebugRendererCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ClientboundMapItemDataCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ClientCacheBlobStatusCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ClientCacheMissResponseCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ClientCacheStatusCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ClientCameraAimAssistCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ClientMovementPredictionSyncCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ClientToServerHandshakeCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\CodeBuilderCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\CodeBuilderSourceCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\CommandBlockUpdateCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\CommandOutputCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\CommandRequestCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\CompletedUsingItemCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ContainerCloseCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ContainerOpenCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ContainerRegistryCleanupCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ContainerSetDataCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\CorrectPlayerMovePredictionCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\CraftingDataCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\CreatePhotoCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\CreativeContentCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\CurrentStructureFeatureCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\DeathInfoCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\DebugInfoCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\DimensionDataCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\DisconnectCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\EditorNetworkCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\EducationSettingsCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\EduUriResourceCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\EmoteCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\EmoteListCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\FeatureRegistryCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\GameRulesChangedCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\GameTestRequestCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\GameTestResultsCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\GuiDataPickItemCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\HurtArmorCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\InteractCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\InventoryContentCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\InventorySlotCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\InventoryTransactionCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ItemRegistryCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ItemStackRequestCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ItemStackResponseCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\JigsawStructureDataCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\LabTableCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\LecternUpdateCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\LegacyTelemetryEventCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\LessonProgressCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\LevelChunkCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\LevelEventCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\LevelEventGenericCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\LevelSoundEventCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\LoginCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\MapCreateLockedCopyCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\MapInfoRequestCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\MobArmorEquipmentCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\MobEffectCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\MobEquipmentCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ModalFormRequestCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ModalFormResponseCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\MotionPredictionHintsCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\MoveActorAbsoluteCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\MoveActorDeltaCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\MovementEffectCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\MovePlayerCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\MultiplayerSettingsCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\NetworkChunkPublisherUpdateCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\NetworkSettingsCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\NetworkStackLatencyCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\NpcDialogueCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\NpcRequestCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\OnScreenTextureAnimationCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\OpenSignCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\PacketViolationWarningCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\PhotoTransferCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\PlayerActionCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\PlayerArmorDamageCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\PlayerAuthInputCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\PlayerEnchantOptionsCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\PlayerFogCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\PlayerHotbarCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\PlayerListCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\PlayerLocationCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\PlayerSkinCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\PlayerStartItemCooldownCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\PlayerToggleCrafterSlotRequestCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\PlayerUpdateEntityOverridesCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\PlayerVideoCaptureCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\PlaySoundCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\PlayStatusCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\PositionTrackingDBClientRequestCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\PositionTrackingDBServerBroadcastCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\PrimitiveShapesCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\PurchaseReceiptCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\RefreshEntitlementsCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\RemoveActorCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\RemoveObjectiveCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\RemoveVolumeEntityCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\RequestAbilityCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\RequestChunkRadiusCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\RequestNetworkSettingsCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\RequestPermissionsCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ResourcePackChunkDataCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ResourcePackChunkRequestCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ResourcePackClientResponseCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ResourcePackDataInfoCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ResourcePacksInfoCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ResourcePackStackCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\RespawnCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ScriptMessageCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ServerboundDiagnosticsCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ServerboundLoadingScreenCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ServerboundPackSettingChangeCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ServerPlayerPostMovePositionCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ServerSettingsRequestCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ServerSettingsResponseCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ServerStatsCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ServerToClientHandshakeCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\SetActorDataCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\SetActorLinkCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\SetActorMotionCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\SetCommandsEnabledCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\SetDefaultGameTypeCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\SetDifficultyCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\SetDisplayObjectiveCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\SetHealthCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\SetHudCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\SetLastHurtByCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\SetLocalPlayerAsInitializedCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\SetPlayerGameTypeCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\SetPlayerInventoryOptionsCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\SetScoreboardIdentityCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\SetScoreCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\SetSpawnPositionCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\SetTimeCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\SettingsCommandCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\SetTitleCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ShowCreditsCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ShowProfileCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ShowStoreOfferCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\SimpleEventCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\SimulationTypeCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\SpawnExperienceOrbCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\SpawnParticleEffectCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\StartGameCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\StopSoundCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\StructureBlockUpdateCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\StructureTemplateDataRequestCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\StructureTemplateDataResponseCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\SubChunkCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\SubChunkRequestCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\SubClientLoginCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\SyncActorPropertyCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\TakeItemActorCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\TextCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\TickingAreasLoadStatusCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\ToastRequestCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\TransferCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\TrimDataCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\UnlockedRecipesCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\UpdateAbilitiesCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\UpdateAdventureSettingsCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\UpdateAttributesCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\UpdateBlockCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\UpdateBlockSyncedCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\UpdateClientInputLocksCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\UpdateClientOptionsCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\UpdateEquipCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\UpdatePlayerGameTypeCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\UpdateSoftEnumCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\UpdateSubChunkBlocksCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v844\UpdateTradeCodec;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ActorEventPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ActorPickRequestPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\AddActorPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\AddBehaviorTreePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\AddItemActorPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\AddPaintingPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\AddPlayerPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\AddVolumeEntityPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\AgentActionEventPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\AgentAnimationPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\AnimateEntityPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\AnimatePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\AnvilDamagePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\AutomationClientConnectPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\AvailableActorIdentifiersPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\AvailableCommandsPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\AwardAchievementPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\BiomeDefinitionListPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\BlockActorDataPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\BlockEventPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\BlockPickRequestPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\BookEditPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\BossEventPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\CameraAimAssistPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\CameraAimAssistPresetsPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\CameraInstructionPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\CameraPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\CameraPresetsPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\CameraShakePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ChangeDimensionPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ChangeMobPropertyPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ChunkRadiusUpdatedPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ClientboundCloseFormPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ClientboundControlSchemeSetPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ClientboundDebugRendererPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ClientboundMapItemDataPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ClientCacheBlobStatusPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ClientCacheMissResponsePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ClientCacheStatusPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ClientCameraAimAssistPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ClientMovementPredictionSyncPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ClientToServerHandshakePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\CodeBuilderPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\CodeBuilderSourcePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\CommandBlockUpdatePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\CommandOutputPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\CommandRequestPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\CompletedUsingItemPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ContainerClosePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ContainerOpenPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ContainerRegistryCleanupPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ContainerSetDataPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\CorrectPlayerMovePredictionPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\CraftingDataPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\CreatePhotoPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\CreativeContentPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\CurrentStructureFeaturePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\DeathInfoPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\DebugInfoPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\DimensionDataPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\DisconnectPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\EditorNetworkPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\EducationSettingsPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\EduUriResourcePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\EmoteListPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\EmotePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\FeatureRegistryPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\GameRulesChangedPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\GameTestRequestPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\GameTestResultsPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\GuiDataPickItemPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\HurtArmorPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\InteractPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\InventoryContentPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\InventorySlotPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\InventoryTransactionPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ItemRegistryPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ItemStackRequestPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ItemStackResponsePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\JigsawStructureDataPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\LabTablePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\LecternUpdatePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\LegacyTelemetryEventPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\LessonProgressPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\LevelChunkPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\LevelEventGenericPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\LevelEventPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\LevelSoundEventPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\LoginPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\MapCreateLockedCopyPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\MapInfoRequestPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\MobArmorEquipmentPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\MobEffectPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\MobEquipmentPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ModalFormRequestPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ModalFormResponsePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\MotionPredictionHintsPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\MoveActorAbsolutePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\MoveActorDeltaPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\MovementEffectPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\MovePlayerPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\MultiplayerSettingsPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\NetworkChunkPublisherUpdatePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\NetworkSettingsPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\NetworkStackLatencyPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\NpcDialoguePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\NpcRequestPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\OnScreenTextureAnimationPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\OpenSignPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\PacketViolationWarningPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\PhotoTransferPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\PlayerActionPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\PlayerArmorDamagePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\PlayerAuthInputPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\PlayerEnchantOptionsPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\PlayerFogPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\PlayerHotbarPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\PlayerListPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\PlayerLocationPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\PlayerSkinPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\PlayerStartItemCooldownPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\PlayerToggleCrafterSlotRequestPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\PlayerUpdateEntityOverridesPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\PlayerVideoCapturePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\PlaySoundPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\PlayStatusPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\PositionTrackingDBClientRequestPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\PositionTrackingDBServerBroadcastPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\PrimitiveShapesPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\PurchaseReceiptPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\RefreshEntitlementsPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\RemoveActorPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\RemoveObjectivePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\RemoveVolumeEntityPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\RequestAbilityPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\RequestChunkRadiusPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\RequestNetworkSettingsPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\RequestPermissionsPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ResourcePackChunkDataPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ResourcePackChunkRequestPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ResourcePackClientResponsePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ResourcePackDataInfoPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ResourcePacksInfoPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ResourcePackStackPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\RespawnPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ScriptMessagePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ServerboundDiagnosticsPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ServerboundLoadingScreenPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ServerboundPackSettingChangePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ServerPlayerPostMovePositionPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ServerSettingsRequestPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ServerSettingsResponsePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ServerStatsPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ServerToClientHandshakePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\SetActorDataPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\SetActorLinkPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\SetActorMotionPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\SetCommandsEnabledPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\SetDefaultGameTypePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\SetDifficultyPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\SetDisplayObjectivePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\SetHealthPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\SetHudPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\SetLastHurtByPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\SetLocalPlayerAsInitializedPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\SetPlayerGameTypePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\SetPlayerInventoryOptionsPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\SetScoreboardIdentityPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\SetScorePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\SetSpawnPositionPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\SetTimePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\SettingsCommandPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\SetTitlePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ShowCreditsPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ShowProfilePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ShowStoreOfferPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\SimpleEventPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\SimulationTypePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\SpawnExperienceOrbPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\SpawnParticleEffectPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\StartGamePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\StopSoundPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\StructureBlockUpdatePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\StructureTemplateDataRequestPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\StructureTemplateDataResponsePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\SubChunkPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\SubChunkRequestPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\SubClientLoginPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\SyncActorPropertyPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\TakeItemActorPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\TextPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\TickingAreasLoadStatusPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\ToastRequestPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\TransferPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\TrimDataPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\UnlockedRecipesPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\UpdateAbilitiesPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\UpdateAdventureSettingsPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\UpdateAttributesPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\UpdateBlockPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\UpdateBlockSyncedPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\UpdateClientInputLocksPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\UpdateClientOptionsPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\UpdateEquipPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\UpdatePlayerGameTypePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\UpdateSoftEnumPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\UpdateSubChunkBlocksPacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet\UpdateTradePacket;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Version\ProtocolVersion;

class Protocol844 implements ProtocolInterface{

    public static function buildCodecType() : CodecType{
        return CodecType::createDefault();
    }

    public static function build() : CodecBuilder{
        return CodecBuilder::create(ProtocolVersion::v844, "1.21.111", self::buildCodecType())
            ->register(LoginPacket::ID, new LoginCodec())
            ->register(PlayStatusPacket::ID, new PlayStatusCodec())
            ->register(ServerToClientHandshakePacket::ID, new ServerToClientHandshakeCodec())
            ->register(ClientToServerHandshakePacket::ID, new ClientToServerHandshakeCodec())
            ->register(DisconnectPacket::ID, new DisconnectCodec())
            ->register(ResourcePacksInfoPacket::ID, new ResourcePacksInfoCodec())
            ->register(ResourcePackStackPacket::ID, new ResourcePackStackCodec())
            ->register(ResourcePackClientResponsePacket::ID, new ResourcePackClientResponseCodec())
            ->register(TextPacket::ID, new TextCodec())
            ->register(SetTimePacket::ID, new SetTimeCodec())
            ->register(StartGamePacket::ID, new StartGameCodec())
            ->register(AddPlayerPacket::ID, new AddPlayerCodec())
            ->register(AddActorPacket::ID, new AddActorCodec())
            ->register(RemoveActorPacket::ID, new RemoveActorCodec())
            ->register(AddItemActorPacket::ID, new AddItemActorCodec())
            ->register(ServerPlayerPostMovePositionPacket::ID, new ServerPlayerPostMovePositionCodec())
            ->register(TakeItemActorPacket::ID, new TakeItemActorCodec())
            ->register(MoveActorAbsolutePacket::ID, new MoveActorAbsoluteCodec())
            ->register(MovePlayerPacket::ID, new MovePlayerCodec())
            ->register(UpdateBlockPacket::ID, new UpdateBlockCodec())
            ->register(AddPaintingPacket::ID, new AddPaintingCodec())
            ->register(LevelEventPacket::ID, new LevelEventCodec())
            ->register(BlockEventPacket::ID, new BlockEventCodec())
            ->register(ActorEventPacket::ID, new ActorEventCodec())
            ->register(MobEffectPacket::ID, new MobEffectCodec())
            ->register(UpdateAttributesPacket::ID, new UpdateAttributesCodec())
            ->register(InventoryTransactionPacket::ID, new InventoryTransactionCodec())
            ->register(MobEquipmentPacket::ID, new MobEquipmentCodec())
            ->register(MobArmorEquipmentPacket::ID, new MobArmorEquipmentCodec())
            ->register(InteractPacket::ID, new InteractCodec())
            ->register(BlockPickRequestPacket::ID, new BlockPickRequestCodec())
            ->register(ActorPickRequestPacket::ID, new ActorPickRequestCodec())
            ->register(PlayerActionPacket::ID, new PlayerActionCodec())
            ->register(HurtArmorPacket::ID, new HurtArmorCodec())
            ->register(SetActorDataPacket::ID, new SetActorDataCodec())
            ->register(SetActorMotionPacket::ID, new SetActorMotionCodec())
            ->register(SetActorLinkPacket::ID, new SetActorLinkCodec())
            ->register(SetHealthPacket::ID, new SetHealthCodec())
            ->register(SetSpawnPositionPacket::ID, new SetSpawnPositionCodec())
            ->register(AnimatePacket::ID, new AnimateCodec())
            ->register(RespawnPacket::ID, new RespawnCodec())
            ->register(ContainerOpenPacket::ID, new ContainerOpenCodec())
            ->register(ContainerClosePacket::ID, new ContainerCloseCodec())
            ->register(PlayerHotbarPacket::ID, new PlayerHotbarCodec())
            ->register(InventoryContentPacket::ID, new InventoryContentCodec())
            ->register(InventorySlotPacket::ID, new InventorySlotCodec())
            ->register(ContainerSetDataPacket::ID, new ContainerSetDataCodec())
            ->register(CraftingDataPacket::ID, new CraftingDataCodec())
            ->register(GuiDataPickItemPacket::ID, new GuiDataPickItemCodec())
            ->register(BlockActorDataPacket::ID, new BlockActorDataCodec())
            ->register(LevelChunkPacket::ID, new LevelChunkCodec())
            ->register(SetCommandsEnabledPacket::ID, new SetCommandsEnabledCodec())
            ->register(SetDifficultyPacket::ID, new SetDifficultyCodec())
            ->register(ChangeDimensionPacket::ID, new ChangeDimensionCodec())
            ->register(SetPlayerGameTypePacket::ID, new SetPlayerGameTypeCodec())
            ->register(PlayerListPacket::ID, new PlayerListCodec())
            ->register(SimpleEventPacket::ID, new SimpleEventCodec())
            ->register(LegacyTelemetryEventPacket::ID, new LegacyTelemetryEventCodec())
            ->register(SpawnExperienceOrbPacket::ID, new SpawnExperienceOrbCodec())
            ->register(ClientboundMapItemDataPacket::ID, new ClientboundMapItemDataCodec())
            ->register(MapInfoRequestPacket::ID, new MapInfoRequestCodec())
            ->register(RequestChunkRadiusPacket::ID, new RequestChunkRadiusCodec())
            ->register(ChunkRadiusUpdatedPacket::ID, new ChunkRadiusUpdatedCodec())
            ->register(GameRulesChangedPacket::ID, new GameRulesChangedCodec())
            ->register(CameraPacket::ID, new CameraCodec())
            ->register(BossEventPacket::ID, new BossEventCodec())
            ->register(ShowCreditsPacket::ID, new ShowCreditsCodec())
            ->register(AvailableCommandsPacket::ID, new AvailableCommandsCodec())
            ->register(CommandRequestPacket::ID, new CommandRequestCodec())
            ->register(CommandBlockUpdatePacket::ID, new CommandBlockUpdateCodec())
            ->register(CommandOutputPacket::ID, new CommandOutputCodec())
            ->register(UpdateTradePacket::ID, new UpdateTradeCodec())
            ->register(UpdateEquipPacket::ID, new UpdateEquipCodec())
            ->register(ResourcePackDataInfoPacket::ID, new ResourcePackDataInfoCodec())
            ->register(ResourcePackChunkDataPacket::ID, new ResourcePackChunkDataCodec())
            ->register(ResourcePackChunkRequestPacket::ID, new ResourcePackChunkRequestCodec())
            ->register(TransferPacket::ID, new TransferCodec())
            ->register(PlaySoundPacket::ID, new PlaySoundCodec())
            ->register(StopSoundPacket::ID, new StopSoundCodec())
            ->register(SetTitlePacket::ID, new SetTitleCodec())
            ->register(AddBehaviorTreePacket::ID, new AddBehaviorTreeCodec())
            ->register(StructureBlockUpdatePacket::ID, new StructureBlockUpdateCodec())
            ->register(ShowStoreOfferPacket::ID, new ShowStoreOfferCodec())
            ->register(PurchaseReceiptPacket::ID, new PurchaseReceiptCodec())
            ->register(PlayerSkinPacket::ID, new PlayerSkinCodec())
            ->register(SubClientLoginPacket::ID, new SubClientLoginCodec())
            ->register(AutomationClientConnectPacket::ID, new AutomationClientConnectCodec())
            ->register(SetLastHurtByPacket::ID, new SetLastHurtByCodec())
            ->register(BookEditPacket::ID, new BookEditCodec())
            ->register(NpcRequestPacket::ID, new NpcRequestCodec())
            ->register(PhotoTransferPacket::ID, new PhotoTransferCodec())
            ->register(ModalFormRequestPacket::ID, new ModalFormRequestCodec())
            ->register(ModalFormResponsePacket::ID, new ModalFormResponseCodec())
            ->register(ServerSettingsRequestPacket::ID, new ServerSettingsRequestCodec())
            ->register(ServerSettingsResponsePacket::ID, new ServerSettingsResponseCodec())
            ->register(ShowProfilePacket::ID, new ShowProfileCodec())
            ->register(SetDefaultGameTypePacket::ID, new SetDefaultGameTypeCodec())
            ->register(RemoveObjectivePacket::ID, new RemoveObjectiveCodec())
            ->register(SetDisplayObjectivePacket::ID, new SetDisplayObjectiveCodec())
            ->register(SetScorePacket::ID, new SetScoreCodec())
            ->register(LabTablePacket::ID, new LabTableCodec())
            ->register(UpdateBlockSyncedPacket::ID, new UpdateBlockSyncedCodec())
            ->register(MoveActorDeltaPacket::ID, new MoveActorDeltaCodec())
            ->register(SetScoreboardIdentityPacket::ID, new SetScoreboardIdentityCodec())
            ->register(SetLocalPlayerAsInitializedPacket::ID, new SetLocalPlayerAsInitializedCodec())
            ->register(UpdateSoftEnumPacket::ID, new UpdateSoftEnumCodec())
            ->register(NetworkStackLatencyPacket::ID, new NetworkStackLatencyCodec())
            ->register(SpawnParticleEffectPacket::ID, new SpawnParticleEffectCodec())
            ->register(AvailableActorIdentifiersPacket::ID, new AvailableActorIdentifiersCodec())
            ->register(NetworkChunkPublisherUpdatePacket::ID, new NetworkChunkPublisherUpdateCodec())
            ->register(BiomeDefinitionListPacket::ID, new BiomeDefinitionListCodec())
            ->register(LevelSoundEventPacket::ID, new LevelSoundEventCodec())
            ->register(LevelEventGenericPacket::ID, new LevelEventGenericCodec())
            ->register(LecternUpdatePacket::ID, new LecternUpdateCodec())
            ->register(ClientCacheStatusPacket::ID, new ClientCacheStatusCodec())
            ->register(OnScreenTextureAnimationPacket::ID, new OnScreenTextureAnimationCodec())
            ->register(MapCreateLockedCopyPacket::ID, new MapCreateLockedCopyCodec())
            ->register(StructureTemplateDataRequestPacket::ID, new StructureTemplateDataRequestCodec())
            ->register(StructureTemplateDataResponsePacket::ID, new StructureTemplateDataResponseCodec())
            ->register(ClientCacheBlobStatusPacket::ID, new ClientCacheBlobStatusCodec())
            ->register(ClientCacheMissResponsePacket::ID, new ClientCacheMissResponseCodec())
            ->register(EducationSettingsPacket::ID, new EducationSettingsCodec())
            ->register(EmotePacket::ID, new EmoteCodec())
            ->register(MultiplayerSettingsPacket::ID, new MultiplayerSettingsCodec())
            ->register(SettingsCommandPacket::ID, new SettingsCommandCodec())
            ->register(AnvilDamagePacket::ID, new AnvilDamageCodec())
            ->register(CompletedUsingItemPacket::ID, new CompletedUsingItemCodec())
            ->register(NetworkSettingsPacket::ID, new NetworkSettingsCodec())
            ->register(PlayerAuthInputPacket::ID, new PlayerAuthInputCodec())
            ->register(CreativeContentPacket::ID, new CreativeContentCodec())
            ->register(PlayerEnchantOptionsPacket::ID, new PlayerEnchantOptionsCodec())
            ->register(ItemStackRequestPacket::ID, new ItemStackRequestCodec())
            ->register(ItemStackResponsePacket::ID, new ItemStackResponseCodec())
            ->register(PlayerArmorDamagePacket::ID, new PlayerArmorDamageCodec())
            ->register(CodeBuilderPacket::ID, new CodeBuilderCodec())
            ->register(UpdatePlayerGameTypePacket::ID, new UpdatePlayerGameTypeCodec())
            ->register(EmoteListPacket::ID, new EmoteListCodec())
            ->register(PositionTrackingDBServerBroadcastPacket::ID, new PositionTrackingDBServerBroadcastCodec())
            ->register(PositionTrackingDBClientRequestPacket::ID, new PositionTrackingDBClientRequestCodec())
            ->register(DebugInfoPacket::ID, new DebugInfoCodec())
            ->register(PacketViolationWarningPacket::ID, new PacketViolationWarningCodec())
            ->register(MotionPredictionHintsPacket::ID, new MotionPredictionHintsCodec())
            ->register(AnimateEntityPacket::ID, new AnimateEntityCodec())
            ->register(CameraShakePacket::ID, new CameraShakeCodec())
            ->register(PlayerFogPacket::ID, new PlayerFogCodec())
            ->register(CorrectPlayerMovePredictionPacket::ID, new CorrectPlayerMovePredictionCodec())
            ->register(ItemRegistryPacket::ID, new ItemRegistryCodec())
            ->register(ClientboundDebugRendererPacket::ID, new ClientboundDebugRendererCodec())
            ->register(SyncActorPropertyPacket::ID, new SyncActorPropertyCodec())
            ->register(AddVolumeEntityPacket::ID, new AddVolumeEntityCodec())
            ->register(RemoveVolumeEntityPacket::ID, new RemoveVolumeEntityCodec())
            ->register(SimulationTypePacket::ID, new SimulationTypeCodec())
            ->register(NpcDialoguePacket::ID, new NpcDialogueCodec())
            ->register(EduUriResourcePacket::ID, new EduUriResourceCodec())
            ->register(CreatePhotoPacket::ID, new CreatePhotoCodec())
            ->register(UpdateSubChunkBlocksPacket::ID, new UpdateSubChunkBlocksCodec())
            ->register(SubChunkPacket::ID, new SubChunkCodec())
            ->register(SubChunkRequestPacket::ID, new SubChunkRequestCodec())
            ->register(PlayerStartItemCooldownPacket::ID, new PlayerStartItemCooldownCodec())
            ->register(ScriptMessagePacket::ID, new ScriptMessageCodec())
            ->register(CodeBuilderSourcePacket::ID, new CodeBuilderSourceCodec())
            ->register(TickingAreasLoadStatusPacket::ID, new TickingAreasLoadStatusCodec())
            ->register(DimensionDataPacket::ID, new DimensionDataCodec())
            ->register(AgentActionEventPacket::ID, new AgentActionEventCodec())
            ->register(ChangeMobPropertyPacket::ID, new ChangeMobPropertyCodec())
            ->register(LessonProgressPacket::ID, new LessonProgressCodec())
            ->register(RequestAbilityPacket::ID, new RequestAbilityCodec())
            ->register(RequestPermissionsPacket::ID, new RequestPermissionsCodec())
            ->register(ToastRequestPacket::ID, new ToastRequestCodec())
            ->register(UpdateAbilitiesPacket::ID, new UpdateAbilitiesCodec())
            ->register(UpdateAdventureSettingsPacket::ID, new UpdateAdventureSettingsCodec())
            ->register(DeathInfoPacket::ID, new DeathInfoCodec())
            ->register(EditorNetworkPacket::ID, new EditorNetworkCodec())
            ->register(FeatureRegistryPacket::ID, new FeatureRegistryCodec())
            ->register(ServerStatsPacket::ID, new ServerStatsCodec())
            ->register(RequestNetworkSettingsPacket::ID, new RequestNetworkSettingsCodec())
            ->register(GameTestRequestPacket::ID, new GameTestRequestCodec())
            ->register(GameTestResultsPacket::ID, new GameTestResultsCodec())
            ->register(UpdateClientInputLocksPacket::ID, new UpdateClientInputLocksCodec())
            ->register(CameraPresetsPacket::ID, new CameraPresetsCodec())
            ->register(UnlockedRecipesPacket::ID, new UnlockedRecipesCodec())
            ->register(CameraInstructionPacket::ID, new CameraInstructionCodec())
            ->register(TrimDataPacket::ID, new TrimDataCodec())
            ->register(OpenSignPacket::ID, new OpenSignCodec())
            ->register(AgentAnimationPacket::ID, new AgentAnimationCodec())
            ->register(RefreshEntitlementsPacket::ID, new RefreshEntitlementsCodec())
            ->register(PlayerToggleCrafterSlotRequestPacket::ID, new PlayerToggleCrafterSlotRequestCodec())
            ->register(SetPlayerInventoryOptionsPacket::ID, new SetPlayerInventoryOptionsCodec())
            ->register(SetHudPacket::ID, new SetHudCodec())
            ->register(AwardAchievementPacket::ID, new AwardAchievementCodec())
            ->register(ClientboundCloseFormPacket::ID, new ClientboundCloseFormCodec())
            ->register(ServerboundLoadingScreenPacket::ID, new ServerboundLoadingScreenCodec())
            ->register(JigsawStructureDataPacket::ID, new JigsawStructureDataCodec())
            ->register(CurrentStructureFeaturePacket::ID, new CurrentStructureFeatureCodec())
            ->register(ServerboundDiagnosticsPacket::ID, new ServerboundDiagnosticsCodec())
            ->register(CameraAimAssistPacket::ID, new CameraAimAssistCodec())
            ->register(ContainerRegistryCleanupPacket::ID, new ContainerRegistryCleanupCodec())
            ->register(MovementEffectPacket::ID, new MovementEffectCodec())
            ->register(CameraAimAssistPresetsPacket::ID, new CameraAimAssistPresetsCodec())
            ->register(ClientCameraAimAssistPacket::ID, new ClientCameraAimAssistCodec())
            ->register(ClientMovementPredictionSyncPacket::ID, new ClientMovementPredictionSyncCodec())
            ->register(UpdateClientOptionsPacket::ID, new UpdateClientOptionsCodec())
            ->register(PlayerVideoCapturePacket::ID, new PlayerVideoCaptureCodec())
            ->register(PlayerUpdateEntityOverridesPacket::ID, new PlayerUpdateEntityOverridesCodec())
            ->register(PlayerLocationPacket::ID, new PlayerLocationCodec())
            ->register(ClientboundControlSchemeSetPacket::ID, new ClientboundControlSchemeSetCodec())
            ->register(PrimitiveShapesPacket::ID, new PrimitiveShapesCodec())
            ->register(ServerboundPackSettingChangePacket::ID, new ServerboundPackSettingChangeCodec());
    }
}