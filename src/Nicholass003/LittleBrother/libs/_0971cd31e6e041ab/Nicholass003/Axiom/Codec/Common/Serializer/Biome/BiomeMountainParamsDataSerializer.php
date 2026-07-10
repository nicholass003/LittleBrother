<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Common\Serializer\Biome;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Biome\ChunkGen\BiomeMountainParamsData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class BiomeMountainParamsDataSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : BiomeMountainParamsData{
        $steepBlock = LE::readUnsignedInt($in);
        $northSlopes = CodecHelper::readBool($in);
        $southSlopes = CodecHelper::readBool($in);
        $westSlopes = CodecHelper::readBool($in);
        $eastSlopes = CodecHelper::readBool($in);
        $topSlideEnabled = CodecHelper::readBool($in);
        return new BiomeMountainParamsData($steepBlock, $northSlopes, $southSlopes, $westSlopes, $eastSlopes, $topSlideEnabled);
    }

    public function write(ByteBufferWriter $out, BiomeMountainParamsData $data) : void{
        LE::writeUnsignedInt($out, $data->steepBlock);
        CodecHelper::writeBool($out, $data->northSlopes);
        CodecHelper::writeBool($out, $data->southSlopes);
        CodecHelper::writeBool($out, $data->westSlopes);
        CodecHelper::writeBool($out, $data->eastSlopes);
        CodecHelper::writeBool($out, $data->topSlideEnabled);
    }
}