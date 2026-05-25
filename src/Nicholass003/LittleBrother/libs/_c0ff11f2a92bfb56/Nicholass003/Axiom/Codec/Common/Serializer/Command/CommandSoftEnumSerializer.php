<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Common\Serializer\Command;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\Type\Command\CommandSoftEnum;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;

class CommandSoftEnumSerializer implements ForkableInterface{
    use StatelessForkable;

    /**
     * @return list<CommandSoftEnum>
     */
    public function readList(ByteBufferReader $in) : array{
        return CodecHelper::readList($in, function($in) : CommandSoftEnum{
            $name = CodecHelper::readString($in);
            $values = CodecHelper::readList($in, fn($in) => CodecHelper::readString($in));
            return new CommandSoftEnum($name, $values);
        });
    }

    /**
     * @param list<CommandSoftEnum> $enums
     */
    public function writeList(ByteBufferWriter $out, array $enums) : void{
        CodecHelper::writeList($out, $enums, function($out, $enum) : void{
            CodecHelper::writeString($out, $enum->name);
            CodecHelper::writeList($out, $enum->values, fn($out, $v) => CodecHelper::writeString($out, $v));
        });
    }
}