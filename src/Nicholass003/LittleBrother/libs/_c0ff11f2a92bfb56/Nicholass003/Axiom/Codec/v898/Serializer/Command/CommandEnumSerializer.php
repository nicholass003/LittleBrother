<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\v898\Serializer\Command;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Common\Serializer\Command\CommandEnumSerializer as BaseCommandEnumSerializer;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Command\CommandEnumRawData;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class CommandEnumSerializer extends BaseCommandEnumSerializer{

    /**
     * @param int $valueListSize Deprecated since v898.
     * @return list<CommandEnumRawData>
     */
    public function readList(ByteBufferReader $in, int $valueListSize = 0) : array{
        return CodecHelper::readList($in, function($in) : CommandEnumRawData{
            $name = CodecHelper::readString($in);
            $indexes = CodecHelper::readList($in, fn($in) => LE::readUnsignedInt($in));
            return new CommandEnumRawData($name, $indexes);
        });
    }

    /**
     * @param list<CommandEnumRawData> $enums
     * @param int $valueListSize Deprecated since v898.
     */
    public function writeList(ByteBufferWriter $out, array $enums, int $valueListSize = 0) : void{
        CodecHelper::writeList($out, $enums, function($out, $enum) : void{
            CodecHelper::writeString($out, $enum->name);
            CodecHelper::writeList($out, $enum->valueIndexes, fn($out, $index) => LE::writeUnsignedInt($out, $index));
        });
    }
}