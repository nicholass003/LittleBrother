<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Common\Serializer\Biome;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Biome\ChunkGen\BiomeCoordinateData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class BiomeCoordinateDataSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : BiomeCoordinateData{
        $minValueType = VarInt::readSignedInt($in);
        $minValue = LE::readSignedShort($in);
        $maxValueType = VarInt::readSignedInt($in);
        $maxValue = LE::readSignedShort($in);
        $gridOffset = LE::readUnsignedInt($in);
        $gridStepSize = LE::readUnsignedInt($in);
        $distribution = VarInt::readSignedInt($in);
        return new BiomeCoordinateData($minValueType, $minValue, $maxValueType, $maxValue, $gridOffset, $gridStepSize, $distribution);
    }

    public function write(ByteBufferWriter $out, BiomeCoordinateData $data) : void{
        VarInt::writeSignedInt($out, $data->minValueType);
        LE::writeSignedShort($out, $data->minValue);
        VarInt::writeSignedInt($out, $data->maxValueType);
        LE::writeSignedShort($out, $data->maxValue);
        LE::writeUnsignedInt($out, $data->gridOffset);
        LE::writeUnsignedInt($out, $data->gridStepSize);
        VarInt::writeSignedInt($out, $data->distribution);
    }
}