<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Common\Serializer\Biome;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Biome\ChunkGen\BiomeWeightedData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class BiomeWeightedDataSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : BiomeWeightedData{
        $biome = LE::readSignedShort($in);
        $weight = LE::readUnsignedInt($in);
        return new BiomeWeightedData($biome, $weight);
    }

    public function write(ByteBufferWriter $out, BiomeWeightedData $data) : void{
        LE::writeSignedShort($out, $data->biome);
        LE::writeUnsignedInt($out, $data->weight);
    }
}