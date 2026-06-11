<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Common\Serializer\Biome;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\Type\Biome\ChunkGen\BiomeMesaSurfaceData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class BiomeMesaSurfaceDataSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : BiomeMesaSurfaceData{
        $clayMaterial = LE::readUnsignedInt($in);
        $hardClayMaterial = LE::readUnsignedInt($in);
        $brycePillars = CodecHelper::readBool($in);
        $forest = CodecHelper::readBool($in);
        return new BiomeMesaSurfaceData($clayMaterial, $hardClayMaterial, $brycePillars, $forest);
    }

    public function write(ByteBufferWriter $out, BiomeMesaSurfaceData $data) : void{
        LE::writeUnsignedInt($out, $data->clayMaterial);
        LE::writeUnsignedInt($out, $data->hardClayMaterial);
        CodecHelper::writeBool($out, $data->brycePillars);
        CodecHelper::writeBool($out, $data->forest);
    }
}