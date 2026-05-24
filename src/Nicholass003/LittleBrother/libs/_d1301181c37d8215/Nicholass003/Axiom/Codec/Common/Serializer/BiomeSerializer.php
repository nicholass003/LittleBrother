<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Common\Serializer;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Common\Serializer\Biome\BiomeDefinitionDataSerializer;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Support\CloneWithProperty;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Support\Forkable;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\Type\Biome\BiomeDefinitionData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class BiomeSerializer implements ForkableInterface{
    use Forkable;
    use CloneWithProperty;

    public function __construct(
        private BiomeDefinitionDataSerializer $definitionDataSerializer
    ){}

    public function definitionData() : BiomeDefinitionDataSerializer{
        return $this->definitionDataSerializer;
    }

    public function withDefinitionData(BiomeDefinitionDataSerializer $serializer) : static{
        return $this->with('definitionDataSerializer', $serializer);
    }

    /**
     * @return list<BiomeDefinitionData>
     */
    public function readDefinitionDataList(ByteBufferReader $in) : array{
        return CodecHelper::readList(
            $in,
            fn($in) => $this->definitionDataSerializer->read($in)
        );
    }

    /**
     * @param list<BiomeDefinitionData> $list
     */
    public function writeDefinitionDataList(ByteBufferWriter $out, array $list) : void{
        CodecHelper::writeList(
            $out,
            $list,
            fn($out, $data) => $this->definitionDataSerializer->write($out, $data)
        );
    }

    /**
     * @return list<string>
     */
    public function readStrings(ByteBufferReader $in) : array{
        return CodecHelper::readList(
            $in,
            fn($in) => CodecHelper::readString($in)
        );
    }

    /**
     * @param list<string> $strings
     */
    public function writeStrings(ByteBufferWriter $out, array $strings) : void{
        CodecHelper::writeList(
            $out,
            $strings,
            fn($out, $value) => CodecHelper::writeString($out, $value)
        );
    }
}