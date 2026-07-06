<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\v859\Serializer\Biome;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\Type\Biome\BiomeReplacementData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;

class BiomeReplacementDataSerializer implements ForkableInterface{
    use StatelessForkable;

    public function read(ByteBufferReader $in) : BiomeReplacementData{
        $biome = LE::readSignedShort($in);
        $dimension = VarInt::readSignedInt($in);
        $targetBiomes = CodecHelper::readList($in, fn($in) => LE::readSignedShort($in));
        $amount = LE::readFloat($in);
        $replacementIndex = LE::readUnsignedInt($in);
        return new BiomeReplacementData($biome, $dimension, $targetBiomes, $amount, $replacementIndex);
    }

    public function write(ByteBufferWriter $out, BiomeReplacementData $data) : void{
        LE::writeSignedShort($out, $data->biome);
        VarInt::writeSignedInt($out, $data->dimension);
        CodecHelper::writeList($out, $data->targetBiomes, fn($out, $biome) => LE::writeSignedShort($out, $biome));
        LE::writeFloat($out, $data->amount);
        LE::writeUnsignedInt($out, $data->replacementIndex);
    }

    /**
     * @return list<BiomeReplacementData>
     */
    public function readList(ByteBufferReader $in) : array{
        return CodecHelper::readList($in, fn($in) => $this->read($in));
    }

    /**
     * @param list<BiomeReplacementData> $replacementsData
     */
    public function writeList(ByteBufferWriter $out, array $replacementsData) : void{
        CodecHelper::writeList($out, $replacementsData, fn($out, $data) => $this->write($out, $data));
    }
}