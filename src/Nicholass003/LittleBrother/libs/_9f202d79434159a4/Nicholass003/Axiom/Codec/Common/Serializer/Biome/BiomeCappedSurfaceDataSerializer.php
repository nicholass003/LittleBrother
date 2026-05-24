<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Common\Serializer\Biome;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Biome\ChunkGen\BiomeCappedSurfaceData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class BiomeCappedSurfaceDataSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : BiomeCappedSurfaceData{
        $floorBlocks = CodecHelper::readList($in, LE::readUnsignedInt(...));
        $ceilingBlocks = CodecHelper::readList($in, LE::readUnsignedInt(...));
        $seaBlock = CodecHelper::readOptional($in, LE::readUnsignedInt(...));
        $foundationBlock = CodecHelper::readOptional($in, LE::readUnsignedInt(...));
        $beachBlock = CodecHelper::readOptional($in, LE::readUnsignedInt(...));
        return new BiomeCappedSurfaceData($floorBlocks, $ceilingBlocks, $seaBlock, $foundationBlock, $beachBlock);
    }

    public function write(ByteBufferWriter $out, BiomeCappedSurfaceData $data) : void{
        CodecHelper::writeList($out, $data->floorBlocks, LE::writeUnsignedInt(...));
        CodecHelper::writeList($out, $data->ceilingBlocks, LE::writeUnsignedInt(...));
        CodecHelper::writeOptional($out, $data->seaBlock, LE::writeUnsignedInt(...));
        CodecHelper::writeOptional($out, $data->foundationBlock, LE::writeUnsignedInt(...));
        CodecHelper::writeOptional($out, $data->beachBlock, LE::writeUnsignedInt(...));
    }
}