<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Inventory\StackRequest\ItemStackRequestAction;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Inventory\StackRequest\LoomStackRequestAction;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class LoomStackRequestActionSerializer implements ItemStackRequestActionSerializer{
    use StatelessForkable;

    public function read(ByteBufferReader $in, CodecType $codec) : ItemStackRequestAction{
        $patternId = CodecHelper::readString($in);
        $repetitions = Byte::readUnsigned($in);
        return new LoomStackRequestAction($patternId, $repetitions);
    }

    public function write(ByteBufferWriter $out, ItemStackRequestAction $action, CodecType $codec) : void{
        assert($action instanceof LoomStackRequestAction);
        CodecHelper::writeString($out, $action->patternId);
        Byte::writeUnsigned($out, $action->repetitions);
    }
}