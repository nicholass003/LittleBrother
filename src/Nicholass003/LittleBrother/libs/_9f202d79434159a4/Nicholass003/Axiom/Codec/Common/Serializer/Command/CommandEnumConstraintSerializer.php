<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Common\Serializer\Command;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\CodecHelper;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Support\ForkableInterface;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Codec\Support\StatelessForkable;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Command\CommandEnumConstraintRawData;
use pmmp\encoding\Byte;
use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;

class CommandEnumConstraintSerializer implements ForkableInterface{
    use StatelessForkable;

    /**
     * @return list<CommandEnumConstraintRawData>
     */
    public function readList(ByteBufferReader $in) : array{
        return CodecHelper::readList($in, function($in) : CommandEnumConstraintRawData{
            $affectedValueIndex = LE::readUnsignedInt($in);
            $enumIndex = LE::readUnsignedInt($in);
            $constraints = CodecHelper::readList($in, fn($in) => Byte::readUnsigned($in));
            return new CommandEnumConstraintRawData($affectedValueIndex, $enumIndex, $constraints);
        });
    }

    /**
     * @param list<CommandEnumConstraintRawData> $constraints
     */
    public function writeList(ByteBufferWriter $out, array $constraints) : void{
        CodecHelper::writeList($out, $constraints, function($out, $c) : void{
            LE::writeUnsignedInt($out, $c->affectedValueIndex);
            LE::writeUnsignedInt($out, $c->enumIndex);
            CodecHelper::writeList($out, $c->constraints, fn($out, $v) => Byte::writeUnsigned($out, $v));
        });
    }
}