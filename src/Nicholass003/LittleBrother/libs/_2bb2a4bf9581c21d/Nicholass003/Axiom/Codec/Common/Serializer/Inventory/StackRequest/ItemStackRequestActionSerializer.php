<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Common\Serializer\Inventory\StackRequest;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\CodecType;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\Type\Inventory\StackRequest\ItemStackRequestAction;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

interface ItemStackRequestActionSerializer extends ForkableInterface{

    public function read(ByteBufferReader $in, CodecType $codec) : ItemStackRequestAction;

    public function write(ByteBufferWriter $out, ItemStackRequestAction $action, CodecType $codec) : void;
}