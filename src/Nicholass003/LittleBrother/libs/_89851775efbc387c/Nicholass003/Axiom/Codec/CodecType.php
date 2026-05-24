<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Armor\ArmorSlotAndDamagePairSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\ArmorSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\AttributeSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeCappedSurfaceDataSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeClimateDataSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeConditionalTransformationDataSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeConsolidatedFeatureDataSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeConsolidatedFeaturesDataSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeCoordinateDataSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeDefinitionChunkGenDataSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeDefinitionDataSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeElementDataSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeLegacyWorldGenRulesDataSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeMesaSurfaceDataSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeMountainParamsDataSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeMultinoiseGenRulesDataSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeOverworldGenRulesDataSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeScatterParamDataSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeSurfaceMaterialAdjustmentDataSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeSurfaceMaterialDataSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeWeightedDataSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeWeightedTemperatureDataSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\BiomeSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\BlockPaletteSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Camera\CameraAimAssistCategorySerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Camera\CameraAimAssistPresetSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Camera\CameraInstructionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Camera\CameraPresetSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Camera\Instruction\CameraFadeInstructionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Camera\Instruction\CameraFovInstructionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Camera\Instruction\CameraSetInstructionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Camera\Instruction\CameraTargetInstructionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Camera\Preset\CameraPresetAimAssistSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\CameraAimAssistSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Command\ChainedSubCommandDataSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Command\CommandDataSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Command\CommandEnumConstraintSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Command\CommandEnumSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Command\CommandOriginDataSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Command\CommandOutputMessageSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Command\CommandOverloadSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Command\CommandParameterSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Command\CommandSoftEnumSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\CommandSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Debug\PacketShapeDataSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\DebugSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Enchant\EnchantOptionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Enchant\EnchantSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\EnchantmentSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\EntityMetadataSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\ExperimentsSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\GameRulesSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\FullContainerNameSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\InventoryTransactionDataSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\ItemInteractionDataSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\ItemStackRequestActionsSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\ItemStackRequestSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\ItemStackResponseSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\NetworkInventoryActionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\PlayerBlockActionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\StackRequest\BeaconPaymentStackRequestActionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\StackRequest\CraftingConsumeInputStackRequestActionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\StackRequest\CraftingCreateSpecificResultStackRequestActionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\StackRequest\CraftRecipeAutoStackRequestActionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\StackRequest\CraftRecipeOptionalStackRequestActionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\StackRequest\CraftRecipeStackRequestActionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\StackRequest\CreativeCreateStackRequestActionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\StackRequest\DeprecatedCraftingNonImplementedStackRequestActionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\StackRequest\DeprecatedCraftingResultsStackRequestActionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\StackRequest\DestroyStackRequestActionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\StackRequest\DropStackRequestActionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\StackRequest\GrindstoneStackRequestActionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\StackRequest\LabTableCombineStackRequestActionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\StackRequest\LoomStackRequestActionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\StackRequest\MineBlockStackRequestActionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\StackRequest\PlaceStackRequestActionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\StackRequest\SwapStackRequestActionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\StackRequest\TakeStackRequestActionSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\InventorySerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\LevelSettingsSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Map\MapDecorationSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Map\MapImageSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Map\MapInfoRequestPacketClientPixelSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Map\MapTrackedObjectSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\MapSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\NetworkPermissionsSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\PlayerMovementSettingsSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\PropertySyncSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\RecipeSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Scoreboard\ScoreboardIdentityPacketEntrySerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Scoreboard\ScorePacketEntrySerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\ScoreboardSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\SkinSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Structure\StructureEditorDataSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Structure\StructureSettingsSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\StructureSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\SubChunk\SubChunkPacketEntryCommonSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\SubChunk\SubChunkPacketHeightMapInfoSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\SubChunk\UpdateSubChunkBlocksPacketEntrySerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\SubChunkSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Trim\TrimMaterialSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Trim\TrimPatternSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\TrimSerializer;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Enum\ItemStackRequestActionType;

