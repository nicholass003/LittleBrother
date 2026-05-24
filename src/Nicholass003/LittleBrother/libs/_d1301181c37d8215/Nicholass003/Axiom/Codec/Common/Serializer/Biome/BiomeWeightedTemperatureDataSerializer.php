<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Common\Serializer\Biome;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Biome\ChunkGen\BiomeWeightedTemperatureData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class BiomeWeightedTemperatureDataSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : BiomeWeightedTemperatureData{
        $temperature = VarInt::readSignedInt($in);
        $weight = LE::readUnsignedInt($in);
        return new BiomeWeightedTemperatureData($temperature, $weight);
    }

    public function write(ByteBufferWriter $out, BiomeWeightedTemperatureData $data) : void{
        VarInt::writeSignedInt($out, $data->temperature);
        LE::writeUnsignedInt($out, $data->weight);
    }
}