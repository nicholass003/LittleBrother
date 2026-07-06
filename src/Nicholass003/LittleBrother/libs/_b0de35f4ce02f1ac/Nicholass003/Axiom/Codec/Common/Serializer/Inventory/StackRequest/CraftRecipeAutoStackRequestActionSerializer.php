<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Inventory\StackRequest\CraftRecipeAutoStackRequestAction;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Inventory\StackRequest\ItemStackRequestAction;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class CraftRecipeAutoStackRequestActionSerializer implements ItemStackRequestActionSerializer{
    use StatelessForkable;

    public function read(ByteBufferReader $in, CodecType $codec) : ItemStackRequestAction{
        $recipeId = VarInt::readUnsignedInt($in);
        $repetitions = Byte::readUnsigned($in);
        $repetitions2 = Byte::readUnsigned($in);
        $ingredients = CodecHelper::readList($in, fn($in) => $codec->recipe()->readIngredient($in));
        return new CraftRecipeAutoStackRequestAction($recipeId, $repetitions, $repetitions2, $ingredients);
    }

    public function write(ByteBufferWriter $out, ItemStackRequestAction $action, CodecType $codec) : void{
        assert($action instanceof CraftRecipeAutoStackRequestAction);
        VarInt::writeUnsignedInt($out, $action->recipeId);
        Byte::writeUnsigned($out, $action->repetitions);
        Byte::writeUnsigned($out, $action->repetitions2);
        CodecHelper::writeList($out, $action->ingredients, fn($out, $i) => $codec->recipe()->writeIngredient($out, $i));
    }
}