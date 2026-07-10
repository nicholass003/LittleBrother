<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Inventory\StackRequest\ItemStackRequestAction;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Inventory\StackRequest\MineBlockStackRequestAction;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\VarInt;

class MineBlockStackRequestActionSerializer implements ItemStackRequestActionSerializer{
    use StatelessForkable;

    public function read(ByteBufferReader $in, CodecType $codec) : ItemStackRequestAction{
        $hotbarSlot = VarInt::readSignedInt($in);
        $predictedDurability = VarInt::readSignedInt($in);
        $stackId = CodecHelper::readItemStackNetIdVariant($in);
        return new MineBlockStackRequestAction($hotbarSlot, $predictedDurability, $stackId);
    }

    public function write(ByteBufferWriter $out, ItemStackRequestAction $action, CodecType $codec) : void{
        assert($action instanceof MineBlockStackRequestAction);
        VarInt::writeSignedInt($out, $action->hotbarSlot);
        VarInt::writeSignedInt($out, $action->predictedDurability);
        CodecHelper::writeItemStackNetIdVariant($out, $action->stackId);
    }
}