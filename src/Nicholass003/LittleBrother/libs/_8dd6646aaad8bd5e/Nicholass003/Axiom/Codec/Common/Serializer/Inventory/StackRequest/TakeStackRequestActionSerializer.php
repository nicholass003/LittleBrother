<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Inventory\StackRequest\ItemStackRequestAction;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\Type\Inventory\StackRequest\TakeStackRequestAction;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class TakeStackRequestActionSerializer implements ItemStackRequestActionSerializer{
    use StatelessForkable;

    public function read(ByteBufferReader $in, CodecType $codec) : ItemStackRequestAction{
        $count = Byte::readUnsigned($in);
        $source = $codec->inventory()->request()->readSlotInfo($in, $codec);
        $destination = $codec->inventory()->request()->readSlotInfo($in, $codec);
        return new TakeStackRequestAction($count, $source, $destination);
    }

    public function write(ByteBufferWriter $out, ItemStackRequestAction $action, CodecType $codec) : void{
        assert($action instanceof TakeStackRequestAction);
        Byte::writeUnsigned($out, $action->count);
        $codec->inventory()->request()->writeSlotInfo($out, $action->source, $codec);
        $codec->inventory()->request()->writeSlotInfo($out, $action->destination, $codec);
    }
}