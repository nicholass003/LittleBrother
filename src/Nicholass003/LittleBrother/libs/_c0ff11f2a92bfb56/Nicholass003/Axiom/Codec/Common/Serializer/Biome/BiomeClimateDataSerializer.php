<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Common\Serializer\Biome;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Biome\ChunkGen\BiomeClimateData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class BiomeClimateDataSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : BiomeClimateData{
        $temperature = LE::readFloat($in);
        $downfall = LE::readFloat($in);
        $snowAccumulationMin = LE::readFloat($in);
        $snowAccumulationMax = LE::readFloat($in);
        return new BiomeClimateData($temperature, $downfall, $snowAccumulationMin, $snowAccumulationMax);
    }

    public function write(ByteBufferWriter $out, BiomeClimateData $data) : void{
        LE::writeFloat($out, $data->temperature);
        LE::writeFloat($out, $data->downfall);
        LE::writeFloat($out, $data->snowAccumulationMin);
        LE::writeFloat($out, $data->snowAccumulationMax);
    }
}