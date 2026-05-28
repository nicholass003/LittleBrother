<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Common\Serializer\SubChunk;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\SubChunk\SubChunkPacketHeightMapInfo;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class SubChunkPacketHeightMapInfoSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : SubChunkPacketHeightMapInfo{
        $heights = [];
        for($i = 0; $i < 256; ++$i){
            $heights[] = Byte::readSigned($in);
        }
        return new SubChunkPacketHeightMapInfo($heights);
    }

    public function write(ByteBufferWriter $out, SubChunkPacketHeightMapInfo $info) : void{
        for($i = 0; $i < 256; ++$i){
            Byte::writeSigned($out, $info->heights[$i]);
        }
    }
}