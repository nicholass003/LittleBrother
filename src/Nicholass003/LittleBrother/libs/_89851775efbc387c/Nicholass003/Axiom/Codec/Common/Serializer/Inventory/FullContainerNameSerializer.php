<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Common\Serializer\Inventory;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\Type\Inventory\FullContainerName;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class FullContainerNameSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : FullContainerName{
        $containerId = Byte::readUnsigned($in);
        $dynamicId = CodecHelper::readOptional($in, LE::readUnsignedInt(...));
        return new FullContainerName($containerId, $dynamicId);
    }

    public function write(ByteBufferWriter $out, FullContainerName $container) : void{
        Byte::writeUnsigned($out, $container->containerId);
        CodecHelper::writeOptional($out, $container->dynamicId, LE::writeUnsignedInt(...));
    }
}