class CodecType implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private InventorySerializer $inventory,
        private SkinSerializer $skin,
        private LevelSettingsSerializer $levelSettings,
        private EntityMetadataSerializer $entityMetadata,
        private RecipeSerializer $recipe,
        private AttributeSerializer $attribute,
        private ExperimentsSerializer $experiments,
        private GameRulesSerializer $gameRules,
        private BlockPaletteSerializer $blockPalette,
        private PropertySyncSerializer $propertySync,
        private PlayerBlockActionSerializer $blockAction,
        private PlayerMovementSettingsSerializer $movementSettings,
        private NetworkPermissionsSerializer $networkPermissions,
        private CommandSerializer $command,
        private BiomeSerializer $biome,
        private CameraAimAssistSerializer $cameraAimAssist,
        private CameraInstructionSerializer $cameraInstruction,
        private CameraPresetSerializer $cameraPreset,
        private MapSerializer $map,
        private ScoreboardSerializer $scoreboard,
        private ArmorSerializer $armor,
        private EnchantmentSerializer $enchantment,
        private SubChunkSerializer $subChunk,
        private StructureSerializer $structure,
        private DebugSerializer $debug,
        private TrimSerializer $trim,
    ){}

    public function inventory() : InventorySerializer{ return $this->inventory; }
    public function skin() : SkinSerializer{ return $this->skin; }
    public function levelSettings() : LevelSettingsSerializer{ return $this->levelSettings; }
    public function entityMetadata() : EntityMetadataSerializer{ return $this->entityMetadata; }
    public function recipe() : RecipeSerializer{ return $this->recipe; }
    public function attribute() : AttributeSerializer{ return $this->attribute; }
    public function experiments() : ExperimentsSerializer{ return $this->experiments; }
    public function gameRules() : GameRulesSerializer{ return $this->gameRules; }
    public function blockPalette() : BlockPaletteSerializer{ return $this->blockPalette; }
    public function propertySync() : PropertySyncSerializer{ return $this->propertySync; }
    public function blockAction() : PlayerBlockActionSerializer{ return $this->blockAction; }
    public function movementSettings() : PlayerMovementSettingsSerializer{ return $this->movementSettings; }
    public function networkPermissions() : NetworkPermissionsSerializer{ return $this->networkPermissions; }
    public function command() : CommandSerializer{ return $this->command; }
    public function biome() : BiomeSerializer{ return $this->biome; }
    public function cameraAimAssist() : CameraAimAssistSerializer{ return $this->cameraAimAssist; }
    public function cameraInstruction() : CameraInstructionSerializer{ return $this->cameraInstruction; }
    public function cameraPreset() : CameraPresetSerializer{ return $this->cameraPreset; }
    public function map() : MapSerializer{ return $this->map; }
    public function scoreboard() : ScoreboardSerializer{ return $this->scoreboard; }
    public function armor() : ArmorSerializer{ return $this->armor; }
    public function enchantment() : EnchantmentSerializer{ return $this->enchantment; }
    public function subChunk() : SubChunkSerializer{ return $this->subChunk; }
    public function structure() : StructureSerializer{ return $this->structure; }
    public function debug() : DebugSerializer{ return $this->debug; }
    public function trim() : TrimSerializer{ return $this->trim; }

    public function withInventory(InventorySerializer $v) : self{ return $this->with('inventory', $v); }
    public function withSkin(SkinSerializer $v) : self{ return $this->with('skin', $v); }
    public function withLevelSettings(LevelSettingsSerializer $v) : self{ return $this->with('levelSettings', $v); }
    public function withEntityMetadata(EntityMetadataSerializer $v) : self{ return $this->with('entityMetadata', $v); }
    public function withRecipe(RecipeSerializer $v) : self{ return $this->with('recipe', $v); }
    public function withAttribute(AttributeSerializer $v) : self{ return $this->with('attribute', $v); }
    public function withExperiments(ExperimentsSerializer $v) : self{ return $this->with('experiments', $v); }
    public function withGameRules(GameRulesSerializer $v) : self{ return $this->with('gameRules', $v); }
    public function withBlockPalette(BlockPaletteSerializer $v) : self{ return $this->with('blockPalette', $v); }
    public function withPropertySync(PropertySyncSerializer $v) : self{ return $this->with('propertySync', $v); }
    public function withBlockAction(PlayerBlockActionSerializer $v) : self{ return $this->with('blockAction', $v); }
    public function withMovementSettings(PlayerMovementSettingsSerializer $v) : self{ return $this->with('movementSettings', $v); }
    public function withNetworkPermissions(NetworkPermissionsSerializer $v) : self{ return $this->with('networkPermissions', $v); }
    public function withCommand(CommandSerializer $v) : self{ return $this->with('command', $v); }
    public function withBiome(BiomeSerializer $v) : self{ return $this->with('biome', $v); }
    public function withCameraAimAssist(CameraAimAssistSerializer $v) : self{ return $this->with('cameraAimAssist', $v); }
    public function withCameraInstruction(CameraInstructionSerializer $v) : self{ return $this->with('cameraInstruction', $v); }
    public function withCameraPreset(CameraPresetSerializer $v) : self{ return $this->with('cameraPreset', $v); }
    public function withMap(MapSerializer $v) : self{ return $this->with('map', $v); }
    public function withScoreboard(ScoreboardSerializer $v) : self{ return $this->with('scoreboard', $v); }
    public function withArmor(ArmorSerializer $v) : self{ return $this->with('armor', $v); }
    public function withEnchantment(EnchantmentSerializer $v) : self{ return $this->with('enchantment', $v); }
    public function withSubChunk(SubChunkSerializer $v) : self{ return $this->with('subChunk', $v); }
    public function withStructure(StructureSerializer $v) : self{ return $this->with('structure', $v); }
    public function withDebug(DebugSerializer $v) : self{ return $this->with('debug', $v); }
    public function withTrim(TrimSerializer $v) : self{ return $this->with('trim', $v); }

    public static function createDefault() : self{
        $actionsRegistry = new ItemStackRequestActionsSerializer();
        $actionsRegistry
            ->register(ItemStackRequestActionType::TAKE, new TakeStackRequestActionSerializer())
            ->register(ItemStackRequestActionType::PLACE, new PlaceStackRequestActionSerializer())
            ->register(ItemStackRequestActionType::SWAP, new SwapStackRequestActionSerializer())
            ->register(ItemStackRequestActionType::DROP, new DropStackRequestActionSerializer())
            ->register(ItemStackRequestActionType::DESTROY, new DestroyStackRequestActionSerializer())
            ->register(ItemStackRequestActionType::CRAFTING_CONSUME_INPUT, new CraftingConsumeInputStackRequestActionSerializer())
            ->register(ItemStackRequestActionType::CRAFTING_CREATE_SPECIFIC_RESULT, new CraftingCreateSpecificResultStackRequestActionSerializer())
            ->register(ItemStackRequestActionType::LAB_TABLE_COMBINE, new LabTableCombineStackRequestActionSerializer())
            ->register(ItemStackRequestActionType::BEACON_PAYMENT, new BeaconPaymentStackRequestActionSerializer())
            ->register(ItemStackRequestActionType::MINE_BLOCK, new MineBlockStackRequestActionSerializer())
            ->register(ItemStackRequestActionType::CRAFTING_RECIPE, new CraftRecipeStackRequestActionSerializer())
            ->register(ItemStackRequestActionType::CRAFTING_RECIPE_AUTO, new CraftRecipeAutoStackRequestActionSerializer())
            ->register(ItemStackRequestActionType::CREATIVE_CREATE, new CreativeCreateStackRequestActionSerializer())
            ->register(ItemStackRequestActionType::CRAFTING_RECIPE_OPTIONAL, new CraftRecipeOptionalStackRequestActionSerializer())
            ->register(ItemStackRequestActionType::CRAFTING_GRINDSTONE, new GrindstoneStackRequestActionSerializer())
            ->register(ItemStackRequestActionType::CRAFTING_LOOM, new LoomStackRequestActionSerializer())
            ->register(ItemStackRequestActionType::CRAFTING_NON_IMPLEMENTED_DEPRECATED_ASK_TY_LAING, new DeprecatedCraftingNonImplementedStackRequestActionSerializer())
            ->register(ItemStackRequestActionType::CRAFTING_RESULTS_DEPRECATED_ASK_TY_LAING, new DeprecatedCraftingResultsStackRequestActionSerializer());

        $requestSerializer = new ItemStackRequestSerializer($actionsRegistry);
        $responseSerializer = new ItemStackResponseSerializer();
        $containerSerializer = new FullContainerNameSerializer();
        $actionSerializer = new NetworkInventoryActionSerializer();
        $transactionSerializer = new InventoryTransactionDataSerializer($actionSerializer);
        $interactionSerializer = new ItemInteractionDataSerializer($transactionSerializer);

        $inventory = new InventorySerializer(
            $requestSerializer,
            $responseSerializer,
            $containerSerializer,
            $actionSerializer,
            $transactionSerializer,
            $interactionSerializer
        );

        $skin = new SkinSerializer();
        $entityMetadata = new EntityMetadataSerializer();
        $recipe = new RecipeSerializer();
        $attribute = new AttributeSerializer();
        $experiments = new ExperimentsSerializer();
        $gameRules = new GameRulesSerializer();
        $blockPalette = new BlockPaletteSerializer();
        $propertySync = new PropertySyncSerializer();
        $movementSettings = new PlayerMovementSettingsSerializer();
        $networkPermissions = new NetworkPermissionsSerializer();
        $blockAction = PlayerBlockActionSerializer::createDefault();

        $levelSettings = new LevelSettingsSerializer($experiments, $gameRules);

        $parameter = new CommandParameterSerializer();
        $overload = new CommandOverloadSerializer($parameter);
        $commandData = new CommandDataSerializer($overload);

        $command = new CommandSerializer(
            new CommandEnumSerializer(),
            new ChainedSubCommandDataSerializer(),
            $commandData,
            new CommandSoftEnumSerializer(),
            new CommandEnumConstraintSerializer(),
            new CommandOriginDataSerializer(),
            new CommandOutputMessageSerializer()
        );

        $biome = new BiomeSerializer(
            new BiomeDefinitionDataSerializer(
                new BiomeDefinitionChunkGenDataSerializer(
                    new BiomeClimateDataSerializer(),
                    new BiomeConsolidatedFeaturesDataSerializer(
                        new BiomeConsolidatedFeatureDataSerializer(
                            new BiomeScatterParamDataSerializer(
                                new BiomeCoordinateDataSerializer()
                            )
                        )
                    ),
                    new BiomeMountainParamsDataSerializer(),
                    new BiomeSurfaceMaterialAdjustmentDataSerializer(
                        new BiomeElementDataSerializer(
                            new BiomeSurfaceMaterialDataSerializer()
                        )
                    ),
                    new BiomeSurfaceMaterialDataSerializer(),
                    new BiomeMesaSurfaceDataSerializer(),
                    new BiomeCappedSurfaceDataSerializer(),
                    new BiomeOverworldGenRulesDataSerializer(
                        new BiomeWeightedDataSerializer(),
                        new BiomeConditionalTransformationDataSerializer(new BiomeWeightedDataSerializer()),
                        new BiomeWeightedTemperatureDataSerializer()
                    ),
                    new BiomeMultinoiseGenRulesDataSerializer(),
                    new BiomeLegacyWorldGenRulesDataSerializer(
                        new BiomeConditionalTransformationDataSerializer(new BiomeWeightedDataSerializer())
                    )
                )
            )
        );

        $cameraAimAssist = new CameraAimAssistSerializer(
            new CameraAimAssistCategorySerializer(),
            new CameraAimAssistPresetSerializer()
        );

        $cameraInstruction = new CameraInstructionSerializer(
            new CameraSetInstructionSerializer(),
            new CameraFadeInstructionSerializer(),
            new CameraTargetInstructionSerializer(),
            new CameraFovInstructionSerializer()
        );

        $cameraPreset = new CameraPresetSerializer(
            new CameraPresetAimAssistSerializer()
        );

        $map = new MapSerializer(
            new MapTrackedObjectSerializer(),
            new MapDecorationSerializer(),
            new MapImageSerializer(),
            new MapInfoRequestPacketClientPixelSerializer()
        );

        $scoreboard = new ScoreboardSerializer(
            new ScorePacketEntrySerializer(),
            new ScoreboardIdentityPacketEntrySerializer()
        );

        $armor = new ArmorSerializer(new ArmorSlotAndDamagePairSerializer());

        $enchantment = new EnchantmentSerializer(
            new EnchantOptionSerializer(new EnchantSerializer())
        );

        $subChunk = new SubChunkSerializer(
            new SubChunkPacketHeightMapInfoSerializer(),
            new SubChunkPacketEntryCommonSerializer(
                new SubChunkPacketHeightMapInfoSerializer()
            ),
            new UpdateSubChunkBlocksPacketEntrySerializer()
        );

        $structureSettings = new StructureSettingsSerializer();

        $structure = new StructureSerializer(
            $structureSettings,
            new StructureEditorDataSerializer($structureSettings)
        );

        $debug = new DebugSerializer(
            new PacketShapeDataSerializer()
        );

        $trim = new TrimSerializer(
            new TrimPatternSerializer(),
            new TrimMaterialSerializer()
        );

        return new self(
            $inventory,
            $skin,
            $levelSettings,
            $entityMetadata,
            $recipe,
            $attribute,
            $experiments,
            $gameRules,
            $blockPalette,
            $propertySync,
            $blockAction,
            $movementSettings,
            $networkPermissions,
            $command,
            $biome,
            $cameraAimAssist,
            $cameraInstruction,
            $cameraPreset,
            $map,
            $scoreboard,
            $armor,
            $enchantment,
            $subChunk,
            $structure,
            $debug,
            $trim
        );
    }
}