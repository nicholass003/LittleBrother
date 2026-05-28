<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Common\Serializer\Command;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Command\CommandEnumRawData;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class CommandEnumSerializer implements ForkableInterface{
    use StatelessForkable;

    /**
     * @return list<CommandEnumRawData>
     */
    public function readList(ByteBufferReader $in, int $valueListSize) : array{
        return CodecHelper::readList($in, function($in) use ($valueListSize) : CommandEnumRawData{
            $name = CodecHelper::readString($in);
            $indexes = CodecHelper::readList($in, function($in) use ($valueListSize) : int{
                return match(true){
                    $valueListSize < 256 => Byte::readUnsigned($in),
                    $valueListSize < 65536 => LE::readUnsignedShort($in),
                    default => LE::readUnsignedInt($in)
                };
            });
            return new CommandEnumRawData($name, $indexes);
        });
    }

    /**
     * @param list<CommandEnumRawData> $enums
     */
    public function writeList(ByteBufferWriter $out, array $enums, int $valueListSize) : void{
        CodecHelper::writeList($out, $enums, function($out, $enum) use ($valueListSize) : void{
            CodecHelper::writeString($out, $enum->name);
            CodecHelper::writeList($out, $enum->valueIndexes, function($out, int $index) use ($valueListSize) : void{
                match(true){
                    $valueListSize < 256 => Byte::writeUnsigned($out, $index),
                    $valueListSize < 65536 => LE::writeUnsignedShort($out, $index),
                    default => LE::writeUnsignedInt($out, $index)
                };
            });
        });
    }
}