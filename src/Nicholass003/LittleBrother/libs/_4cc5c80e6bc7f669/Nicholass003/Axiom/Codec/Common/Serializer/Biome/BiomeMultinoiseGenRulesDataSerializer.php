<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Common\Serializer\Biome;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\Type\Biome\ChunkGen\BiomeMultinoiseGenRulesData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class BiomeMultinoiseGenRulesDataSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : BiomeMultinoiseGenRulesData{
        $temperature = LE::readFloat($in);
        $humidity = LE::readFloat($in);
        $altitude = LE::readFloat($in);
        $weirdness = LE::readFloat($in);
        $weight = LE::readFloat($in);
        return new BiomeMultinoiseGenRulesData($temperature, $humidity, $altitude, $weirdness, $weight);
    }

    public function write(ByteBufferWriter $out, BiomeMultinoiseGenRulesData $data) : void{
        LE::writeFloat($out, $data->temperature);
        LE::writeFloat($out, $data->humidity);
        LE::writeFloat($out, $data->altitude);
        LE::writeFloat($out, $data->weirdness);
        LE::writeFloat($out, $data->weight);
    }
}