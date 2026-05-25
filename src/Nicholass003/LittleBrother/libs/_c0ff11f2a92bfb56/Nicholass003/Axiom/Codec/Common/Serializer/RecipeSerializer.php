<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Common\Serializer;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Recipe\ComplexAliasItemDescriptor;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Recipe\IntIdMetaItemDescriptor;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Recipe\ItemDescriptor;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Recipe\MaterialReducerRecipe;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Recipe\MaterialReducerRecipeOutput;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Recipe\MolangItemDescriptor;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Recipe\PotionContainerChangeRecipe;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Recipe\PotionTypeRecipe;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Recipe\RecipeIngredient;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Recipe\RecipeUnlockingRequirement;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Recipe\StringIdMetaItemDescriptor;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Recipe\TagItemDescriptor;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Enum\ItemDescriptorType;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class RecipeSerializer implements ForkableInterface{
    use StatelessForkable;

    public function readIngredient(ByteBufferReader $in) : RecipeIngredient{
        $type = ItemDescriptorType::safe(Byte::readUnsigned($in));
        $descriptor = $this->readDescriptor($in, $type);
        $count = VarInt::readSignedInt($in);
        return new RecipeIngredient($descriptor, $count);
    }

    public function writeIngredient(ByteBufferWriter $out, RecipeIngredient $ingredient) : void{
        if($ingredient->descriptor === null){
            Byte::writeUnsigned($out, 0);
        }else{
            $type = $ingredient->descriptor::ID;
            Byte::writeUnsigned($out, $type->value);
            $this->writeDescriptor($out, $ingredient->descriptor);
        }
        VarInt::writeSignedInt($out, $ingredient->count);
    }

    public function readDescriptor(ByteBufferReader $in, ItemDescriptorType $type) : ?ItemDescriptor{
        return match($type){
            ItemDescriptorType::INT_ID_META => new IntIdMetaItemDescriptor(
                LE::readSignedShort($in),
                LE::readSignedShort($in)
            ),
            ItemDescriptorType::MOLANG => new MolangItemDescriptor(
                CodecHelper::readString($in),
                Byte::readUnsigned($in)
            ),
            ItemDescriptorType::TAG => new TagItemDescriptor(CodecHelper::readString($in)),
            ItemDescriptorType::STRING_ID_META => new StringIdMetaItemDescriptor(
                CodecHelper::readString($in),
                LE::readUnsignedShort($in)
            ),
            ItemDescriptorType::COMPLEX_ALIAS => new ComplexAliasItemDescriptor(CodecHelper::readString($in)),
            default => null
        };
    }

    public function writeDescriptor(ByteBufferWriter $out, ItemDescriptor $descriptor) : void{
        match($descriptor::ID){
            ItemDescriptorType::INT_ID_META => (function() use ($out, $descriptor){
                assert($descriptor instanceof IntIdMetaItemDescriptor);
                LE::writeSignedShort($out, $descriptor->id);
                LE::writeSignedShort($out, $descriptor->meta);
            })(),
            ItemDescriptorType::MOLANG => (function() use ($out, $descriptor){
                assert($descriptor instanceof MolangItemDescriptor);
                CodecHelper::writeString($out, $descriptor->molangExpression);
                Byte::writeUnsigned($out, $descriptor->molangVersion);
            })(),
            ItemDescriptorType::TAG => (function() use ($out, $descriptor){
                assert($descriptor instanceof TagItemDescriptor);
                CodecHelper::writeString($out, $descriptor->tag);
            })(),
            ItemDescriptorType::STRING_ID_META => (function() use ($out, $descriptor){
                assert($descriptor instanceof StringIdMetaItemDescriptor);
                CodecHelper::writeString($out, $descriptor->id);
                LE::writeUnsignedShort($out, $descriptor->meta);
            })(),
            ItemDescriptorType::COMPLEX_ALIAS => (function() use ($out, $descriptor){
                assert($descriptor instanceof ComplexAliasItemDescriptor);
                CodecHelper::writeString($out, $descriptor->alias);
            })(),
            default => throw new \InvalidArgumentException("Unknown descriptor type")
        };
    }

    public function readUnlockingRequirement(ByteBufferReader $in) : RecipeUnlockingRequirement{
        $unlockingContext = CodecHelper::readBool($in);
        $ingredients = null;
        if(!$unlockingContext){
            $ingredients = CodecHelper::readList($in, fn($in) => $this->readIngredient($in));
        }
        return new RecipeUnlockingRequirement($ingredients);
    }

    public function writeUnlockingRequirement(ByteBufferWriter $out, RecipeUnlockingRequirement $req) : void{
        CodecHelper::writeBool($out, $req->unlockingIngredients === null);
        if($req->unlockingIngredients !== null){
            CodecHelper::writeList($out, $req->unlockingIngredients, fn($out, $i) => $this->writeIngredient($out, $i));
        }
    }

    public function readPotionTypeRecipe(ByteBufferReader $in) : PotionTypeRecipe{
        return new PotionTypeRecipe(
            VarInt::readSignedInt($in),
            VarInt::readSignedInt($in),
            VarInt::readSignedInt($in),
            VarInt::readSignedInt($in),
            VarInt::readSignedInt($in),
            VarInt::readSignedInt($in)
        );
    }

    public function writePotionTypeRecipe(ByteBufferWriter $out, PotionTypeRecipe $r) : void{
        VarInt::writeSignedInt($out, $r->inputItemId);
        VarInt::writeSignedInt($out, $r->inputItemMeta);
        VarInt::writeSignedInt($out, $r->ingredientItemId);
        VarInt::writeSignedInt($out, $r->ingredientItemMeta);
        VarInt::writeSignedInt($out, $r->outputItemId);
        VarInt::writeSignedInt($out, $r->outputItemMeta);
    }

    public function readPotionContainerChangeRecipe(ByteBufferReader $in) : PotionContainerChangeRecipe{
        return new PotionContainerChangeRecipe(
            VarInt::readSignedInt($in),
            VarInt::readSignedInt($in),
            VarInt::readSignedInt($in)
        );
    }

    public function writePotionContainerChangeRecipe(ByteBufferWriter $out, PotionContainerChangeRecipe $r) : void{
        VarInt::writeSignedInt($out, $r->inputItemId);
        VarInt::writeSignedInt($out, $r->ingredientItemId);
        VarInt::writeSignedInt($out, $r->outputItemId);
    }

    public function readMaterialReducerRecipe(ByteBufferReader $in) : MaterialReducerRecipe{
        $inputIdAndData = VarInt::readSignedInt($in);
        $inputId = $inputIdAndData >> 16;
        $inputMeta = $inputIdAndData & 0x7fff;
        $outputs = CodecHelper::readList($in, fn($in) => new MaterialReducerRecipeOutput(
            VarInt::readSignedInt($in),
            VarInt::readSignedInt($in)
        ));
        return new MaterialReducerRecipe($inputId, $inputMeta, $outputs);
    }

    public function writeMaterialReducerRecipe(ByteBufferWriter $out, MaterialReducerRecipe $r) : void{
        VarInt::writeSignedInt($out, ($r->inputItemId << 16) | $r->inputItemMeta);
        CodecHelper::writeList($out, $r->outputs, fn($out, $o) => [
        	VarInt::writeSignedInt($out, $o->itemId),
        	VarInt::writeSignedInt($out, $o->count)
        ]);
    }
}