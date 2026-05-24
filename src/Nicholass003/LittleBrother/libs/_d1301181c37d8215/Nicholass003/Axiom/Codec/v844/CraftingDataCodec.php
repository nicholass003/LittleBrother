<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\v844;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Codec;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Recipe\FurnaceRecipe;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Recipe\MultiRecipe;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Recipe\RecipeWithTypeId;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Recipe\ShapedRecipe;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Recipe\ShapelessRecipe;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Recipe\SmithingTransformRecipe;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Recipe\SmithingTrimRecipe;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet\CraftingDataPacket;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet\Packet;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class CraftingDataCodec implements Codec{

    public function decode(ByteBufferReader $in, CodecType $codec) : CraftingDataPacket{
        $pk = new CraftingDataPacket();
        $recipeCount = VarInt::readUnsignedInt($in);
        for($i = 0; $i < $recipeCount; ++$i){
            $recipeType = VarInt::readSignedInt($in);
            $pk->recipesWithTypeIds[] = $this->readRecipeWithTypeId($in, $recipeType, $codec);
        }
        $potionTypeCount = VarInt::readUnsignedInt($in);
        for($i = 0; $i < $potionTypeCount; ++$i){
            $pk->potionTypeRecipes[] = $codec->recipe()->readPotionTypeRecipe($in);
        }
        $potionContainerCount = VarInt::readUnsignedInt($in);
        for($i = 0; $i < $potionContainerCount; ++$i){
            $pk->potionContainerRecipes[] = $codec->recipe()->readPotionContainerChangeRecipe($in);
        }
        $materialReducerCount = VarInt::readUnsignedInt($in);
        for($i = 0; $i < $materialReducerCount; ++$i){
            $pk->materialReducerRecipes[] = $codec->recipe()->readMaterialReducerRecipe($in);
        }
        $pk->cleanRecipes = CodecHelper::readBool($in);
        return $pk;
    }

    public function encode(ByteBufferWriter $out, Packet $pk, CodecType $codec) : void{
        assert($pk instanceof CraftingDataPacket);
        VarInt::writeUnsignedInt($out, count($pk->recipesWithTypeIds));
        foreach($pk->recipesWithTypeIds as $recipe){
            VarInt::writeSignedInt($out, $recipe->typeId);
            $this->writeRecipeWithTypeId($out, $recipe, $codec);
        }
        VarInt::writeUnsignedInt($out, count($pk->potionTypeRecipes));
        foreach($pk->potionTypeRecipes as $recipe){
            $codec->recipe()->writePotionTypeRecipe($out, $recipe);
        }
        VarInt::writeUnsignedInt($out, count($pk->potionContainerRecipes));
        foreach($pk->potionContainerRecipes as $recipe){
            $codec->recipe()->writePotionContainerChangeRecipe($out, $recipe);
        }
        VarInt::writeUnsignedInt($out, count($pk->materialReducerRecipes));
        foreach($pk->materialReducerRecipes as $recipe){
            $codec->recipe()->writeMaterialReducerRecipe($out, $recipe);
        }
        CodecHelper::writeBool($out, $pk->cleanRecipes);
    }

    protected function readRecipeWithTypeId(ByteBufferReader $in, int $recipeType, CodecType $codec) : RecipeWithTypeId{
        return match($recipeType){
            CraftingDataPacket::ENTRY_SHAPELESS,
            CraftingDataPacket::ENTRY_USER_DATA_SHAPELESS,
            CraftingDataPacket::ENTRY_SHAPELESS_CHEMISTRY => $this->readShapelessRecipe($in, $recipeType, $codec),
            CraftingDataPacket::ENTRY_SHAPED,
            CraftingDataPacket::ENTRY_SHAPED_CHEMISTRY => $this->readShapedRecipe($in, $recipeType, $codec),
            CraftingDataPacket::ENTRY_FURNACE,
            CraftingDataPacket::ENTRY_FURNACE_DATA => $this->readFurnaceRecipe($in, $recipeType),
            CraftingDataPacket::ENTRY_MULTI => $this->readMultiRecipe($in, $recipeType),
            CraftingDataPacket::ENTRY_SMITHING_TRANSFORM => $this->readSmithingTransformRecipe($in, $recipeType, $codec),
            CraftingDataPacket::ENTRY_SMITHING_TRIM => $this->readSmithingTrimRecipe($in, $recipeType, $codec),
            default => throw new \RuntimeException("Unknown recipe type $recipeType")
        };
    }

    protected function writeRecipeWithTypeId(ByteBufferWriter $out, RecipeWithTypeId $recipe, CodecType $codec) : void{
        if($recipe instanceof ShapelessRecipe){
            $this->writeShapelessRecipe($out, $recipe, $codec);
        }elseif($recipe instanceof ShapedRecipe){
            $this->writeShapedRecipe($out, $recipe, $codec);
        }elseif($recipe instanceof FurnaceRecipe){
            $this->writeFurnaceRecipe($out, $recipe);
        }elseif($recipe instanceof MultiRecipe){
            $this->writeMultiRecipe($out, $recipe);
        }elseif($recipe instanceof SmithingTransformRecipe){
            $this->writeSmithingTransformRecipe($out, $recipe, $codec);
        }elseif($recipe instanceof SmithingTrimRecipe){
            $this->writeSmithingTrimRecipe($out, $recipe, $codec);
        }else{
            throw new \RuntimeException("Unknown recipe type " . $recipe::class);
        }
    }

    protected function readShapelessRecipe(ByteBufferReader $in, int $typeId, CodecType $codec) : ShapelessRecipe{
        $recipeId = CodecHelper::readString($in);
        $inputs = [];
        $inputCount = VarInt::readUnsignedInt($in);
        for($i = 0; $i < $inputCount; ++$i){
            $inputs[] = $codec->recipe()->readIngredient($in);
        }
        $outputs = [];
        $outputCount = VarInt::readUnsignedInt($in);
        for($i = 0; $i < $outputCount; ++$i){
            $outputs[] = CodecHelper::readItemStackWithoutStackId($in);
        }
        $uuid = CodecHelper::readUuid($in);
        $blockName = CodecHelper::readString($in);
        $priority = VarInt::readSignedInt($in);
        $unlockingRequirement = $codec->recipe()->readUnlockingRequirement($in);
        $recipeNetId = CodecHelper::readRecipeNetId($in);
        return new ShapelessRecipe($typeId, $recipeId, $inputs, $outputs, $uuid, $blockName, $priority, $unlockingRequirement, $recipeNetId);
    }

    protected function writeShapelessRecipe(ByteBufferWriter $out, ShapelessRecipe $recipe, CodecType $codec) : void{
        CodecHelper::writeString($out, $recipe->recipeId);
        VarInt::writeUnsignedInt($out, count($recipe->inputs));
        foreach($recipe->inputs as $ingredient){
            $codec->recipe()->writeIngredient($out, $ingredient);
        }
        VarInt::writeUnsignedInt($out, count($recipe->outputs));
        foreach($recipe->outputs as $item){
            CodecHelper::writeItemStackWithoutStackId($out, $item);
        }
        CodecHelper::writeUuid($out, $recipe->uuid);
        CodecHelper::writeString($out, $recipe->blockName);
        VarInt::writeSignedInt($out, $recipe->priority);
        $codec->recipe()->writeUnlockingRequirement($out, $recipe->unlockingRequirement);
        CodecHelper::writeRecipeNetId($out, $recipe->recipeNetId);
    }

    protected function readShapedRecipe(ByteBufferReader $in, int $typeId, CodecType $codec) : ShapedRecipe{
        $recipeId = CodecHelper::readString($in);
        $width = VarInt::readSignedInt($in);
        $height = VarInt::readSignedInt($in);
        $input = [];
        for($row = 0; $row < $height; ++$row){
            $rowData = [];
            for($col = 0; $col < $width; ++$col){
                $rowData[] = $codec->recipe()->readIngredient($in);
            }
            $input[] = $rowData;
        }
        $output = [];
        $outputCount = VarInt::readUnsignedInt($in);
        for($i = 0; $i < $outputCount; ++$i){
            $output[] = CodecHelper::readItemStackWithoutStackId($in);
        }
        $uuid = CodecHelper::readUuid($in);
        $blockName = CodecHelper::readString($in);
        $priority = VarInt::readSignedInt($in);
        $symmetric = CodecHelper::readBool($in);
        $unlockingRequirement = $codec->recipe()->readUnlockingRequirement($in);
        $recipeNetId = CodecHelper::readRecipeNetId($in);
        return new ShapedRecipe($typeId, $recipeId, $input, $output, $uuid, $blockName, $priority, $symmetric, $unlockingRequirement, $recipeNetId);
    }

    protected function writeShapedRecipe(ByteBufferWriter $out, ShapedRecipe $recipe, CodecType $codec) : void{
        CodecHelper::writeString($out, $recipe->recipeId);
        VarInt::writeSignedInt($out, count($recipe->input[0] ?? []));
        VarInt::writeSignedInt($out, count($recipe->input));
        foreach($recipe->input as $row){
            foreach($row as $ingredient){
                $codec->recipe()->writeIngredient($out, $ingredient);
            }
        }
        VarInt::writeUnsignedInt($out, count($recipe->output));
        foreach($recipe->output as $item){
            CodecHelper::writeItemStackWithoutStackId($out, $item);
        }
        CodecHelper::writeUuid($out, $recipe->uuid);
        CodecHelper::writeString($out, $recipe->blockName);
        VarInt::writeSignedInt($out, $recipe->priority);
        CodecHelper::writeBool($out, $recipe->symmetric);
        $codec->recipe()->writeUnlockingRequirement($out, $recipe->unlockingRequirement);
        CodecHelper::writeRecipeNetId($out, $recipe->recipeNetId);
    }

    protected function readFurnaceRecipe(ByteBufferReader $in, int $typeId) : FurnaceRecipe{
        $inputId = VarInt::readSignedInt($in);
        $inputMeta = null;
        if($typeId === CraftingDataPacket::ENTRY_FURNACE_DATA){
            $inputMeta = VarInt::readSignedInt($in);
        }
        $result = CodecHelper::readItemStackWithoutStackId($in);
        $blockName = CodecHelper::readString($in);
        return new FurnaceRecipe($typeId, $inputId, $inputMeta, $result, $blockName);
    }

    protected function writeFurnaceRecipe(ByteBufferWriter $out, FurnaceRecipe $recipe) : void{
        VarInt::writeSignedInt($out, $recipe->inputId);
        if($recipe->typeId === CraftingDataPacket::ENTRY_FURNACE_DATA){
            VarInt::writeSignedInt($out, $recipe->inputMeta);
        }
        CodecHelper::writeItemStackWithoutStackId($out, $recipe->result);
        CodecHelper::writeString($out, $recipe->blockName);
    }

    protected function readSmithingTransformRecipe(ByteBufferReader $in, int $typeId, CodecType $codec) : SmithingTransformRecipe{
        $recipeId = CodecHelper::readString($in);
        $template = $codec->recipe()->readIngredient($in);
        $input = $codec->recipe()->readIngredient($in);
        $addition = $codec->recipe()->readIngredient($in);
        $output = CodecHelper::readItemStackWithoutStackId($in);
        $blockName = CodecHelper::readString($in);
        $recipeNetId = CodecHelper::readRecipeNetId($in);
        return new SmithingTransformRecipe($typeId, $recipeId, $template, $input, $addition, $output, $blockName, $recipeNetId);
    }

    protected function writeSmithingTransformRecipe(ByteBufferWriter $out, SmithingTransformRecipe $recipe, CodecType $codec) : void{
        CodecHelper::writeString($out, $recipe->recipeId);
        $codec->recipe()->writeIngredient($out, $recipe->template);
        $codec->recipe()->writeIngredient($out, $recipe->input);
        $codec->recipe()->writeIngredient($out, $recipe->addition);
        CodecHelper::writeItemStackWithoutStackId($out, $recipe->output);
        CodecHelper::writeString($out, $recipe->blockName);
        CodecHelper::writeRecipeNetId($out, $recipe->recipeNetId);
    }

    protected function readSmithingTrimRecipe(ByteBufferReader $in, int $typeId, CodecType $codec) : SmithingTrimRecipe{
        $recipeId = CodecHelper::readString($in);
        $template = $codec->recipe()->readIngredient($in);
        $input = $codec->recipe()->readIngredient($in);
        $addition = $codec->recipe()->readIngredient($in);
        $blockName = CodecHelper::readString($in);
        $recipeNetId = CodecHelper::readRecipeNetId($in);
        return new SmithingTrimRecipe($typeId, $recipeId, $template, $input, $addition, $blockName, $recipeNetId);
    }

    protected function writeSmithingTrimRecipe(ByteBufferWriter $out, SmithingTrimRecipe $recipe, CodecType $codec) : void{
        CodecHelper::writeString($out, $recipe->recipeId);
        $codec->recipe()->writeIngredient($out, $recipe->template);
        $codec->recipe()->writeIngredient($out, $recipe->input);
        $codec->recipe()->writeIngredient($out, $recipe->addition);
        CodecHelper::writeString($out, $recipe->blockName);
        CodecHelper::writeRecipeNetId($out, $recipe->recipeNetId);
    }

    protected function readMultiRecipe(ByteBufferReader $in, int $typeId) : MultiRecipe{
        $uuid = CodecHelper::readUuid($in);
        $recipeNetId = CodecHelper::readRecipeNetId($in);
        return new MultiRecipe($typeId, $uuid, $recipeNetId);
    }

    protected function writeMultiRecipe(ByteBufferWriter $out, MultiRecipe $recipe) : void{
        CodecHelper::writeUuid($out, $recipe->recipeId);
        CodecHelper::writeRecipeNetId($out, $recipe->recipeNetId);
    }
}