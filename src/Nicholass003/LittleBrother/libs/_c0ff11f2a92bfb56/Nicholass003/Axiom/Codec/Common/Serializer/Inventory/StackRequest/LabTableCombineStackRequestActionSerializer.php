<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Inventory\StackRequest\ItemStackRequestAction;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Inventory\StackRequest\LabTableCombineStackRequestAction;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class LabTableCombineStackRequestActionSerializer implements ItemStackRequestActionSerializer{
    use StatelessForkable;

    public function read(ByteBufferReader $in, CodecType $codec) : ItemStackRequestAction{
        return new LabTableCombineStackRequestAction();
    }

    public function write(ByteBufferWriter $out, ItemStackRequestAction $action, CodecType $codec) : void{
        // No additional data
    }
}