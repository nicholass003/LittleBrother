<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Common\Serializer\Biome;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Biome\ChunkGen\BiomeSurfaceMaterialData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class BiomeSurfaceMaterialDataSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : BiomeSurfaceMaterialData{
        $topBlock = LE::readUnsignedInt($in);
        $midBlock = LE::readUnsignedInt($in);
        $seaFloorBlock = LE::readUnsignedInt($in);
        $foundationBlock = LE::readUnsignedInt($in);
        $seaBlock = LE::readUnsignedInt($in);
        $seaFloorDepth = LE::readSignedInt($in);
        return new BiomeSurfaceMaterialData($topBlock, $midBlock, $seaFloorBlock, $foundationBlock, $seaBlock, $seaFloorDepth);
    }

    public function write(ByteBufferWriter $out, BiomeSurfaceMaterialData $data) : void{
        LE::writeUnsignedInt($out, $data->topBlock);
        LE::writeUnsignedInt($out, $data->midBlock);
        LE::writeUnsignedInt($out, $data->seaFloorBlock);
        LE::writeUnsignedInt($out, $data->foundationBlock);
        LE::writeUnsignedInt($out, $data->seaBlock);
        LE::writeSignedInt($out, $data->seaFloorDepth);
    }
}